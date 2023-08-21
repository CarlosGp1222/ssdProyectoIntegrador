<div class="contenedor_cards">
    <h1 class="titulo_general">Lista de Matriculas</h1>
    <div class="container__agregar">
        <a class="agregar" href="/matricula">Nueva Matricula</a>
    </div>
    <?php
    require_once __DIR__ . '/../templates/alerta.php';
    ?>
    <div class="contenedor-card">
        <?php foreach ($alumnos as $alumno) { ?>
            <div class="card">
                <div class="card__content">
                    <h2 class="card__title"><?php echo $alumno->nombres  . " " . $alumno->apellidos ?></h2>
                    <p class="card__description">Curso: <span class="card__span"><?php echo $alumno->id_matricula ?></span></p>
                    <p class="card__description">Estado: <span class="card__span"><?php echo $alumno->id_alumno ?></span></p>
                    <a href="/matriculaEditar?id=<?php echo $alumno->cedula ?>" class="card__button">Modificar</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>