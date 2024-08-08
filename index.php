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
    <?php include './PHP/Config.php'; ?>
    <div class="container">
        <div class="side_box">            
            <div id="searchbar"> 
                <p> Search for an idea...</p>   
                <form id="searchForm">
                    <input type="text" name="query" placeholder="Search..." id="searchInput">
                    <button type="submit" id="search-button">Search</button>
                    <a href="./index.php">X</a>
                </form>
            </div>
            <div id="selectedGenres"> 
                <p> Search by Genre...</p>
                <form id="genre">
                </form>
            </div>
        </div>
        <div class="content">
            <div class="idea-list">
                    <div class=idealists id="results">
                        <?php include './PHP/GameIdeas/List_Ideas.php'; ?>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>