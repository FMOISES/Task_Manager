<?php

class Conexao {

    private $host = 'localhost';
    private $banco = 'gestor_tarefa';
    private $user = 'root';
    private $senha = '';

    public function conectar() {
        try {
            $conecta = new PDO("mysql:host=$this->host;dbname=$this->banco", $this->user, $this->senha);
            return $conecta;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
