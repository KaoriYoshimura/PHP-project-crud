<?php
//To connect with functions/PDO, start session
require_once ('../includes/initialize.php');


//If already logged in skip log in again and jump to check out page directly.
if(isset($_SESSION["username"])){
    redirect_to('../views/checkout.php');
}

?>

<!doctype html>
<html lang="en">
    <head>
<!-- head require-->
        <?php    require '../includes/head.php'; ?>
        <!-- egen CSS -->
        <link rel="stylesheet" href="../css/style.css">

        <title>Log in | Bonsai</title>

    </head>

    <body>
<!-- header include-->
<?php    include '../includes/header.php'; ?>
<!-- To check if PDO connection is successfully done     -->
<?php include_once '../includes/check_pdo.php'; ?>

        <main id="login">

            <div class="container">
                <div class="contents">

                    <p>To shop our products, please register and log in.</p>
<!--  Register form  -->
                    <h2>Register</h2>

                    <p>if you are not registered, please register first.</p>

                    <form action="../includes/register_admin.php" method="post" id="form_register">
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" class="form-control" id="name" name="username" placeholder="Enter name">
                            <small class="form-text text-muted">Please enter User Name.</small>
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address">
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                            <small class="form-text text-muted">Password must be longer than 10 charactors.</small>
                        </div>
                        <button type="submit" class="btn button_color">Register</button>
                    </form>
                    <!--  Display error message  if register is unsucceeded
                    If any of input forms are missing, redirect to the top of this page and show the error message.
                    Otherwise redirect to index.php top.-->
                    <?php
                    is_error("empty_error", "error", "exist_error", null);
                    is_successfull("register", null, null, null);

                    ?>

<!--  Devider       -->

                        <hr>

<!--  Log in  form       -->

                    <h2>Log in</h2>

                    <p>Please log in.</p>
                    <form action="../includes/login_admin.php" method="post" id="form_login">
                        <div class="form-group" id="login">
                            <label for="username">Name</label>
                            <input type="text" class="form-control" id="name" name="username" placeholder="Enter name">
                            <small class="form-text text-muted">Please enter username.</small>
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                            <small class="form-text text-muted">Please enter your password</small>

                        </div>
                        <button type="submit" class="btn button_color">Log in</button>
                    </form>
                    <!--  Display error message  if log in is unsucceeded
                    If any of input forms are missing redirect to index.php top and show the error message.
                    Otherwise redirect to index.php top  and show the error message.
                    -->
                    <?php
                        is_error("log_empty_error", "log_error", "pw_error", null)
                    ?>


                </div>
            </div>

        </main>

<!-- footer include-->
<?php    include '../includes/footer.php'; ?>

<!-- Optional JavaScript-->
        <?php    require '../includes/optional_js.php'; ?>
        </body>
</html>