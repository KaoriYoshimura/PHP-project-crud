<?php
    //Start session
    session_start(); 

//Login form submission from  index page.
//If any of input is missing go back to index.php and show error message.
if(empty($_POST['username'])||empty($_POST['address'])||empty($_POST['tel'])||empty($_POST['email'])){
    header('Location: ../index.php?empty_error=Please enter all information.');
    exit(); //exit() should be set if more action is set after this redirect.
    //If all information is filled in and "address" is shorter than 10 charactors, go back to index.php and show error message.
    } else{
        if(strlen($_POST['address']) < 10){
        header('Location: ../index.php?error=Address must be longer than 10 charactors.');
        exit();
//Otherwise information will be registered as session and go to #product catalog in index.php.
} else
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["address"] = $_POST["address"];
    $_SESSION["tel"] = $_POST["tel"];
    $_SESSION["email"] = $_POST["email"];
   header('Location: ../index.php#product_catalog'); 
    exit();
   }  