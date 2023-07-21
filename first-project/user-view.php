<?php

//start use session 
    session_start();

    if(!isset($_SESSION['user']))

    header('Location: home.php');
    $_SESSION['table'] = 'users';
    $user = $_SESSION['user'];
    $users = include('database/show-user.php');
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php  include('partials/app-header-script.php');?> 
    <title>View Users - Pos System</title>
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
                <div class="column column-7">
                        <h1 class="section-header"><i class="fa fa-list"></i >List of Users</h1>
                        <div class="section-content">
                            <div class="users">
                                <table>
                                  
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    foreach($users as $index => $user){?>
                                  
                                   <tr>

                                            <td id="userId"><?=$index + 1 ?></td>
                                            <td class="firstName" id="firstName"><?= $user['first_name'] ?></td>
                                            <td class="lastName" id="lastName"><?= $user['last_name'] ?></td>
                                            <td class="email" id="email"><?= $user['email'] ?></td>
                                            <td><?= date('M d,Y @ h:i:s A', strtotime($user['created_at'])) ?></td>
                                            <td><?= date('M d,Y @ h:i:s A', strtotime($user['updated_at'])) ?></td>
                                            <td>
                                            <a href="#" class="updateUser" data-userid="<?= $user['id'] ?>"><i class="fa fa-pencil"></i>Edit</a>
                                            <a href="#" class="deleteUser" data-userid="<?= $user['id'] ?>"data-fname="<?=$user['first_name']?>" data-lname="<?=$user['last_name']?>"><i class="fa fa-trash"></i>Delete</a>
                                                                                           
                                            </td>
                                    </tr>
                              <?php }?>
                                    </tbody>

                                </table>
                            <p class="userCount"><?= count($users)?> Users</p>
                            </div>
                        </div>
                    </div>  
                </div>
                    
                    
            </div>

        </div>
        
        <?php  include('partials/app-script.php');  ?> 

</body>
</html>