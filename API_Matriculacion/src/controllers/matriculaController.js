const mysqlConnection = require("../database");
const controller = {};

controller.list_all = (req, res) => {

  const query = ` SELECT id_matricula, a.id_alumno, c.id_curso, a.nombres AS 'nombres_alumno', 
  a.apellidos AS 'apellidos_alumno', c.nombre, n_matricula, estado
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
  const { id_alumno, n_matricula, id_curso, estado } = req.body;
  const query = `INSERT INTO matricula(id_alumno, n_matricula, id_curso, estado) VALUES (?, ?, ?, ?)`;
  mysqlConnection.query(
    query,
    [id_alumno, id_curso, estado],
    (err, rows, fields) => {
      if (!err) {
        res.json({
          status_code: 202,
          message: "Matricula creada",
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
  const { id_curso, estado } = req.body;
  const { id_matricula } = req.params;
  const query = `UPDATE cursos SET id_curso='${id_curso}', estado='${estado}' WHERE id_matricula='${id_matricula}'`;
  mysqlConnection.query(
    query,
    [id_curso, nombre],
    (err, rows, fields) => {
      if (!err) {
        res.json({
          status_code: 202,
          message: "Matricula actualizada",
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