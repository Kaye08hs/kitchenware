<?php
  include('../admin/include/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : null;
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
    $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : null;
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
    $year_section = isset($_POST['year_section']) ? $_POST['year_section'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;

  	try{
  		$stmt = $con -> prepare("INSERT INTO students(student_id, username, password, firstname, middlename, lastname, year_section, address) VALUES(?,?,?,?,?,?,?,?)");

  		$stmt -> bind_param("ssssssss", $student_id, $username, $password, $firstname, $middlename, $firstname, $year_section, $address);

  		$stmt -> execute();

  		$con-> commit();

  		header("Location: student_login.php");

	}catch (Exception $e){
  		$con->rollback();
  		echo"Error" . $e->getMessage();

  	}
  	$stmt->close();

}


?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=League+Spartan:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
	<title>REGISTRATION FORM</title>
</head>
<body>
		<div class="container-fluid">
		<div class=" row header">
			<div class="col-md-12 logo-box">
				<img src="img/logo.png"> <span>CPC-BSHM's KITCHENWARES</span>
			</div>
		</div>
		<div class="row content">
			<div class="col-md-6 img-box"></div>
			<div class="col-md-6 text-center register-box">
				<h1>Registration Form</h1>
			<form action="student_register.php" method="POST">
				<div class="row register-container">
					<div class="col-md-6">
						<label >Student ID:</label>
						<input type="text" name="student_id" placeholder="Enter your Student ID">
					</div>
					<div class="col-md-6">
						<label >Username:</label>
						<input  type="text" name="username" placeholder="Enter your Username" required>
					</div>
					<div class="col-md-12">
						<label>Password:</label>
						<input type="Password" name="password" placeholder="Enter Password">
					</div>
					<div class="col-md-6">
						<label>First Name:</label>
						<input type="text" name="firstname" placeholder="Enter your First Name">
					</div>
					<div class="col-md-6">
						<label>Middle Name:</label>
						<input type="text" name="middlename" placeholder="Enter your Middle Name">
					</div>
					<div class="col-md-6">
						<label>Last Name:</label>
						<input type="text" name="lastname" placeholder="Enter your Last Name">
					</div>
					<div class="col-md-6">
						<label>Year & Section:</label>
						<input type="text" name="year_section" placeholder="Enter your Year & Section">
					</div>
					<div class="col-md-12">
						<label>Address:</label>
						<input type="address" name="address" placeholder="Enter your address">
					</div>
					<div class="col-md-12">
						<button type="submit">Register</button>
					</div>
				</div>
			</form>
			</div>
		</div>
		<div class="row footer">
			<div class="col-md-12"></div>
		</div>
	</div>
</body>
</html>
