<?php 
    session_start();
    require_once('dbcontrollersc.php');
    $db_handle = new DBControllersc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/stylelogin.css">
</head>
<body>
   
    <div class="header">
        <h2>stock</h2>
    </div>
    <form action="admin_pagedb.php" method="post">
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
            <label for="name">name</label>
            <input type="text" name="name">
        </div>
        <div class="input_group">
            <label for="code">code</label>
            <input type="text" name="code">
        </div>
        <div class="input_group">
            <label for="image">image</label>
            <input type="text" name="image">
        </div>
        <div class="input_group">
            <label for="price">price</label>
            <input type="address" name="price">
        </div>
        <div class="input_group">
            <button type="submit" name ="reg_stock" class="btn">add in stock</button>
        </div>
                
    </form>
    <footer class="footer">
            <a href="index.php" class="link">HEAIJOME.</a>
    </footer>
</body>
</html>