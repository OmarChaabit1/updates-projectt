<?php
// Start the session
session_start();

// Check if the user is already logged in, redirect to the dashboard if true
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit();
}

// Include the database connection
include 'database/cnx.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Prepare and execute the SQL query to check user credentials
    $stmt = $cnx->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
    $stmt->execute([$email, $role]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['Password'])) {
        // Authentication successful
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit();
    } else {
        $error_message = "Please make sure that the email, password, and role are correct.";
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>
    <link rel="stylesheet" href="css/first-project.css?v=<?= time();?>">
</head>
<body>
            <?php if (isset($error_message) && !empty($error_message)) { ?>
                    <div id="error">
                        <p><strong>Error: </strong><?= $error_message ?></p>
                    </div>
                <?php } ?>

    

            <div class="login-form-container">

                <div id="close-login-btn" class="fas fa-times">

                </div>

                <form action="home.php" method="POST">
                    
                    <h3>Sign in </h3>
                    
                    <span>Email</span>
                    <input type="email" name="email" class="box" placeholder="entrer your email " id="email">

                    <span>password</span>
                    <input type="password" name="password" class="box" placeholder="entrer your password " id="password">
                    <p>forget password? <a href="#">click here</a></p>

                    <div class="checkbox"> 
                        <input type="checkbox" name="" id="remember-me">
                        <label for="remember-me">remember me</label>
                    </div>

                    <select name="role">
                            <option value="user" selected>User</option>
                            <option value="admin">Admin</option>
                    </select>           


                    <input type="submit" value="sign in" class="btn">
                   <div class="users">
                   <input type="submit" value="admin" id="btn1" class="btn">
                    <input type="submit" value="sales"id="btn2" class="btn">
                   </div>
                </form>
                
            </div>





<script src="js/first-project.js?v=<?= time();?>"></script>
</body>
</html>