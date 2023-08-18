<h1 class="titulo_general">Lista cursos</h1>
<a href="/cursos">Agregar curso</a>
<div class="contenedor-card">
    
    <?php foreach ($cursos as $curso) { ?>
        <div class="card">
            <div class="card__content">
                <h2 class="card__title"><?php echo $curso->nombre?></h2>
                
                <a href="/cursos-editar?id=" class="card__button">Modificar</a>
            </div>
        </div>
    <?php } ?>
</div>