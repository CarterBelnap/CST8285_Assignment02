var addButton = document.getElementById("add-section");
addButton.addEventListener('click', addSection);

function addSection(){

    var sectionsDiv = document.getElementById('sections');
    var newSection = document.createElement('div');
    var sectionCount = document.getElementsByClassName('idea-section').length;

    newSection.classList.add('idea-section');
    newSection.innerHTML = `
        <input type="text" name="section_titles[]" class="section-title" placeholder="Section Title">
        <textarea name="section_texts[]" class="section-body"></textarea>
        <input type="text" name="section_urls[]" class="section-url" placeholder="image URL (Optional)">`;
    if (sectionCount >= 1) {
        var removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('remove-section');
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', function() {
            newSection.remove();
        });
        newSection.appendChild(removeButton);
    }

    sectionsDiv.appendChild(newSection);
}

