<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Online Bookstore</title>
</head>
<body>
<div><p>Welcome to the online book store!</p>
<div><p>Use the menu buttons below to interact:</p>

<form action="online_store.php" method="post">
<input type="submit" name="show_books" value="Show Books">
</form>
<form action="add_book.php" method="post">
<input type="submit" name="add_book" value="Add New Book">
</form>
</form>
<form action="search_book_delete.php" method="post">
<input type="submit" name="delete_book" value="Delete Book">
</form>
</form>
<form action="update_book.php" method="post">
<input type="submit" name="update_book" value="Update Book">
</form>

<form action="login.html" method="post">
<input type="submit" name="logout" value="Logout">
</form>


</div>
</body>
</html>

<?php
include("db.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch books table details.
    if (isset($_POST['show_books'])){
        get_books($conn);
    
    }
}

function get_books($conn){
    $sql = "SELECT * from book_list";
    $result = $conn->query($sql);
    print("******Book List*******");
    print("<br>");
    foreach($result as $row) {
        $id = $row['id'];
        $title = $row['title'];
        $author = $row['author'];
        $genre = $row['genre'];
        print("Book ID: $id ");
        print("Title: $title ");
        print("Author: $author ");
        print("Genre: $genre ");
        print("<br>");

    }
}
function output_formatter($string){
    
}


?>
