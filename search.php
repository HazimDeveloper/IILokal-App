<?php
include("connection/connect.php"); 
// 1. Check if the search form has been submitted
if(isset($_POST['search'] )){
$data_search = $_POST['search_query'];
$sql = "SELECT * FROM `dishes` ORDER BY `d_id`
    WHERE title ='$data_search' or d_id  ='$data_search'";
mysqli_query($db, $sql);
Header('location: index.php');
}
   