<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); 
error_reporting(0);
session_start();

// include_once 'product-action.php'; 
$res_id = $_GET['res_id'];
$problem = mysqli_query($db,"SELECT * FROM restaurant WHERE rs_id = '$res_id'");
$data_prob =mysqli_fetch_assoc($problem);
$nama_problem = $data_prob['title'];

$now = date('y-m-d');

$select_data_laptop = mysqli_query($db,"SELECT * FROM laptop
WHERE DATEDIFF(NOW(), expired_warranty_date ) < 90;");

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

?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/company.jpeg">
    <title>Laptop Details</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> </head>

<body>
    
        <header id="header" class="header-scroll top-header headrom">
            <nav class="navbar navbar-dark">
                   <div class="container">
                       <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Problem Details <span class="sr-only"></span></a> </li>
                            
							
							 
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        </div>
            </div>
			<?php $ress= mysqli_query($db,"select * from restaurant where rs_id='$_GET[res_id]'");
									     $rows=mysqli_fetch_array($ress);
										  
										  ?>
            <section class="inner-page-hero bg-image" style="background-image: url('images/kkkk.jpg')">
                <div class="profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                <div class="image-wrap">
                                    <figure><?php echo '<img src="admin/Res_img/'.$rows['image'].'" alt="Restaurant logo">'; ?></figure>
                                </div>
                            </div>
							
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                                <div class="pull-left right-text white-txt">
                                    <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                                    <p><?php echo $rows['address']; ?></p>   
                                </div>
                            </div>
							
							
                        </div>
                    </div>
                </div>
            </section>
            <div class="breadcrumb">
                <div class="container">
                   
                </div>
            </div>
            <div class="container m-t-30">
                <div class="row">
                    
                    </div>

                    <div class="col-md-8">
                      
             
                        <div class="menu-widget" id="2">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                              Laptop Details <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
							  
                              <i class="fa fa-angle-right pull-right"></i>
                              <i class="fa fa-angle-down pull-right"></i>
                              </a>
							  
							  
							  
                           </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collapse in" id="popular2">
						<?php  
									$stmt = mysqli_query($db,"select * from laptop where problem = '$nama_problem'  ");
									
								while($product = mysqli_fetch_assoc($stmt))
								
										{
					?>
                                <div class="food-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
										<form method="post" action='dishes.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $product['laptop_id']; ?>'>
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="admin/Res_img/'.$product['image'].'" alt="Food logo">'; ?>
                                                <?php if($product['status']  == 'Good Condition'){  ?>
                                                    <div class="btn btn-success " style="margin-top: 90px;">Good Condition</div>
                                                    <?php }else if($product['status'] == 'Waiting To Repair'){ ?>
                                                        <div class="btn btn-warning " style="margin-top: 90px;">Waiting For Repair</div>
    
                                                        <?php }else if($product['status'] == 'Current Repair'){ ?>                                                    
                                                            <div class="btn " style="background-color: orange;margin-top: 90px;">Currently Repair</div>
              
<?php } else{ ?>
    <div class="btn btn-danger" style="margin-top: 90px;">Broken</div>
              
    <?php }?>
    
                                            </a>
                                               
                                            </div>
                                            <div class="rest-descr">
                                                <h6><a href="#"><?php echo "Serial No: " .$product['serial_no']; ?></a></h6>
                                                <p> <?php echo $product['laptop_desc']; ?></p>
												 <p> <?php echo "Date Reported: ".$product['current_warrant_date']; ?></p>
                                                 <?php 
                                                 $warranty_expiration_date = strtotime($product['expired_warranty_date']);
                                                 $warranty_expiration_date_formatted = date('y-m-d', $warranty_expiration_date);
                                                 $current_date = date('y-m-d');
                                                    
                                                    if($warranty_expiration_date_formatted < $current_date ){ 
                                                        ?>
    <b class="" style="position: relative;left:100%">Warranty Status : <span style="color:red;"> Expired</span></b><br>

                                                        <?php }else{ ?>
                                                 <div class="mt-2" style="position: relative;left:100%" >  Warranty expired : <?php 
                                               
// Set the current date
$currentDate = new DateTime();

// Set the expired date
$expiredDate = new DateTime($product['expired_warranty_date']);

// Calculate the difference between the current date and the expired date
$interval = $currentDate->diff($expiredDate);

// Get the number of days from the interval
$days = $interval->days;

// Output the number of days
echo $days;


                                              ?> Day(s) Left
                                            <?php } ?>  
                                            </div>
                                            </div>
                           
                                        </div>
                               
                                      
										</form>
                                    </div>
              
                                </div>
                
								<?php
									  }
									
								?>
								
								
                              
                            </div>
             
                        </div>
            
                       
                    </div>
                    
                </div>
     
            </div>
        
            <footer class="footer" >
                <div class="container">
           
                    <div class="row bottom-footer">
                        <div class="container">
                            <div class="row">
                                
                                <div class="col-xs-12 col-sm-4 address color-gray">
                                    <h5>Address</h5>
                                    <p> TM Innovation Center (R&D) Cyberjaya, Lingkaran Teknokrat 3 Timur, 63000 Cyberjaya, Selangor</p>
                                    <h5>Phone: +03-7954 0326</a></h5> </div>
                                <div class="col-xs-12 col-sm-5 additional-info color-gray">
                                    <h5>IT Unit @ TMRnD Cyberjaya (2023)</h5>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
       
                </div>
            </footer>
      
        </div>
  
    </div>

 
    <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <div class="modal-body cart-addon">
                    <div class="food-item white">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
              
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
               
                            </div>
           
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 2.99</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect2">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-2"> </div>
                                </div>
                            </div>
                        </div>
               
                    </div>
              
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                    
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                
                            </div>
               
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 2.49</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect3">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-3"> </div>
                                </div>
                            </div>
                        </div>
            
                    </div>
            
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                       
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                 
                            </div>
                
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 1.99</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect5">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-4"> </div>
                                </div>
                            </div>
                        </div>
                 
                    </div>
               
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                 
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                      
                            </div>
                       
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 3.15</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect6">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-5"> </div>
                                </div>
                            </div>
                        </div>
           
                    </div>
             
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-btn">Add To Cart</button>
                </div>
            </div>
        </div>
    </div>
 
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>
