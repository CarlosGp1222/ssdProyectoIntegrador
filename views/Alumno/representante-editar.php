<div class="containerRepre">
    <!-- Formulario para agregar representante -->
    <div class="section">
        <h2>Editar Representante</h2>
        <form action="/representantes-editar" method="POST">
            <input type="text" name="nombres" placeholder="Nombres" value="<?php echo $representante->nombres ?? "" ?>" required>
            <input type="text" name="apellidos" placeholder="Apellidos" value="<?php echo $representante->apellidos ?? "" ?>" required>
            <select name="genero" required>
                <option value="M" <?php echo $representante->genero == "M" ? "selected" : ""?>>Masculino</option>
                <option value="F" <?php echo $representante->genero == "F" ? "selected" : ""?>>Femenino</option>
            </select>
            <input type="hidden" name="cedula" placeholder="Cédula" value="<?php echo $representante->cedula ?? "" ?>" required>
            <input type="text" name="direccion" placeholder="Dirección" value="<?php echo $representante->direccion ?? "" ?>" required>
            <input type="text" name="telefono" placeholder="Teléfono" value="<?php echo $representante->telefono ?? "" ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo $representante->email ?? "" ?>" required>
            <button type="submit">Actualizar</button>
        </form>
    </div>
</div>