const jwt = require('jsonwebtoken');
const crypto = require('crypto');
const mysqlConnection = require("../database");

const SECRET_KEY = 'mySecretKey';  // ¡Mantener en secreto!
const ENCRYPTION_KEY = '01234567890123456789012345678901'; // Llave de 256 bits
const IV_LENGTH = 16; // Para AES, es siempre 16

const controller = {};

// Funciones para encriptar y desencriptar
function encrypt(text) {
    let iv = crypto.randomBytes(IV_LENGTH);
    let cipher = crypto.createCipheriv('aes-256-cbc', Buffer.from(ENCRYPTION_KEY), iv);
    let encrypted = cipher.update(text);

    encrypted = Buffer.concat([encrypted, cipher.final()]);
    return iv.toString('hex') + ':' + encrypted.toString('hex');
}

controller.list = (req, res) => {
    const { username, password} = req.body;
    const query = `SELECT usuario, password from login WHERE usuario = ? AND password = ? `;
    mysqlConnection.query(query, [username, password], (err, rows) => {
        if (!err && rows.length > 0) {
            const token = jwt.sign({ username: username , password: password}, SECRET_KEY, {
                expiresIn: '1h' // El token expira en 1 hora
            });

            const encryptedToken = encrypt(token);

            res.json({
                status_code: 202,
                message: "Listado",
                usuario: rows,
                token: encryptedToken
            });
        } else if (!err && rows.length === 0) {
            res.status(401).send('Credenciales incorrectas');
        } else {
            res.json({
                code: 500,
                error: true,
                message: err
            });
        }
    });
};

controller.listRol = (req, res) => {
    const { usuario, psw, rol } = req.body;
    const query = `SELECT * from rol where id <> '1';`;
    mysqlConnection.query(query, [usuario, psw, rol], (err, rows) => {
        if (!err) {
            res.json({
                status_code: 202,
                message: "Listado",
                rol: rows,
            });
        } else {
            res.json({
                code: 500,
                error: true,
                message: err,
            });
        }
    });
};

module.exports = controller;
