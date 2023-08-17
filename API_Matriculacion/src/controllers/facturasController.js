const mysqlConnection = require("../database");
const controller = {};

controller.list = (req, res) => {

    const query = `SELECT * FROM factura`;
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
        total_pa
    } = req.body;
    const query = `INSERT INTO factura (id_cliente, id_recibo, n_documento, concepto, cantidad, precio, subtotal, total, total_pagar, total_pago, f_documento) VALUES (?,?,?,?,?,?,?,?,?,?,?)`;
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
    const { id_factura } = req.params;
    const query = `UPDATE factura SET concepto=?, cantidad=?, precio=?, subtotal=?, total=?, total_pagar=?, 
    total_pago=?, WHERE id_factura=?`;
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
            f_documento,
            id_factura
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