<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de Votación</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/rutValidation.js"></script> <!-- Archivo JS para validación de RUT -->
    </head>
    <body>
        <div class="container">
            <h1 class="mt-5">Sistema de Votación</h1>
            <form id="votacionForm" method="POST" action="votacion.php">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="alias">Alias:</label>
                    <input type="text" class="form-control" id="alias" name="alias" required>
                </div>
                
                <div class="form-group">
                    <label for="rut">RUT:</label>
                    <input type="text" class="form-control" id="rut" name="rut" required>
                    <small class="form-text text-muted">Formato: 12345678-9</small>
                </div>
                
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="region">Región:</label>
                        <select class="form-control" id="region" name="region" required>
                            <option value="">Seleccionar</option>
                            <!-- Agrega las demás regiones aquí -->
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="comuna">Comuna:</label>
                        <select class="form-control" id="comuna" name="comuna" required>
                            <option value="">Seleccionar</option>
                            <!-- Las opciones de comuna se cargarán dinámicamente mediante JavaScript -->
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="candidato">Candidato:</label>
                    <select class="form-control" id="candidato" name="candidato" required>
                        <option value="">Seleccionar</option>

                    </select>            
                </div>
                
                <div class="form-group">
                    <label>¿Cómo se enteró de nosotros?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="web" name="entero[]" value="web" required>
                        <label class="form-check-label" for="web">Sitio web</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="tv" name="entero[]" value="tv" >
                        <label class="form-check-label" for="tv">TV</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="redes" name="entero[]" value="redes" >
                        <label class="form-check-label" for="redes">Redes sociales</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="amigo" name="entero[]" value="amigo" >
                        <label class="form-check-label" for="amigo">Amigo</label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </body>
</html>