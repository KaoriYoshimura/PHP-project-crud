<?php

//Redirect
function redirect_to($location){
    header('Location: ' .$location);
    exit; //exit() should be set if more action is set after this redirect.
}

//Redirect if user is not logged in
function is_login($location){
    if(!isset($_SESSION['username'])){
        redirect_to($location);
}
}

//To whow the error message
function is_error($message1, $message2, $message3, $message4){
    if(isset($_GET[$message1])){
        echo '<p><span class=\'warning\'>'.($_GET[$message1]).'</span></p>';
    }elseif(isset($_GET[$message2])){
        echo '<p><span class=\'warning\'>'.($_GET[$message2]).'</span></p>';
    }elseif(isset($_GET[$message3])){
        echo '<p><span class=\'warning\'>'.($_GET[$message3]).'</span></p>';
    }elseif(isset($_GET[$message4])){
        echo '<p><span class=\'warning\'>'.($_GET[$message4]).'</span></p>';
    }
}

//Show the message if any process went well.
function is_successfull($message1, $message2, $message3, $message4){
    if(isset($_GET[$message1])){
        echo '<p><span class=\'successfull\'>'.($_GET[$message1]).'</span></p>';
    }elseif(isset($_GET[$message2])){
        echo '<p><span class=\'successfull\'>'.($_GET[$message2]).'</span></p>';
    }elseif(isset($_GET[$message3])){
        echo '<p><span class=\'successfull\'>'.($_GET[$message3]).'</span></p>';
    }elseif(isset($_GET[$message4])){
        echo '<p><span class=\'successfull\'>'.($_GET[$message4]).'</span></p>';
    }
}


//To get user information from users table 
function get_user_info(PDO $pdo, $username){
    //Provide values for placefolders prepared in the sql statement and excecute
    $statement = $pdo->prepare(
        "SELECT * FROM users WHERE username = :username");
    $statement->execute(
        [
        ':username'=>$username
        ]
    );
    //When select is used fetch must happen
    return $statement->fetch(); 
}

//To get cart information from cart table & products table by user_id
function get_cart_info(PDO $pdo, $user_id){
    //Prepare a SQL statement
    $statement_cart = $pdo->prepare("
    SELECT * FROM `products` INNER JOIN cart
    ON products.product_id = cart.product_id
    WHERE purchased_by = $user_id");
    //Run a SQL command
    $statement_cart->execute();
    //Fetch cart infomartion
    return $statement_cart->fetchAll(PDO::FETCH_ASSOC);
}


function get_product_info(PDO $pdo){
    //Prepare a SQL statement
    $statement_product = $pdo->prepare("SELECT * FROM products ORDER BY product_id ASC");
    //Run a SQL command
    $statement_product->execute();
    //Fetch cart infomartion
    return $statement_product->fetchAll(PDO::FETCH_ASSOC);
}

//To get all information from cart table & products & products table by user_id
function get_all_info(PDO $pdo, $user_id){
    //Prepare a SQL statement
    $statement_all = $pdo->prepare("
    SELECT * FROM products INNER JOIN cart JOIN users 
    ON products.product_id = cart.product_id 
    AND cart.purchased_by = users.user_id 
    WHERE purchased_by = $user_id 
    ORDER BY products.product_id ASC
    ");
    //Run a SQL command
    $statement_all->execute();
    //Fetch cart infomartion
    return $statement_all->fetchAll(PDO::FETCH_ASSOC);
}