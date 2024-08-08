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
    <link rel="stylesheet" href="CSS/General_Styling.css">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/Idea_List.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="./JS/Search.js"></script>
    <title>Home Page</title>
</head>
<body>
    <?php include './PHP/Header/header.php'; ?>
    <?php include './PHP/Config.php'; ?>
    <div class="container">
        <div class="side_box">            
            <div id="searchbar"> 
                <p>Search</p>   
                <form id="searchForm">
                    <input id="search-input" type="text" name="query" placeholder="Search..." id="searchInput">
                    <button type="button" id="search-button">GO...</button>
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
            <div class="idea_list">
            <h2>My Game Ideas</h2>
                <?php include './PHP/GameIdeas/List_Ideas.php'; ?>
            </div>
        </div>
    </div>
</body>
</html>