<?php
    //To connect with functions/PDO, start session
    require_once ('initialize.php');

    //Register form submission from  index page.
    //If any of input is missing go back to login.php and show error message.
        
        //If all information is NOT filled, go back to login.php and show error message.
        if(empty($_POST['username'])||empty($_POST['email'])||empty($_POST['password'])){
            redirect_to('../views/login.php?empty_error=Please enter all information.');

        //If all information is filled in and passwor is shorter than 10 charactors, go back to login.php and show error message.
        } else{
            if(strlen($_POST['password']) < 10){
                redirect_to('../views/login.php?error=Password must be longer than 10 charactors.');
                
            //Otherwise send user details to database.
            } else
                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = $_POST["password"];
            
                //Convert to encrypted password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
                //Get user infromation from users table
                $fetched_user = get_user_info($pdo, $username);
            
                if($fetched_user["username"] == $username){
                    //If username exist already in the database go back to login.php and show error message.
                    redirect_to('../views/login.php?exist_error=This username is already taken.');
                }else{
                    
                //Prepare sql statement
                $statement = $pdo->prepare("
                INSERT INTO users (username, email, hashed_password)
                VALUES(:username, :email, :hashed_password)
                ");
                //Provide values for placefolders prepared in the sql statement and excecute
                $statement->execute(
                [
                    ":username" =>$username,
                    ":email" =>$email,
                    ":hashed_password" =>$hashed_password
                ]
                );
                
                //Redirect to login.php and show the message
                redirect_to('../views/login.php?register=Registered successfully! You can now log in.');
                }
        }