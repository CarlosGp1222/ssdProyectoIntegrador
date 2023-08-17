const jwt = require('jsonwebtoken');
const crypto = require('crypto');
const SECRET_KEY = 'mySecretKey';  // ¡Mantener en secreto!
const ENCRYPTION_KEY = '01234567890123456789012345678901'; // Clave para AES-256 (32 bytes)
const IV_LENGTH = 16; 

function decrypt(text) {
    let parts = text.split(':');
    let iv = Buffer.from(parts.shift(), 'hex');
    let encryptedText = Buffer.from(parts.join(':'), 'hex');
    let decipher = crypto.createDecipheriv('aes-256-cbc', Buffer.from(ENCRYPTION_KEY), iv);
    let decrypted = decipher.update(encryptedText);
    decrypted = Buffer.concat([decrypted, decipher.final()]);
    return decrypted.toString();
}

function verifyToken(req, res, next) {
    const bearerHeader = req.headers['authorization'];
    
    if (typeof bearerHeader !== 'undefined') {
        const bearer = bearerHeader.split(' ');
        const bearerToken = bearer[1];

        // Desencriptar el token
        try {
            const decryptedToken = decrypt(bearerToken);
            
            jwt.verify(decryptedToken, SECRET_KEY, (err, authData) => {
                if(err) {
                    res.status(403).send('Token inválido'); 
                } else {
                    req.authData = authData;
                    next();
                }
            });
        } catch (error) {
            res.status(403).send('Error al desencriptar el token');
        }
        
    } else {
        res.status(403).send('Token no proporcionado');
    }
}
module.exports = verifyToken;