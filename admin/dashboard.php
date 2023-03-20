<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if(empty($_SESSION["adm_id"]))
{
	header('location:index.php');
}else{
    
     $admin_id = $_SESSION["adm_id"];

     $select_admin = mysqli_query($db,"SELECT * FROM admin WHERE adm_id = $admin_id");
     $data_admin = mysqli_fetch_assoc($select_admin);

     $select_log = mysqli_query($db,"SELECT * FROM log ORDER BY log_id DESC limit 2");
     $data_log = mysqli_fetch_assoc($select_log);

     $select_laptop = mysqli_query($db,"SELECT COUNT(*) as tot_warranty FROM laptop
     WHERE DATEDIFF(expired_warranty_date,CURDATE()  ) < 90;");
     $select_data_laptop = mysqli_query($db,"SELECT *
     FROM laptop
     WHERE DATEDIFF(expired_warranty_date, CURDATE()) < 90;;
     ;");
     

     function diffMonth($from, $to) {

        $fromYear = date("Y", strtotime($from));
        $fromMonth = date("m", strtotime($from));
        $toYear = date("Y", strtotime($to));
        $toMonth = date("m", strtotime($to));
        if ($fromYear == $toYear) {
            return ($toMonth-$fromMonth)+1;
        } else {
            return (12-$fromMonth)+1+$toMonth;
        }

    }

    //  $start_date = $data['current_warrant_date'];
    //  while($data = mysqli_fetch_assoc($select_laptop)){
         
    //      $current_date =date('yyyy-mm-dd');
    //      $end_date = $data['expired_warranty_date'];
    //     echo "<script>alert('".  diffMonth($current_date,$end_date)
    //     ."Days ')</script>";
    //     }

    //  $date2 = $end_date;
     
    //  $ts1 = strtotime($date1);
    //  $ts2 = strtotime($date2);
     
    //  $year1 = date('Y', $ts1);
    //  $year2 = date('Y', $ts2);
     
    //  $month1 = date('m', $ts1);
    //  $month2 = date('m', $ts2);
     
    //  $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

    //  echo "<script>alert('$diff')</script>";
     
     //  echo "<script>alert('$start_date')</script>" ;
    // $end
    //  $interval = $start_date->diff($end_date);
// $days_count = $interval->days;
// echo $days_count;
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
    <title>Admin Panel</title>
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
                        
                    <!--<span><img src="images/iLokal.png" alt="homepage" class="dark-logo" /></span>-->
                    </a>
                </div>

                <div class="navbar-collapse" style="position: absolute;left:85%">
                    
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/<?= $data_admin['image'] ?>" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-left animated zoomIn">
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
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
                        </li>
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

                       <li> <a class="has-arrow" href="add_account.php" aria-expanded="false"><span class="hide-menu"><i class="fa fa-users" aria-hidden="true"></i>Create New Acc</span></a> </li>

                         
                    </ul>
                </nav>
            
            </div>
           
        </div>
    
        <div class="page-wrapper">
         
        
        
            <div class="container-fluid">
            <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Admin Dashboard</h4>
                            </div>
                     <div class="row">
                   
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-warning f-s-40 "></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php $sql="select * from restaurant";
												$result=mysqli_query($db,$sql); 
													$rws=mysqli_num_rows($result);
													
													echo $rws;?></h2>
                                    <p class="m-b-0">Laptop Conditions</p>
                                </div>
                            </div>
                        </div>
                    </div>
					
					 <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-laptop f-s-40" aria-hidden="true"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php $sql="select * from laptop";
												$result=mysqli_query($db,$sql); 
													$rws=mysqli_num_rows($result);
													
													echo $rws;?></h2>
                                    <p class="m-b-0">Laptop</p>
                                </div>
                            </div>
                        </div>
                    </div>
					 <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-laptop f-s-40" aria-hidden="true"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <a href="" onclick="alert('test')">
                                    <h5>Warranty Expired Alert</h5>
                                    <p class="m-b-0"><?php
$data_warrant = mysqli_fetch_assoc($select_laptop)  ;
echo $data_warrant['tot_warranty'];
?> Laptops</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="container">
                                <div style="width:100%;height:400px" class="card">
                            <div class="card-body" style="color:black">
                            <p> Last Edited by</p>
                            <p class="mt-4">(<?= $data_log['date'] ?>) at <?= $data_log['time'] ?></p>
                            <p >Name: <?= $data_log['name'] ?></p>
                            <p >Last Serial No Edited: <?= $data_log['serial_no'] ?></p>
<hr >
</div>
                            </div>
        
                            </div>
                        </div>
                        <div class="col-3">
                        <div class="container">
                        <div style="width:100%;height:400px" class="card">
                        <div class="card-body">
                        <p >List laptop (serial no.) < 3 months warranty expired</p>
                            <div class="row">
                                <?php while($list = mysqli_fetch_assoc($select_data_laptop)) { ?>
                                <div class="col-8"> &bull; <?= $list['serial_no'] ?></div>
                                <?php } ?>
                            </div>
                            </div>
</div>
                    </div>
                        </div>

                        <div class="col-6">
                    
                        <div class="row">
                            <div class="col-6">
                                <div class="btn btn-danger " style="font-size:15px;width:200px" >
                                    <p class="text-white">BROKEN
                                        
                            <div ><?php 
                            $select_laptop_1 = mysqli_query($db,"SELECT * FROM laptop WHERE status = 'Rosak'");
                            echo mysqli_num_rows($select_laptop_1);
                            ?> Laptops</div>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                            <div class="btn" style="background-color:orange;font-size:15px;width:200px" >
                                    <p class="text-white">CURRENTLY REPAIR
                            <div class="text-white" >
                            <?php 
                            $select_laptop_2 = mysqli_query($db,"SELECT * FROM laptop WHERE status = 'Current Repair'");
                            echo mysqli_num_rows($select_laptop_2);
                            ?> Laptops
                            </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="btn btn-warning " style="font-size:15px;width:200px">
                                    <p class="text-white">WAITING 
                                       FOR REPAIR
                                    <div>
                                    <?php 
                            $select_laptop_3 = mysqli_query($db,"SELECT * FROM laptop WHERE status = 'Waiting To Repair'");
                            echo mysqli_num_rows($select_laptop_3);
                            ?> Laptops
                                    </div>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                            <div class="btn btn-success ml-2" style="font-size:15px;width:200px;position:relative;right:5px">
                                    <p class="text-white" >GOOD CONDITION
                                    <div> <?php 
                            $select_laptop_4 = mysqli_query($db,"SELECT * FROM laptop WHERE status = 'Good Condition'");
                            echo mysqli_num_rows($select_laptop_4);
                            ?> Laptops</div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    

<!-- <button type="button" onclick="window.print()" class="btn btn-primary mt-4">Generate Report</button> -->
                        </div>
                    </div>
                    
					
                    
					
					
   <script>
   

function printChart() {
    window.print();
		}
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
<?php
}
?>
