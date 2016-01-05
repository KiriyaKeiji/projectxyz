<?php 
	if(empty($_COOKIE['type'])  or $_COOKIE['type']!='admin' ){
    header('location: ../index.php');}
    require_once '../models/pelaporan.php';
    $Pelaporan=new Pelaporan();
    $Pelaporan->deleteRespond($_GET['id']);
    
    header("location:dashboard.php");

 ?>