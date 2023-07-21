
<?php
                                // this "add.php" is for the adding users and products ;
session_start();

//capture the table mappping 
    include('tables_columns.php');



/*
var_dump($_POST);
//for the files we need to use the global variables 
var_dump($_FILES);die ;
*/

    //capture the table name 
    $table_name = $_SESSION['table'];
    $columns = $table_columns_mapping[$table_name]; 


    

//loop trought the columns 
    $db_array = [];
    $user = $_SESSION['user'] ;
    foreach($columns as $column){
        
        if(in_array($column,['created_at','updated_at'])) $value = date('Y-m-d H:i:s');
        else if($column == 'created_by') $value = $user['id'];
//add another els if for the password-hash 
        else if($column == 'password')
         $value =  password_hash($_POST[$column], PASSWORD_DEFAULT);
// Aanother else if for theimage file 
        else if($column == 'img'){
// upload or move the file to our directory 
        $target_dir = "../uploads/products/";
        $file_data = $_FILES[$column];

        $file_name =  $file_data['name'];
        $file_ext =  pathinfo($file_name, PATHINFO_EXTENSION);
        
        $file_name = 'product-' . time() . "." . $file_ext;

        $check = getimagesize($file_data['tmp_name']);

        if($check){
                    //move the file 
                                    if(move_uploaded_file($file_data['tmp_name'],$target_dir . $file_name)){
                    //save the name to database
                                    $file_name_value = $file_name; 
                                    }
            }else {
//do not mobe the file

        }
//Save the path to our database 
        }
         else $value = isset($_POST[$column]) ? $_POST[$column] : ''; 

            $db_array[$column] = $value ;
    }
    

    $table_properties = implode(", ",  array_keys($db_array)); 
    $table_placeholders = ':' . implode(", :", array_keys($db_array)); 


//for users data

// $first_name = $_POST['first_name'];
// $last_name = $_POST['last_name'];
// $email = $_POST['email'];
// $user_password = $_POST['password'];
// $encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);

try {
    
    
    $sql = "INSERT INTO $table_name($table_properties)
    
            VALUES ($table_placeholders)"; 
    
    include('cnx.php'); 

    $stmt = $cnx->prepare($sql);
    $stmt->execute($db_array);
    $response = [
        'success' => true, 
        'message' => $first_name . " " . $last_name . "successfuly added to the system "
    ];
} catch (PDOException $e) {
    $response = [
        'success' => false, 
        'message' => $e->getMessage()
    ];
}
    $_SESSION['response'] = $response;

    header('Location: ../' . $_SESSION['redirect_to']);

?>
