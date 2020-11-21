<?php
    session_start();
    if(isset($_SESSION['user']))
    {
        header("location: chat.php");
    }
    else
    {
        header("location: login.php");
    }
?>