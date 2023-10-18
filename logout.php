<?php
require_once('funs.php');
session_start();
unset($_SESSION['email']);
session_destroy();

if(isset($_SESSION['email']))
echo 'error in logout';
else
{
	header("location:index.php");
    exit();
}