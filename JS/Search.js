$(document).ready(function () {
  // Search form submission
  $("#searchForm").on("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission

    var query = $("#searchInput").val(); // Get the search query

    // Call the function to perform the AJAX request
    performSearch(query);
  });

  function performSearch(query) {
    $.ajax({
      url: "./PHP/GameIdeas/List_Ideas.php",
      type: "GET",
      data: { query: query }, // Only send the search query as data
      success: function (response) {
        $("#results").html(response); // Update the results div with the response
      },
      error: function () {
        alert("Error retrieving search results.");
      },
    });
  }
});
