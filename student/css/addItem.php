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
	<title>Dashboard-CPC-BSHM's KITCHENWARES</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row header">
			<div class="col-md-12 logo-box">
				<a href="dashboard.php"><img src="img/logo.png"></a> <span>CPC-BSHM's KITCHENWARES</span>
			</div>
		</div>
		<div class="row content">
				<div class="col-md-12 img-dashboard">
					<div class="row">
						<div class="col-md-3">
							<div class="sidebar">
			                    <h2>DASHBOARD</h2>
			                    <a href="addItem.php"><i class="fa fa-plus"></i> New Item</a>
			                    <a href="add-course.php"><i class="fa fa-plus"></i> New Item Category</a>
			                    <a href="add-subject-sched.php"><i class="fa fa-spoon"></i> View Items</a>
			                    <a href="view-students.php"><i class="fa fa-list"></i> View Item Category</a>
			                    <a href="view-course.php"><i class="fa fa-users"></i> View Students</a>
			                    <a href="view-subject.php"><i class="fa fa-bell"></i> Borrowing Requests</a>
			                    <a href="view-subject.php"><i class="fa fa-book"></i> Transactions</a>
			                </div>
			            </div>  
				        <div class="col-md-9 height-100%">
				        	<div class="new d-flex justify-content-md-center">
				        		<h2>ADD NEW ITEM</h2>
				        	</div>
							<form action="">
							<div class="card">
								<div class="card-body">
								<div>
								<label for="" class="input1">Item Name:</label>
									<div class="input-group">
										<input type="text" name="" id="" class="inputtext">
									</div>
								</div>
								<div>
									<label class="input1">Item Category:</label>
									<select class="form-select border border-secondary rounded-0" id="inputGroupSelect01">
										<option selected disabled>Select</option>
										<option value="1">One</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									</select>
								</div>
								<div>
								<label for="" class="input1">Item Description:</label>
									<div class="input-group">
										<input type="text" name="" id="" class="inputtext">
									</div>
								</div>
								<div>
								<label for="" class="input1">Quantity:</label>
									<div class="input-group">
										<input type="text" name="" id="" class="inputtext">
									</div>
								</div>
								<div class="file-upload">
									<label for="file-input"> Image Upload:
										<div class="upload-box">
											<img src="img/imageupload.png" alt="" class="upload_icon">
										</div>
									</label>
									<input type="file" id="file-input" />
								</div>

								</div>
										<div class="d-flex justify-content-md-center">
											<button class="addButton">Save</button>
										</div>
								</div>
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
