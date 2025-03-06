<?php include('header.php'); ?>
<div class="col-md-9 ">
    <div class="top-title"> 
        <h2>NEW CATEGORY</h2>
    </div>
    <div class="newcat">
        <form id="newCategoryForm" method="POST">
            <label>Category Name:</label>
            <input type="text" id="categoryName" name="category_name" placeholder="Enter Category">
            <div class="submit">
                <button type="submit" class="button primary">Save</button>
            </div>
        </form>
    </div>
</div>	

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        $('#newCategoryForm').on('submit', function(e){
            e.preventDefault();  

            var categoryName = $('#categoryName').val();

            if (categoryName.trim() === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please enter a category name!',
                });
                return;
            }

            $.ajax({
                url: 'include/new_category.php',  
                type: 'POST',
                data: {categoryName: categoryName},  
                success: function(response){
                    if(response === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Category Created',
                            text: 'Your new category has been created successfully.',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'There was an issue creating the category.',
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
