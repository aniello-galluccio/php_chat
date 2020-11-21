<?php
    declare(strict_types=1);
    require_once('./classi/Utils.php');
    require_once('Utente.php');

    class Messaggio {
        private $conn;
        private $documentName = 'messaggi';
        private $utenteRef;

        public function __construct($conn)
        {
            $this->conn = $conn->getReference($this->documentName);
            $this->utenteRef = new Utente($conn);
        }

        public function insert(string $mitt, string $dest, string $testo) : int
        {
            if(Utils::isVoidString($mitt) || Utils::isVoidString($dest) || Utils::isVoidString($testo))
                return -1;

            $mittente = strtolower($mitt);
            $destinatario = strtolower($dest);

            if($this->utenteRef->exist($mittente) == false || $this->utenteRef->exist($destinatario) == false)
                return -1;

            $id = $this->newIdMex();
            $this->conn->update([
                $id => [
                    'id' => $id,
                    'mittente' => $mittente,
                    'destinatario' => $destinatario,
                    'testo' => $testo,
                    'is_letto' => false,
                ],
            ]);

            return intval($id);
        }

        public function delete(string $id)
        {
            $this->conn->getChild($id)->remove();
        }

        private function newIdMex(): string
        {
            if($this->conn->getSnapshot()->numChildren() == 0)
                return '1';
            
            $lastId = end($this->conn->getValue())['id'];
            return strval(intval($lastId) + 1);
        }

        public function getMexList() : array
        {
            return $this->conn->getValue();
        }

        public function setLetto(string $id)
        {
            $this->conn->getChild($id)->update(['is_letto' => true,]);
        }
    }
?>