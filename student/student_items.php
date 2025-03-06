<?php 
include('../admin/include/connection.php');

    header('Access-Control-Allow-Origin: *');

    session_start();

    $student_id = $_SESSION['student_id'];

// Fetch categories
$sql = "SELECT category_id, category_name FROM item_category";
$result = $con->query($sql);

// Fetch items
$sql1 = "SELECT item_id, item_name, category_id, item_description, quantity, item_image FROM items";
$result1 = $con->query($sql1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITEMS-CPC-BSHM's KITCHENWARES</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=League+Spartan:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- jQuery (required for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        label {
            width: 100% !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row header">
            <div class="col-md-12 logo-box">
                <img src="img/logo.png" alt="Logo"> <span>CPC-BSHM's KITCHENWARES</span>
            </div>
        </div>

        <div class="row content">
            <div class="col-md-12 img-dashboard">
                <div class="new">
                    <h2>ITEMS</h2>
                </div>

                <div class="row filter-cat">
                    <div class="col-md-6 select-cat">
                        <select>
                            <option value="" disabled selected>Select Category</option>
                            <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No categories available</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 search-cat">
                        <input type="search" placeholder="Search Item">
                    </div>
                </div>

                <div class="row item-container">
                    <?php
                    if ($result1->num_rows > 0) {
                        while ($row = $result1->fetch_assoc()) {
                            echo '<div class="col-md-4 item-box">';
                            echo '<div class="row">';
                            echo '<div class="col-md-6 text-center">';
                            echo '<img src="../admin/uploads/' . $row['item_image'] . '" alt="' . $row['item_name'] . '" style="width: 100%;">';
                            echo '</div>';
                            echo '<div class="col-md-6">';
                            echo '<h5>' . $row['item_name'] . '</h5>';
                            echo '<span id="quantity-available-' . $row['item_id'] . '">Stocks: ' . $row['quantity'] . '</span>';
                            echo '<button class="button" data-bs-toggle="modal" data-bs-target="#borrowModal" onclick="setItemDetails(' . $row['item_id'] . ', \'' . $row['item_name'] . '\', ' . $row['quantity'] . ')">Borrow</button>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No items available</p>';
                    }
                    ?>
                </div>
            </div> 
        </div>

        <!-- Modal for Borrowing Item -->
        <div class="modal fade" id="borrowModal" tabindex="-1" aria-labelledby="borrowModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background-color: #A14100; color: white; font-family: 'Josefin Sans', sans-serif;">
                    <div class="modal-header border-0" style="background-color: #097B7B !important; ">
                        <h5 class="modal-title w-100 text-center" id="borrowModalLabel" style="font-weight: bold;">View Details</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form id="borrowForm" method="POST">
                                <div class="form-group row mb-3">  
                                    <input type="hidden" id="studID" name="student_id" value="<?php echo $student_id; ?>">
                                    <div class="col-md-4">
                                        <label for="itemQuantity" class="input1 col-6 text-start">Quantity:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="number" name="quantity" id="itemQuantity" class="inputtext col-6" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">  
                                    <div class="col-md-4">
                                        <label for="itemPurpose" class="input1 col-6 text-start">Purpose:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="text" name="purpose" id="itemPurpose" class="inputtext col-6" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">  
                                    <div class="col-md-4">
                                        <label for="dateBorrowed" class="input1 col-6 text-start">Date Borrowed:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" name="date" id="dateBorrowed" class="inputtext" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-md-4">
                                        <label for="returnDate" class="input1 col-6 text-start">Return Date:</label>
                                    </div>  
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" name="return" id="returnDate" class="inputtext" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden fields to store item_id and availableQuantity -->
                                <input type="hidden" id="itemId" name="item_id">
                                <input type="hidden" id="availableQuantity" name="available_quantity">
                                
                                <div class="d-flex justify-content-md-center">
                                    <button type="submit" class="requestButton">Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row footer">
            <div class="col-md-12"></div>
        </div>

    </div>

    <script>
        // This function is called when the Borrow button is clicked
        function setItemDetails(itemId, itemName, availableQuantity) {
            // Set item details in modal for the user
            document.getElementById("itemId").value = itemId; 
            document.getElementById("itemQuantity").value = ""; 
            document.getElementById("itemPurpose").value = ""; 
            document.getElementById("dateBorrowed").value = ""; 
            document.getElementById("returnDate").value = "";  
            // Store available quantity in hidden field
            $('#availableQuantity').val(availableQuantity);  // Store available quantity in hidden input

            // Update modal title or any other details if needed
            $('#borrowModalLabel').text("Borrow Item: " + itemName);
        }

        $(document).on('submit', '#borrowForm', function(e) {
            e.preventDefault();  // Prevent normal form submission

            var itemId = $('#itemId').val();
            var quantity = $('#itemQuantity').val();
            var purpose = $('#itemPurpose').val();
            var dateBorrowed = $('#dateBorrowed').val();
            var returnDate = $('#returnDate').val();
            var studID = $('#studID').val();  
            var availableQuantity = $('#availableQuantity').val();  

            if (parseInt(quantity) > parseInt(availableQuantity)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Quantity',
                    text: 'You cannot borrow more than the available quantity!',
                });
                return;  
            }

            
            $.ajax({
                url: 'borrow_item.php',  
                type: 'POST',
                data: {
                    item_id: itemId,
                    quantity: quantity,
                    purpose: purpose,
                    date_borrowed: dateBorrowed,
                    return_date: returnDate,
                    student_id: studID
                },
                success: function(response) {
                    if (response == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Item Borrowed!',
                            text: 'You have successfully borrowed the item.',
                        }).then(function() {
                            $('#borrowModal').modal('hide');  // Close the modal
                            window.location.reload();  // Reload the page
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong, please try again.',
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to process your request.',
                    });
                }
            });
        });
    </script>
</body>
</html>
