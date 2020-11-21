<?php
    require_once('./vendor/autoload.php');
    use \Kreait\Firebase\Factory;

    $factory = (new Factory)->withServiceAccount('./db/livechat-8dcb3-d3e8a31043e7.json');

    $conn = $factory->createDatabase();
?>