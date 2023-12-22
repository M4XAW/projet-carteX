const express = require('express') // Importation du framework Express
const mariadb = require('mariadb') // Importation du module MariaDB
const bcrypt = require('bcrypt') // Importation du module Bcrypt 
const jwt = require('jsonwebtoken'); // Importation du module JsonWebToken
const axios = require('axios'); // Importation du module Axios

require('dotenv').config(); // Importation du module dotenv
const app = express() // Création de l'application Express
var cors = require('cors') // Importation du module Cors 

app.use(express.json()) 
app.use(cors()) 

const pool = mariadb.createPool({ // Création de la connexion à la base de données
    host: process.env.DB_HOST,
    database: process.env.DB_DTB,
    user: process.env.DB_USER,
    password: process.env.DB_PWD,
})

app.get('/api/cards', async (req, res) => { // Récupération de toutes les cartes
    let conn; // Déclaration de la variable de connexion
    try {
        conn = await pool.getConnection(); // Connexion à la base de données
        const rows = await conn.query("SELECT * FROM cards"); // Requête SQL pour récupérer toutes les cartes
        res.json(rows); // Renvoie des données au format JSON
    } catch (err) { // Gestion des erreurs
        console.error(err);
        res.status(500).send('Erreur lors de la récupération des données');
    } finally {
        if (conn) conn.release(); // Libération de la connexion
    }
});

app.get('/api/cards/user', async (req, res) => {
    let conn;
    try {
        const token = req.headers.authorization.split(' ')[1]; // Récupération du token
        const decoded = jwt.verify(token, process.env.JWT_SECRET); // Décodage du token
        const userId = decoded.userId; // Récupération de l'identifiant de l'utilisateur
        
        conn = await pool.getConnection();
        // Récupération des cartes de l'utilisateur
        const rows = await conn.query("SELECT c.* FROM cards c JOIN deck d ON c.id = d.card_id WHERE d.user_id = ?", [userId]);

        res.json(rows);
    } catch (err) {
        console.error('Erreur lors de la récupération des cartes: ', err.message);
        res.status(500).send('Erreur interne du serveur');
    } finally {
        if (conn) conn.release(); 
    }
});

app.get('/api/card/:id', async (req, res) => { // Récupération d'une carte par son id
    let conn;
    try {
        conn = await pool.getConnection();
        const rows = await conn.query("SELECT * FROM cards WHERE id = ?", [req.params.id]); // Requête SQL pour récupérer une carte
        res.json(rows[0] || {}); // renvoie le premier objet de la liste ou un objet vide
    } catch (err) {
        console.error(err);
        res.status(500).send('Erreur lors de la récupération des données');
    } finally {
        if (conn) conn.release();
    }
});

app.delete('/api/card/delete/:id', async (req, res) => { // Suppression d'une carte par son id
    let conn;
    try {
        conn = await pool.getConnection();
        const cardId = req.params.id; // Récupération de l'id de la carte

        // Supprimer d'abord toutes les références dans la table deck
        await conn.query("DELETE FROM deck WHERE card_id = ?", [cardId]);

        // Ensuite, supprimer la carte de la table cards
        await conn.query("DELETE FROM cards WHERE id = ?", [cardId]);

        res.status(204).send();
    } catch (err) {
        console.error(err);
        res.status(500).send('Erreur lors de la suppression des données');
    } finally {
        if (conn) conn.release();
    }
});

app.post('/api/card/create', async (req, res) => {
    let conn;
    try {
        conn = await pool.getConnection();
        await conn.beginTransaction(); // Début de la transaction

        const token = req.headers.authorization.split(' ')[1];
        const decoded = jwt.verify(token, process.env.JWT_SECRET);
        const userId = decoded.userId;

        // Vérifier si la carte existe déjà dans la table 'cards'
        const existingCard = await conn.query("SELECT id FROM cards WHERE name = ?", [req.body.name]);

        if (existingCard.length === 0) {
            // Insérer la carte dans la table 'cards' si elle n'existe pas
            const insertCardSql = "INSERT INTO cards (name, type, description, race, archetype, set_name, set_rarity, set_price, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            const cardValues = [
                req.body.name,
                req.body.type,
                req.body.description,
                req.body.race,
                req.body.archetype,
                req.body.set_name,
                req.body.set_rarity,
                req.body.set_price,
                req.body.image_url
            ];

            const result = await conn.query(insertCardSql, cardValues);
            const insertCardId = result.insertId.toString();

            // Insertion dans la table 'deck'
            const insertDeckSql = "INSERT INTO deck (user_id, card_id) VALUES (?, ?)";
            const deckValues = [userId, insertCardId];

            await conn.query(insertDeckSql, deckValues);

            await conn.commit();
            res.json({ success: true, cardId: insertCardId, message: "Carte créée avec succès" });
        } else {
            res.json({ success: false, message: "Une carte avec ce nom existe déjà" });
        }
    } catch (err) {
        await conn.rollback();
        console.error(err);
        res.status(500).json({ success: false, message: "Erreur lors de la création des données" });
    } finally {
        if (conn) conn.release();
    }
});

