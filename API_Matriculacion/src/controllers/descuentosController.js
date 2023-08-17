const mysqlConnection = require("../database");
const controller = {};

controller.list_all = (req, res) => {

    const query = `SELECT * FROM descuento`;
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
    const {
        nombre,
        porcentaje
    } = req.body;

    const query = `INSERT INTO descuento (nombre, porcentaje) VALUES (?,?)`;
    mysqlConnection.query(
        query, [nombre, porcentaje],
        (err) => {
            if (!err) {
                res.json({
                    status_code: 202,
                    message: "Descuento guardado",
                    //authData
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
    const {
        nombre,
        porcentaje,
        id_descuento
    } = req.body;
    const query = `UPDATE descuento SET nombre=?, porcentaje=? WHERE id_descuento=?`;
    mysqlConnection.query(
        query, [nombre, porcentaje, id_descuento],
        (err) => {
            if (!err) {
                res.json({
                    status_code: 202,
                    message: "Descuento actualizado",
                    //authData
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