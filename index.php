<?php
    include("connect.inc.php");

    try {
	
	$conn = new PDO("mysql:host=$host;dbname=$dbname", "$login", "$password");	
	   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	   $conn->exec("set names utf8");	
	   $conn->exec("set names latin1");
    }
    catch (PDOException $erreur) {	
	   echo "<p>Erreur : " . $erreur->getMessage() . "</p>\n";
    }

   

    $action = $_SERVER['REQUEST_URI'];
    $newUrl = parse_url($action, PHP_URL_PATH);
    $url = substr($action, strrpos($action, '/') + 1);
    $urlParam = parse_url($url, PHP_URL_QUERY);
    
    include("header.php");    
	
if($urlParam){
    include("adminPage.php");break;
}
else{
	switch($url) {				
		case "valeurs": include("valeurs.php");break;	
		case "ordre": include("ordre.php");break;		
		case "service-oral":include("service-oral.php");break;	
		case "service-art": include("service-art.php");break;	
		case "service-technical": include("service-technical.php");break;	
		case "contact": include("contact.php");break;	
		case "login": include("newlogin.php");break;	
		case "adminPage": include("adminPage.php");break;        
		default : include("main.php");break;	
	}    
}


    include("footer.php");    

    $conn = null;
?>