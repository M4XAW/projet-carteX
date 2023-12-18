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

