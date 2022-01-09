<?php
session_start();
require_once ('connection.php');
$conn = getConnection();

$id = $_REQUEST['id'];
$query = "SELECT * FROM `books_reservations` where id = ". $id;

$result = $conn->query($query);

$reservations = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($reservations,
            [
                "id" => $row["id"],
                "status" => $row["status"],
                "financial_penalty" => $row["financial_penalty"],
                "paid_financial_penalty" => $row["paid_financial_penalty"],
            ]
        );
    }
}

echo json_encode($reservations);
?>
