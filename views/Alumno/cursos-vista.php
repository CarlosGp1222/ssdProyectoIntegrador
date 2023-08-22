<div class="contenedor_cards">
    <h1 class="titulo_general">Lista cursos</h1>
    <div class="container__agregar">
        <a class="agregar" href="/cursos">Agregar Curso</a>
    </div>
    <?php
    require_once __DIR__ . '/../templates/alerta.php';
    ?>
    <div class="contenedor-card">
        <?php foreach ($cursos as $curso) { ?>
            <div class="card">
                <div class="card__content">
                    <h2 class="card__title"><?php echo $curso->nombre?></h2>
                    
                    <a href="/cursos-editar?id=<?php echo $curso->id_curso ?>" class="card__button">Modificar</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>