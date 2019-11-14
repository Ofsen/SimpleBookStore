<?php
include 'config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search a book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Search a book</h2>
    <a class="list" href="index.php">List of books</a>
    <form class="search" action="" method="post">
        <input type="text" name="search" id="search" placeholder="Search titles, authors and genres.">
        <input type="submit" value="Search" name="sub">
    </form>
    <?php
    if(isset($_POST['search'])) {
        $search = htmlspecialchars($_POST['search']);
        if(isset($search) && !empty($search)) {
            $req = $db->query("SELECT * FROM books WHERE title LIKE '%" . $search . "%' OR author LIKE '%" . $search . "%' OR genre LIKE '%" . $search . "%'")->fetchAll();
            ?>
            <h3>Results for : <?= $search;?></h3>
            <div class="book bold"><p>Title</p><p>Author</p><p class="genre">Genre</p><p>Nb</p><p>-1</p><p>+1</p><p>Del</p></div>
            <?php
            foreach($req as $book) {
                echo "<div class='book'><p>" . $book['title'] . "</p><p>" . $book['author'] . "</p><p class='genre'>" . $book['genre'] . "</p><p>" . $book['nb'] . "</p><p><a href='delete.php?id=" . $book['id'] . "'>&minus;</a></p><p><a style='color:green' href='add.php?id=" . $book['id'] . "'>+</a></p><p><a style='color:black' href='delete.php?all=yes&id=" . $book['id'] . "'>&times;</a></p></div>";
            }
        }
    }
    ?>
</body>
</html>