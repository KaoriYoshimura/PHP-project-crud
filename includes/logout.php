<?php
//Initialize the session.
session_start();

//Unset all of the session variables.
$_SESSION = array();

//Delete session cookie
//$params is getting the current params in order to make sure the same params are used for removing it.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
              $params["path"], $params["domain"],
              $params["secure"], $params["httponly"]
             );
}
//Destroy the session.
session_destroy();

//Go back to the index.php
header('Location: ../views/login.php'); 

?>