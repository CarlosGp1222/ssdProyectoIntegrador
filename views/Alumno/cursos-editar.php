<div class="containerCurso">
    <div class="section">
        <h2>Agregar Nuevo Curso</h2>
        <!-- llamar al template alerta -->
        <?php
        require_once __DIR__ . '/../templates/alerta.php';
        ?>
        <form action="/cursos-editar" method="POST">
            <label for="nombreCurso">Nombre:</label>
            <input type="hidden" name="id_curso" value="<?php echo $curso->id_curso; ?>">
            <input type="text" id="nombreCurso" name="nombreCurso" value="<?php echo $curso->nombre; ?>" required>
            <button type="submit">Agregar Curso</button>
        </form>
    </div>
</div>