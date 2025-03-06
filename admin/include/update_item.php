<?php
include('connection.php');

$itemId = $_POST['itemId'];
$itemName = $_POST['itemName'];
$itemDescription = $_POST['itemDescription'];
$categoryName = $_POST['categoryName'];

$sql = "UPDATE items 
        SET item_name = ?, item_description = ?, category_id = (SELECT category_id FROM item_category WHERE category_name = ?) 
        WHERE item_id = ?";
$stmt = $con->prepare($sql);

if ($stmt === false) {
    die('MySQL prepare error: ' . $con->error);
}

$stmt->bind_param('sssi', $itemName, $itemDescription, $categoryName, $itemId);

if ($stmt->execute()) {
    echo 'success'; 
} else {
    echo 'error';  
}

$stmt->close();
$con->close();
?>
