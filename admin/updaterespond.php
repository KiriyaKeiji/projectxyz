<?php 
	if(empty($_COOKIE['type'])  or $_COOKIE['type']!='admin' ){
    header('location: ../index.php');}
    require_once '../models/pelaporan.php';
    $Pelaporan=new Pelaporan();
    $Pelaporan->updateRespond($_POST['isi'],$_POST['idtanggap']);
    
    header("location:dashboard.php");

 ?>