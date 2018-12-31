<?php
//To check if connection is successfully done.
/*if ($pdo) :
echo "<p>Connection successful.</p>";
else*/
    if (isset($error)) :
        echo "<p>$error</p>";
    endif;
?>