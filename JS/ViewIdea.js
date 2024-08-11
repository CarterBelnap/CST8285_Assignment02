/*
	Name: Carter Belnap
	File Name: ViewIdea.js
	Date: 08-04-2024
	Purpose: JS in order to view an idea on index.php
*/

document.addEventListener("DOMContentLoaded", () => {
  const ideaList = document.querySelector(".idea_list");

  ideaList.addEventListener("click", (event) => {
    if (event.target.classList.contains("view-button")) {
      const ideaId = event.target.getAttribute("data-id");

      fetch(`./PHP/GameIdeas/View_Idea.php?id=${encodeURIComponent(ideaId)}`)
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("displayed_idea").innerHTML = data;
        })
        .catch((error) => console.error("Error:", error));
    }
  });
});

function showDisplayedIdea() {
  document.getElementById("overlay").style.display = "block";
  document.getElementById("displayed_idea").style.display = "block";
}

function hideDisplayedIdea() {
  document.getElementById("overlay").style.display = "none";
  document.getElementById("displayed_idea").style.display = "none";
}
