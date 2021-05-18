<?php
    session_start();
    // if(!isset($_SESSION['username'])){
    //     $_SESSION['mas'] = "You must log in first";
    //     header('location: index.php');
    // }
    require_once('dbcontrollersc.php');
    $db_handle = new DBControllersc();
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        header('location: index.php');
    }
    if(!empty($_GET["action"])){
        switch($_GET["action"]){
            case "add":
                if(!empty($_POST["quantity"])) {
                    $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
                    $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"],
                                                                        'code'=>$productByCode[0]["code"], 
                                                                        'quantity'=>$_POST["quantity"], 
                                                                        'price'=>$productByCode[0]["price"], 
                                                                        'image'=>$productByCode[0]["image"]));
                    
                    if(!empty($_SESSION["cart_item"])) {
                        if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                    if($productByCode[0]["code"] == $k) {
                                        if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                            $_SESSION["cart_item"][$k]["quantity"] = 0;
                                        }
                                        $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                    }
                            }
                        } else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArray;
                    }
                }
                break;
                case "remove":
                    if(!empty($_SESSION["cart_item"])) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($_GET["code"] == $k)
                                unset($_SESSION["cart_item"][$k]);                      				
                            if(empty($_SESSION["cart_item"]))
                                unset($_SESSION["cart_item"]);
                        }
                    }
                    break;
                case "empty":
                    unset($_SESSION["cart_item"]);
                        break;
        }
    }
       
   
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านขายของชำสมุทรปราการ</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/styleindexz.css">
    
</head>
<body>
    <div class="menubar">
        <div class="container">
                <div class="logo">
                    <h1><a href="index.php">HEAIJOME.</a></h1>
                </div>
                <ul>
                    <li>
                        <a href="register.php">register</a>
                    </li>
                    <li>
                    
                        <a href="login.php">log in</a>
                    </li> 
                    
                    <li>
                        <a href="pageabout.php">about</a>
                    </li>
                   
                   
                    <li>
                        <a href="shoppingcart.php">chart</a>
                    </li>
                </ul>
        </div>
    </div>
    <div class="imgslide">
        <div class="slide">
            <figure>
                <img src="image1//1.gif" alt="">
                <img src="image1//2.jpg" alt="">
                <img src="image1//3.jpg" alt="">
                <img src="image1//4.jpg" alt="">
                <!-- <img src="image1//1.jpg" alt=""> -->
            </figure>
        </div>
    </div>
    <?php if (isset($_SESSION['username'])) : ?>
            <p>welcome <strong> <?php echo $_SESSION['username'] ?></strong></p>
           
            <p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
        <?php endif ?>
    <div class="content">
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <h3>
                    <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        
        <?php endif ?>
   
    </div>
     <div id="product-grid">
        <div class="txt-heading">products</div>
        <?php

            $product_array = $db_handle->runquery("SELECT * FROM tblproduct ORDER BY id ASC");

            if  (!empty($product_array)) {
                foreach($product_array as $key => $value) {

                
        ?>
        <div class="product-item">
		<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
		<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
		<div class="product-tile-footer">
		<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
		<div class="product-price"><?php echo "฿".$product_array[$key]["price"]; ?></div>
		<div class="cart-action">
        <input type="text" class="product-quantity" name="quantity" value="0" size="1" />
        <input type="submit" value="Add" class="btnAddAction" /></div>
		</div>
		</form>
	</div>

        <?php
                }
}

        ?> 
    </div>
</body>
</html>