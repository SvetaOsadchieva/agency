<?php 
    include("connect.inc.php");

    $conn = new PDO("mysql:host=$host;dbname=$dbname", "$login", "$password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
    $conn->exec("set names utf8");	
    $conn->exec("set names latin1");      
 
    $data = json_decode($_POST['data'], true);

    $price = $data['price']; 
    $time = $data['time'];
    $id_qoute = $data['id_qoute'];
    $status_work = $data['status_work'];
    $status_pay = $data['status_pay'];

    $rUpdate = "UPDATE qoute SET price=$price, time=$time, status_work='$status_work',
    status_pay='$status_pay' WHERE id_qoute=$id_qoute";
 
 	
    $result= $conn->exec($rUpdate);	

    var_dump($result);
    
    $conn = null; 
?>