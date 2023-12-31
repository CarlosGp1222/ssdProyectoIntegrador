<div class="container">
    <!-- Formulario para agregar estudiantes -->
    <div class="section left-section">
        <h2>Nueva Matricula</h2>
        <!-- Llamar al template alerta -->
        <?php 
            require_once __DIR__.'/../templates/alerta.php';
        ?>
        <form action="/matricula" method="POST">
            <div class="label">Alumnos</div>
            <select name="alumno" class="input-box">
                <?php foreach ($alumnos as $alumno) { ?>
                    <option value="<?php echo $alumno->id_alumno ?>"><?php echo $alumno->nombres." ".$alumno->apellidos ?></option>
                <?php } ?>
            </select>
            <div class="label">Cursos</div>
            <select name="curso" class="input-box">
                <?php foreach ($cursos as $curso) { ?>
                    <option value="<?php echo $curso->id_curso ?>"><?php echo $curso->nombre?></option>
                <?php } ?>
            </select>
            <div class="label">Estado</div>
            <input name = "estado" type="text" value="Matriculado" readonly>
            <button type="submit">Aceptar</button>
        </form>
    </div>
</div>
