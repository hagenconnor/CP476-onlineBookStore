<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Online Bookstore</title>
</head>
<body>
<!-- Script 3.2 - feedback.html -->
<div><p>Welcome to the online book store!</p>
<div><p>Show books:</p>

<form action="/CP476/CP476-onlineBookStore/online_store.php" method="post">
<input type="submit" name="show_books" value="Show Books">
</form>

</div>
</body>
</html>

<?php
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
    $sql = "SELECT * from book_list";
    $result = $conn->query($sql);
    foreach($result as $row) {
        print_r($row);       // Print the entire row data
    }
    
}


?>
