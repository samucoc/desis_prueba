function validarRut(rut) {
    if (typeof rut !== 'string') {
      return false;
    }

    if (!/^(\d{1,8}|\d{1,8}-\d|(\d{1,3}\.){2}\d{1,2}-(\d|K))$/.test(rut)) {
      return false;
    }

    var cuerpo = rut.slice(0, -2);
    var digitoVerificador = rut.slice(-1);
    
    var suma = 0;
    var multiplo = 2;
    
    for (var i = cuerpo.length - 1; i >= 0; i--) {
      suma += parseInt(cuerpo.charAt(i)) * multiplo;
      multiplo = multiplo === 7 ? 2 : multiplo + 1;
    }
    
    var resto = suma % 11;
    var dv = resto === 0 ? 0 : resto === 1 ? 'K' : 11 - resto;
    
    return dv.toString() === digitoVerificador;
  }

function validarAlias(alias) {
    if (typeof alias !== 'string') {
      return false;
    }
    
    // Verificar la longitud mínima de 6 caracteres
    if (alias.length < 6) {
      return false;
    }
    
    // Verificar que contenga letras y números
    var hasLetter = false;
    var hasNumber = false;
    
    for (var i = 0; i < alias.length; i++) {
      if (/[a-zA-Z]/.test(alias.charAt(i))) {
        hasLetter = true;
      } else if (/\d/.test(alias.charAt(i))) {
        hasNumber = true;
      }
      
      if (hasLetter && hasNumber) {
        return true;
      }
    }
    
    return false;
  }

function validarNombreApellido(nombre, apellido) {
    if (nombre.trim() === '' || apellido.trim() === '') {
      return false;
    }
    
    return true;
  }

function validarEmail(email) {
    // Expresión regular para validar el correo electrónico
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    return regex.test(email);
  }

  function validarSeleccionOpciones() {
    var checkboxes = document.querySelectorAll('input[name="entero[]"]:checked');
    var numOpcionesSeleccionadas = checkboxes.length;
  
    return numOpcionesSeleccionadas >= 2;
  }

$(document).ready(function() {

    $("#apellido").blur(function() {
        var nombre = $(this).val();
        var apellido = $(this).val();
        if (!validarNombreApellido(nombre, apellido)) {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }
    });
    $("#nombre").blur(function() {
        var nombre = $(this).val();
        var apellido = $(this).val();
        if (!validarNombreApellido(nombre, apellido)) {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }
    });

    $("#alias").blur(function() {
        var alias = $(this).val();
        if (!validarAlias(alias)) {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }
    });

    $("#rut").blur(function() {
        var rut = $(this).val();
        if (!validarRut(rut)) {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }
    });

    $("#email").blur(function() {
        var email = $(this).val();
        if (!validarEmail(email)) {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }
    });

    $('form').submit(function(event) {
        var checkboxes = $('input[name="entero[]"]:checked');
        var numOpcionesSeleccionadas = checkboxes.length;

        if (numOpcionesSeleccionadas < 2) {
        event.preventDefault(); // Evitar el envío del formulario
        alert('Debe seleccionar al menos dos opciones.');
        }
    });

});

