
<?php 
$dburl = parse_url(getenv("CLEARDB_DATABASE_URL")); 
$host = $dburl["host"]; 
$login = $dburl["user"]; 
$password = $dburl["pass"]; 
$dbname = substr($dburl["path"], 1); 
?>

