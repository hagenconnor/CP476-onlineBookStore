<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Delete Book</title>
</head>
<body>
</form>
<form action="online_store.php" method="post">
<input type="submit" name="back" value="Back">
</form>

<?php
include("db.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])){
            $id = $_POST['book_id'];
            $sql = $conn->prepare("DELETE FROM book_list WHERE id= ?");
            $sql->bind_param("i", $id); 
            $sql->execute();
            $result = mysqli_stmt_affected_rows($sql);
            if ($result == 1){
                print("Book was deleted successfully.");
                print("Affected rows: $result");
            }
            else{
                print("Book not found.");
            }
    }
}

?>