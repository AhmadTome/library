<?php
session_start();
require_once ('connection.php');
$conn = getConnection();


$bookId = $_POST['bookId'];
$subscriber_name = $_POST['subscriber_name'];
$subscriber_phone = $_POST['subscriber_phone'];
$subscribe_date = $_POST['subscribe_date'];
$back_date = $_POST['back_date'];
$status = "قيد الاستخدام";
$financial_penalty = 0;
$paid_financial_penalty = 0;

if ($bookId == 0) {
    $_SESSION['Error'] = "لم يتم تسجيل الاشتراك, يرجى اختيار الكتاب";
    header('Location: ../reserveBook.php');
    return;
}

$query = "INSERT INTO `books_reservations`(`book_id`, `subscriber_name`, `subscriber_phone`, `subscribe_date`, `back_date`, `status`, `financial_penalty`, `paid_financial_penalty`) VALUES
 ('". $bookId ."', '". $subscriber_name ."', '". $subscriber_phone ."', '". $subscribe_date ."', '". $back_date ."', '". $status ."', '". $financial_penalty ."', '". $paid_financial_penalty ."')";

$result = $conn->query($query);

if ($result) {
    $_SESSION['Success'] = "تم تسجيل الاشتراك بنجاح !";
    header('Location: ../reserveBook.php');
}
else {
    $_SESSION['Error'] = "لم يتم تسجيل الاشتراك, هناك مشكله حدثت!ّ";
    header('Location: ../reserveBook.php');
}
?>
