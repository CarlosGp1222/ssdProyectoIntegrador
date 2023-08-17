const express = require('express');
const router = express.Router();

const representantesController = require('../controllers/representantesController');
const alumnoController = require('../controllers/alumnosController');

//alumnos
router.get('/alumno', alumnoController.list_all);
router.get('/alumno/:cedula', alumnoController.list_cedula);
router.post('/alumno', alumnoController.save);
router.put('/:id_representante', alumnoController.update);

//representantes
router.get('/representante', representantesController.list_all);
router.post('/representante', representantesController.save);
router.put('/representante/:cedula', representantesController.update);

//matricula
//cursos
//facturas
//nota
//recibo
//descuento
//metodos


module.exports = router;