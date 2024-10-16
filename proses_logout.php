<?php
    setcookie("usename", "", time() - 3600, "/");
    header("Location: index.php");
    
?>
