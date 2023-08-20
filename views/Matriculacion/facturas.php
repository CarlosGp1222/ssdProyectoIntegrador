<div class="containerRepre">
    <div class="section">
        <h2>Facturacion</h2>
        <?php
        require_once __DIR__ . '/../templates/alerta.php';
        ?>
        <?php
        $fecha_actual = date("Y-m-d"); ?>
        <form action="/facturas" method="POST">
            <select name="id_cliente" required>
                <?php foreach ($facturas as $factura) { ?>
                    <option value="<?php echo $factura->id_representante ?>"><?php echo $factura->nombres  . " " . $factura->apellidos ?></option>
                <?php } ?>
            </select>

            <input type="text" name="concepto" placeholder="Concepto" required>
            <input type="text" name="descripcion" placeholder="Descripción" required>
            <input type="number" name="cantidad" placeholder="Cantidad" required>
            <input type="number" name="precio" placeholder="Precio" required>
            <input type="text" name="fecha" placeholder="fecha" required value="<?php echo $fecha_actual; ?>">


            <input type="text" name="ndocumentos" placeholder="N* DOCUMENTOS" required value="<?php echo $facturas2; ?>">
            <button type="submit">Facturar</button>
        </form>
    </div>
</div>