let fullname_error = document.getElementById("name-error");
let email_error = document.getElementById("email-error");
let password_error = document.getElementById("password-error");
let repeat_password_error = document.getElementById("repeatPassword-error");
let submit_error = document.getElementById("submit-error");

function fullnameValidate() {
    let fullname = document.getElementById("fullName").value;
    let nameRegx = /^\w+\s{1}\w+$/gi;
    if (fullname.trim().length == 0) {
        fullname_error.innerHTML = "Name is required";
        return false;
    }
    if (!fullname.match(nameRegx)) {
        fullname_error.innerHTML = "Write full name";
        return false;
    }
    fullname_error.innerHTML = `<i class="fa-solid fa-circle-check" style="color: #47c918;"></i> `;
    return true;
}


function emailValidate() {
    let email = document.getElementById("email").value;
    let emailRegex = /^\w+[.-]?\w+@\w+.(com|net|org|ma|info)/gi;
    if (email.trim().length == 0) {
        email_error.innerHTML = "Email is required";
        return false;
    }
    if (!email.match(emailRegex)) {
        email_error.innerHTML = "Email is not valid";
        return false;
    }
    email_error.innerHTML = `<i class="fa-solid fa-circle-check" style="color: #47c918;"></i>`;
    return true;
}
function passwordValidate() {
    let password = document.getElementById("password").value;
    if (password.trim().length == 0) {
        password_error.innerHTML = "Password is required";
        return false;
    }
    if (password.trim().length < 9) {
        password_error.innerHTML = "must contain at least 8 char";
        return false;
    }
    password_error.innerHTML = `<i class="fa-solid fa-circle-check" style="color: #47c918;"></i>`;
    return true;
}
function repeatPasswordValidate() {
    let repeatPassword = document.getElementById("repeatPassword").value;
    let password = document.getElementById("password").value;
    if (repeatPassword.trim().length == 0) {
        repeat_password_error.innerHTML = "Repeat Password is required";
        return false;
    }
    if (repeatPassword !== password) {
        repeat_password_error.innerHTML = "Passwords do not match";
        return false;
    }
    repeat_password_error.innerHTML = `<i class="fa-solid fa-circle-check" style="color: #47c918;"></i>`;
    return true;
}
function validateForm() {
    if (
        !fullnameValidate() ||
        !emailValidate() ||
        !passwordValidate() ||
        !emailValidate()
    ) {
        submit_error.style.display = "block";
        submit_error.innerHTML = "Please fix error";
        setTimeout(function () {
            submit_error.style.display = "none";
        }, 3000);
        return false;
    }
}
