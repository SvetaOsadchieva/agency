<?php
include("connect.inc.php");

if (isset($_POST['submit'])) {
    
$error=''; // Variable To Store Error Message
    
if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {
        // Define $username and $password
        $username=$_POST['username'];
        $pass=$_POST['password'];
        // Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $connection = new PDO("mysql:host=$host;dbname=$dbname", "$login", "$password");	
        $stmt = $connection->prepare("select * from `admin` where password='$pass' AND username='$username'");	
        $stmt->execute();  

        if (!empty($stmt->fetchAll())) {
            session_start(); // Starting Session
            if(!isset($_SESSION['username1'])){
                $_SESSION['username1']=$username;
            }
            echo $_SESSION['username1'];
            // Initializing Session
            header("location: adminPage"); // Redirecting To Other Page
        } else {
            header("location: login");
        }
    }
}
?>