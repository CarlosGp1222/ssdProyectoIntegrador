const e = require("express");
const mysqlConnection = require("../database");
const controller = {};


controller.list = (req, res) => {

  const query = `SELECT * FROM alumnos`;
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
  const query = `SELECT a.nombres, a.apellidos, a.cedula, a.direccion, a.telefono, a.email, a.genero, a.f_nacimiento,
  r.cedula AS 'cedula_representante', d.nombre AS 'tipo_matricula'
  FROM alumnos AS a 
  INNER JOIN representantes AS r ON a.id_representante = r.id_representante 
  INNER JOIN descuento AS d ON a.id_descuento = d.id_descuento
  WHERE a.cedula = '${cedula}'`;
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
controller.save = async (req, res) => {
  const { nombres, apellidos, cedula, direccion, telefono, email, genero, f_nacimiento, cedulaRepre, tipo_matriculacion } = req.body;
  const queryRepresentante = "SELECT id_representante FROM representantes WHERE cedula = ? LIMIT 1";
  const queryDescuento = "SELECT id_descuento FROM descuento WHERE id_descuento = ? LIMIT 1";

  mysqlConnection.query(queryRepresentante, [cedulaRepre], (err, results) => {
    if (err) {
      return res.json({ error: true, message: err });
    }

    const idRepresentante = results[0]?.id_representante;

    if (!idRepresentante) {
      return res.json({ error: true, message: "No se encontró el representante con la cédula proporcionada" });
    }

    const queryAlumnos = "SELECT id_alumno FROM alumnos WHERE cedula = ? LIMIT 1";
    mysqlConnection.query(queryAlumnos, [cedula], (err, results) => {
      if (err) {
        return res.json({ error: true, message: err });
      }

      if (results.length > 0) {
        return res.json({ error: true, message: "La cédula ya está en uso por otro alumno" });
      }

      mysqlConnection.query(queryDescuento, [tipo_matriculacion], (err, results) => {
        if (err) {
          return res.json({ error: true, message: err });
        }

        const idDescuento = results[0]?.id_descuento;

        if (!idDescuento) {
          return res.json({ error: true, message: "No se encontró el tipo de matriculación proporcionado" });
        }

        const insertQuery = `
          INSERT INTO alumnos(id_representante, id_descuento, nombres, apellidos, cedula, direccion, telefono, email, genero, f_nacimiento)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        `;

        mysqlConnection.query(insertQuery, [idRepresentante, idDescuento, nombres, apellidos, cedula, direccion, telefono, email, genero, f_nacimiento], (err) => {
          if (!err) {
            return res.json({ error: false, message: "Saved" });
          } else {
            return res.json({ error: true, message: err });
          }
        });
      });
    });
  });
};


//Update
controller.update = (req, res) => {
  const { nombres, apellidos, direccion, telefono, email, genero, f_nacimiento, cedula_representante } = req.body;
  const { cedula } = req.params;
  const query = `UPDATE alumnos SET nombres = '${nombres}', apellidos = '${apellidos}', cedula = '${cedula}', 
    direccion = '${direccion}', telefono = '${telefono}', email = '${email}', genero = '${genero}', 
    f_nacimiento = '${f_nacimiento}', r.cedula AS 'cedula_representante' = '${cedula_representante}',
    INNER JOIN representantes AS r ON a.id_representante = r.id_representante 
    WHERE cedula = '${cedula}'`;

  mysqlConnection.query(query, [apellidos, cedula], (err) => {
    if(!cedula_representante) {
      return res.json({ error: true, message: "No se encontró el representante con la cédula proporcionada" });
    }
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