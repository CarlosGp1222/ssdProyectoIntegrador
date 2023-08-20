const mysqlConnection = require("../database");
const controller = {};

controller.list_all = (req, res) => {

    const query = `Select r.id_representante, r.nombres, r.apellidos, r.cedula, r.direccion, r.telefono, r.email, 
    rc.n_documento AS 'n_documento_recibo', f.n_documento 'n_documento_factura', f.concepto, 
    f.cantidad, f.precio, f.subtotal, f.total, f.total_pagar, f.f_documento
    FROM factura AS f
    INNER JOIN representantes AS r ON r.id_representante = f.id_cliente
    INNER JOIN recibo_cobro AS rc ON rc.id_recibo = f.id_recibo`;
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