<div class="containerLog">
    <div class="section">
        <h2>Login</h2>
        <?php if (!empty($errores)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errores as $error) : ?>
                    <p class="mensaje"><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="/login" method="POST">
            <div class="inputGroup">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="inputGroup">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="inputGroup">
                <button type="submit">Ingresar</button>
            </div>
        </form>
    </div>
</div>