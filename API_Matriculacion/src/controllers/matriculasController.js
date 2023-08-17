const mysqlConnection = require("../database");
const controller = {};

controller.list = (req, res) => {

  const query = ` SELECT id_matricula, a.id_alumno, c.id_curso, a.nombres AS 'nombres_alumno', 
  a.apellidos AS 'apellidos_alumno', n_matricula, estado
  FROM matricula AS m
  INNER JOIN alumnos AS a ON m.id_alumno = a.id_alumno
  INNER JOIN cursos AS c ON m.id_curso = m.id_curso`;
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
  const { id_curso, nombre } = req.body;
  const query = `INSERT INTO cursos(nombre) VALUES (?)`;
  mysqlConnection.query(
    query,
    [id_curso, nombre],
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
  const query = `UPDATE cursos SET nombre=? WHERE id_curso=?`;
  mysqlConnection.query(
    query,
    [id_curso, nombre],
    (err, rows, fields) => {
      if (!err) {
        res.json({
          status_code: 202,
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

module.exports = controller;