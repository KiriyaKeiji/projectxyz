<?php 
	if(empty($_COOKIE['type'])  or $_COOKIE['type']!='admin' ){
    header('location: ../index.php');}
    require_once '../models/pelaporan.php';
    $Pelaporan=new Pelaporan();
    $Pelaporan->newRespond($_POST['isi'],$_POST['oleh'],$_POST['idlaporan']);
    header("location:respond.php?id=$_POST[idlaporan]");

 ?>