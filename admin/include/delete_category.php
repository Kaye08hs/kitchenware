<?php
// Include database connection
include('connection.php');

if (isset($_POST['categoryId'])) {
    $categoryId = $_POST['categoryId'];

    $sql = "DELETE FROM item_category WHERE category_id = ?";

    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $categoryId);

        if (mysqli_stmt_execute($stmt)) {
            echo 'success';
        } else {
            echo 'error';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo 'error';
    }

    mysqli_close($con);
} else {
    echo 'error';
}
?>
