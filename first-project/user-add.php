<?php

//start use session 
    session_start();

    if(!isset($_SESSION['user']))

    header('Location: home.php');
    $_SESSION['table'] = 'users';
    //redirection ( like when you add the product the message will receive in the same page to the form  )
    $_SESSION['redirect_to'] = 'user-add.php';
    $user = $_SESSION['user'];
    $users = include('database/show-user.php');
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Pos System</title>
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

                         <h1 class="section-header"><i class="fa fa-plus"></i>Insert User</h1>
                        
                        <form action="database/add.php" method="POST">

                                    <div class="info-person">
                                        <div>
                                            <label for="first_name">First Name</label>
                                            <input type="text" id="first_name" name="first_name">
                                        </div>

                                        <div>
                                            <label for="last_name">Last Name</label>
                                            <input type="text" id="last_name" name="last_name">
                                        </div>
                                    </div>

                                    <div class="info-person">

                                        <div>
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email">
                                        </div>

                                        <div>
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password">
                                        </div>

                                    </div>  
                                    

                                   <!--
                                     <div class="info-person">

                                        <div>
                                            <label for="">Created At</label>
                                            <input type="date" id="created_at" name="created_at">
                                        </div>

                                        <div>
                                            <label for="">Updated At</label>
                                            <input type="date" id="updated_at" name="updated_at">
                                        </div>

                                    </div>
                                   -->

                                    <div class="buttons">
                                        <button type="submit"><i class="fa fa-send"></i>Add User</button>
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