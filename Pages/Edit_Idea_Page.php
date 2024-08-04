<?php include "../PHP/GameIdeas/Get_Editable.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/General_Styling.css">
    <link rel="stylesheet" href="../CSS/Create_Idea.css">
    <script defer src="../JS/Genres.js"></script>
    <script defer src="../JS/Add_Section.js"></script>
    <script defer src="../JS/Idea_validation.js"></script>
    <title>Edit Idea</title>
</head>
<body>
    <form method="post" action="../PHP/GameIdeas/Submit_Edit.php">
        <input type="hidden" name="idea_id" value="<?php echo htmlspecialchars($ideaId); ?>">
        <div id="idea_form">
            <h1>Edit Idea</h1>
            <div id="idea_top">
                <input type="text" name="title" id="idea_title" placeholder="Title" value="<?php echo htmlspecialchars($idea['title']); ?>">
                <select name="genres[]" id="genres"></select>
                <div id="selectedGenres"></div>
                <input type="text" name="cover_image_url" id="cover_image_url" placeholder="Cover Image URL" value="<?php echo htmlspecialchars($idea['cover_image_url']); ?>">
            </div>
            <div name="sections" id="sections">
                <?php foreach ($sections as $index => $section) { ?>
                <div class="idea-section">
                    <input type="text" name="section_titles[]" class="section_title" placeholder="Section Title" value="<?php echo htmlspecialchars($section['section_title']); ?>">
                    <textarea name="section_texts[]" class="section_body"><?php echo htmlspecialchars($section['section_text']); ?></textarea>
                    <?php
                    $sectionId = $section['id'];
                    $imageQuery = "SELECT image_url FROM SectionImages WHERE section_id = $sectionId";
                    $imageResult = mysqli_query($connection, $imageQuery);
                    $imageUrl = '';
                    if ($row = mysqli_fetch_assoc($imageResult)) {
                        $imageUrl = $row['image_url'];
                    }
                    ?>
                    <input type="text" name="section_urls[]" class="section_url" placeholder="Image URL (Optional)" value="<?php echo htmlspecialchars($imageUrl); ?>">
                    <?php if ($index > 0) { ?>
                        <button type="button" class="remove_section">Remove</button>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
            <button type="button" id="add_section">+</button>
            <div id="form_buttons">
                <button type="submit" id="post_form">Update</button>
                <a href="./Profile.php" id="cancel_form">Cancel</a>
            </div>
        </div>
    </form>
    <div id="delete_form">
        <form method="post" action="../PHP/GameIdeas/Delete_Idea.php">
            <input type="hidden" name="idea_id" value="<?php echo htmlspecialchars($ideaId); ?>">
            <button type="submit" id="delete_idea" onclick="return confirm('Are you sure you want to delete this idea?');">Delete Idea</button>
        </form>
    </div>
</body>
</html>