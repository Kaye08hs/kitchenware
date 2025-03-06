<?php session_start();
  if(isset($_SESSION['user_id']) || isset($_SESSION['user_id']) || isset($_SESSION['username']) || isset($_SESSION['role']) || isset($_SESSION['password'])){
      header('Location:dashboard.php');
  } 
?>
<?php 

  $x=0;
  include('include/connection.php');
  
  if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $query = mysqli_query($con,"select * from user where password='$password' AND username='$username' AND(role=0  OR role=1)");
    $count = mysqli_num_rows($query);

    if($count > 0)
    {
       while ($row=mysqli_fetch_array($query)){
          $_SESSION['username'] = $row['username'];
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['f_name'] = $row['f_name'];
          $_SESSION['lname'] = $row['lname'];
          $_SESSION['role'] = $row['role'];
          header('location:dashboard.php');
       }
    }
    else
    {
      $x=1;
    }
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
	<title>MINICAPSTONE</title>
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
			<div class="col-md-6 text-center logIn-box">
				<h1>Log In</h1>
			   	<div class="alert alert-danger text-center animated fadeInUp" role="alert" style="display:<?php echo $x==1?'block':'none'; ?>;">
                    <strong><i class="fa fa-warning"></i></strong>
                    Invalid Account .
                </div>   
				<div class="logIn-container">
					<i class="fa fa-user"></i>
					<form class="form-horizontal" method="post">
						<div class="col-md-12">
							<label>Username:</label>
							<input type="text" name="username" placeholder="Enter Username">
						</div>
						<div class="col-md-12">
							<label>Password:</label>
							<input type="Password" name="password" placeholder="Enter Password">
						</div>
						<div class="col-md-12">
							<button class="button"  name="submit">Log In</button>
						</div>
						<div class="col-md-12">
							<p> No Account?  <a href="register.php">Register Here</a></p>
						</div>
					</form>
					
				</div>
			</div>
			
		</div>
		<div class="row footer">
			<div class="col-md-12"></div>
		</div>
	</div>

</body>
</html>