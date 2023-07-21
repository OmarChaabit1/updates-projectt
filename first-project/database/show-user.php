<?php
    include('cnx.php');

    $stmt = $cnx->prepare("SELECT * FROM users ORDER BY created_at DESC  ");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
   
    


?>