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

var genreSelect = document.getElementById("genres");

// Function to populate the dropdown
function populateGenres() {
  genres.forEach(function (genre) {
    var option = document.createElement("option");
    option.value = genre;
    option.textContent = genre;
    genreSelect.appendChild(option);
  });
}

// Call the function to populate genres on page load
window.onload = populateGenres;

// Event listener for dropdown selection
function genreSelection() {
  var selectedGenre = genreSelect.value;
  if (selectedGenre) {
    addGenre(selectedGenre);
    removeOptionFromDropdown(selectedGenre);
  }
}
genreSelect.addEventListener("change", genreSelection);

// Add genre to list
function addGenre(selectedGenre) {
  var selectedGenresDiv = document.getElementById("selectedGenres");
  var listedGenre = document.createElement("span");
  listedGenre.className = "selected_genre";
  listedGenre.textContent = selectedGenre;

  // Add click event listener to the span to remove the genre
  listedGenre.onclick = function () {
    removeGenre(selectedGenre, listedGenre);
  };

  selectedGenresDiv.appendChild(listedGenre);
}

// Remove genre from dropdown
function removeOptionFromDropdown(genre) {
  var options = genreSelect.options;
  for (var i = 0; i < options.length; i++) {
    if (options[i].value === genre) {
      genreSelect.remove(i);
      break;
    }
  }
}

// Remove genre from selected list and add back to dropdown
function removeGenre(genre, element) {
  element.remove(); // Remove the genre from the displayed list
  var option = document.createElement("option");
  option.value = genre;
  option.textContent = genre;
  genreSelect.appendChild(option); // Add it back to the dropdown
}
