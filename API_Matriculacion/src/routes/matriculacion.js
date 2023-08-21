const express = require('express');
const router = express.Router();

const representantesController = require('../controllers/representantesController');
const alumnoController = require('../controllers/alumnosController');
const loginController = require('../controllers/loginController');
const matriculaController = require('../controllers/matriculaController');
const descuentoController = require('../controllers/descuentosController');
const cursosController = require('../controllers/cursosController');
const metodosController = require('../controllers/metodosController');
const facturaController = require('../controllers/facturaController');

// Importar el middleware
const verifyToken = require('../middlewares/authMiddleware');

//alumnos
router.get('/alumno', verifyToken, alumnoController.list_all); // Protegido
router.get('/alumnos', verifyToken, alumnoController.list); // Protegido
router.get('/alumno/:cedula', verifyToken, alumnoController.list_cedula); // Protegido
router.post('/alumno', verifyToken, alumnoController.save); // Protegido
router.put('/alumno/:cedula', verifyToken, alumnoController.update); // Protegido
//representantes
router.get('/representante', verifyToken, representantesController.list_all); // Protegido
router.get('/representante/:cedula', verifyToken, representantesController.list_one); // Protegido
router.post('/representante', verifyToken, representantesController.save); // Protegido
router.put('/representante/:cedula', verifyToken, representantesController.update); // Protegido
//Login - No se protege porque aquí es donde obtienen el token.
router.post('/login', loginController.list);
//matricula
router.get('/matricula', verifyToken, matriculaController.list_all); // Protegido
router.post('/matricula', verifyToken, matriculaController.save); // Protegido
router.put('/matricula/:id_matricula', verifyToken, matriculaController.update); // Protegido
//descuento
router.get('/descuento', verifyToken, descuentoController.list_all); // Protegido
router.post('/descuento', verifyToken, descuentoController.save); // Protegido
router.put('/descuento/:id_descuento', verifyToken, descuentoController.update); // Protegido
//cursos
router.post('/curso', verifyToken, cursosController.save);
router.get('/cursos', verifyToken, cursosController.list);
//facturas
router.get('/facturas', facturaController.list_all);
router.post('/facturas', facturaController.save);
//router.put('/facturas/:n_documento', facturasController.update);
//nota
//recibo
//descuento
router.get('/descuento', descuentoController.list_all);
router.post('/descuento', descuentoController.save);
router.put('/descuento/:id_descuento', descuentoController.update);
//metodos
router.get('/metodos', metodosController.list);
router.post('/metodos', metodosController.save);
router.put('/metodos/:id_metodo', metodosController.update);

module.exports = router;
