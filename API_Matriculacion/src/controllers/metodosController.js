const mysqlConnection = require("../database");
const controller = {};

controller.list = (req, res) => {

  const query = `SELECT * FROM metodo_pago`;
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
  const query = `INSERT INTO metodo_pago(nombre, tipo) VALUES (?, ?)`;
  mysqlConnection.query(
    query,
    [nombre],
    (err, rows, fields) => {
      if (!err) {
        res.json({
          status_code: 202,
          message: "Metodo creado",
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
  const { nombre, tipo} = req.body;
  const { id_metodo } = req.params;
  const query = `UPDATE metodo_pago SET nombre=?, tipo=? WHERE id_metodo=?`;
  mysqlConnection.query(
    query,
    [id_metodo, nombre, tipo],
    (err, rows, fields) => {
      if (!err) {
        res.json({
          status_code: 202,
          message: "Metodo actualizado",
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