app.post('/api/login', async (req, res) => { // Connexion d'un utilisateur
    let conn;
    try {
        conn = await pool.getConnection();
        const rows = await conn.query("SELECT * FROM users WHERE email = ?", [req.body.email]); // Requête SQL pour récupérer un utilisateur par son email
        if (rows.length === 0) { // Si l'utilisateur n'existe pas
            res.status(404).send('Utilisateur non trouvé');
        } else {
            const match = await bcrypt.compare(req.body.password, rows[0].password); // Comparaison du mot de passe avec celui de la base de données
            if (match) {
                // Création du token avec username
                const token = jwt.sign(
                    { 
                        userId: rows[0].id, // Utilisation de l'identifiant de l'utilisateur
                        username: rows[0].username // Utilisation du nom d'utilisateur
                    },
                    process.env.JWT_SECRET, // Utilisation de la clé secrète
                    { expiresIn: '1h' } // Durée de validité du token
                );

                res.json({ token: token, user: { id: rows[0].id, username: rows[0].username } }); // Envoi du token et de l'utilisateur

            } else {
                res.status(401).send('Mot de passe incorrect');
            }
        }
    } catch (err) {
        console.error("Erreur lors de la connexion", err);
        res.status(500).send('Erreur de connexion');
    } finally {
        if (conn) conn.release(); // Libération de la connexion
    }
});

app.post('/api/signup', async (req, res) => { 
    const { username, email, password } = req.body;

    if (!username || !email || !password) {
        return res.status(400).send('Données manquantes');
    }

    let conn;
    try {
        conn = await pool.getConnection();
    
        // Vérifier si l'email existe déjà
        const existingUser = await conn.query('SELECT email FROM users WHERE email = ?', [email]);
        if (existingUser.length > 0) {
            return res.status(409).send('Un utilisateur avec cet email existe déjà');
        }
  
        // Hachage du mot de passe
        const hashedPassword = await bcrypt.hash(password, 10);
  
        // Insertion du nouvel utilisateur
        const result = await conn.query('INSERT INTO users (username, email, password) VALUES (?, ?, ?)', [username, email, hashedPassword]);
    
        // Création du token avec username
        const token = jwt.sign(
            { 
                userId: result.insertId.toString(), // Utilisation de l'identifiant de l'utilisateur nouvellement créé
                username: username
            },
            process.env.JWT_SECRET,
            { expiresIn: '1h' }
        );

        res.status(201).json({
            message: 'Utilisateur créé avec succès',
            token: token
        });
    } catch (error) {
        console.error('Erreur lors de la création de l\'utilisateur', error);
        res.status(500).send('Erreur serveur');
    } finally {
        if (conn) conn.release();
    }
});

app.put('/api/card/update/:id', async (req, res) => { // Modification d'une carte par son id
    let conn;
    try {
        const token = req.headers.authorization.split(' ')[1]; // Récupération du token
        const decoded = jwt.verify(token, process.env.JWT_SECRET); // Décodage du token
        const userId = decoded.userId; // Récupération de l'identifiant de l'utilisateur dans le token
        const cardId = req.params.id; // Récupération de l'id de la carte dans l'URL

        conn = await pool.getConnection();
        await conn.beginTransaction();

        // Vérifier si l'utilisateur possède la carte
        const userOwnsCard = await conn.query("SELECT id FROM deck WHERE user_id = ? AND card_id = ?", [userId, cardId]);

        if (userOwnsCard.length === 0) { // Si l'utilisateur ne possède pas la carte
            return res.status(403).json({ success: false, message: "Vous n'avez pas la permission de modifier cette carte." });
        }

        // Mettre à jour la carte
        const updateCardSql = "UPDATE cards SET name = ?, type = ?, description = ?, race = ?, archetype = ?, set_name = ?, set_rarity = ?, set_price = ?, image_url = ? WHERE id = ?";
        const cardValues = [
            req.body.name,
            req.body.type,
            req.body.description,
            req.body.race,
            req.body.archetype,
            req.body.set_name,
            req.body.set_rarity,
            req.body.set_price,
            req.body.image_url,
            cardId
        ];

        await conn.query(updateCardSql, cardValues); // Exécution de la requête SQL

        await conn.commit(); // Validation de la transaction
        res.json({ success: true, message: "Carte modifiée avec succès" }); 
    } catch (err) {
        await conn.rollback(); // Annulation de la transaction
        console.error(err); 
        res.status(500).send('Erreur lors de la modification des données');
    } finally {
        if (conn) {
            conn.release(); // Libération de la connexion
        }
    }
});

app.listen(8000, () => { // Lancement du serveur sur le port 8000
    console.log("Started on PORT 8000")
})