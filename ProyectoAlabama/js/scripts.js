function validarUser(){
    var user = document.getElementById('txtUser').value;
    var contrasena = document.getElementById('txtContrasena').value;

    if(user === '' || contrasena === ''){
        alert('Por favor, completa todos los campos.');
        return false;
    }

    return true;
}

function btnPressed(direccion){
    window.location.href=direccion;
}

function newWindow(direccion){
    var name = 'Ventana Emergente';
    var options = 'width=auto, height=auto, resizable=yes, scrollbars=yes';

    window.open(direccion, name, options);
}

function validarDatos(){
    var folio = document.getElementById('txtFolio').value;
    var nombre = document.getElementById('txtNombre').value;
    var telefono = document.getElementById('txtTelefono').value;
    var curp = document.getElementById('txtCURP').value;
    var cantidad = document.getElementById('txtCantidad').value;
    var dinero = document.getElementById('txtDinero').value;
    var botones = document.getElementsByClassName('generic-btn');
    var valorBoton = '';

    for(var i = 0; i < botones.length; i++){
        botones[i].addEventListener("click", function(){
            valorBoton = this.value;
        });

        if(valorBoton != ''){
            break;
        }
    }

    if(valorBoton === 'insert'){
        if(((nombre === '' || telefono === '' || curp === '' || cantidad === '' || dinero === '') || (nombre.length > 50 || telefono.length > 15 || curp.length != 18))){
            alert('Por favor, completa correctamente todos los campos.');
            return false;
        }
    }else if(valorBoton === 'update'){
        if(((folio === '' || nombre === '' || telefono === '' || curp === '' || cantidad === '' || dinero === '') || (nombre.length > 50 || telefono.length > 15 || curp.length != 18))){
            alert('Por favor, completa correctamente todos los campos.');
            return false;
        }
    }else if(valorBoton === 'delete'){
        if(folio === ''){
            alert('Por favor, completa correctamente todos los campos.');
            return false;
        }
    }

    return true;
}

function closeButton(){
    window.close();
}

function reloadWindow(){
    location.reload();
}

function validarDatosUsuario(){
    var user = document.getElementById('txtUser').value;
    var contrasena = document.getElementById('txtContrasena').value;
    var rango = document.getElementById('cbxRango').value;
    var botones = document.getElementsByClassName('generic-btn');
    var valorBoton = '';

    for(var i = 0; i < botones.length; i++){
        botones[i].addEventListener("click", function(){
            valorBoton = this.value;
        });

        if(valorBoton != ''){
            break;
        }
    }

    if(valorBoton === 'insert' || valorBoton === 'update'){
        if(((user === '' || contrasena === '' || rango === '') || (user.length > 25 || contrasena.length > 25))){
            alert('Por favor, completa correctamente todos los campos.');
            return false;
        }
    }else if(valorBoton === 'delete'){
        if(((user === ''))){
            alert('Por favor, completa correctamente todos los campos.');
            return false;
        }else if(!confirm('¿Esta seguro de eliminar este usuario?')){
            return false;
        }
    }

    return true;
}