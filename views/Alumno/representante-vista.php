<h1 class="titulo_general">Lista representantes</h1>
<div class="container__agregar">
    <a class="agregar" href="/representante">Agregar Representante</a>
</div>
<?php 
    require_once __DIR__.'/../templates/alerta.php';
?>
<div class="contenedor-card">
    
    <?php foreach ($representantes as $representante) { ?>
        <div class="card">
            <div class="card__content">
                <h2 class="card__title"><?php echo $representante->nombres  ." ". $representante->apellidos?></h2>
                <p class="card__description">Cedula: <span class="card__span"><?php echo $representante->cedula ?></span></p>
                <p class="card__description">Email: <span class="card__span"><?php echo $representante->email ?></span></p>
                <a href="/representantes-editar?id=<?php echo $representante->cedula ?>" class="card__button">Modificar</a>
            </div>
        </div>
    <?php } ?>
</div>