const express = require('express');
const router = express.Router();

const representantesController = require('../controllers/representantesController');
const alumnoController = require('../controllers/alumnosController');
const loginController = require('../controllers/loginController');
const matriculaController = require('../controllers/matriculasController');
const descuentoController = require('../controllers/descuentosController');

//alumnos
router.get('/alumno', alumnoController.list_all);
router.get('/alumno/:cedula', alumnoController.list_cedula);
router.post('/alumno', alumnoController.save);
router.put('/alumno/:cedula', alumnoController.update);
//representantes
router.get('/representante', representantesController.list_all);
router.post('/representante', representantesController.save);
router.put('/representante/:cedula', representantesController.update);
//Login
router.post('/login', loginController.list);
//matricula
router.get('/matricula', matriculaController.list_all);
router.post('/matricula', matriculaController.save);
router.put('/matricula/:id_matricula', matriculaController.update);
//cursos
//facturas
//nota
//recibo
//descuento
router.get('/descuento', descuentoController.list_all);
router.post('/descuento', descuentoController.save);
router.put('/descuento/:id_descuento', descuentoController.update);
//metodos


module.exports = router;