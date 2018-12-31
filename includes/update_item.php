<?php
    //To connect with functions, PDO, start session
    require_once ('../includes/initialize.php');

    $query = "
    UPDATE cart
    SET qty = :qty
    WHERE product_id = :product_id
    ";

    $statement = $pdo->prepare($query);

    $statement->execute([
            ":product_id" => $_POST["hidden_id"],
            ":qty" => $_POST["qty"]
        ]);

    //Redirect back to index.php with message
    redirect_to('../index.php?update=Quantity updated successfully!');