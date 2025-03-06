<?php
session_start();
if(!isset($_SESSION['student_id']))
{
    header('location:student_login.php');
}
include('../admin/include/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $year_section = $_POST['year_section'];
    $address = $_POST['address'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    if (!$password) {
        $query = "SELECT password FROM students WHERE student_id = ?";
        $stmt = $dbcon->prepare($query);
        $stmt->bind_param("s", $_SESSION['student_id']);
        $stmt->execute();
        $stmt->bind_result($existing_password);
        $stmt->fetch();
        $stmt->close();
        $password = $existing_password;
    }

    $sql = "UPDATE students 
            SET firstname = ?, middlename = ?, lastname = ?, username = ?, student_id = ?, password = ?, year_section = ?, address = ?
            WHERE student_id = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param(
        "sssssssss",
        $firstname,
        $middlename,
        $lastname,
        $username,
        $student_id,
        $password,
        $year_section,
        $address,
        $_SESSION['student_id']
    );

    if ($stmt->execute()) {
        // Update session variables
        $_SESSION['firstname'] = $firstname;
        $_SESSION['middlename'] = $middlename;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['username'] = $username;
        $_SESSION['student_id'] = $student_id;
        $_SESSION['address'] = $address;
        $_SESSION['password'] = $password;
        $_SESSION['year_section'] = $year_section;

        $success = true;
    } else {
        $error = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Kaisei+Tokumin&family=Kalnia:wght@508&family=Katibeh&display=swap" rel="stylesheet">
	<script type="text/javascript" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>CPC - BSHM's KITCHENWARES</title>
</head>
<body>
    <header class="header">
        <div class="d-flex align-items-center">
            <img src="img/hm_logo.png" alt="Logo">
            <h1 class="h6 mb-0">CPC-BSHM's KITCHENWARES</h1>
           </div>
				<div class="d-flex align-items-right">
						<div class="dropdown">
						<button class="btn fa fa-bars" type="button" id="hamburgerMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="hamburgerMenu">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updateProfileModal">Update Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewTransactionModal">View Transaction</a></li>
                        <li><a class="dropdown-item" href="../student/student_logout.php">Log Out</a></li>
                    </ul>
						</div>
					</div>
				</div>
            </a>
        </div>
		
<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content square-modal mb-12" style="background-color: #C94700; color: white; font-family: 'Josefin Sans', sans-serif;">
            <div class="modal-header border-0">
                <h5 class="modal-title w-100 text-center" id="updateProfileModalLabel" style="font-weight: bold;">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../student/student_index.php" method="POST">
                    <div class="row g-2">
                        <div class="col-6 mb-3">
                            <label for="studentId" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="studentId" name="student_id" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6 mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6 mb-3">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middlename">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="year_section" class="form-label">Year/Section</label>
                            <input type="text" class="form-control" id="year_section" name="year_section" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-12 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        <button type="submit" class="btn w-50 h-40" style="background-color: #097B7B; color: white;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

	
	<div class="modal fade" id="viewTransactionModal" tabindex="-1" aria-labelledby="viewTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #C94700; color: white; font-family: 'Josefin Sans', sans-serif;">
            <div class="modal-header border-0">
                <h5 class="modal-title w-100 text-center" id="viewTransactionModalLabel" style="font-weight: bold;">View Transaction</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-6 text-start">Item Name: </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-start">Quantity:</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-start">Purpose:</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-start">Date Borrowed:</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-start">Return Date:</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-start">Request Status:</div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    </header>
    
      
      <div class="banner">
        <img src="img/bg-img.png" class="banner-image" alt="Banner Image">
        <div class="overlay">
            <div class="front-text">
            <h1 class="main-text">WELCOME TO CPC BSHM’s KITCHENWARES</h1>
            <p class="sub-text">Explore and choose from a wide range of<br> kitchenware for your needs.</p>
            </div>
        </div>
        <div class="button-group">
            <a href="../student/student_items.php" class="btn btn-orange" type="button">View Item List</a>
            <a href="../student/borrow.php" class="btn btn-orange" type="button">Return Items</a>
        </div>
    </div>
    </div>
    <footer class="footer">
	        <div class="col-md-12"></div>
    </footer>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
