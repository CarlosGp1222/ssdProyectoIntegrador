const mysqlConnection = require("../database");
const controller = {};

controller.list = (req, res) => {

  const query = `SELECT * FROM cursos`;
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

controller.save = (req, res) => {
  const { nombre } = req.body;
  const query = `INSERT INTO cursos(nombre) VALUES (?)`;
  mysqlConnection.query(
    query,
    [nombre],
    (err, rows, fields) => {
      if (!err) {
        res.json({
          status_code: 202,
          message: "Curso creado",
        });
      } else {
        res.json({
          code: 500,
          error: true,
          message: err,
        });
      }
    }
  );
}

controller.update = (req, res) => {
  const { nombre } = req.body;
  const { id_curso } = req.params;
  const query = `UPDATE cursos SET nombre=? WHERE id_curso=${id_curso}`;
  mysqlConnection.query(
    query,
    [nombre],
    (err, rows, fields) => {
      if (!err) {
        res.json({
          status_code: 202,
          error: false,
          message: "Curso actualizado",
        });
      } else {
        res.json({
          code: 500,
          error: true,
          message: err,
        });
      }
    }
  );
}

controller.list_one = (req, res) => {
  const { id_curso } = req.params;
  const query = `SELECT c.id_curso, c.nombre 
  FROM cursos AS c WHERE c.id_curso = '${id_curso}'`;
  mysqlConnection.query(query, [id_curso], (
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


module.exports = controller;