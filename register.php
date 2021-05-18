<?php 
    session_start();
    include('server.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register page</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/stylelogin.css">
</head>
<body>
   
    <div class="header">
        <h2>register</h2>
    </div>
    <form action="register_db.php" method="post">
        <?php include('error.php');?>
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <h3>
                    <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        
        <?php endif ?>
        <div class="input_group">
            <label for="username">Username</label>
            <input type="text" name="username">
        </div>
        <div class="input_group">
            <label for="password_1">Password</label>
            <input type="password" name="password_1">
        </div>
        <div class="input_group">
            <label for="password_2">Confirm Password</label>
            <input type="password" name="password_2">
        </div>
        <div class="input_group">
            <label for="phonenumber">Phone Number</label>
            <input type="phonenumber" name="phonenumber">
        </div>
        <div class="input_group">
            <label for="address">Address</label>
            <input type="address" name="address">
        </div>
        <div class="input_group">
            <button type="submit" name ="reg_user" class="btn">Register</button>
        </div>
        <div class="bot">
            <p>Already a member?<a href="login.php">  Sign in</a></p>
        </div>
        
    </form>
    <footer class="footer">
            <a href="index.php" class="link">HEAIJOME.</a>
    </footer>
</body>
</html>