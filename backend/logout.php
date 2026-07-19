<?php 
    session_start();
    session_destroy();
    header('Location: ../public/auth/index.php');
    

?>