<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book store</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Book store</h2>
    <a class="addBook" href="add.php">New book</a>
    <a class="list" href="search.php">Search</a>
    <div class="book bold"><p>Title</p><p>Author</p><p class="genre">Genre</p><p>Nb</p><p>-1</p><p>+1</p><p>Del</p></div>
    <?php
    include 'config.php';

    $req = $db->query("SELECT * FROM books")->fetchAll();
    if(empty($req)) {
        echo "<div class='book'><span>No books</span></div>";
    } else {
        foreach($req as $book) {
            ?>
            <div class='book'><p><?= $book['title']; ?></p><p><?= $book['author']; ?></p><p class='genre'><?= $book['genre']; ?></p><p><?= $book['nb']; ?></p><p><a <?php if($book['nb'] < 2) { ?> onclick='return confirm("You are going to delete the book, are you sure ?")' <?php } ?>  href="delete.php?id=<?= $book['id']; ?>">&minus;</a></p><p><a style='color:green' href='add.php?id=<?= $book['id']; ?>'>+</a></p><p><a onclick="return confirm('You are going to delete the book, are you sure ?')" style='color:black' href='delete.php?all=yes&id=<?= $book['id']; ?>'>&times;</a></p></div>
            <?php
        }
    }
    ?>
</body>
</html>