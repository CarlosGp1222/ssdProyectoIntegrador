<div class="container">
    <h1>Matriculación de Estudiantes</h1>
    
    <form action="/matricula" method="POST">
        <div class="section">
            <div class="label">Curso</div>
            <input class="input-box" type="text">
            <button class="button">&#128269;</button>
        </div>
        <div class="section">
            <div class="label">Estudiante</div>
            <input class="input-box" type="text">
            <button class="button">&#128269;</button>
        </div>
        <div class="section">
            <div class="label">Estado</div>
            <select class="input-box">
                <option value="- -">- -</option>
                <option value="retirado">Retirado</option>
                <option value="matriculado">Matriculado</option>
            </select>
        </div>
        <div class="button-group"> 
            <button type="submit">Guardar Matrícula</button>
            <button type="button" onclick="cancel()">Cancelar</button>
        </div>
    </form>
</div>

<script>
    function cancel() {
        
    }
</script>
