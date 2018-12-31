<?php
    //To connect with functions, PDO, start session
    require_once ('initialize.php');

    //To check if the qty which added into the cart is more than 0. If it is less than 0, redirect to index.
    if($_POST["qty"]>0):

        //Fetch shopping cart details from database
        $cart = get_cart_info($pdo, $_SESSION['user_id']);

        //Run loop in order to get product name which exists in the cart table
        foreach($cart as $index){
            $product_in_cart = $index["product_name"];
        }

        //Check if the same product name as POST exists already in the cart table
        if($_POST["hidden_name"] == $product_in_cart):       
            //If already exists redirect and show the error message.
            redirect_to('../index.php?cart_exist=The product you had added are already in the shopping cart.');

            else:
                //If does not exists in the cart send the POST information to the cart table in the database.
                $query = "INSERT INTO cart
                (
                product_id, qty, purchased_by
                )
                VALUES
                (
                :product_id, :qty, :purchased_by
                )
                ";

                $statement = $pdo->prepare($query);
                $statement->execute([
                        ":product_id" => $_POST["hidden_id"],
                        ":qty" => $_POST["qty"],
                        ":purchased_by" =>$_SESSION['user_id']
                        ]);

                //Redirect to index and show the successfully done message
                redirect_to('../index.php?successfull_sent=The item has been successfully added into the shopping cart!');
            endif;//End of if (to check product name duplication)

        else:
            //If the qty which added into the cart is less than 0, redirect to index with an error message.
            redirect_to('../index.php?qty_empty=Quantity must be more than 0.');

    endif; //End of if (to check if POST qty is more than 0)
?>