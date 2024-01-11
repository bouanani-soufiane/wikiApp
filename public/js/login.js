let email = document.getElementById('email');
let errorEmail = document.getElementById('errorEmail');

let emailRegex = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;

email.addEventListener('input', function () {
    validateEmail();
});

function validateEmail() {
    let inputValue = email.value.trim();

    if (inputValue === '') {
        errorEmail.textContent = 'Email is required.';
    } else if (!emailRegex.test(inputValue)) {
        errorEmail.textContent = 'Invalid email format.';
    } else {
        errorEmail.textContent = '';
    }
}
