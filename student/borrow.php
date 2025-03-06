<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=League+Spartan:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/borrow.css">
    <title>Borrow Items</title>
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
                <div class="col-md-12 height-100%">
                        <div class="borrowText text-center">
                            <p>BORROWED ITEMS</p>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                        <div class="overlay">
                            <div class="row borrowed-item">
                                <div class="col-md-2">
                                    <img src="img/pot.png" alt="Pot" class="item-img">
                                </div>
                                <div class="col-md-4">
                                    <h5 class="item-name">Pot</h5>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end align-items-center">
                                    <!-- VIEW DETAILS Modal Trigger -->
                                    <button 
                                        class="btn btn-primary me-3" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#viewDetailsModal">
                                        VIEW DETAILS
                                    </button>
                                    <!-- RETURN Modal Trigger -->
                                    <button 
                                        class="btn btn-success" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#returnItemModal">
                                        RETURN
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- VIEW DETAILS Modal -->
<div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #A14100; color: white; font-family: 'Josefin Sans', sans-serif;">
            <!-- Modal Header -->
            <div class="modal-header border-0">
                <h5 class="modal-title w-100 text-center" id="viewDetailsModalLabel" style="font-weight: bold;">View Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-6 text-start">Transaction ID</div>
                        <div class="col-6 text-end"><span>__________</span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-start">Item Category</div>
                        <div class="col-6 text-end"><span>__________</span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-start">Item Name</div>
                        <div class="col-6 text-end"><span>__________</span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-start">Quantity</div>
                        <div class="col-6 text-end"><span>__________</span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-start">Purpose</div>
                        <div class="col-6 text-end"><span>__________</span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-start">Date Borrowed</div>
                        <div class="col-6 text-end"><span>__________</span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-start">Return Date</div>
                        <div class="col-6 text-end"><span>__________</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RETURN Modal -->
<div class="modal fade" id="returnItemModal" tabindex="-1" aria-labelledby="returnItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"  style="background-color: #097B7B; color: white; font-family: 'Josefin Sans', sans-serif;">
            <!-- Modal Header -->
            <div class="modal-header border-0">
            <h5 class="modal-title w-100 text-center" id="viewDetailsModalLabel" style="font-weight: bold;">Return</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body text-start">
                <div class="mb-3 returnText">
                    <p class="mb-1"><strong>Date Borrowed:</strong> 11-01-24</p>
                    <p><strong>Return Date:</strong> 11-01-24</p>
                </div>
                <div class="mb-3 file-upload">
                <label for="file-input"> Image Upload:
                    <div class="upload-box">
                        <img src="img/imageupload.png" alt="" class="upload_icon">
                    </div>
                </label>
                <input type="file" id="file-input" />
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-primary w-50 h-40">Save</button>
            </div>
        </div>
    </div>
</div>


        <div class="row footer">
            <div class="col-md-12"></div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
