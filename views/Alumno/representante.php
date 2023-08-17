<div class="containerRepre">
    <!-- Formulario para agregar representante -->
    <div class="section">
        <h2>Agregar Nuevo Representante</h2>
        <form action="/representante" method="POST">
            <input type="text" name="nombres" placeholder="Nombres" required>
            <input type="text" name="apellidos" placeholder="Apellidos" required>
            <select name="genero" required>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            </select>
            <input type="text" name="cedula" placeholder="Cédula" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <input type="text" name="telefono" placeholder="Teléfono" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Agregar</button>
        </form>
    </div>
</div>