<div class="container">
    <!-- Formulario para agregar estudiantes -->
    <div class="left-section">
        <h2>Editar Estudiante</h2>
        <!-- llamar al template alerta -->
        <?php 
            require_once __DIR__.'/../templates/alerta.php';
        ?>
        <form action="/alumnos-editar" method="POST">
            <input type="text" name="nombres" placeholder="Nombres" value="<?php echo $alumno->nombres; ?>" required>
            <input type="text" name="apellidos" placeholder="Apellidos" value="<?php echo $alumno->apellidos; ?>" required>
            <select name="genero" required>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
            <input type="hidden" name="cedula" placeholder="Cédula" value="<?php echo $alumno->cedula; ?>" required>
            <input type="hidden" name="cedulaRepre" placeholder="Cédula Representante" value="<?php echo $alumno->cedula_representante; ?>" required>
            <input type="text" name="direccion" placeholder="Dirección" value="<?php echo $alumno->direccion; ?>" required>
            <input type="text" name="telefono" placeholder="Teléfono" value="<?php echo $alumno->telefono; ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo $alumno->email; ?>" required>
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" value="<?php  $dateTime = new DateTime($alumno->f_nacimiento); echo $dateTime->format("Y-m-d");?>" required>
            <label for="tipo_matriculacion">Tipo de Matriculación:</label>
            <select name="tipo_matriculacion" required>
                <?php foreach ($descuentos as $descuento) {?>
                    <option value="<?php echo $descuento->id_descuento ?>" <?php echo $alumno->tipo_matricula == $descuento->nombre ? "selected" : ""?>><?php echo $descuento->nombre ?></option>
                <?php } ?>
            </select>
            <button type="submit">Actualizar</button>
        </form>
    </div>
</div>