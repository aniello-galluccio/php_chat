<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- myImport -->
    <link rel="stylesheet" href="css/login.css">
    <script src="js/login.js"></script>

</head>
<body>
    <?php
        require_once('./db/conn.php');
        require_once('modelli/Utente.php');
        if(!empty($_POST['user']) && !empty($_POST['pass']))
        {
            $user = $_POST['user'];
            $pass = $_POST['pass'];

            $utente = new Utente($conn);
            if($utente->insert($user, $pass))
            {
                session_start();
                $_SESSION['user'] = $user;
                header("location: index.php");
            }
        }
    ?>
    <form class="form" method="POST" action="signin.php?log=1">
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errore">
            <strong>Errore!</strong> Username già esistente o password mancante.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter username" name="user">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass">
        </div>
        <button type="submit" class="btn btn-primary">Registrati</button>
        <a href="login.php"><button type="button" class="btn btn-light">Login</button></a>
    </form>
</body>
</html>