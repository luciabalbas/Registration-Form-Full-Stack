// Valores
let uname = document.getElementById("name");
let surname1 = document.getElementById("surname1");
let surname2 = document.getElementById("surname2");
let email = document.getElementById("email");
let login = document.getElementById("login");
let password = document.getElementById("password");

// Validation función
function validateForm(event) {
    // Enviar formulario
    sendForm = true;

    // Validación del nombre
    if (uname.value == "") {
        error(uname, "* Este campo es obligatorio");
    }
    else {
        success(uname);
    }

    // Validcación apellidos
    if (surname1.value == "") {
        error (surname1, "* Este campo es obligatorio");
    }
    else {
        success(surname1);
    }
    if (surname2.value == "") {
        error(surname2, "* Este campo es obligatorio");    
    }
    else {
        success(surname2);
    }

    // Validacion Email
    const regEmail = new RegExp(/^((?!\.)[\w-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/, "gim");
    let isValidEmail = regEmail.test(email.value)

    if (email.value == "") {
        error(email, "* Este campo es obligatorio");
    }
    else if (isValidEmail == false) {
        error(email, "* Email inválido");
    } 
    else {
        success(email);
    }

    // Validacion login
    if (login.value == "") {
        error (login, "* Este campo es obligatorio");
    }
    else {
        success(login);
    }

    // Validacion contraseña
    if (password.value == "") {
        error (password, "* Este campo es obligatorio");
    }
    else if (password.value.length < 4 || password.value.length > 8) {
        error(password, "* La contraseña debe tener entre 4-8 carácteres");
    }
    else {
        success(password);
    }


    // Comprobar que no hay errores
    if (sendForm == false) {
        event.preventDefault();
    }
    else {
        alert("Done!");
    }
}

function success(input) {
    let parent = input.parentElement;
    let text = parent.querySelector("p");
    text.textContent = "";
    parent.classList.remove("error");
    parent.classList.add("success");
}

function error(input, message) {
    let parent = input.parentElement;
    let text = parent.querySelector("p");
    text.textContent = message;
    parent.classList.remove("success");
    parent.classList.add("error");
    sendForm = false;
}