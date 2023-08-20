<div class="container">
    <!-- Formulario para agregar estudiantes -->
    <div class="left-section">
        <h2>Agregar Nuevo Estudiante</h2>
        <form action="/alumno" method="POST">
            <input type="text" name="nombres" placeholder="Nombres" required>
            <input type="text" name="apellidos" placeholder="Apellidos" required>
            <select name="genero" required>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
            <!-- <input type="text" name="cedula" placeholder="Cédula" required> -->
            <input type="text" name="cedulaRepre" placeholder="Cédula Representante" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <input type="text" name="telefono" placeholder="Teléfono" required>
            <input type="email" name="email" placeholder="Email" required>
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" required>
            <label for="tipo_matriculacion">Tipo de Matriculación:</label>
            <select name="tipo_matriculacion" required>
                <option value="regular">Regular</option>
                <option value="becado">Becado</option>
            </select>
            <button type="submit">Editar</button>
        </form>
    </div>
</div>