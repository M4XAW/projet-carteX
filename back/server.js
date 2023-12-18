const express = require('express')
const mariadb = require('mariadb')
const bcrypt = require('bcrypt')
// const jwt = require('jsonwebtoken');

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

app.post('/api/login', async (req, res) => {
    let conn;
    try {
        conn = await pool.getConnection();
        const rows = await conn.query("SELECT * FROM users WHERE Email = ?", [req.body.email]);
        if (rows.length == 0) {
            res.status(404).send('Utilisateur non trouvé');
        } else {
            const match = await bcrypt.compare(req.body.password, rows[0].password);
            if (match) {
                res.json(rows[0]);
            } else {
                res.status(401).send('Mot de passe incorrect');
            }
        }
    } catch (err) {
        console.error(err);
        res.status(500).send('Erreur lors de la récupération des données');
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
      const conn = await pool.getConnection();
  
      // Vérifier si l'email existe déjà
      const existingUser = await conn.query('SELECT email FROM users WHERE email = ?', [email]);
      if (existingUser.length > 0) {
        conn.end();
        return res.status(409).send('Un utilisateur avec cet email existe déjà');
      }
  
      // Hachage du mot de passe
      const hashedPassword = await bcrypt.hash(password, 10);
  
      // Insertion du nouvel utilisateur
      await conn.query('INSERT INTO users (username, email, password) VALUES (?, ?, ?)', [username, email, hashedPassword]);
      
      conn.end();
      res.status(201).send('Utilisateur créé avec succès');
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