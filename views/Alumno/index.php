<div class="container">
    <!-- Formulario para agregar estudiantes -->
    <div class="left-section">
        <h2>Agregar Nuevo Estudiante</h2>
        <form action="procesar.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombres">
            <input type="text" name="apellido" placeholder="Apellidos">
            <select name="genero">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            </select>
            <input type="text" name="cedula" placeholder="Cédula">
            <input type="text" name="ceduleRepre" placeholder="Cédula Representante">
            <input type="text" name="direccion" placeholder="Dirección">
            <input type="text" name="telefono" placeholder="Teléfono">
            <input type="email" name="email" placeholder="Email">
            <input type="date" name="fecha_nacimiento">
            <select name="tipo_matriculacion">
                <option value="regular">Regular</option>
                <option value="becado">Becado</option>
            </select>
            <button type="submit">Agregar</button>
        </form>
    </div>
</div>