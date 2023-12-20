const express = require('express')
const mariadb = require('mariadb')
const bcrypt = require('bcrypt')
const jwt = require('jsonwebtoken');

require('dotenv').config();
const app = express()
var cors = require('cors')
app.use(express.json())
app.use(cors())
const pool = mariadb.createPool({
    host: process.env.DB_HOST,
    database: process.env.DB_DTB,
    user: process.env.DB_USER,
    password: process.env.DB_PWD,
})
app.get('/api/cards', async (req, res) => {
    let conn;
    try {
        conn = await pool.getConnection();
        const rows = await conn.query("SELECT * FROM cards");
        res.json(rows);
    } catch (err) {
        console.error(err);
        res.status(500).send('Erreur lors de la récupération des données');
    } finally {
        if (conn) conn.release();
    }
});
app.get('/api/card/:id', async (req, res) => {
    let conn;
    try {
        conn = await pool.getConnection();
        const rows = await conn.query("SELECT * FROM cards WHERE id = ?", [req.params.id]);
        res.json(rows[0] || {}); // renvoie le premier objet de la liste ou un objet vide
    } catch (err) {
        console.error(err);
        res.status(500).send('Erreur lors de la récupération des données');
    } finally {
        if (conn) conn.release();
    }
});

app.delete('/api/card/:id', async (req, res) => {
    let conn;
    try {
        conn = await pool.getConnection();
        await conn.query("DELETE FROM cards WHERE id = ?", [req.params.id]);
        res.status(204).send();
    } catch (err) {
        console.error(err);
        res.status(500).send('Erreur lors de la suppression des données');
    } finally {
        if (conn) conn.release();
    }
});
app.post('/api/card', async (req, res) => {
    let conn;
    try {
        conn = await pool.getConnection();
        const rows = await conn.query(
            "INSERT INTO cards (name, type, frame_type, description, race, archetype, set_name, set_code, set_rarity, set_rarity_code, set_price, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [
                req.body.name,
                req.body.type,
                req.body.frame_type,
                req.body.description,
                req.body.race,
                req.body.archetype,
                req.body.set_name,
                req.body.set_code,
                req.body.set_rarity,
                req.body.set_rarity_code,
                req.body.set_price,
                req.body.image_url
            ]
        );

        res.json({ id: rows.insertId, ...req.body });
    } catch (err) {
        console.error(err);
        res.status(500).send('Erreur lors de la création des données');
    } finally {
        if (conn) conn.release();
    }
});

app.post('/api/login', async (req, res) => {
    let conn;
    try {
        conn = await pool.getConnection();
        const rows = await conn.query("SELECT * FROM users WHERE email = ?", [req.body.email]);
        if (rows.length === 0) {
            res.status(404).send('Utilisateur non trouvé');
        } else {
            const match = await bcrypt.compare(req.body.password, rows[0].password);
            if (match) {
                // Création du token avec username
                const token = jwt.sign(
                    { 
                        userId: rows[0].id,
                        username: rows[0].username
                    },
                    process.env.JWT_SECRET,
                    { expiresIn: '1h' }
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
        if (conn) conn.release();
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
                userId: result.insertId, // Utilisation de l'identifiant de l'utilisateur nouvellement créé
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

app.listen(8000, () => {
    console.log("Started on PORT 8000")
})