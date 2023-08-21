<div class="containerRepre">
    <!-- Formulario para agregar representante -->
    <div class="section">
        <h2>Agregar Nuevo Representante</h2>
        <?php 
            require_once __DIR__.'/../templates/alerta.php';
        ?>
        <form action="/representante" method="POST">
            <input type="text" name="nombres" placeholder="Nombres" required>
            <input type="text" name="apellidos" placeholder="Apellidos" required>
            <select name="genero" required>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
            <input type="text" name="cedula" placeholder="Cédula" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <input type="text" name="telefono" placeholder="Teléfono" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Agregar</button>
        </form>
    </div>
</div>