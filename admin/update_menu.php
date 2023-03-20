<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

$admin_id = $_SESSION["adm_id"];

$select_admin = mysqli_query($db,"SELECT * FROM admin WHERE adm_id = $admin_id");
$data_admin = mysqli_fetch_assoc($select_admin);

$id_menu = $_GET['menu_upd'];

$ssql = "select * from laptop WHERE laptop_id =  $id_menu ";
$sql_menu = mysqli_query($db,$ssql);
$res=mysqli_fetch_assoc( $sql_menu); 
$name_admin = $data_admin['username'];

if(isset($_POST['submit']))           //if upload btn is pressed
{

    
    $fname = $_FILES['file']['name'];
                $temp = $_FILES['file']['tmp_name'];
                $fsize = $_FILES['file']['size'];
                $extension = explode('.',$fname);
                $extension = strtolower(end($extension));  
                $fnew = uniqid().'.'.$extension;

                $store = "Res_img/".basename($fnew);      
   
								// $store = "Res_img/".basename($fnew);                 
                                
                                 
													$date = date('y-m-d');
													$time = date('h:i:s');
                                                    $serial_no = $_POST['serial_no'];
                                                    $processor = $_POST['processor'];
                                                    $problem = $_POST['problem'];                     
    $laptop_desc = $_POST['laptop_desc'];
    $status = $_POST['status'];
    $currDate = $_POST['currDate'];
    $date_str = $_POST['expDate'];
    $date_obj = strtotime($date_str); // convert string to timestamp
    $expDate = date('y-m-d', $date_obj);

                                                    $img = $fnew;
								
                                                    $sql_log = "INSERT INTO `log`(`log_id`,`name` ,`serial_no`, `date`, `time`) VALUES ('','$name_admin','$serial_no','$date','$time')";

                                                    mysqli_query($db,$sql_log);
    
                                                    
                                            $sql = "update laptop set serial_no='$serial_no',laptop_desc = '$laptop_desc',problem = '$problem', status = '$status', processor='$processor',image='$img' , current_warrant_date = '$date' , expired_warranty_date = '$expDate' where laptop_id='$id_menu'";
                                            
                                            mysqli_query($db, $sql); 
                                          
                                            move_uploaded_file($temp, $store); 
                                              $success = 	'<div class="alert alert-success alert-dismissible fade show">
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                               Laptop Updated Successfully.
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
												
                                            // echo '<script>location.reload()</script>';
	
										}
					}
					            	   
	   

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
   
    <link rel="icon" href="../images/company.jpeg">
    <title>Update Laptop</title>
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
								<li><a href="all_restaurant.php">All Problem Details</a></li>
						
                                <li><a href="add_restaurant.php">Add Problem Encountered</a></li>
                                
                            </ul>
                        </li>
                      <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-laptop" aria-hidden="true"></i><span class="hide-menu">Laptop</span></a>
                            <ul aria-expanded="false" class="collapse">
								<li><a href="all_menu.php">All Laptop</a></li>
								<li><a href="add_menu.php">Add Laptop</a></li>
                              
                                
                            </ul>
                        </li>
				
                         
                    </ul>
                </nav>
                
            </div>
           
        </div>
      
        <div class="page-wrapper">
        
            
          
            <div class="container-fluid">
        								
					    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Update Laptop Condition</h4>
                            </div>
                            <div class="card-body">
                                <form action='' method='post'  enctype="multipart/form-data">
                                    <div class="form-body">
                                       
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Serial No.</label>
                                                    <input type="text" name="serial_no" class="form-control"  value="<?= $res['serial_no'] ?>">
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
                                             
                                        <hr>
									
                                        <div class="row p-t-20">
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                    <label class="control-label">Description (Processor/RAM/Storage/ Graphic Card / Battery Status / ETC)</label>
                                                    <textarea name="laptop_desc" type="text" style="height:100px;" class="form-control"><?= $res['laptop_desc'] ?></textarea>
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
                                        </div>
                                  
                                   
                                   
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Image</label>
                                                    <input type="file" name="file"  id="lastName" class="form-control form-control-danger" placeholder="12n" >
                                                    </div>
                                            </div>
                                        </div>
                              
										
                                  
                                        <div class="row">
                                            
											
											 <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Select Problem</label>
													<select name="problem" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                        <option>--Select Problem Details--</option>
                                                 <?php $ssql ="select * from restaurant";
													$res=mysqli_query($db, $ssql); 
													while($row=mysqli_fetch_array($res))  
													{
                                                       echo' <option value="'.$row['title'].'">'.$row['title'].'</option>';;
													}  
                                                 
													?> 
													 </select>
                                                </div>
                                            </div>
											
											
											
                                        </div>
											
											
											
                                        </div>
                                     
                                        </div>
                                    </div>
                                    <div class="form-actions">
										
                                        <input type="submit" name="submit" class="btn btn-primary" value="Save"> 
                                        <a href="all_menu.php" class="btn btn-inverse">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

					<footer class="footer"> © 2022 - IT UNIT TMRND </footer>
					
                </div>
             
            </div>

        </div>
       
    </div>
  
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>

</body>

</html>