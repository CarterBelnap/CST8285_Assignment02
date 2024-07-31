var addButton = document.getElementById("add-section");
addButton.addEventListener('click', addSection);

function addSection(){

    var sectionsDiv = document.getElementById('sections');
    var newSection = document.createElement('div');
    var sectionCount = document.getElementsByClassName('idea-section').length;

    newSection.classList.add('idea-section');
    newSection.innerHTML = `
        <input type="text" class="section-title" placeholder="Section Title">
        <textarea name="section_text" class="section-body"></textarea>`;
    sectionsDiv.appendChild(newSection);
}
