let numeroaSumar;
const numeroElement = document.getElementById('numeros');
let viajes = parseInt(numeroElement.textContent, 10);

function agregarViaje() {
    if (isNaN(numeroaSumar)) {
        numeroElement.textContent = "¿valor?";
    }
    else {
        viajes += numeroaSumar;
        numeroElement.textContent = viajes.toString().padStart(3, '0');
    }
}

function eliminarViaje() {
    if(!viajes<=0){
        viajes -= numeroaSumar;
        numeroElement.textContent = viajes.toString().padStart(3, '0');
    } 
}

document.addEventListener('DOMContentLoaded', (event) => {
    const inputElement = document.getElementById('input-numero');
    const numeroElement = document.getElementById('numeros');

    // Detectar cuando el usuario ingrese un número en el campo de entrada
    inputElement.addEventListener('input', () => {
        const nuevoNumero = parseInt(inputElement.value, 10); // Obtener el valor del input
        if (!isNaN(nuevoNumero)) {
            numeroaSumar = nuevoNumero;
        }
    });
});