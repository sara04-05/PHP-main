<?php
$host = 'localhost';
$user = 'root';
$pass = '';

try{

    $conn =new PDO("mysql:host = $host", $user, $pass);
    echo "Connected";

} 
catch(Exception $e){
    echo "not connected";
}
?>