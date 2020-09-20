<?php
$acao = 'recuperar';
require 'tarefa_controle.php';
// print_r($tarefas);
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>App Lista Tarefas</title>

        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <script>
            //codido em Js que edita as tarefas, recebendo o Id vindo do banco de dados
            function editar(id, lembrar) {
                //cria um form de edição
                let form = document.createElement('form')
                form.action = 'tarefa_controle.php?acao=atualizar'
                form.method = 'post'
                form.className = 'row'
                form.name = 'atualizar'

                //cria um input para entrada de texto
                let inputTarefa = document.createElement('input')
                inputTarefa.type = 'text'
                inputTarefa.name = 'tarefa'
                inputTarefa.className = 'col-9 form-control'
                inputTarefa.placeholder = lembrar

                //criando variavel que guarda o Id para posteriormente ser submetida ao backend e ao SGBD
                let inputId = document.createElement('input')
                inputId.type = 'hidden'
                inputId.name = 'id'
                inputId.value = id

                //cria um botão para envio do fomulario
                let button = document.createElement('button')
                button.type = 'submit'
                button.className = 'col-3 btn btn-info'
                button.innerHTML = 'Atualizar'
                //incluindo elementos ao formulario
                form.appendChild(inputId)
                form.appendChild(inputTarefa)
                form.appendChild(button)
                console.log(form)
                //seleciona a tarefa a ser editada
                let tarefa = document.getElementById('tarefa_' + id)
                //limpa o texto  da tarefa  para a inclusão do formulario
                tarefa.innerHTML = ''
                tarefa.insertBefore(form, tarefa[0])
            }
        </script>

        <script>
            function remover(id) {
                window.location.href = "todas_tarefas.php?acao=remover&id=" + id + "&inicio=1";

            }
        </script>
        <script>
            function marcar(id) {
                window.location.href = "todas_tarefas.php?acao=marcar&id=" + id + "&inicio=1";
            }
        </script>

    </head>

    <body>
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    Lista de Tarefas
                </a>
            </div>
        </nav>

        <div class="container app">
            <div class="row">
                <div class="col-md-3 menu">
                    <ul class="list-group">
                        <li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
                        <li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
                        <li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
                    </ul>
                </div>

                <div class="col-md-9">
                    <div class="container pagina">
                        <div class="row">
                            <div class="col">
                                <h4>Tarefas pendentes</h4>
                                <hr />

                                <?php
                                foreach ($tarefas as $indice => $tarefa) {
                                    $mensagem = 0;
                                    if ($tarefa->status == 'pendente') {
                                        $mensagem = 1;
                                        ?>
                                        <div class="row mb-3 d-flex align-items-center tarefa" >
                                            <div id="tarefa_<?= $tarefa->id ?>" class="col-sm-9" ><?= $tarefa->tarefa ?> (<?= $tarefa->status ?>)</div>
                                            <div class="col-sm-3 mt-2 d-flex justify-content-between">
                                                <i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $tarefa->id ?>)"></i>

                                                <i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id ?>, '<?= $tarefa->tarefa ?>')"></i>
                                                <i class="fas fa-check-square fa-lg text-success" onclick="marcar(<?= $tarefa->id ?>)"></i>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>