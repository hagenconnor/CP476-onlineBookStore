</form>
<form action="/CP476/CP476-onlineBookStore/change_book.php" method="post">

<label for="book_id">Enter Book ID:</label><br>
<input type="text" id="book_id" name="book_id"><br>

<input type="submit" name="submit" value="Search for Book">
</form>

</form>
<form action="/CP476/CP476-onlineBookStore/online_store.php" method="post">
<input type="submit" name="back" value="Back">
</form>

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])){
        print "Got here and add_book was pressed.";
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

        $title = $_POST['title'];
        $author = $_POST['author'];
        $genre = $_POST['genre'];
        $year = $_POST['year'];

        $sql = $conn->prepare("INSERT INTO book_list(title, author, genre) VALUES (?, ?, ?)");
        $sql->bind_param("sss", $title, $author, $genre); 
        if($sql->execute() == true)
        {
            echo "Insertion succeeded \n";
        }else{
            echo "Insertion failed \n";
        }

    }

}
?>