<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add a Book</title>
</head>
<body>
</form>
<form action="add_book.php" method="post">

<label for="title">Book Title:</label><br>
<input type="text" id="title" name="title"><br>
<label for="author">Author:</label><br>
<input type="text" id="author" name="author"><br>
<label for="year">Year:</label><br>
<input type="text" id="year" name="year"><br>
<label for="genre">Genre:</label><br>
<input type="text" id="genre" name="genre"><br>

<input type="submit" name="submit" value="Add New Book">
</form>

</form>
<form action="online_store.php" method="post">
<input type="submit" name="back" value="Back">
</form>



<?php
include("db.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])){
        
        $title = $_POST['title'];
        $author = $_POST['author'];
        $genre = $_POST['genre'];
        $year = $_POST['year'];

        $sql = $conn->prepare("INSERT INTO book_list(title, author, genre, year) VALUES (?, ?, ?, ?)");
        $sql->bind_param("sssi", $title, $author, $genre, $year); 
        if($sql->execute() == true)
        {
            echo "Insertion succeeded \n";
        }else{
            echo "Insertion failed \n";
        }

    }

}
?>