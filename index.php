<?php
//Start session
session_start(); 
?>


<!-- login include-->
<?php    include './partials/products.php'; ?>

<!doctype html>
<html lang="en">   
    <head>
    
<!-- head require-->
<?php    require './partials/head.php'; ?>

        <title>Index | Bonsai</title>

    </head>

    <body>
<!-- header include-->
<?php    include './partials/header.php'; ?>   

        <main id="index"> 

            <div class="container">
                <div class="contents">

<!--  Log in  form       -->
                    <p>To shop our products, please fill in the below information.</p> 
                
                    <form action="./partials/login.php" method="post" id="form_login">
                    <div class="form-group">
                    <label for="username">Name</label>
                    <input type="text" class="form-control" id="name" name="username" placeholder="Enter name">
                    <small class="form-text text-muted">Please enter your first name.</small>
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
                    <small class="form-text warning">Please enter longer than 10 charactors.</small>
                    <label for="tel">Telefon number</label>
                    <input type="text" class="form-control"  id="tel" name="tel" placeholder="Enter telefon Number">
                    <small class="form-text text-muted">Please enter your telefon number.</small>
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                <button type="submit" class="btn button_color">Submit</button>
                </form>                
<!--  Display error message  if log in is unsucceeded
                        If any of input forms are missing redirect to index.php top and show the error message.
                        Otherwise redirect to index.php top  and show the error message.
-->
                        <?php if(isset($_GET["empty_error"])){
                            echo '<span class=\'warning\'>'.($_GET["empty_error"]).'</span>';
                            } elseif(isset($_GET["error"])){
                            echo '<span class=\'warning\'>'.($_GET["error"]).'</span>';
                        }
                        ?>
                </div>
                
<!--  Product catalog & Welcome message & loggin btn when logged in
-->
                        <?php
                        if(isset($_SESSION["username"])):
                        ?>
                        <h3 id="product_catalog">Product catalog</h3>
                        <p class="float-right"><a href="./partials/logout.php"><span class="button_color">Log out</span></a></p>
                        <p class="welcom">Welcome <?= $_SESSION["username"];?>!</p>         

                
<!--  Product catalog  form       -->
                <div class="row justify-content-around">

                    <?php
                    //Loop to show product details
                    for ($i=0; $i< count($products); $i++) :
                    ?>            
                    <div class="col-12 col-md-3 card justify-content-start">
                        <img class="card-img-top" src="images/<?= $products[$i]['images']; ?>" alt="<?= $products[$i]['name'];?>" class="img-fluid"/>
                        <h4><?= $products[$i]['name']; ?></h4>
                        <p>Cost: <?= $products[$i]['costs']; ?>SEK</p>

                    <!-- Input form to choose qty and send it to checkout.php-->
                        <form action="checkout.php" method="post" id="form_product">
                            <label for="qty">Quantity:</label>
                            <input type="number" form="form_product" name="qty[]" min="0" size="1" value="0" style="width:40px"/>
                            <input type="hidden" form="form_product" name="hidden_name[]" value="<?= $products[$i]['name'];?>">
                            <input type="hidden" form="form_product" name="hidden_cost[]" value="<?= $products[$i]['costs'];?>">
                        </form>
                    </div>
                    <?php
                    //End of forloop
                    endfor;
                    ?>

                </div>
                <!-- Submit btn for chosen qty  -->
                <div>
                    <input type="submit" value="Add to Cart" name="add" form="form_product" class="to_checkout button_color"/>
                </div>
                
<!-- close tag for "if"(when log in is succeeded)               -->
                <?php 
                endif;
                ?>
            </div>

        </main>

<!-- footer include-->
<?php    include './partials/footer.php'; ?>

<!-- Optional JavaScript-->
        <?php    require './partials/optional_js.php'; ?>
        
        </body>
</html>