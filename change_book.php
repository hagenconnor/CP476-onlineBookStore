<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Modify a Book</title>
</head>
<body>
</form>
<form action="change_book.php" method="post">

<label for="title">Book Title:</label><br>
<input type="text" id="title" name="title"><br>
<label for="author">Author:</label><br>
<input type="text" id="author" name="author"><br>
<label for="year">Year:</label><br>
<input type="text" id="year" name="year"><br>
<label for="genre">Genre:</label><br>
<input type="text" id="genre" name="genre"><br>

<label> Select which field to update:</label><br>
<input type="radio" id="u_title" name="update_field" value="Title">
<label for="u_title">Title</label><br>
<input type="radio" id="u_author" name="update_field" value="Author">
<label for="u_author">Author</label> <br>
<input type="radio" id="u_year" name="update_field" value="Year">
<label for="u_year">Year</label><br>
<input type="radio" id="u_genre" name="update_field" value="Genre">
<label for="u_genre">Genre</label><br>

<input type="submit" name="update" value="Update Book">

</form>
</form>
<form action="online_store.php" method="post">
<input type="submit" name="back" value="Back">
</form>

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $conn = new mysqli("localhost", "root", "password", "online_bookstore");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $conn->set_charset("utf8mb4");
    } catch(Exception $e) {
        error_log($e->getMessage());
        exit('Error connecting to database'); 
    }
    if (isset($_POST['submit'])){
        $id = $_POST['book_id'];
        $sql = $conn->prepare("SELECT * FROM book_list WHERE id= ?");
        $sql->bind_param("i", $id); 
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_array(MYSQLI_NUM);

        if ($row == null){
            print("Error: Book does not exist.");
        }
        else{
            $_SESSION['update_id'] = $row[0];
        }

        //print($_SESSION['id']);
        //print("ID passed from previous page: $id");

    }
    if (isset($_POST['update'])){

        $selection = $_POST['update_field'];
        $id = $_SESSION['update_id'];

        //print("id after function call: $id");

        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['year'];
        $genre = $_POST['genre'];
        $exec_success = false;

        if ($selection == "Title"){
            $sql = $conn->prepare("UPDATE book_list SET title=? WHERE id=?");
            $sql->bind_param("si", $title, $id);
            if ($sql->execute() == true){
                $exec_success = true;
            }
            print($id);
        }
        else if ($selection == "Author"){
            $sql = $conn->prepare("UPDATE book_list SET author=? WHERE id=?");
            $sql->bind_param("si", $author, $id);
            $sql->execute();
            if ($sql->execute() == true){
                $exec_success = true;
            }
        }
        else if ($selection == "Year"){
            $sql = $conn->prepare("UPDATE book_list SET year=? WHERE id=?");
            $sql->bind_param("si", $year, $id);
            $sql->execute();
            if ($sql->execute() == true){
                $exec_success = true;
            }
        }
        else{
            //Selection is genre.
            $sql = $conn->prepare("UPDATE book_list SET genre=? WHERE id=?");
            $sql->bind_param("si", $genre, $id);
            $sql->execute();
            if ($sql->execute() == true){
                $exec_success = true;
            }
        }



    }

}
?>