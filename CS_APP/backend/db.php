<?php 


if( !function_exists('mysqli_init') && !extension_loaded('mysqli')){
    echo "PAS DE MYSQLI";
}else{
    echo "PHEw  on a le mysqli";
}

$user = 'root';
$pass = '';
$db = "testdb";

$connexion = new mysqli('localhost',$user,$pass,$db,"3309") or die("Pas de connexion");
/*
try {
  $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
*/if($connexion->connect_errno){
    echo $connexion->connect_errno;
}
echo "CONNECTED";
?>