const mysqlConnection = require("../database");
const controller = {};

const token = $token;

//Select
controller.list = (req, res) => {
  const { usuario, psw, rol } = req.body;
  const query = `SELECT usuario, password from login  where '${token}' = '1';`;
  mysqlConnection.query(query, [usuario, psw, rol], (
    err,
    rows
  ) => {
    if (!err) {
      res.json({
        status_code: 202,
        message: "Listado",
        usuario: rows,
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

controller.listRol = (req, res) => {
  const { usuario, psw, rol } = req.body;
  const query = `SELECT * from rol where id <> '1';`;
  mysqlConnection.query(query, [usuario, psw, rol], (
    err,
    rows
  ) => {
    if (!err) {
      res.json({
        status_code: 202,
        message: "Listado",
        rol: rows,
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