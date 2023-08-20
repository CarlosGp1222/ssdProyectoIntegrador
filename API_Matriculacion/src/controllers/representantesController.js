const mysqlConnection = require("../database");
const controller = {};

controller.list_all = (req, res) => {

    const query = `SELECT * FROM representantes`;
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


//insert
controller.save = (req, res) => {
    const { nombres, apellidos, cedula, direccion, telefono, email, genero } = req.body;
    const query = `INSERT INTO representantes(nombres, apellidos, cedula, direccion, telefono, email, genero)
    VALUES (?, ?, ?, ?, ?, ?, ?)`;

    const queryAlumnos = "SELECT id_representante FROM representantes WHERE cedula = ? LIMIT 1";
    mysqlConnection.query(queryAlumnos, [cedula], (err, results) => {
      if (err) {
        return res.json({ error: true, message: err });
      }

      if (results.length > 0) {
        return res.json({ error: true, message: "La cédula ya está en uso por otro representante" });
      }

    mysqlConnection.query(query, [nombres, apellidos, cedula, direccion, telefono, email, genero],(err) => {
        
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
            console.log("Query aqui"+query);
            console.log(err);
        }
    });
});
};

//update
controller.update = (req, res) => {
    const { nombres, apellidos, direccion, telefono, email, genero } = req.body;
    const { cedula } = req.params;
    const query = `UPDATE representantes SET nombres = '${nombres}', apellidos = '${apellidos}', cedula = '${cedula}',
    direccion = '${direccion}', telefono = '${telefono}', email = '${email}', genero = '${genero}' WHERE cedula = '${cedula}'`;

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


controller.list_one = (req, res) => {
    const { cedula } = req.params;
    const query = `SELECT * FROM representantes where cedula = '${cedula}'`;
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

module.exports = controller;