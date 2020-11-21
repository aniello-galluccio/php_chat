<?php
    error_reporting(E_ALL & ~E_NOTICE);
    require_once('./db/conn.php');

    require_once('./modelli/Messaggio.php');

    $mex = new Messaggio($conn);
    
    echo $mex->insert($_POST['mitt'], $_POST['dest'], $_POST['text']);
?>