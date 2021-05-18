<?php
    session_start();
    include('server.php');

    $errors = array();
    if(isset($_POST['reg_user'])){
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password_1 = mysqli_real_escape_string($conn,$_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn,$_POST['password_2']);
        $phonenumber = mysqli_real_escape_string($conn,$_POST['phonenumber']);
        $address = mysqli_real_escape_string($conn,$_POST['address']);
        
       
       
        
        
        if(empty($address)){
            array_push($errors,"Address is required");
            $_SESSION['error'] = "Address is required";
            
        }
        if(empty($phonenumber)){
            array_push($errors,"Phonenumber is required");
            $_SESSION['error'] = "Phonenumber is required";
            
        }
        if($password_1 != $password_2){
            array_push($errors,"The two passwords do not match");
            $_SESSION['error'] = "The two passwords do not match";
           
        }
        if(empty($password_2) && $password_2 ==""){
            array_push($errors,"Password is required");
            $_SESSION['error'] = "Password is required";
            
        }
        if(empty($password_1)){
            array_push($errors,"Password is required");
            $_SESSION['error'] = "Password is required";
            
        }
        if(empty($username)){
            array_push($errors,"Username is required");
            $_SESSION['error'] = "Username is required";
           
        }
        $user_check_query = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
        $query = mysqli_query($conn,$user_check_query);
        $result = mysqli_fetch_assoc($query);

       
            if($result['username'] === $username){
                array_push($errors,"Username already exit");
                $_SESSION['error'] = "Username already exit";
            }
        

        if(count($errors) == 0){
           //$password = md5($password_1);

            $sql = "INSERT INTO user(username,password,phonenumber,address,userlevel) 
                    VALUES ('$username','$password_1','$phonenumber','$address','m')";
            mysqli_query($conn,$sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }else{  
            header("location: register.php");
        }
      
    }
?>