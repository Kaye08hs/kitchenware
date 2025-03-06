<?php include('header.php'); ?>

<div class="col-md-9 height-100%">
  <div class="view-item top-title">
    <h2>VIEW ITEM</h2>
  </div>
  <table id="dataTable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Item #</th>
        <th>Image</th>
        <th>Item Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>Borrowed</th>
        <th width="150" style="text-align: center;">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Query to get items along with their category names
      $sql = "SELECT i.item_id, i.item_name, i.item_description, i.quantity, i.item_image, c.category_name 
              FROM items i
              JOIN item_category c ON i.category_id = c.category_id";
      $result = mysqli_query($con, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <tr>
        <td><?php echo $row['item_id']; ?></td>
        <td><img src="uploads/<?php echo $row['item_image']; ?>" alt="Item Image" width="50"></td>
        <td><?php echo $row['item_name']; ?></td>
        <td><?php echo $row['item_description']; ?></td>
        <td><?php echo $row['category_name']; ?></td>
        <td><?php echo $row['quantity']; ?></td>
        <td>10</td>
        <td>
          <button class="btn btn-primary btn-sm" onclick="openEditModal(<?php echo $row['item_id']; ?>, '<?php echo $row['item_name']; ?>', '<?php echo $row['item_description']; ?>', '<?php echo $row['category_name']; ?>', <?php echo $row['quantity']; ?>, '<?php echo $row['item_image']; ?>')">Edit</button>
          <button class="btn btn-success btn-sm" onclick="openAddQuantityModal(<?php echo $row['item_id']; ?>)">Add Quantity</button>
        </td>
      </tr>
      <?php
        }
      } else {
        echo "<tr><td colspan='8'>No items found</td></tr>";
      }
      mysqli_close($con);
      ?>
    </tbody>
  </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">UPDATE</h5>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <div class="mb-3">
            <label for="editItemId" class="form-label">Item #</label>
            <input type="text" class="form-control" id="editItemId" readonly>
          </div>
          <div class="mb-3">
            <label for="editItemName" class="form-label">Item Name</label>
            <input type="text" class="form-control" id="editItemName">
          </div>
          <div class="mb-3">
            <label for="editDescription" class="form-label">Description</label>
            <textarea class="form-control" id="editDescription"></textarea>
          </div>
          <div class="mb-3">
            <label for="editCategory" class="form-label">Category</label>
            <input type="text" class="form-control" id="editCategory">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update-item" onclick="saveEdit()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Add Quantity Modal -->
<div class="modal fade" id="addQuantityModal" tabindex="-1" aria-labelledby="addQuantityModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addQuantityModalLabel">ADD Quantity</h5>
      </div>
      <div class="modal-body">
        <form id="addQuantityForm">
          <div class="mb-3">
            <label for="addQuantity" class="form-label">Quantity to Add</label>
            <input type="number" class="form-control" id="addQuantity" placeholder="Enter Quantity">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add-quantity" onclick="saveAddQuantity()">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- Include SweetAlert2, jQuery, and Bootstrap -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function () {
    $('#dataTable').DataTable();
  });

  function openEditModal(itemId, itemName, itemDescription, categoryName) {
    $('#editItemId').val(itemId);
    $('#editItemName').val(itemName);
    $('#editDescription').val(itemDescription);
    $('#editCategory').val(categoryName);
    
    $('#editImage').val(''); 
    $('#editModal').modal('show');
  }

  // Function to save changes using AJAX
  function saveEdit() {
    // Get values from the form
    var itemId = $('#editItemId').val();
    var itemName = $('#editItemName').val();
    var itemDescription = $('#editDescription').val();
    var categoryName = $('#editCategory').val();
    
    var formData = new FormData();
    formData.append('itemId', itemId);
    formData.append('itemName', itemName);
    formData.append('itemDescription', itemDescription);
    formData.append('categoryName', categoryName);

    $.ajax({
      url: 'include/update_item.php',  
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response == 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Item Updated Successfully!',
            text: 'Your changes have been saved.',
            background: '#fff',  
            color: '#4CAF50',  
            iconColor: '#2E8B57',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#4CAF50', 
            timer: 3000, 
            timerProgressBar: true, 
            willClose: () => {
              $('#editModal').modal('hide');
              location.reload();  
            }
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong. Please try again.',
            background: '#fff',  
            color: '#721c24',  
            iconColor: '#d33',
            showConfirmButton: true,
            confirmButtonText: 'Try Again',
            confirmButtonColor: '#d33',
          });
        }
      }
    });
  }
</script>

<?php include('footer.php'); ?>
