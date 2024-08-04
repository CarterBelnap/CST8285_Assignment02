$(document).ready(function () {
  // Function to populate genres
  function populateGenres() {
    var genres = [
      "Action",
      "Adventure",
      "Horror",
      "Puzzle",
      "2D",
      "3D",
      "Platformer",
      "Roguelike",
      "RPG",
      "Simulation",
      "Comedy",
      "Rhythm",
      "Multiplayer",
      "Story",
      "Shooter",
      "Card",
      "Board",
      "Party",
    ];
    var genreSelect = $("#genres");

    genres.forEach(function (genre) {
      var option = $("<option></option>").val(genre).text(genre);
      genreSelect.append(option);
    });
  }

  populateGenres(); // Populate dropdown on page load

  // Handle form submission for search
  $("#searchForm").on("submit", function (e) {
    e.preventDefault();

    var query = $("#searchInput").val();

    $.ajax({
      url: "./PHP/GameIdeas/List_Ideas.php",
      type: "GET",
      data: { query: query },
      success: function (response) {
        $("#results").html(response);
      },
      error: function () {
        alert("Error retrieving search results.");
      },
    });
  });

  // Handle form submission for genre filter
  $("#genre").on("submit", function (e) {
    e.preventDefault();

    var selectedGenres = $("#genres").val(); // Get all selected genres

    $.ajax({
      url: "./PHP/GameIdeas/List_Ideas.php",
      type: "GET",
      data: { genres: selectedGenres },
      success: function (response) {
        $("#results").html(response);
      },
      error: function () {
        alert("Error retrieving genre results.");
      },
    });
  });
});
