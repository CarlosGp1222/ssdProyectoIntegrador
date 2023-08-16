<div class="containerRepre">
    <!-- Formulario para agregar representante -->
    <div class="section">
        <h2>Agregar Nuevo Representante</h2>
        <form action="/representante" method="POST">
            <input type="text" name="nombres" placeholder="Nombres">
            <input type="text" name="apellidos" placeholder="Apellidos">
            <select name="genero">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            </select>
            <input type="text" name="cedula" placeholder="Cédula">
            <input type="text" name="direccion" placeholder="Dirección">
            <input type="text" name="telefono" placeholder="Teléfono">
            <input type="email" name="email" placeholder="Email">
            <button type="submit">Agregar</button>
        </form>
    </div>
</div>