<div class="containerRepre">
    <!-- Formulario para agregar representante -->
    <div class="section">
        <h2>Editar Representante</h2>
        <?php
        require_once __DIR__ . '/../templates/alerta.php';
        ?>
        <form action="/representantes-editar" method="POST">
            <label for="nombres">Nombres:</label>
            <input type="text" name="nombres" placeholder="Nombres" value="<?php echo $representante->nombres ?? "" ?>" required>
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" placeholder="Apellidos" value="<?php echo $representante->apellidos ?? "" ?>" required>
            <select name="genero" required>
                <option value="M" <?php echo $representante->genero == "M" ? "selected" : "" ?>>Masculino</option>
                <option value="F" <?php echo $representante->genero == "F" ? "selected" : "" ?>>Femenino</option>
            </select>
            <input type="hidden" name="cedula" placeholder="Cédula" value="<?php echo $representante->cedula ?? "" ?>" required>
            <label for="direccion">direccion:</label>
            <input type="text" name="direccion" placeholder="Dirección" value="<?php echo $representante->direccion ?? "" ?>" required>
            <label for="Telefono">Telefono:</label>
            <input type="text" name="telefono" placeholder="Teléfono" value="<?php echo $representante->telefono ?? "" ?>" required>
            <label for="correo">Correo:</label>
            <input type="email" name="email" placeholder="Email" value="<?php echo $representante->email ?? "" ?>" required>
            <button type="submit">Actualizar</button>
        </form>
    </div>
</div>