const usernameField = document.querySelector("[name=usuario]");
const passwordField = document.querySelector("[name=contraseña]");
const buttonField = document.querySelector("[value=Enviar]");


passwordField.addEventListener("blur", function (e) {
    const field = e.target;
    const fieldValue = e.target.value;
    if (fieldValue.length === 0) {
        field.nextElementSibling.innerText = "La contraseña es requerida";
    }
    else {
        field.nextElementSibling.innerText = "✔️";
    }
});
function validationField() {

}
usernameField.addEventListener("blur", function (e) {
    const field = e.target;
    const fieldValue = e.target.value;
    if (fieldValue.length === 0) {
        field.nextElementSibling.innerText = "El nombre de usuario es requerido";
    }
    else {
        field.nextElementSibling.innerText = "✔️";
    }
});
