<?php
include('connection.php');  

if (isset($_POST['borrowed_id'])) {
    $borrowedId = $_POST['borrowed_id'];  

    $sql = "UPDATE item_borrowed SET status = 1 WHERE borrowed_id = ?";
    
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $borrowedId);

        if ($stmt->execute()) {
            echo "success";  
        } else {
            echo "error";
        }
    } else {
        echo "error";  
    }
}
?>
