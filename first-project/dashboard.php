<?php

//start use session 
    session_start();

    if(!isset($_SESSION['user'])){

        header('Location: home.php');
    }

    $user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/first-project.css?v=<?= time();?>">
    <title>Dashboard - Pos System</title>
</head>
<body>
<div id="dashboard_main_container">
    
      <?php include('partials/sidebar.php');?>
    
      </div>
        <div class="dashboard-content-container" id="dashboard_content_container">

            <?php include('partials/topNav.php') ?>

            <div class="dashboard-content">
                    <div class="dashboard-content-main">

                    </div>
            </div>

        </div>
    
        <script src="js/dashboard.js?v=<?= time();?>"></script>
</body>
</html>