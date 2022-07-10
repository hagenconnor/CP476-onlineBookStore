</form>
<form action="/CP476/CP476-onlineBookStore/change_book.php" method="post">

<label for="title">Book Title:</label><br>
<input type="text" id="title" name="title"><br>
<label for="author">Author:</label><br>
<input type="text" id="author" name="author"><br>
<label for="year">Year:</label><br>
<input type="text" id="year" name="year"><br>
<label for="genre">Genre:</label><br>
<input type="text" id="genre" name="genre"><br>

<input type="submit" name="update" value="Update Book">

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
        
        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            foreach ($row as $r) {
                print "$r ";
            }
            print "\n";
        }

    }
    if (isset($_POST['update'])){
        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['year'];
        $genre = $_POST['genre'];
        $exec_success = false;

        if ($title != null & $author != null & $year != null & $genre != null){
            //all are here
            $sql = $conn->prepare("UPDATE book_list SET title=?, author=?, genre=?");
            $sql->bind_param("sss", $title, $author, $genre);
            if($sql->execute() == true){
                $exec_success = true;
            }
            
        }
        else if ($author != null & $year != null & $genre != null){
            //title is null
            $sql = $conn->prepare("UPDATE book_list SET author=?, genre=?");
            $sql->bind_param("ss", $author, $genre);
        }
        else if ($year != null & $genre != null){
            //title and author are null
            $sql = $conn->prepare("UPDATE book_list SET year=?, genre=?");
            $sql->bind_param("is", $year, $genre);
        }
        else if ($genre != null){
            //title, author, and year are null
            $sql = $conn->prepare("UPDATE book_list SET genre=?");
            $sql->bind_param("s", $genre);
        }
        else{
            //all are null
            print("Add details to this page to change the book details.");
        }


    }

}
?>