var usuario = document.getElementById("usuario");
var contraseña = document.getElementById("contraseña");


function validarFormulario(){

    if(usuario.value === null || usuario.value === ""){
        alert("Campo del usuario vacio");
        return false;
    }

    if(contraseña.value === null || contraseña.value === ""){
        alert("Campo de contraseña vacio");
        return false;
    }
    
    return true;
}
