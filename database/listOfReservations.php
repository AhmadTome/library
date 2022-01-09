<?php
session_start();
require_once ('connection.php');
$conn = getConnection();


$query = "SELECT *, br.id as reservation_id FROM `books_reservations` br LEFT JOIN `books` b on br.book_id = b.id";

$result = $conn->query($query);

$reservations = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($reservations,
            [
                "reservation_id" => $row["reservation_id"],
                "subscriber_name" => $row["subscriber_name"],
                "subscriber_phone" => $row["subscriber_phone"],
                "book_name" => $row["book_name"],
                "subscribe_date" => $row["subscribe_date"],
                "back_date" => $row["back_date"],
                "status" => $row["status"],
                "financial_penalty" => $row["financial_penalty"],
                "paid_financial_penalty" => $row["paid_financial_penalty"],
            ]
        );
    }
}

echo json_encode($reservations);
?>
