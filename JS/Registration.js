/*
	Name: Ahmed Al-Zaher
	File Name: Registration.js
	Date: 08-04-2024
	Purpose: Form Validation Functionality for registration
*/


const registrationForm = document.forms[0];
let isValid = true;
document.getElementById("register_button").addEventListener("click", validate);

//elements for email
const email = document.getElementById("email"); //selects the email input tag from the html sheet
let emailFormat = /^[A-Za-z0-9._]+@[A-Za-z0-9.]+\.[A-Za-z]{2,4}$/; //regex for email format

//elements for login
const login = document.getElementById("username");

//elements for password
const password = document.getElementById("password");

//elements for password verification
const password2 = document.getElementById("password2");

function validate(event) {

    isValid = true;
    errorMessage = "";

    if(!emailFormat.test(email.value) || email.value.length <= 0){
        isValid = false;
        errorMessage += "Email address should be non-empty with the format xyz@xyz.xyz.\n";
    }
    if(login.value == "" || login.value.length <= 0 ){
        isValid = false;
        errorMessage += "User name should be non-empty.\n";
    }
    if (password.value.length <= 0){
        isValid = false;
        errorMessage += "Password should be non-empty.\n";
    }
    if(password2.value !== password.value || password2.value.length <= 0){
        isValid = false;
        errorMessage += "Passwords must match.";
    }

    if(isValid == false){
        event.preventDefault();
        alert(errorMessage);
    }
    else{
        login.value = login.value.toLowerCase();
    }
}