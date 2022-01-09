<?php
session_start();
require_once ('connection.php');
$conn = getConnection();


$id = $_POST['id'];
$status = $_POST['status'];
$financial_penalty = $_POST['financial_penalty'];
$paid_financial_penalty = $_POST['paid_financial_penalty'];

$query = "UPDATE `books_reservations` SET `status`='". $status ."',`financial_penalty`='". $financial_penalty ."',`paid_financial_penalty`='". $paid_financial_penalty ."' WHERE `id` = ".$id;

$result = $conn->query($query);

if ($result) {
    $_SESSION['Success'] = "تم تعديل الحجز بنجاح !";
    header('Location: ../editReservation.php?id='.$id);
}
else {
    $_SESSION['Error'] = "لم يتم تعديل الحجز, هناك مشكله حدثت!ّ";
    header('Location: ../editReservation.php?id='.$id);
}
?>
