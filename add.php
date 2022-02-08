<?php
include 'config.php';

if(isset($_GET) && !empty($_GET)) {
    $id = htmlspecialchars($_GET['id']);
    $prep = $db->prepare("UPDATE books SET nb = nb+1 WHERE id = ?");
    try {
        $prep->execute([$id]);
    } catch(Exception $e) {
        echo "Nice";
    }
    header('Location:index.php');
} else {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adding books</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Adding books</h2>
    <a class="list" href="index.php">List of books</a>
    <div class="error">
    <?php
    if(isset($_POST['insert'])) {
        $title = htmlspecialchars($_POST['title']);
        $author = htmlspecialchars($_POST['author']);
        $genre = htmlspecialchars($_POST['genre']);
        $nb = htmlspecialchars($_POST['nb']);
        
        if (!empty($title) && isset($title)) {
            if(!empty($author) && isset($author)) {
                if(!empty($genre) && isset($genre)) {
                    if(!empty($nb) && isset($nb)) {
                        if($db->query("INSERT INTO books (title,author, genre, nb) VALUES('" . $title . "', '" . $author . "','" . $genre . "', '" . $nb . "')")) {
                            echo "<span style='color:green'>Nice, Book added.</span>";
                        }
                    } else {
                        echo "<span>Nope, error in the numbre of books possossed.</span>";
                    }
                } else {
                    echo "<span>Nope, error in genres.</span>";
                }
            } else {
                echo "<span>Nope, error in the author's name.</span>";
            }
        } else {
            echo "<span>Nope, error in the title.</span>";
        }
    }

    ?>
    </div>
    <form action="" method="post">
            <div class="input"><label for="title">Title</label><input type="text" id="title" name="title"></div>
            <div class="input"><label for="author">Author</label><input type="text" id="author" name="author"></div>
            <div class="input"><label for="genre">Genre(s)</label><input type="text" id="genre" name="genre"></div>
            <div class="input"><label for="nb">Number possessed</label><input type="number" id="nb" name="nb"></div>
            <div class="input"><input type="submit" name="insert" value="Add"></div>
    </form>
</body>
</html>
<?php
}
?>