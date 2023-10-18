<?php
session_start();
require_once('dbconfig.php');
global $con;
 if(isset($_GET['token'])){
    $token = $_GET['token'];
    $updatequery= "update userinfo set status='active' where token='$token'";
    $query= mysqli_query($con,$updatequery);
    if($query){
        echo "Acount activated successfuly";
        header('location:index.php');
    }
    else{
        echo "logout";
        header('loaction:index.php');
    }
  


 }
?>