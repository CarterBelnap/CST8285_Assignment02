/*
	Name: Ahmed Al-Zaher
	File Name: Idea-validation.js
	Date: 08-04-2024
	Purpose: Form Validation Functionality for idea submissions
*/


const Form = document.forms[0];
let isValid = true;
document.getElementById("post_form").addEventListener("click", validate);

const iTitle = document.getElementById("idea_title"); 
const selectedGenresDiv  = document.getElementById("selectedGenres");
const coverImageURL = document.getElementById("cover_image_url");

function validate(event) {

    isValid = true;
    errorMessage = "";

    if (iTitle.value == ""){
        isValid = false;
        errorMessage += "Title must not be empty.\n";
    }
    if(coverImageURL.value == ""){
        isValid = false;
        errorMessage += "Cover Image URL must not be empty.\n";
    }
    
    const selectedGenre = selectedGenresDiv.getElementsByTagName('span');
    if(selectedGenre.length === 0){
        isValid = false;
        errorMessage += "Please select at least one genre.\n";
    }
    
    const sections = document.querySelectorAll('.idea_section');
    sections.forEach((section) => {
        const sectionTitle = section.querySelector('.section_title');
        const sectionBody = section.querySelector('.section_body');
        if (sectionTitle.value == "") {
            isValid = false;
            errorMessage += `Section title must not be empty.\n`;
        }
        if (sectionBody.value == "") {
            isValid = false;
            errorMessage += `Section text must not be empty.\n`;
        }
    });

    if(isValid == false){
        event.preventDefault();
        alert(errorMessage);
    }
    else{
        login.value = login.value.toLowerCase();
        alert("success");
    }
}