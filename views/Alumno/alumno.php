<div class="container">
    <!-- Formulario para agregar estudiantes -->
    <div class="left-section">
        <h2>Agregar Nuevo Estudiante</h2>
        <form action="/alumno" method="POST">
            <input type="text" name="nombres" placeholder="Nombres">
            <input type="text" name="apellidos" placeholder="Apellidos">
            <select name="genero">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="otro">otros 39 tipos de gay</option>
            </select>
            <input type="text" name="cedula" placeholder="Cédula">
            <input type="text" name="cedulaRepre" placeholder="Cédula Representante">
            <input type="text" name="direccion" placeholder="Dirección">
            <input type="text" name="telefono" placeholder="Teléfono">
            <input type="email" name="email" placeholder="Email">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento">
            <label for="tipo_matriculacion">Tipo de Matriculación:</label>
            <select name="tipo_matriculacion">
                <option value="regular">Regular</option>
                <option value="becado">Becado</option>
            </select>
            <button type="submit">Agregar</button>
        </form>
    </div>
</div>