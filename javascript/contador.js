const numeroElement = document.getElementById('numeros');
var table = document.getElementById('tabla').getElementsByTagName('tbody')[0];
let numeroaSumar;
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
    if (!viajes <= 0) {
        viajes -= numeroaSumar;
        numeroElement.textContent = viajes.toString().padStart(3, '0');
    }
}

function eliminarFila(row) {
    var d = row.parentNode.parentNode.rowIndex;
    document.getElementById('tabla').deleteRow(d);
}

function reiniciarContador() {
    viajes = 0;
    numeroElement.textContent = "000";
    numeroaSumar = 0;
}

function agregarEntrada() {
    var inputProducto = document.getElementById('modal-producto');
    var inputNovedad = document.getElementById('modal-novedad');
    var inputEmpresa = document.getElementById('modal-empresa');
    var selectEmpresa = document.getElementById('modal-empresa');
    var empresaSeleccionada = selectEmpresa.options[selectEmpresa.selectedIndex].value;
    var newRow = table.insertRow();
    var productoCell = newRow.insertCell(0);
    var cantidadCell = newRow.insertCell(1);
    var novedadCell = newRow.insertCell(2);
    var empresaCell = newRow.insertCell(3);
    var eliminarCell = newRow.insertCell(4);
    productoCell.textContent = inputProducto.value;
    cantidadCell.textContent = viajes;
    novedadCell.textContent = inputNovedad.value;
    empresaCell.textContent = empresaSeleccionada;
    eliminarCell.innerHTML = '<button onclick="eliminarFila(this)">Eliminar</button>';
    numeroElement.textContent = "000";
    viajes = 0;
    numeroaSumar = 0;
    hideModal();
}

document.addEventListener('DOMContentLoaded', (event) => {
    const inputElement = document.getElementById('input-numero');
    const numeroElement = document.getElementById('numeros');

    inputElement.addEventListener('input', () => {
        const nuevoNumero = parseInt(inputElement.value, 10);
        if (!isNaN(nuevoNumero)) {
            numeroaSumar = nuevoNumero;
        }
    });
});


var modal = document.getElementById("myModal");

var btn = document.getElementById("openModalBtn");

var terminarRecibida = document.getElementById("terminar-recibida");


var span = document.getElementsByClassName("close")[0];


function showModal() {
    modal.classList.remove("hide");
    modal.classList.add("show");
    modal.style.display = "block";
}


function hideModal() {
    modal.classList.remove("show");
    modal.classList.add("hide");
    setTimeout(() => {
        modal.style.display = "none";
    }, 500);
}

btn.onclick = function () {
    showModal();
}


span.onclick = function () {
    hideModal();
}


window.onclick = function (event) {
    if (event.target == modal) {
        hideModal();
    }
}

terminarRecibida.onclick = function () {

}
