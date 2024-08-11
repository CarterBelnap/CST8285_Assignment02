/*
	Name: Carter Belnap
	File Name: Search.js
	Date: 08-04-2024
	Purpose: Search function for finding specific ideas
*/

document.getElementById("search-button").addEventListener("click", function () {
  var query = document.getElementById("search-input").value;
  var genre = document.getElementById("genre-select").value;
  var url =
    "List_Ideas.php?query=" +
    encodeURIComponent(query) +
    "&genre=" +
    encodeURIComponent(genre);
  window.location.href = url;
});
