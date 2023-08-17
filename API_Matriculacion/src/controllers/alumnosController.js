const mysqlConnection = require("../database");
const controller = {};

controller.list_all = (req, res) => {

  const query = `SELECT a.id_alumno, r.id_representante, d.id_descuento,
  a.nombres, a.apellidos, a.cedula, a.direccion, a.telefono, a.email, a.genero, a.f_nacimiento,
  r.cedula AS 'cedula_representante', r.nombres, r.apellidos,
  d.id_descuento, d.nombre AS 'tipo_matricula'
  FROM alumnos AS a 
  INNER JOIN representantes AS r ON a.id_representante = r.id_representante
  INNER JOIN descuento AS d ON a.id_descuento = d.id_descuento`;
  mysqlConnection.query(query, (
    err,
    rows
  ) => {
    if (!err) {
      res.json({
        status_code: 202,
        message: "Listado",
        tipos: rows,
        //authData
      });
      console.log(rows);
    } else {
      res.json({
        code: 500,
        error: true,
        message: err,
      });
    }
  });
};

controller.list_cedula = (req, res) => {
  const { cedula } = req.params;
  const query = `SELECT r.id_representante, r.cedula AS 'cedula_representante', r.nombres, r.apellidos, r.direccion, r.telefono, r.email
  FROM alumnos AS a 
  INNER JOIN representantes AS r ON a.id_representante = r.id_representante 
  WHERE r.cedula = '${cedula}'`;
  mysqlConnection.query(query, [cedula], (
    err,
    rows
  ) => {
    if (!err) {
      res.json({
        status_code: 202,
        message: "Listado",
        tipos: rows,
        //authData
      });
      console.log(rows);
    } else {
      res.json({
        code: 500,
        error: true,
        message: err,
      });
    }
  });
};

//Insert
controller.save = (req, res) => {
  const query = `INSERT INTO alumnos(nombres, apellidos, cedula, direccion, telefono, email, genero, f_nacimiento)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)`;
  mysqlConnection.query(query, (err) => {
    if (!err) {
      res.json({
        error: false,
        message: "Saved",
      });
    } else {
      res.json({
        error: true,
        message: err,
      });
      console.log(err);
    }
  });
};

//Update
controller.update = (req, res) => {
  const { apellidos } = req.body;
  const { cedula, cedula_representante } = req.params;
  const query = `UPDATE alumnos SET nombres = '${nombres}', apellidos = '${apellidos}', cedula = '${cedula}', 
    direccion = '${direccion}', telefono = '${telefono}', email = '${email}', genero = '${genero}', 
    f_nacimiento = '${f_nacimiento}', r.cedula AS 'cedula_representante' = '${cedula_representante}',
    INNER JOIN representantes AS r ON a.id_representante = r.id_representante 
    WHERE cedula = '${cedula}'`;

  mysqlConnection.query(query, [apellidos, cedula], (err) => {
    if (!err) {
      res.json({
        error: false,
        message: "Actualizado",
      });
    } else {
      res.json({
        error: true,
        message: err,
      });
    }
  });
};

//Delete
//   controller.delete = (req, res) => {
//     const { id_tipo } = req.params;
//     const query = `DELETE FROM tipo WHERE id_tipo = '${id_tipo}'`;
// mysqlConnection.query(query, [id_tipo], (err) => {
//       if (!err) {
//         res.json({
//           error: false,
//           message: "Deleted",
//         });
//       } else {
//         res.json({
//           error: true,
//           message: err,
//         });
//       }
//     });
//   };

module.exports = controller;