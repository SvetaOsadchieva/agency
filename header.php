<?php
 
$mainUrl = "https://$_SERVER[HTTP_HOST]/index.php";
$pathUrl = parse_url($url, PHP_URL_PATH);
$urlParam = parse_url($action, PHP_URL_QUERY);

echo
"<html lang='en'>

<head>
    <title>Trigon</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>";
    
    
   
    $action = $_SERVER['REQUEST_URI'];
//    $url = substr($action, strrpos($action, '/') + 1);

    if($pathUrl == "index.php"){
        echo "<link rel='stylesheet' href='./style/style.css'>
              <link rel='stylesheet' href='./style/font-awesome.min.css'>";
    }
    else{
          echo "<link rel='stylesheet' href='../style/style.css'>
                <link rel='stylesheet' href='../style/font-awesome.min.css'>";
    }
	
if($urlParam){
    echo "<link rel='stylesheet' href='../style/admin.css'>";   
}
else{
  	switch($pathUrl) {				
		case "valeurs": echo "<link rel='stylesheet' href='../style/valeurs.css'></head>"; break;
		case "ordre": echo "<link rel='stylesheet' href='../style/service.css'><link rel='stylesheet' href='../style/order.css'>"; break;		
		case "service-oral": echo "<link rel='stylesheet' href='../style/service.css'>"; break;
		case "service-art": echo "<link rel='stylesheet' href='../style/service.css'>"; break;
		case "service-technical": echo "<link rel='stylesheet' href='../style/service.css'>"; break;
		case "login": echo "<link rel='stylesheet' href='../style/login.css'>"; break;
		case "adminPage": echo "<link rel='stylesheet' href='../style/admin.css'>"; break;
		case "contact": echo "<link rel='stylesheet' href='../style/service.css'>
                              <link rel='stylesheet' href='../style/contact.css'>"; break;
	}  
}

	
    
echo "<body>";
     
echo "<nav class='navbar navbar-default header'>
    <div class='container'>
        <div class='navbar-header'>
            <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
            </button>
            <a class='navbar-brand' href='#'>TRIGON</a>
        </div>
        <div class='collapse navbar-collapse' id='myNavbar'>
            <ul class='nav navbar-nav navbar-right'>
                <li><a href='$mainUrl'>ACCUEIL</a></li>
                <li><a href='$mainUrl/valeurs'>VALEURS</a></li>
                <li><a href='$mainUrl#service'>SERVICES</a></li>
                <li><a href='$mainUrl/ordre'>ORDRE</a></li>
                <li><a href='$mainUrl/contact'>CONTACTING</a></li>
                
            </ul>
        </div>
    </div>
</nav>";

?>