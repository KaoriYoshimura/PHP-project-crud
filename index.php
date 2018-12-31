<?php
//To connect with functions, PDO, start session
require_once ('./includes/initialize.php');

//Redirect to login.php if user is not logged in
is_login('views/login.php');
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- head require-->
        <?php    require './includes/head.php'; ?>
        <!-- egen CSS -->
        <link rel="stylesheet" href="./css/style.css">

        <title>Index | Bonsai</title>

    </head>

    <body>
        <!-- header include-->
        <?php    include './includes/header.php'; ?>

        <!-- To check if PDO connection is successfully done     -->
        <?php include_once './includes/check_pdo.php'; ?>

        <main id="index">
            <div class="container">
                <div class="contents">
                <!-- Welcome message, log out btn and show the error/successfully done message after redirecting from insert, update, delete  -->
                    <p class="welcom">Welcome, <?= $_SESSION["username"];?>!</p>
                    <p class="float-right"><a href="./includes/logout.php"><span class="button_color">Log out</span></a></p>

                    <?php
                        //Show error message if already exsisting product had added into the cart.
                        is_error("cart_exist", "qty_empty", null, null);
                        //Show successfull message if successfully item is sent to the database/successfully item qty updated or item deleted in the database.
                        is_successfull("successfull_sent", "update", "delete", null);
                    ?>
                <!--  Product catalog  form       -->
                <div>

                    <h3>Product catalog</h3>

                    <div class="row justify-content-around">
                        <?php
                            //Fetch product information from database
                            $product_array = get_product_info($pdo);
                            //Loop to show product details
                            for($i=0; $i< count($product_array); $i++):
                        ?>
                        <!--  Product cards -->
                        <div class="col-12 col-md-3 card justify-content-start">
                            <img class="card-img-top" src="./images/<?= $product_array[$i]['images']; ?>" alt="<?= $product_array[$i]['product_name'];?>" class="img-fluid"/>
                            <h4><?= $product_array[$i]['product_name']; ?></h4>
                            <p>Cost: <?= $product_array[$i]['cost']; ?>SEK</p>

                        <!-- Input form to choose qty  -->
                            <form action="./includes/add_to_cart.php" method="post">
                                <label for="qty">Quantity:</label>
                                <input type="number"  name="qty" min="0" size="1" value="0" style="width:40px"/>
                                <input type="hidden"  name="hidden_id" value="<?= $product_array[$i]['product_id'];?>">
                                <input type="hidden"  name="hidden_name" value="<?= $product_array[$i]['product_name']; ?>">
                                <input type="hidden"  name="hidden_cost" value="<?= $product_array[$i]['cost'];?>">
                                <input type="submit" value="Add to Cart" name="add"  class="button_color"/>

                            </form>
                        </div>
                        <?php
                            //End of forloop for product cards
                            endfor;
                        ?>

                    </div>
                </div>
                <!-- Separator  -->
                <hr>
                <!-- Shopping cart details  -->
                <div>
                    <h3>Shopping cart</h3>

                    <?php
                        //Fetch shopping cart details from database
                        $cart = get_cart_info($pdo, $_SESSION['user_id']);
                    var_dump( $cart["0"]);

                        //Shows the shopping cart details if cart is NOT empty
                        if(!empty($cart)):
                    ?>
                    <!-- The table shrinks with tablet size or bigger screen -->
                    <div class="table-responsive narrow_table">

                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Cost</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center"></th>
                            </tr>

                            <?php
                                //Loop cart to show shopping cart details
                                foreach($cart as $value):
                            ?>

                            <tr>
                                <td class="align-middle"><?= $value["product_name"]; ?></td>
                                <td class="text-right align-middle"><?= $value["cost"]; ?></td>
                                <td class="text-center">
                                    <!-- Update form with the qty from the data  -->
                                    <form action="./includes/update_item.php" method="post">
                                        <input type="number"  name="qty" min="1" size="1" value="<?= $value["qty"]; ?>" style="width:40px"/>
                                        <input type="hidden"  name="hidden_name" value="<?= $value["product_name"];?>">
                                        <input type="hidden"  name="hidden_id" value="<?= $value["product_id"];?>">
                                        <input type="submit" value="Update" name="update" class="d-inline button_color"/>
                                    </form>

                                </td>

                                <td class="text-center align-middle">
                                    <!-- Delete btn to delete item from the database-->
                                    <a href="./includes/remove_item.php?product_id=<?= $value["product_id"]; ?>" class="button_color">Delete</a>
                                </td>
                            </tr>

                            <?php
                                //End of Loop cart to show shopping cart details
                                endforeach;
                            ?>

                        </table>
                    </div><!-- End of shopping cart table-->


                    <!-- Btn to jump to checkout.php -->
                    <p class="text-right"><a href="./views/checkout.php"><span class="button_color">Check out</span></a></p>

                    <?php
                        //if shopping cart is empty shows the message
                        else:
                    ?>

                    <!-- Shows only the shopping cart is empty -->
                        <p>Your shopping cart is empty.</p>
                        <p class="text-right"><span class="button_emp_color">Check out</span></p>

                    <?PHP
                        //End of if for "if shopping cart is empty"
                        endif;
                    ?>
                </div><!-- Shopping cart div end-->
            </div><!-- End of contents div -->
        </div><!-- End of container div-->
        </main>

        <!-- footer include-->
        <?php include './includes/footer.php'; ?>

        <!-- Optional JavaScript-->
        <?php require './includes/optional_js.php'; ?>
    </body>
</html>