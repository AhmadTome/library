<?php
session_start();
require_once ('connection.php');
$conn = getConnection();


$book_name = $_POST['book_name'];
$book_number = $_POST['book_number'];
$publish_name = $_POST['publish_name'];
$author_name = $_POST['author_name'];

$query = "INSERT INTO `books`(`book_name`, `book_number`, `publish_name`, `author_name`) VALUES ('". $book_name ."', '". $book_number ."', '". $publish_name ."', '". $author_name ."')";

$result = $conn->query($query);

if ($result) {
    $_SESSION['Success'] = "تم تسجيل الكتاب بنجاح !";
    header('Location: ../addBook.php');
}
else {
    $_SESSION['Error'] = "لم يتم تسجيل الكتاب, هناك مشكله حدثت!ّ";
    header('Location: ../addBook.php');
}
?>
