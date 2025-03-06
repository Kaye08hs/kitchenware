<?php include('header.php'); ?>
<div class="col-md-9 height-100%">
  <div class="view-item top-title">
    <h2>STUDENT INFORMATION</h2>
  </div>
  <table id="dataTable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Year Level</th>
        <th>Status</th>
        <th width="150" style="text-align: center;">Action</th>
      </tr>
    </thead>
      <?php
        $sql = "SELECT * FROM `students`";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
              <td><?php echo htmlspecialchars($row['student_id']); ?></td>
              <td><?php echo htmlspecialchars($row['firstname']) . ' ' . htmlspecialchars($row['middlename']) . ' ' . htmlspecialchars($row['lastname']); ?></td>
              <td><?php echo htmlspecialchars($row['year_section']); ?></td>
              <td>
                  <?php if($row['role'] == 1): ?>
                     <span style="color: red;"> Deactivated </span>
                  <?php else: ?>
                    <span> Activated </span>
                  <?php endif; ?>
              </td>
              <td>
                  <?php if ($row['role'] == 0): ?>
                      <button class="btn btn-danger btn-sm deactivate-btn" data-id="<?php echo htmlspecialchars($row['student_id']); ?>">Deactivate</button>
                  <?php else: ?>
                   <button class="btn btn-success btn-sm activate-btn" data-student-id="<?php echo htmlspecialchars($row['student_id']); ?>">Activate</button>
                  <?php endif; ?>
              </td>
          </tr>

        <?php
            }
        } else {
            echo "<tr><td colspan='8'>No students found.</td></tr>";
        }
        ?>
    </tbody>
  </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">EDIT STUDENT DETAILS</h5>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <div class="mb-3">
            <label for="editStudentId" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="editStudentId" readonly>
          </div>
          <div class="mb-3">
            <label for="editName" class="form-label">Name</label>
            <input type="text" class="form-control" id="editName">
          </div>
          <div class="mb-3">
            <label for="editAge" class="form-label">Age</label>
            <input type="number" class="form-control" id="editAge">
          </div>
          <div class="mb-3">
            <label for="editCourse" class="form-label">Course</label>
            <input type="text" class="form-control" id="editCourse">
          </div>
          <div class="mb-3">
            <label for="editYearLevel" class="form-label">Year Level</label>
            <input type="text" class="form-control" id="editYearLevel">
          </div>
          <div class="mb-3">
            <label for="editStatus" class="form-label">Status</label>
            <select class="form-control" id="editStatus">
              <option>Active</option>
              <option>Inactive</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="editPhoto" class="form-label">Photo</label>
            <input type="file" class="form-control" id="editPhoto" data-current-photo="">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update-student" onclick="saveEdit()">Save changes</button>
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
  $(document).on('click', '.deactivate-btn', function () {
    var studentId = $(this).data('id'); 

    Swal.fire({
      title: 'Are you sure?',
      text: "You are about to deactivate this student!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, deactivate it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'include/deactivate_student.php', 
          type: 'POST',
          data: { student_id: studentId },
          success: function(response) {
            if (response === 'success') {
              Swal.fire(
                'Deactivated!',
                'The student has been Deactivated.',
                'success'
              ).then(function() {
                  window.location.reload();  // Reload the page
              });
            } else {
              Swal.fire(
                'Error!',
                'There was an issue activating the student.',
                'error'
              );
            }
          },
          error: function() {
            Swal.fire(
              'Error!',
              'Something went wrong with the request.',
              'error'
            );
          }
        });
      }
    });
  });
  $(document).on('click', '.activate-btn', function () {
    var studentId = $(this).data('student-id'); 

    Swal.fire({
      title: 'Are you sure?',
      text: "You are about to Activate this student!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, activate it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'include/activate.php', 
          type: 'POST',
          data: { student_id: studentId },
          success: function(response) {
            if (response === 'success') {
              Swal.fire(
                'Activated!',
                'The student has been Activated.',
                'success'
              ).then(function() {
                  window.location.reload();  // Reload the page
              });
            } else {
              Swal.fire(
                'Error!',
                'There was an issue activating the student.',
                'error'
              );
            }
          },
          error: function() {
            Swal.fire(
              'Error!',
              'Something went wrong with the request.',
              'error'
            );
          }
        });
      }
    });
  });
</script>


<?php include('footer.php'); ?>
