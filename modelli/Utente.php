<?php
    declare(strict_types=1);
    require_once('./classi/Utils.php');

    class Utente {
        private $conn;
        private $documentName = 'utenti';

        public function __construct($conn)
        {
            $this->conn = $conn->getReference($this->documentName);
        }

        public function insert(string $username, string $password): bool
        {
            if(Utils::isVoidString($username) || Utils::isVoidString($password))
                return false;

            if($this->exist($username))
                return false;

            $this->conn->update([
                strtolower($username) => [
                    'user' => strtolower($username),
                    'pass' => password_hash($password, PASSWORD_DEFAULT),
                ],
            ]);

            return true;
        }

        public function exist(string $username) : bool
        {
            return $this->conn->getChild($username)->getSnapshot()->exists();
        }

        public function checkPsw(string $username, string $password) : bool
        {
            if(!$this->exist($username))
                return false;

            $user = strtolower($username);

            $hash = $this->conn->getChild($user)->getValue()['pass'];
            return password_verify($password, $hash);
        }
    }
?>