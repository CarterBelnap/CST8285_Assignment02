function viewDetails(gameIdeaId) {
  $.ajax({
    url: "/CST8285_Assignment02/PHP/GameIdeas/View_Idea.php",
    type: "GET",
    data: { id: gameIdeaId },
    success: function (response) {
      $("results").html(response);
    },
    error: function () {
      alert("Error loading details.");
    },
  });
}

function loadAllIdeas() {
  $.ajax({
    url: "/CST8285_Assignment02/PHP/GameIdeas/List_Ideas.php",
    success: function (response) {
      $("results").html(response);
    },
  });
}
