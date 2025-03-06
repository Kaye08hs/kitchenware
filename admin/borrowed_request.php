<?php include('header.php'); ?>

<div class="col-md-9 height-100%">
  <div class="view-item top-title">
    <h2>VIEW ITEM</h2>
  </div>
  <table id="dataTable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th width="200">Student Information</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th width="200">Purpose</th>
        <th>Date</th>
        <th width="180" style="text-align: center;">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT 
          ib.borrowed_id,
          ib.item_id,
          ib.quantity,
          ib.student_id,
          ib.date_borrowed,
          ib.date_return,
          ib.status,
          ib.purpose,
          i.item_name,     
          s.*           
      FROM 
          item_borrowed ib
      JOIN 
          items i ON ib.item_id = i.item_id   
      JOIN 
          students s ON ib.student_id = s.student_id  
      WHERE 
          ib.status = 0;
      ";
      $result = mysqli_query($con, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <tr>
        <td><?php echo $row['borrowed_id']; ?></td>
        <td><?php echo $row['student_id']; ?> : <?php echo $row['firstname']; ?> <?php echo $row['middlename']; ?> <?php echo $row['lastname']; ?></td>
        <td><?php echo $row['item_name']; ?></td>
        <td><?php echo $row['quantity']; ?></td>
        <td><?php echo $row['purpose']; ?></td>
        <td><?php echo date('F j, Y', strtotime($row['date_borrowed'])); ?> - <?php echo date('F j, Y', strtotime($row['date_return'])); ?></td>
        <td>
          <button class="btn btn-primary btn-sm approve-btn" data-borrowed-id="<?php echo $row['borrowed_id']; ?>">Approved</button>
           <button class="btn btn-danger btn-sm disapprove-btn" data-borrowed-id="<?php echo $row['borrowed_id']; ?>">Disapproved</button>
        </td>
      </tr>
      <?php
        }
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

  $(document).on('click', '.approve-btn', function() {
    var borrowedId = $(this).data('borrowed-id'); 

    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to approve this borrow request?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Approve',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
              url: 'include/approved_borrow.php',  // PHP file to process the approval
              type: 'POST',
              data: { borrowed_id: borrowedId },
              success: function(response) {
                  if (response == 'success') {
                      Swal.fire(
                          'Approved!',
                          'The borrow request has been approved.',
                          'success'
                      ).then(() => {
                          location.reload();  // Or you can remove the row from the table using jQuery
                      });
                  } else {
                      Swal.fire(
                          'Error!',
                          'There was a problem approving the borrow request.',
                          'error'
                      );
                  }
              },
              error: function() {
                  Swal.fire(
                      'Error!',
                      'An error occurred while processing the request.',
                      'error'
                  );
              }
          });
        }
    });
  });
  $(document).on('click', '.disapprove-btn', function() {
    var borrowedId = $(this).data('borrowed-id'); 

    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to disapprove this borrow request?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Disapprove',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
              url: 'include/disapproved_borrow.php',  // PHP file to process the approval
              type: 'POST',
              data: { borrowed_id: borrowedId },
              success: function(response) {
                  if (response == 'success') {
                      Swal.fire(
                          'Dispproved!',
                          'The borrow request has been disapproved.',
                          'success'
                      ).then(() => {
                          location.reload();  // Or you can remove the row from the table using jQuery
                      });
                  } else {
                      Swal.fire(
                          'Error!',
                          'There was a problem disapproving the borrow request.',
                          'error'
                      );
                  }
              },
              error: function() {
                  Swal.fire(
                      'Error!',
                      'An error occurred while processing the request.',
                      'error'
                  );
              }
          });
        }
    });
  });
</script>

<?php include('footer.php'); ?>
