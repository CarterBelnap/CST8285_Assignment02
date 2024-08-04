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
    <link rel="stylesheet" href="CSS\General-Styling.css">
        <link rel="stylesheet" href="CSS\index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./JS/SearchAndGenre.js"></script>
    <title>Home Page</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <div class="side-box left-box"></div>
        <div class="content">
            <div id="searchbar"> 
                <p> Search for an idea...</p>   
                <form id="searchForm">
                    <input type="text" name="query" placeholder="Search..." id="searchInput">
                    <button type="submit" id="search-button">Search</button>
                </form>
            </div>
            <div id="selectedGenres"> 
                <p> Search by Genre...</p>
                <form id="genre">
                    <select name="genres[]" id="genres"></select>
                    <button type="submit" id="search-button">Search</button>
                </form>
            </div>
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