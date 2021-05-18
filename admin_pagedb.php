<?php
    session_start();
    include('dbcontrollersc.php');

    $errors = array();
    if(isset($_POST['reg_stock'])){
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $code = mysqli_real_escape_string($conn,$_POST['code']);
        $image = mysqli_real_escape_string($conn,$_POST['image']);
        $price = mysqli_real_escape_string($conn,$_POST['peice']);
       
        if(empty($image)){
            array_push($errors,"image is required");
            $_SESSION['error'] = "image is required";
            
        }
        if(empty($price)){
            array_push($errors,"price is required");
            $_SESSION['error'] = "price is required";
            
        }
     
        if(empty($code)){
            array_push($errors,"code is required");
            $_SESSION['error'] = "code is required";
            
        }
        if(empty($name)){
            array_push($errors,"name is required");
            $_SESSION['error'] = "name is required";
           
        }
        // $user_check_query = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
        // $query = mysqli_query($conn,$user_check_query);
        // $result = mysqli_fetch_assoc($query);

       
        //     if($result['username'] === $username){
        //         array_push($errors,"Username already exit");
        //         $_SESSION['error'] = "Username already exit";
        //     }
        

        if(count($errors) == 0){
           //$password = md5($password_1);

            $sql = "INSERT INTO tblproduct(name,code,image,price) 
                    VALUES ('$name','$code','$image','$price')";
            mysqli_query($conn,$sql);
            header('location: index.php');
        }else{  
            header("location: admin_page.php");
        }
      
    }
?>