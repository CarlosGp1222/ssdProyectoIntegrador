<h1 class="titulo_general">Lista alumnos</h1>
<a class="agregar" href="/alumno">Agregar Alumno</a>
<?php 
    require_once __DIR__.'/../templates/alerta.php';
?>
<div class="contenedor-card">
    
    <?php foreach ($alumnos as $alumno) { ?>
        <div class="card">
            <div class="card__content">
                <h2 class="card__title"><?php echo $alumno->nombres  ." ". $alumno->apellidos?></h2>
                <p class="card__description">Cedula: <span class="card__span"><?php echo $alumno->cedula ?></span></p>
                <p class="card__description">Email: <span class="card__span"><?php echo $alumno->email ?></span></p>
                <a href="/alumnos-editar?id=<?php echo $alumno->cedula ?>" class="card__button">Modificar</a>
            </div>
        </div>
    <?php } ?>
</div>