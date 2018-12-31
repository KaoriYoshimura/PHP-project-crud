<?php
    //To connect with functions/PDO, start session
    require_once ('initialize.php');


    //If any of input is missing go back to login.php and show error message.
    if(empty($_POST['username'])||empty($_POST['password'])){
        redirect_to('../views/login.php?log_empty_error=Please enter all information.');
    
    //If all information is filled in and password is shorter than 10 charactors, go back to login.php and show error message.
    }else{
        if(strlen($_POST['password']) < 10){
            redirect_to('../views/login.php?log_error=Password must be longer than 10 charactors.');
    
    //Otherwise do password verification.
    }else

        //Get user infromation from users table
        $fetched_user = get_user_info($pdo, $_POST["username"]);

        //Check if password is correct
        $is_password_correct = password_verify($_POST["password"], $fetched_user["hashed_password"]);

        if($is_password_correct){
            //If password matches register as sesions.
            $_SESSION["username"] = $fetched_user["username"];
            $_SESSION["user_id"] = $fetched_user["user_id"];

            //Redirect to index.
            redirect_to('../index.php.');

        }else{
            //If the password does not match redirect back to login.php and show the error message
            redirect_to('../views/login.php?pw_error=Password or username is not correct.');
        }

    }  