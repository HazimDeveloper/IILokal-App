<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();




if(isset($_POST['submit']))          
{
	
	

		
				$fname = $_FILES['file']['name'];
								$temp = $_FILES['file']['tmp_name'];
								$fsize = $_FILES['file']['size'];
								$extension = explode('.',$fname);
								$extension = strtolower(end($extension));  
								$fnew = uniqid().'.'.$extension;
   
								$store = "Res_img/".basename($fnew);                    
	
                                		
    $serial_no = $_POST['serial_no'];
    $laptop_desc = $_POST['laptop_desc'];
    $processor = $_POST['processor'];
    $status = $_POST['status'];
    $problem = $_POST['problem'];
    $currDate = $_POST['currDate'];
    $expDate = $_POST['expDate'];
    $img = $fnew;

    $date = date('d-m-y');
    $time = date('h:m:s');


			
		  
		
		
    $success = 	'<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     New Laptop Added Successfully.
</div>';

					if($extension == 'jpg'||$extension == 'png'||$extension == 'gif' )
					{        
									if($fsize>=1000000)
										{
		
		
												$error = 	'<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Max Image Size is 1024kb!</strong> Try different Image.
															</div>';
	   
										}
		
									else
										{
												
												
												

                                            $sql = "INSERT INTO `laptop`(`laptop_id`, `serial_no`, `laptop_desc`, `image`, `problem`, `processor`, `status`, `current_warrant_date`, `expired_warranty_date`) VALUES ('','$serial_no','$laptop_desc','$img','$problem','$processor','$status','$currDate','$expDate')";  // store the submited data ino the database :images
                                            mysqli_query($db, $sql);
												// $sql = "INSERT INTO dishes(rs_id,title,slogan,price,img,date,time) VALUE('".$_POST['res_name']."','".$_POST['d_name']."','".$_POST['about']."','".$_POST['price']."','".$fnew.", '$date' ,'$time' ')";  // store the submited data ino the database :images
												
                                               
												move_uploaded_file($temp, $store);
			  
	
										}
					}
					elseif($extension == '')
					{
						$error = 	'<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>select image</strong>
															</div>';
					}
					else{
					}               
	   
	   
	   }


?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="icon" href="../images/company.jpeg">
    <title>Add Laptop</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="fix-header">
  
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
  
    <div id="main-wrapper">
      
         <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">
                        
                        
                    </a>
                </div>
                <div class="navbar-collapse">
       
                    <ul class="navbar-nav mr-auto mt-md-0">
              
                        
                     
                       
                    </ul>
          
                    <ul class="navbar-nav my-lg-0">

                        
          
                        <li class="nav-item dropdown">
                           
                            <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                  
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                   <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
     
        <div class="left-sidebar">
     
            <div class="scroll-sidebar">
               
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Log</li>
                   
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Problem</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_restaurant.php">All Details Category</a></li>
							
                                <li><a href="add_restaurant.php">Add Problem Encountered</a></li>
                                
                            </ul>
                        </li>
                      <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-laptop" aria-hidden="true"></i><span class="hide-menu">Laptop</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_menu.php">All Laptop</a></li>
								<li><a href="add_menu.php">Add Laptop</a></li>
                              
                                
                            </ul>
                        </li>
					
                
                        <li> <a class="has-arrow" href="add_account.php" aria-expanded="false"><span class="hide-menu"><i class="fa fa-users" aria-hidden="true"></i>Create New Acc</span></a> </li>

                         
                    </ul>
                </nav>
            
            </div>
        
        </div>
      
        <div class="page-wrapper">
     
            
         
            <div class="container-fluid">
                <!-- Start Page Content -->
                  
									
									<?php  echo $error;
									        echo $success; ?>
									
									
								
								
                                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Add Laptop Details</h4>
                            </div>
                            <div class="card-body">
                                <form action='' method='post'  enctype="multipart/form-data">
                                    <div class="form-body">
                                       
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Serial No.</label>
                                                    <input type="text" name="serial_no" class="form-control" >
                                                   </div>
                                            </div>
                                            <div class="col-md-4">
                                                <b>Processor</b>
                                            <div class="form-check">
  <input class="form-check-input" type="radio" name="processor" id="exampleRadios1" value="i7" checked>
  <label class="form-check-label" for="exampleRadios">
    i7
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="processor" id="exampleRadios2" value="i5">
  <label class="form-check-label" for="exampleRadios2">
   i5
  </label>
</div>
                                            </div>
                                            <div class="col-md-4">
                                            <b>Status</b>
                                            <div class="form-check">
  <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="Rosak" checked>
  <label class="form-check-label" for="exampleRadios1">
    Rosak
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="Waiting To Repair">
  <label class="form-check-label" for="exampleRadios2">
  Waiting To Repair
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="Current Repair">
  <label class="form-check-label" for="exampleRadios2">
   Currently Repair
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="Good Condition">
  <label class="form-check-label" for="exampleRadios2">
   Good Condition
  </label>
</div>
                                            </div>
                                      
									  <hr>
                                             
                                        <hr>
									
                                        <div class="row p-t-20">
                                            <div class="col-6 ">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                    <label class="control-label">Description (Processor/ RAM/ Storage/ Graphic Card/ Battery Status/ ETC)</label>
                                                    <textarea class="form-control" placeholder="" name="laptop_desc" style="height:100px;" id="floatingTextarea"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                     <div class="col-6">
                                         <h5>Warranty Date</h5>
                                        <div class="row">
                                        <div class="col">
                                            <label for="">Current Date</label>
                                            <input type="date" name="currDate" id="currDate" class="form-control">

                                        </div>
                                        <div class="col">
                                            <label for="">Expired Warranty Date</label>
                                            <input type="date" name="expDate" class="form-control" id="">

                                        </div></div>
                                     </div>
                                        
                                  
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Image</label>
                                                    <input type="file" name="file"  id="lastName" class="form-control form-control-danger" placeholder="12n">
                                                    </div>
                                            </div>
                                        </div>
                              
										
                                  
                                        <div class="row">
                                            
											
											
											
											
											
											
											 <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Select Problem</label>
													<select name="problem" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                        <option>--Select Problem Details--</option>
                                                 <?php 
                                                 $ssql ="select * from restaurant";
													$res=mysqli_query($db, $ssql); 
													while($row=mysqli_fetch_array($res))  
													{
                                                        ?>
                                                        <option value="<?= $row['title'] ?>"><?= $row['title'] ?></option>'
												<?php 	}  
                                                 
													?> 
													 </select>
                                                </div>
                                            </div>
											
											
											
                                        </div>
                                     
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Save"> 
                                        <a href="add_menu.php" class="btn btn-inverse">Cancel</a>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                    <footer class="footer"> © 2023 - IT UNIT TMRND CYBERJAYA </footer>
                </div>               
            </div>
        </div>    
    </div>
  
    <script>
        var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd;
document.getElementById("currDate").value = today;

    </script>
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>

</body>

</html>