<?php

class TarefaService {

    private $conexao;
    private $tarefa;

    public function __construct($conexao, $tarefa) {
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    public function inserir() {
        $query = 'insert into tb_tarefas(tarefa)values(:tarefa)';
        $conexao = $this->conexao->prepare($query);
        $conexao->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $conexao->execute();
    }

    public function recuperar() {
        $query = 'select t.id,s.status,tarefa from tb_tarefas as t left join tb_status as s on (t.id_status = s.id)';
        $conexao = $this->conexao->prepare($query);
        $conexao->execute();
        return $conexao->fetchAll(PDO::FETCH_OBJ);
    }

    public function atualizar() {
        $query = "update tb_tarefas set tarefa = :tarefa where id = :id";
        $conexao = $this->conexao->prepare($query);
        $conexao->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $conexao->bindValue(':id', $this->tarefa->__get('id'));
        return $conexao->execute();
    }

    public function remover() {
        $query = 'DELETE FROM tb_tarefas WHERE id = :id ';
        $conexao = $this->conexao->prepare($query);
        $conexao->bindValue(':id', $this->tarefa->__get('id'));
        $conexao->execute();
    }

    public function marcar() {
        $query = "update tb_tarefas set id_status = ? where id = ?";
        $conexao = $this->conexao->prepare($query);
        $conexao->bindValue(1, $this->tarefa->__get('id_status'));
        $conexao->bindValue(2, $this->tarefa->__get('id'));
        return $conexao->execute();
    }

}

?>
