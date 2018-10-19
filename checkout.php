<?php
session_start();
?>

<!-- Shopping cart actions (add sessions/unset sessions etc) include-->
<?php    include './partials/sc_actions.php'; ?>


<!doctype html>
<html lang="en">
    <head>
<!-- head require-->
<?php    require './partials/head.php'; ?>   

        <title>Checkout | Bonsai</title>

    </head>



    <body>
<!-- header include-->
<?php    include './partials/header.php'; ?> 
        
        <main id="checkout"> 
            <div class="container">
                <div class="contents">

<!--  Shopping cart title and logout, back btns        -->
    
                    <h3>Shopping Cart</h3>
                    <p class="float-right"><a href="./partials/logout.php"><span class="button_color">Log out</span></a></p>
                    <p class="float-right"><a href="index.php#product_catalog"><span class="button_color">Back to product catalog</span></a></p>

<!--  Shopping cart         -->
                    <div class="table-responsive">
                        <?php //Show this message if qty of the shopping cart is more than 0 or total amount of qty is more than 0.
                        if(!isset($_SESSION['qty']) || array_sum($_SESSION['qty'])===0):
                        ?>
                        <p>Shopping cart is empty.</p>
                        <?php //Show shopping cart contents only qty is more than 0 or total amount of qty is more than 0.
                        else:
                        ?>
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center">Item Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Today's price*</th>
                                <th class="text-center">Total</th>
                            </tr>
                            <?php
                            //loop to show shopping cart contents 
                            foreach($_SESSION['qty'] as $index =>$amount):
                            //show only item(s) which have qty more than 0.
                            if($amount > 0):

                            //Price caluculation
                            $today_cost = $_SESSION['cost'][$index];
                            //If it is Wednesday 10% addition for every products
                            if(date('w')==3):
                            $today_cost = floor($today_cost*1.1);
                            endif;
                            //If it is Friday -20 deduction from every products over 200SEK
                            if(date('w')==5 && $today_cost>200):
                            $today_cost = $today_cost-20;
                            endif;

                            $product_total = $today_cost * $_SESSION['qty'][$index]; //total amount for each product
                            $total += $product_total; //Shorthand for $total = $total + $product_total

                            ?>

                            <!--shopping cart details-->
                            <tr>
                                <td><?= $_SESSION['name'][$index]; ?></td>
                                <td class="text-right"><?= $amount; ?></td>
                                <td class="text-right"><?= $_SESSION['cost'][$index]; ?></td>
                                <td class="text-right"><?= $today_cost; ?></td>
                                <td class="text-right"><?= $product_total; ?></td>
                            </tr>

                            <?php //End of the loop for the shopping cart content
                            endif;
                            endforeach;
                            ?>

                            <!--Discount and total amount-->
                           <?php //Price adjustment for Monday
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
                            *Fridays:20SEK discount for every product over 200SEK.</p>


                       <!--  The btn to empty shopping cart      -->
                        <div>    
                        <form method="post">
                            <input class="btn button_color" value="Empty Order" name="empty" id="empty" type="submit">
                        </form>
                        </div>
                        
                        <?php //The end of if to show shopping cart content
                        endif;
                        ?>
                    </div>

                </div>

            </div>

        </main>


<!-- footer include-->
<?php    include './partials/footer.php'; ?>

<!-- Optional JavaScript-->
<?php    require './partials/optional_js.php'; ?>

    </body>
</html>