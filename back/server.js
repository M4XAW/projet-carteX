const express = require('express')
const mariadb = require('mariadb')
const bcrypt = require('bcrypt')
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
        const rows = await conn.query("SELECT * FROM Cartes"); // Assurez-vous que cette requête correspond à la structure de votre table
        res.json(rows);
    } catch (err) {
        console.error(err);
        res.status(500).send('Erreur lors de la récupération des données');
    } finally {
        if (conn) conn.release();
    }
});

app.listen(8000, () => {
    console.log("Serveur a l'ecoute");
})