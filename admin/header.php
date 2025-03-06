<?php
    include('include/connection.php');
    header('Access-Control-Allow-Origin: *');

    session_start();

    if(!isset($_SESSION['user_id']))
    {
        header('location:index.php');
    }
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
    $firstname = $_SESSION['f_name'];
    $lastname = $_SESSION['lname'];
    $role = $_SESSION['role'];

    $sql = "SELECT COUNT(*) as count FROM `item_borrowed` WHERE `status` = 0";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $item_count = $row['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KITCHENWARE CATEGORY</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=League+Spartan:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row header">
            <div class="col-md-12 d-flex align-items-center justify-content-between">
                <div class="logo-box">
                    <img src="img/logo.png" alt="Logo"> 
                    <span>CPC-BSHM's KITCHENWARES</span>
                </div>
                <!-- Dropdown User Menu -->
                <div class="dropdown user-menu">
				    <a href="#" 
				       class="dropdown-toggle d-flex align-items-center" 
				       id="userMenu" 
				       data-bs-toggle="dropdown" 
				       aria-expanded="false" style="color: #fff;">
				        <i class="fa fa-user fa-2x" style="color: #fff;"></i>
				    </a>
				    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
				        <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
				    </ul>
				</div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="row content">
            <div class="col-md-12 img-dashboard">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-md-3">
                        <div class="sidebar">
                            <a href="dashboard.php"><h2 style="margin-left: 0; ">DASHBOARD</h2></a>
                            <a href="addItem.php"><i class="fa fa-plus"></i> New Item</a>
                            <a href="addCategory.php"><i class="fa fa-plus"></i> New Item Category</a>
                            <a href="view_item.php"><i class="fa fa-spoon"></i> View Items</a>
                            <a href="view_category.php"><i class="fa fa-list"></i> View Item Category</a>
                            <a href="view_student.php"><i class="fa fa-users"></i> View Students</a>
                            <a href="borrowed_request.php">
                                <i class="fa fa-bell"></i> Borrowing Requests 
                                <?php if ($item_count > 0): ?>
                                    <span class="badge bg-danger"><?php echo $item_count; ?></span>
                                <?php endif; ?>
                            </a>
                            <a href="view-subject.php"><i class="fa fa-book"></i> Transactions</a>
                        </div>
                    </div>
