const mysqlConnection = require("../database");
const controller = {};

controller.list_all = (req, res) => {

    const query = `Select * from Representante`;
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
        id_cliente,
        id_recibo,
        n_documento,
        concepto,
        cantidad,
        precio,
        subtotal,
        total,
        total_pagar,
        total_pago,
        f_documento
    } = req.body;
    const query = `INSERT INTO factura (id_cliente, id_recibo, n_documento, concepto, cantidad, precio, 
        subtotal, total, total_pagar, total_pago, f_documento) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?)`; //total_pago es innecesario
    mysqlConnection.query(
        query,
        [
            id_cliente,
            id_recibo,
            n_documento,
            concepto,
            cantidad,
            precio,
            subtotal,
            total,
            total_pagar,
            total_pago,
            f_documento
        ],
        (err, rows, fields) => {
            if (!err) {
                res.json({
                    status_code: 202,
                    message: "Factura guardada",
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
};

controller.update = (req, res) => {
    const {
        id_cliente,
        id_recibo,
        concepto,
        cantidad,
        precio,
        subtotal,
        total,
        total_pagar,
    } = req.body;
    const { n_documento } = req.params;
    const query = `UPDATE factura SET concepto=?, cantidad=?, precio=?, subtotal=?, total=?, total_pagar=?, 
    total_pago=?, WHERE n_documento=?`;
    mysqlConnection.query(
        query,
        [
            id_cliente,
            id_recibo,
            n_documento,
            concepto,
            cantidad,
            precio,
            subtotal,
            total,
            total_pagar,
        ],
        (err, rows, fields) => {
            if (!err) {
                res.json({
                    status_code: 202,
                    message: "Factura actualizada",
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