<?php
   
    $conn = mysqli_connect("localhost","root","","register_db");
    if(!$conn){
        die("fail".mysqli_connect_error());
    }
?>