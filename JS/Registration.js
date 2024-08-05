/*
	Name: Ahmed Al-Zaher
	File Name: Registration.js
	Date: 08-04-2024
	Purpose: Form Validation Functionality for registration
*/


const registrationForm = document.forms[0];
let isValid = true;
let validated = false;
document.getElementById("register_button").addEventListener("click", validate);

//elements for email
const email = document.getElementById("email"); //selects the email input tag from the html sheet
const emailError = document.createElement("p");
let emailFormat = /^[A-Za-z0-9._]+@[A-Za-z0-9.]+\.[A-Za-z]{2,4}$/; //regex for email format

//elements for login
const login = document.getElementById("username");
const loginError = document.createElement("p");

//elements for password
const password = document.getElementById("password");
const passwordError = document.createElement("p");

//elements for password verification
const password2 = document.getElementById("password2");
const password2Error = document.createElement("p");

const reset = document.getElementById("reset_button");
reset.addEventListener("click", clear);

function clear(){
    emailError.remove();
    email.style.border = "1.5px solid #e08866";
    loginError.remove();
    login.style.border = "1.5px solid #e08866";
    passwordError.remove();
    password.style.border = "1.5px solid #e08866";
    password2Error.remove();
    password2.style.border = "1.5px solid #e08866";
}

function addError(inputElement, errorElement, message){
    errorElement.innerText = message;
    errorElement.className = "error";
    inputElement.parentNode.insertBefore(errorElement, inputElement.lastChild);
}

//email validation
function emailValidate(){
    if(emailFormat.test(email.value) && email.value.length > 0){
        emailError.remove();
        email.style.border = "1.5px solid #e08866";
    }
    else if(!emailFormat.test(email.value) || email.value.length <= 0){
        var message = "X Email address should be non-empty with the format xyz@xyz.xyz.";
        addError(email, emailError, message);
        email.style.border = "1px solid #FF0000";
        isValid = false;
    }
}

function loginValidate(){
    if(login.value.length > 0 && login.value.length < 30){
        loginError.remove();
        login.style.border = "1.5px solid #e08866";
    }
    else if(login.value == "" || login.value.length <= 0 || login.value.length >= 30){
        var message = "X User name should be non-empty, and less than 30 characters long.";
        addError(login, loginError, message);
        login.style.border = "1px solid #FF0000";
        isValid = false;
    }
}

//password validation
function passwordValidate(){
    if(password.value.length !== "" && password.value.length >= 8){
        passwordError.remove();
        password.style.border = "1.5px solid #e08866";
    }
    else if(password.value.length < 8){
        message = "X Password should be at least 8 characters long.";
        addError(password, passwordError, message);
        password.style.border = "1px solid #FF0000";
        isValid = false;
    }
}

//password verification validation
function password2Validate(){
    if(password2.value == password.value && password2.value.length > 0){
        password2Error.remove();
        password2.style.border = "1.5px solid #e08866";
    }
    else if(password2.value !== password.value || password2.value == ""){
        message = "X Passwords must match.";
        addError(password2, password2Error, message);
        password2.style.border = "1px solid #FF0000";
        isValid = false;
    }
}


function validate(event) {

    isValid = true;
    errorMessage = "";

    emailValidate();
    loginValidate();
    passwordValidate();
    password2Validate();

    if(isValid == false){
        event.preventDefault();
    }
    else{
        login.value = login.value.toLowerCase();
    }

    if(!validated){
        email.addEventListener("input", emailValidate);
        login.addEventListener("input", loginValidate);
        password.addEventListener("input", passwordValidate);
        password2.addEventListener("input", password2Validate);
        password.addEventListener("input", password2Validate);
    }

    validated = true;
}