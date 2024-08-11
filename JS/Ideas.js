/*
	Name: Carter Belnap
	File Name: Ideas.js
	Date: 08-04-2024
	Purpose: AJAX scripts in order to load and list ideas on the main page
*/

function loadAllIdeas() {
  $.ajax({
    url: "/CST8285_Assignment02/PHP/GameIdeas/List_Ideas.php",
    success: function (response) {
      $("results").html(response);
    },
  });
}
