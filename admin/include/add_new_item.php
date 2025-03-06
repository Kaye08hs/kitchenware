<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemName = mysqli_real_escape_string($con, $_POST['item_name']);
    $categoryId = mysqli_real_escape_string($con, $_POST['category_id']);
    $itemDescription = mysqli_real_escape_string($con, $_POST['item_description']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    
    $imagePath = '';
    if (isset($_FILES['item_image']) && $_FILES['item_image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['item_image']['tmp_name'];
        $imageName = $_FILES['item_image']['name'];
        $imagePath = '../uploads/' . basename($imageName);  // Save image in the "uploads" folder

        if (!move_uploaded_file($imageTmpName, $imagePath)) {
            echo 'error';
            exit;
        }
    }

    $query = "INSERT INTO items (item_name, category_id, item_description, quantity, item_image) 
              VALUES ('$itemName', '$categoryId', '$itemDescription', '$quantity', '$imageName')";
    if (mysqli_query($con, $query)) {
        echo 'success';
    } else {
        echo 'error';
    }

    mysqli_close($con);
}
?>
