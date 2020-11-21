<?php
    require_once('./db/conn.php');

    require_once('./modelli/Messaggio.php');

    $userId = $_POST['myid'];
    $friendId = $_POST['friendid'];
    $json = [];

    $mex = new Messaggio($conn);
    
    $arr = $mex->getMexList();

    foreach($arr as $val)
    {
        if(isset($val['mittente']))
        {
            if(($val['mittente'] == $userId && $val['destinatario'] == $friendId) || ($val['destinatario'] == $userId && $val['mittente'] == $friendId))
            {
                if($val['destinatario'] == $userId)
                {
                    $mex->setLetto($val['id']);
                    $val['is_letto'] = true;
                }
                array_push($json, $val);
            }
        }
    }

    echo json_encode($json);
?>