// search.js

$(document).ready(function () {
  $("#searchForm").on("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission

    var query = $("#searchInput").val(); // Get the search query

    $.ajax({
      url: "./PHP/GameIdeas/List_Ideas.php",
      type: "GET",
      data: { query: query },
      success: function (response) {
        $("#results").html(response); // Update the results div with the response
      },
      error: function () {
        alert("Error retrieving search results.");
      },
    });
  });
});
