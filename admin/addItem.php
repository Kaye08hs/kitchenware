<?php include('header.php'); ?>
<div class="col-md-9">
    <div class="new-item top-title">
        <h2>ADD NEW ITEM</h2>
    </div>
    <form id="addItemForm">
        <div class="card">
            <div class="card-body">
                <div class="form-group">  
                    <label for="itemName" class="input1">Item Name:</label>
                    <div class="input-group">
                        <input type="text" name="item_name" id="itemName" class="inputtext" required>
                    </div>
                </div>
                <div class="form-group">  
                    <label class="input1">Item Category:</label>
                    <select class="form-select border border-secondary rounded-0" id="inputGroupSelect01" name="category_id" required>
                        <option selected disabled>Select Item Category</option>
                        <?php
                            $sql = "SELECT * from item_category";
                            $res = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($res)):
                        ?>
                            <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">  
                    <label for="itemDescription" class="input1">Item Description:</label>
                    <div class="input-group">
                        <input type="text" name="item_description" id="itemDescription" class="inputtext" required>
                    </div>
                </div>
                <div class="form-group">  
                    <label for="itemQuantity" class="input1">Quantity:</label>
                    <div class="input-group">
                        <input type="number" name="quantity" id="itemQuantity" class="inputtext" required>
                    </div>
                </div>
                <div class="form-group file-upload">
                    <label for="file-input"> Image Upload:
                        <div class="upload-box">
                            <img src="img/imageupload.png" alt="" class="upload_icon">
                        </div>
                    </label>
                    <input type="file" name="item_image" id="file-input" required />
                </div>
                <div class="d-flex justify-content-md-center">
                    <button type="submit" class="addButton">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        $('#addItemForm').on('submit', function(e){
            e.preventDefault();  

            var formData = new FormData(this);  

            $.ajax({
                url: 'include/add_new_item.php',  
                type: 'POST',
                data: formData,
                contentType: false,  
                processData: false,  
                success: function(response) {
                    if (response === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Item Added',
                            text: 'Your new item has been added successfully.',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();  // Optionally reload the page to see the new item
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'There was an issue adding the item.',
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong. Please try again later.',
                    });
                }
            });
        });
    });
</script>

<?php include('footer.php'); ?>
