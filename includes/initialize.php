<?php
    //Start session
    session_start(); 

    //To retuns the path to the same level as index.
    //Define: assign file paths to PHP constants
    //__FILE__: returns the current path to this file
    // dirname(): returns the path to the parent directry
    define("INCLUDES_PATH", dirname(__FILE__));
    define("VIEWS_PATH", dirname(__FILE__));

    
    require_once(INCLUDES_PATH.'/functions.php');
    require_once(INCLUDES_PATH.'/database_connection.php');

?>