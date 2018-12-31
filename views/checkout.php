<?php
//To connect with functions, PDO, start session
require_once ('../includes/initialize.php');

//Redirect to login.php if user is not logged in
is_login('login.php');
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- head require-->
        <?php    require '../includes/head.php'; ?>

        <!-- egen CSS -->
        <link rel="stylesheet" href="../css/style.css">

        <title>Checkout | Bonsai</title>

    </head>

    <body>
        <!-- header include-->
        <?php    include '../includes/header.php'; ?>

        <!-- To check if PDO connection is successfully done     -->
        <?php include_once '../includes/check_pdo.php'; ?>

        <main id="checkout">
            <div class="container">
                <div class="contents">

                    <!--  Shopping cart title and logout, back btns   -->
                    <h3>Your order status</h3>
                    <p class="float-right"><a href="../includes/logout.php"><span class="button_color">Log out</span></a></p>
                    <p class="float-right"><a href="../index.php"><span class="button_color">Back to product catalog</span></a></p>

                    <!--  Shopping cart table  -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Today's price*</th>
                                <th class="text-center">Total</th>
                            </tr>
                            <?php
                                //Fetch shopping cart details from database
                                $cart = get_cart_info($pdo, $_SESSION['user_id']);

                                //Shopping cart caluculation
                                //Define $total, $discount variable
                                $total = 0;
                                $discount = 0;
                                //Loop cart to show shopping cart details
                                foreach($cart as $value):
                                    //Fetch cost from the product table in the database.
                                    $today_cost = $value["cost"];
                                    //If it is Wednesday 10% addition for every products
                                    if(date('w')==3):
                                        $today_cost = floor($today_cost*1.1);
                                    endif;
                                    //If it is Friday -20 deduction from every products over 200SEK
                                    if(date('w')==5 && $today_cost>200):
                                        $today_cost = $today_cost-20;
                                    endif;
                                    $product_total = $today_cost * $value['qty']; //total amount for each product
                                    $total += $product_total; //Shorthand for $total = $total + $product_total
                            ?>
                            <tr>
                                <td><?= $value["product_name"]; ?></td>
                                <td class="text-right"><?= $value["cost"]; ?></td>
                                <td class="text-right"><?= $value["qty"]; ?></td>
                                <td class="text-right"><?= $today_cost; ?></td>
                                <td class="text-right"><?= $product_total; ?></td>
                            </tr>
                            <?php
                                //End of loop cart to show shopping cart details
                                endforeach;
                                //Calculate discount and total amount
                                //Price adjustment for Monday
                                //If it is Monday 50% deduction from total amount
                                if(date('w')==1):
                                    $discount = floor($total*0.5);
                                endif;
                            ?>
                            <tr>
                                <td class= "font-weight-bold" colspan="4">Discount*</td>
                                <td class="text-right text-danger"><?= $discount; ?></td>
                            </tr>
                            <tr>
                                <td class= "font-weight-bold" colspan="4">Total payment</td>
                                <td class="text-right">SEK <?= $total - $discount;?></td>
                            </tr>
                        </table>
                        <p>*Mondays: 50% discount from total amount.<br>
                            *Wednesdays: 10% addition for every product.<br>
                            *Fridays:20SEK discount for every product over 200SEK.
                        </p>
                    </div><!-- End of the shopping cart table div -->

                    <!--  The btn to go to confirmation page      -->
                        <p class="text-right"><a href="./confirm.php"><span class="button_color">Confirm your order</span></a></p>

                </div><!-- End of contents div -->
            </div><!-- End of container div -->
        </main>


        <!-- footer include-->
        <?php    include '../includes/footer.php'; ?>

        <!-- Optional JavaScript-->
        <?php    require '../includes/optional_js.php'; ?>

    </body>
</html>