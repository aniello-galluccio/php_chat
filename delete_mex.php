<?php
    require_once('./db/conn.php');

    require_once('./modelli/Messaggio.php');

    $mex = new Messaggio($conn);
    
    $mex->delete($_GET['id']);
?>