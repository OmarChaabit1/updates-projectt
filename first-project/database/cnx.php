<?php
$servername = 'localhost'; 
$username = 'root'; 
$password = ''; 
$dbname = 'pos_project'; // Replace with your actual database name

try {
    $cnx = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\Exception $e) {
    $error_message = $e->getMessage();
    // Handle the connection error
}
?>
