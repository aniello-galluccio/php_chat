<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- myImport -->
    <link rel="stylesheet" href="css/chat.css">
    <script src="js/chat.js"></script>
</head>
<body>
    <div class="top">
        <div class="dropdown" id="all_users">
            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Scegli con chi vuoi chattare
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <?php
                    session_start();
                    require_once('./db/conn.php');

                    if(!isset($_SESSION['user']))
                    {
                        header("location: index.php");
                    }

                    $userArr = $conn->getReference('utenti')->getValue();

                    foreach($userArr as $val)
                    {
                        $friendId = $val['user'];
                        $myId = $_SESSION['user'];

                        if($friendId != $myId)
                        {
                            echo '<a class="dropdown-item" href="chat.php?user='. $friendId .'&myid='. $myId .'">'. $friendId .'</a>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="mex" id="chat">
    </div>

    <div class="send_mex">
        <div class="input-group mb-3 col-md-5" class="send_box">
            <input type="text" class="form-control" placeholder="Scrivi messaggio" aria-label="Recipient's username" aria-describedby="button-addon2" id="input_mex">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="btn_send">Invia</button>
            </div>
        </div>
    </div>
</body>
</html>