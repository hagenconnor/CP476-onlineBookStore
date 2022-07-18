<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Online Bookstore</title>
</head>
<body>
<div><p>Welcome to the online book store!</p>
<div><p>Show books:</p>

<form action="/CP476/CP476-onlineBookStore/online_store.php" method="post">
<input type="submit" name="show_books" value="Show Books">
</form>
<form action="/CP476/CP476-onlineBookStore/add_book.php" method="post">
<input type="submit" name="add_book" value="Add New Book">
</form>
</form>
<form action="/CP476/CP476-onlineBookStore/search_book_delete.php" method="post">
<input type="submit" name="delete_book" value="Delete Book">
</form>
</form>
<form action="/CP476/CP476-onlineBookStore/update_book.php" method="post">
<input type="submit" name="update_book" value="Update Book">
</form>


</div>
</body>
</html>

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $conn = new mysqli("localhost", "root", "password", "online_bookstore");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //echo "Connected to MySQL server \n";
        $conn->set_charset("utf8mb4");
    } catch(Exception $e) {
        error_log($e->getMessage());
        exit('Error connecting to database'); 
    }
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
