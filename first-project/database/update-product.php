<?php 


        $product_name = $_POST['product_name'];
        $description = $_POST['description'];
        $pid = $_POST['pid'];


//this is we copy it  from "add.php"

        $target_dir = "../uploads/products/";
        

        $file_name_value = '' ;
        $file_data = $_FILES['img'];

        if($file_data['tmp_name'] !== '' ){


            $file_name =  $file_data['name'];

            $file_ext =  pathinfo($file_name,PATHINFO_EXTENSION);
        
            $file_name = 'product-' . time() . "." . $file_ext;

            $check = getimagesize($file_data['tmp_name']);
        

            if($check){
    //move the file 
                    if(move_uploaded_file($file_data['tmp_name'], $target_dir . $file_name)){
    //save the name to database
                        $file_name_value = $file_name; 
                    }
                }   
            }

        

    // var_dump($product_name);
    // var_dump($description);
    // var_dump($pid);
    // var_dump($file_name_value); 
    // die ;
//Save the database : 


try {
        $sql = "UPDATE  products 

        SET 
                product_name =? , description =? , img =? 
                
        WHERE 
                id =? ";
            
            

    include('cnx.php'); 
    $stmt = $cnx->prepare($sql);
    $stmt->execute([$product_name ,$description, $file_name_value, $pid]);


    $response = [
        'success' => true, 
        'message' => " <strong>$product_name</strong> Successfuly updated to the system  "
    ];
} catch (\Exception $e) {
    $response = [
        'success' => false, 
        'message' => "Error Processing Your Request!"
    ];
}
echo json_encode($response);
