const mysqlConnection = require("../database");
const controller = {};

controller.list_all = (req, res) => {

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


//insert
controller.save = (req, res) => {
    // Obtener el valor máximo actual de n_documento de la base de datos
   

                const {
                    id_cliente,
                    id_recibo = 1,
                    n_documento,
                    concepto,
                    descripcion,
                    cantidad,
                    precio,
                    subtotal = cantidad * precio,
                    total = (subtotal * 0.12) + subtotal,
                    total_pagar = total,
                    f_documento
                } = req.body;

                const query = `INSERT INTO factura (id_cliente, id_recibo, n_documento, descripcion,concepto, cantidad, precio, 
                    subtotal, total, total_pagar, f_documento) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)`; // total_pago es innecesario
                mysqlConnection.query(
                    query,
                    [
                        id_cliente,
                        id_recibo,
                        n_documento, // Usar el valor calculado de n_documento
                        descripcion,
                        concepto,
                        cantidad,
                        precio,
                        subtotal,
                        total,
                        total_pagar,
                        f_documento
                    ],
                    (err, rows, fields) => {
                        if (!err) {
                            res.json({
                                status_code: 202,
                                error: false,
                                message: total,
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

module.exports = controller;
