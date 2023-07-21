<?php
    $data = $_POST; 
    $id = (int) $data['id'];
    $table = $data['table'];

try {
        $command = "DELETE FROM $table WHERE id ={$id}";

        include('cnx.php');

        $cnx->exec($command);
        
        echo json_encode([
            'success' => true,
        ]);
} catch(PDOException $e) {
        echo json_encode([
            'success' => false,
        ]);
}
?>