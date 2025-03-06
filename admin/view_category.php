<?php include('header.php'); ?>
<div class="col-md-9 height-100%">
    <div class="view-item top-title">
        <h2>VIEW CATEGORY</h2>
    </div>
    <table id="dataTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Category #</th>
                <th>Category Name</th>
                <th width="150" style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM item_category"; 
                $res = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($res)):
            ?>
                <tr>
                    <td><?php echo $row['category_id']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="openEditModal(<?php echo $row['category_id']; ?>, '<?php echo $row['category_name']; ?>')">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteCategory(<?php echo $row['category_id']; ?>)">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
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
                        <label for="editItemId" class="form-label">Category #</label>
                        <input type="text" class="form-control" id="editItemId" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editItemName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="editItemName">
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

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function () {
    $('#dataTable').DataTable();
  });

  function openEditModal(id, name) {
    $('#editItemId').val(id);
    $('#editItemName').val(name);
    $('#editModal').modal('show');
  }

  function deleteCategory(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      input: 'checkbox',
      inputValue: true,
      inputPlaceholder: 'I agree',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, keep it',
      inputValidator: (value) => {
        if (!value) {
          return 'You must agree to proceed!'
        }
      }
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'include/delete_category.php',
          method: 'POST',
          data: { categoryId: id },
          success: function(response) {
            if (response === 'success') {
              Swal.fire(
                'Deleted!',
                'Category has been deleted.',
                'success'
              ).then(() => {
                location.reload();  // Refresh the page
              });
            } else {
              Swal.fire(
                'Failed!',
                'Failed to delete category.',
                'error'
              );
            }
          }
        });
      }
    });
  }

  function saveEdit() {
    var id = $('#editItemId').val();
    var name = $('#editItemName').val();

    $.ajax({
      url: 'include/update_category.php',
      method: 'POST',
      data: { categoryId: id, categoryName: name },
      success: function(response) {
        if (response === 'success') {
          Swal.fire(
            'Updated!',
            'Category has been updated.',
            'success'
          ).then(() => {
            location.reload();  // Refresh the page
          });
        } else {
          Swal.fire(
            'Failed!',
            'Failed to update category.',
            'error'
          );
        }
      }
    });
  }
</script>

<?php include('footer.php'); ?>
