const mysqlConnection = require("../database");
const controller = {};

controller.list_all = (req, res) => {

  const query = ` SELECT m.id_matricula, a.id_alumno, c.nombre, a.nombres AS 'nombres_alumno', 
  a.apellidos AS 'apellidos_alumno', n_matricula, estado
  FROM matricula AS m
  INNER JOIN alumnos AS a ON m.id_alumno = a.id_alumno
  INNER JOIN cursos AS c ON m.id_curso = c.id_curso`;
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
      
    } else {
      res.json({
        code: 500,
        error: true,
        message: err,
      });
    }
  });
};

controller.list_one = (req, res) => {
    const { id_matricula } = req.params;
    const query = ` SELECT * from matricula WHERE id_matricula = '${id_matricula}'`;
    console.log(query);
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
  const {  id_alumno, n_matricula, id_curso, estado } = req.body;
  const queryAlumnos = "SELECT id_matricula FROM matricula WHERE estado = 'Matriculado' AND id_alumno = ? LIMIT 1";
  mysqlConnection.query(queryAlumnos, [id_alumno], (err, results) => {
    if (err) {
      return res.json({ error: true, message: err });
    }

    if (results.length > 0) {
      return res.json({ error: true, message: "El alumno ya está matriculado" });
    }

    const queryAlumnos = "SELECT id_alumno FROM matricula WHERE id_curso = ? LIMIT 1";
    mysqlConnection.query(queryAlumnos, [id_alumno], (err, results) => {
      if (err) {
        return res.json({ error: true, message: err });
      }
  
      if (results.length > 0) {
        return res.json({ error: true, message: "El alumno ya está matriculado en este curso" });
      }

  const query = `INSERT INTO matricula( id_alumno ,n_matricula, id_curso, estado) VALUES (?, ?, ?, ?)`;
  console.log(query);
  mysqlConnection.query(
    query,
    [ id_alumno, n_matricula, id_curso, estado],
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
});
}
  )};

controller.update = (req, res) => {
  const { id_curso, estado } = req.body;
  const { id_matricula } = req.params;
  const query = `UPDATE matricula SET id_curso='${id_curso}', estado='${estado}' WHERE id_matricula='${id_matricula}'`;
  console.log(query);
  mysqlConnection.query(
    query,
    [id_curso, estado],
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