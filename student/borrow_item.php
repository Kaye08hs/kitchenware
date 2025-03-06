<?php
include('../admin/include/connection.php');

$item_id = $_POST['item_id'];
$quantity = $_POST['quantity'];
$purpose = $_POST['purpose'];
$date_borrowed = $_POST['date_borrowed'];
$return_date = $_POST['return_date'];
$student_id = $_POST['student_id']; 

$status = 0;  

$sql = "INSERT INTO item_borrowed (item_id, quantity, student_id, date_borrowed, date_return, status, purpose) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($sql);
$stmt->bind_param("iiissis", $item_id, $quantity, $student_id, $date_borrowed, $return_date, $status, $purpose);

if ($stmt->execute()) {
    // Update the item's quantity
    $update_sql = "UPDATE items SET quantity = quantity - ? WHERE item_id = ?";
    $update_stmt = $con->prepare($update_sql);
    $update_stmt->bind_param("ii", $quantity, $item_id);
    $update_stmt->execute();

    echo "success"; 
} else {
    echo "error";
}

$stmt->close();
$update_stmt->close();
$con->close();
?>
