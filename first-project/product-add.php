<?php

//start use session 
    session_start();

    if(!isset($_SESSION['user'])) header('Location: home.php');
    $_SESSION['table'] = 'products';
    $_SESSION['redirect_to'] = 'product-add.php';

    $user = $_SESSION['user'];
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Pos System</title>
    <!--product css -->

<link rel="stylesheet" href="css/product.css?v=<?= time();?>">

    <!--lets include the file-->
    <?php  include('partials/app-header-script.php');  ?> 
</head>
<body>
    <div id="dashboard_main_container">
      <?php include('partials/sidebar.php');?>
    
      </div>
        <div class="dashboard-content-container" id="dashboard_content_container">

            <?php include('partials/topNav.php') ?>

            <div class="dashboard-content">
                <!--row-->
            <div class="dashboard-content-main">
                <div class="row">
                    <div class="column column-5">

                         <h1 class="section-header"><i class="fa fa-plus"></i>Create Product</h1>
                        
    <form action="database/add.php" method="POST" enctype="multipart/form-data">

                                    <div class="info-person">
                                        <div>
                                            <label for="product_name">Product Name</label>
                                            <input type="text" id="product_name" name="product_name" placeholder="Enter ur product name...">
                                        </div>

                                    <div>
                                            <label for="description">Description</label>
                                            <textarea class="description" id="description" name="description" placeholder="Enter ur product description..."></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="info-person">
                                        <div>
                                            <label for="product_image">Product Image </label>
                                            <!--value="Upload the Image"-->
                                            <input type="file" id="img" name="img" >
                                        </div>
                                    </div>
                                    

                                    <div class="buttons">
                                        <button type="submit"><i class="fa fa-send"></i>Create Product </button>
                                        <button type="reset"><i></i>Cancel</button>
                                
                                    </div>
                        </form>
                        <?php if(isset($_SESSION['response'])){
                                $response_message = $_SESSION['response']['message'];
                                $is_success = $_SESSION['response']['success'];
                            ?>
                            <div class="responseMessage">
                                <p class="responseMessage <?= $is_success ? 'responseMessage__success 
                                ' : 'responseMessage__error' ?>" >
                                <?= $response_message ?>
                            </p>
                            </div>

                       <?php unset($_SESSION['response']); } ?>
                        </div>

                </div>
                    </div>
                    
                    
            </div>

        </div>
        <?php  include('partials/app-script.php');  ?> 

</body>
</html>