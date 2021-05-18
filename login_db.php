<?php
    session_start();
    include('server.php');

    $errors = array();

    if(isset($_POST['login_user'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        if(empty($username)){
            array_push($errors,"Username is required");
        }

        if(empty($password)){
            array_push($errors,"Password is required");
        }

        if(count($errors) == 0){
             //$password = md5($password);
            $query = "SELECT * FROM user WHERE password = '$password'AND username = '$username' ";
            
                $result = mysqli_query($conn,$query);
             
            $row = mysqli_fetch_array($result);
            if($row > 0){
                
                $_SESSION['username'] = $username;
                $_SESSION['userlevel'] = $row['userlevel'];
               // header("location: index.php");
               if($_SESSION['userlevel'] == 'm'){
                header("location: index.php");
                }
                if($_SESSION['userlevel'] == 'a'){
                header("location: admin_page.php");
                }
            }
            else{
                array_push($errors,"Worng username/password combinition");
                
                $_SESSION['error'] = "Worng username or password please try agian";
               
                header("location: login.php");
            }
        }
        else{
            array_push($errors,"Username or password required");
            $_SESSION['error'] = "Username or password required";
            header("location: login.php");
        }
    }
?>