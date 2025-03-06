<?php
include('connection.php');

if (isset($_POST['categoryId'], $_POST['categoryName'])) {
    $categoryId = $_POST['categoryId'];
    $categoryName = $_POST['categoryName'];

    $sql = "UPDATE item_category SET category_name = ? WHERE category_id = ?";

    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, 'si', $categoryName, $categoryId);

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
