<?php

require '../tarefa_model.php';
require '../tarefa_service.php';
require '../conexao.php';

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);
    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();

    header('location:nova_tarefa.php?inclusao=1');
} elseif ($acao == 'recuperar') {
    $tarefa = new Tarefa();
    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->recuperar();
} elseif (isset($_GET['acao']) && $_GET['acao'] == 'atualizar') {
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_POST['id']);
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->atualizar();
    echo '
        <script>
           window.location.href = "todas_tarefas.php";
        </script>';
} elseif (isset($_GET['acao']) && $_GET['acao'] == 'remover') {
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->remover();
    if(isset($_GET['inicio'])&& $_GET['inicio']=1){
        header("location:index.php");
    }else{
        header("location:todas_tarefas.php");}
} elseif (isset($_GET['acao']) && $_GET['acao'] == 'marcar') {
    $tarefa = new Tarefa;
    $tarefa->__set('id', $_GET['id']);
    $tarefa->__set('id_status', 2);
    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->marcar();
    if(isset($_GET['inicio'])&& $_GET['inicio']=1){
        header("location:index.php");
    }else{
        header("location:todas_tarefas.php");}
}
?>
