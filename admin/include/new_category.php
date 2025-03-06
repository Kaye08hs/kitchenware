<?php
include('connection.php');  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryName = trim($_POST['categoryName']);

    if (!empty($categoryName)) {
        $query = "INSERT INTO item_category (category_name) VALUES (?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $categoryName); 

        if ($stmt->execute()) {
            echo 'success';  
        } else {
            echo 'error';  
        }

        $stmt->close();
    } else {
        echo 'error';  
    }
}

$con->close();
?>
