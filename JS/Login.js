/*
	Name: Ahmed Al-Zaher
	File Name: Login.js
	Date: 08-04-2024
	Purpose: Form Validation Functionality for registration
*/

//select the sign up button and have it trigger the validate method
const registrationForm = document.forms[0];
let isValid = true;
document.getElementById("register-button").addEventListener("click", validate);

//elements for login
const login = document.getElementById("username");

//elements for password
const password = document.getElementById("password");



function validate(event) {

    isValid = true;
    errorMessage = "";

    if(login.value == "" || login.value.length <= 0 ){
        isValid = false;
        errorMessage += "User name should be non-empty.\n";
    }
    if (password.value.length <= 0){
        isValid = false;
        errorMessage += "Password should be non-empty.\n";
    }

    if(isValid == false){
        event.preventDefault();
        alert(errorMessage);
    }
    else{
        login.value = login.value.toLowerCase();
        alert("Login Successful!");
    }
}