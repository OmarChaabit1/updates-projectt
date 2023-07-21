<?php
    include('cnx.php');

    $id = $_GET['id'];

    
    $stmt = $cnx->prepare("SELECT * FROM products  WHERE  id = $id ");
    
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);   
    
    echo json_encode($row) ;

?>