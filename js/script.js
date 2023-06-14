$(document).ready(function() {
    $('#votacionForm').submit(function(event) {
        event.preventDefault(); // Evitar el envío normal del formulario
        
        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize();
        
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response) {
                // Manejar la respuesta del servidor (puedes mostrar un mensaje de éxito aquí)
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud Ajax (puedes mostrar un mensaje de error aquí)
                console.error(xhr.responseText);
            }
        });
    });

    // Obtener todas los candidatos
    $.ajax({
        url: '../database/obtener_candidatos.php',
        method: 'GET',
        success: function(data) {
            // Rellenar el select de regiones
            var candidatosSelect = $('#candidato');
            $.each(JSON.parse(data), function(index, candidato) {
                candidatosSelect.append('<option value="' + candidato.id + '">' + candidato.nombre + '</option>');
            });
        },
        error: function(error) {
            console.log('Error al obtener los candidatos:', error);
        }
    });
    
    // Obtener todas las regiones
    $.ajax({
        url: '../database/obtener_regiones.php',
        method: 'GET',
        success: function(data) {
            // Rellenar el select de regiones
            var regionesSelect = $('#region');
            $.each(JSON.parse(data), function(index, region) {
                regionesSelect.append('<option value="' + region.id + '">' + region.region + '</option>');
            });

            // Obtener comunas al seleccionar una región
            regionesSelect.on('change', function() {
                var codigoRegion = $(this).val();
                obtenerComunas(codigoRegion);
            });
        },
        error: function(error) {
            console.log('Error al obtener las regiones:', error);
        }
    });

    // Obtener comunas por código de región
    $(document).on('change', '#region', function() {
        var codigoRegion = $(this).val();
        obtenerComunas(codigoRegion);
    });

    function obtenerComunas(codigoRegion) {
        $.ajax({
            url: '../database/obtener_comunas_region.php?region=' + codigoRegion,
            method: 'GET',
            success: function(data) {
                // Rellenar el select de comunas
                var comunasSelect = $('#comuna');
                comunasSelect.empty(); // Limpiar las opciones anteriores
                $.each(JSON.parse(data), function(index, comuna) {
                    comunasSelect.append('<option value="' + comuna.id + '">' + comuna.comuna + '</option>');
                });
            },
            error: function(error) {
                console.log('Error al obtener las comunas:', error);
            }
        });
    }
});