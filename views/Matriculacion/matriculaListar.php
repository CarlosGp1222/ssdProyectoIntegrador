<div class="contenedor_cards">
    <h1 class="titulo_general">Lista de Matriculas</h1>
    <div class="container__agregar">
        <a class="agregar" href="/matricula">Nueva Matricula</a>
    </div>
    <?php
    require_once __DIR__ . '/../templates/alerta.php';
    ?>
    <div class="contenedor-card">
        <?php foreach ($matriculas as $matricula) { ?>
            <div class="card">
                <div class="card__content">
                    <h2 class="card__title"><?php echo $matricula->nombres_alumno  . " " . $matricula->apellidos_alumno ?></h2>
                    <p class="card__description">Curso: <span class="card__span"><?php echo $matricula->nombre ?></span></p>
                    <p class="card__description">Estado: <span class="card__span"><?php echo $matricula->estado ?></span></p>
                    <a href="/matriculaEditar?id=<?php echo $matricula->cedula ?>" class="card__button">Modificar</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>