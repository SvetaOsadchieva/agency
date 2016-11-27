<?php
   include("connect.inc.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $conn = new PDO("mysql:host=$host;dbname=$dbname", "$login", "$password");	
       
      $myusername=$_POST['username'];
      $mypassword=$_POST['password'];
       
       if($_POST && isset($_POST['username'])){
            $stmt = $conn->prepare("SELECT * FROM admin WHERE username = '$myusername' AND password='$mypassword'");
            $stmt->execute();
 
           if(!empty($stmt->fetchAll())) {
     
              
               $_SESSION['login_user'] = $myusername;
                
                header("location: adminPage");
           }
           else{
                $error = "Your Login Name or Password is invalid";
           }
       } 
   }
?>

    <div class="container-fluid login">
        <form action="" method="post" class="col-md-offset-4 col-md-4">
           <h2>Login</h2>
            <div class="form-group">
                <input type="text" placeholder="username" name="username">
            </div>
            <div class="form-group">
                <input type="password" placeholder="password" name="password">
            </div>
            <button type="submit">Submit</button>
            <br />
        </form>
    </div>