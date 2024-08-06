$(document).ready(function () {
  // Search form submission
  $("#searchForm").on("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission

    var query = $("#searchInput").val(); // Get the search query

    // Call the function to perform the AJAX request
    performSearch(query, getSelectedGenres());
  });

  // Genre filter form submission
  $("#genre").on("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Call the function to perform the AJAX request
    performSearch($("#searchInput").val(), getSelectedGenres());
  });

  function performSearch(query, genres) {
    $.ajax({
      url: "./PHP/GameIdeas/List_Ideas.php",
      type: "GET",
      data: { query: query, genres: genres },
      success: function (response) {
        $("#results").html(response); // Update the results div with the response
      },
      error: function () {
        alert("Error retrieving search results.");
      },
    });
  }

  function getSelectedGenres() {
    return $("#genres").val(); // Get the selected genres from the dropdown
  }
});
