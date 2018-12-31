<?php
//Connect with PDO
include_once './database_connection.php';


$statement = $pdo->prepare("DELETE FROM cart WHERE product_id = :product_id");
$statement->execute([
    ":product_id" => $_GET["product_id"]
]);

//Redirect to the index.php and show the error message
header('Location: ../index.php?delete=Item deleted successfully!');

?>