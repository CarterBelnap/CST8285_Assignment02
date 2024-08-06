<!-- 
	Name: Ahmed Al-Zaher & Carter Belnap
	File Name: index.php
	Date: 08-04-2024
	Purpose: HTML for the homepage of the website. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\General_Styling.css">
    <link rel="stylesheet" href="CSS\index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./JS/Search.js"></script>
    <title>Home Page</title>
</head>
<body>
    <?php include './PHP/Header/header.php'; ?>
    <?php include 'C:\Users\carte\OneDrive\Documents\XAMPP Files\htdocs\CST8285_Assignment02\PHP\Config.php'; ?>
    <?php
        // Fetch genres from the database
        $genres_query = "SELECT id, name FROM Genres"; // Adjust table and column names as needed
        $genres_result = mysqli_query($connection, $genres_query);

        $genres = [];
        if (mysqli_num_rows($genres_result) > 0) {
            while ($genre = mysqli_fetch_assoc($genres_result)) {
                $genres[] = $genre;
            }
        }
    ?>
    <div class="container">
        <div class="side_box">            
            <div id="searchbar"> 
                <p> Search for an idea...</p>   
                <form id="searchForm">
                    <input type="text" name="query" placeholder="Search..." id="searchInput">
                    <button type="submit" id="search-button">Search</button>
                    <button type="reset" id="search-button">X</button>
                </form>
            </div>
            <div id="selectedGenres"> 
                <p> Search by Genre...</p>
                <form id="genre">
                    <select name="genres[]" id="genres" multiple>
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?php echo htmlspecialchars($genre['id']); ?>">
                                <?php echo htmlspecialchars($genre['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" id="search-button">Search</button>
                    <button type="reset" id="search-button">X</button>
                </form>
            </div>
        </div>
        <div class="content">
            <div class="idea-list">
                <form class="ideas">
                    <div id="results">
                        <?php include './PHP/GameIdeas/List_Ideas.php'; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>