<?php
$acao = "recuperar";
require "tarefa_controller.php";

//apenas para testar
// echo "<pre>";
// print_r($tarefas);
// echo "</pre>";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo - Todas Tarefas</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/69e5255fc0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="img/list.png" type="image/x-icon">
    <script>
        function marcarRealizada(id) {
            location.href = "todas_tarefas.php?acao=marcarRealizada&id=" + id;
        }

        function removerTarefa(id) {
            location.href = "todas_tarefas.php?acao=removerTarefa&id=" + id;
        }

        function editarTarefa(id, txt_tarefa) {
            //criação do formulário de edição:
            let form = document.createElement('form');
            form.action = 'todas_tarefas.php?pagina=todas_tarefas&acao=atualizarTarefa';
            form.method = 'post';
            form.className = 'row';

            //criação de um "input" para o usuário digitar atualizar a tarefa:
            let inputTarefa = document.createElement('input');
            inputTarefa.name = 'tarefa';
            inputTarefa.type = 'text';
            inputTarefa.value = txt_tarefa;
            inputTarefa.className = 'form-control col-sm-4';
            inputTarefa.required = true;

            //criação de um campo oculto a ser enviado no post do form:
            let inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'id';
            inputId.value = id;

            //criação do botão para salvar:
            let button = document.createElement('button');
            button.type = 'submit';
            button.innerHTML = 'Atualizar';
            button.className = 'btn btn-info col-sm-2'

            //inclusão dos componentes no form:
            form.appendChild(inputTarefa);
            form.appendChild(inputId);
            form.appendChild(button);

            let tarefa = document.getElementById('tarefa_'+id);
            tarefa.innerHTML = '';

            tarefa.insertBefore(form, tarefa[0]);
        }

    </script>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand text-white" href="#">
                <img src="img/list.png" width="30" height="30" alt="logo">
                SuperTodo
            </a>
        </div>
    </nav>

    <div class="container app">
        <div class="row">
            <div class="col-sm-3 menu">
                <ul>
                    <li class="list-group-item"><a href="index.php">Tarefas Pendentes</a></li>
                    <li class="list-group-item"><a href="nova_tarefa.php">Nova Tarefa</a></li>
                    <li class="list-group-item active"><a href="todas_tarefas.php">Todas Tarefas</a></li>
                </ul>
            </div>

            <div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />

								<?php foreach($tarefas as $indice => $tarefa) { ?>
									<div class="row mb-3 d-flex align-items-center">
										<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>">
											<?= $tarefa->tarefa ?> (<?= $tarefa->status ?>)
										</div>
                                        <div class="col-sm-3 d-flex justify-content-between">
                                            <i class="fa-regular fa-trash-can fa-lg text-black" onclick="removerTarefa(<?=$tarefa->id?>)"></i>
                                        <?php if ($tarefa->status == 'pendente') { ?>
                                            <i class="fa-regular fa-pen-to-square fa-lg text-black" onclick="editarTarefa(<?=$tarefa->id?>, '<?=$tarefa->tarefa?>')"></i>
                                            <i class="fa-regular fa-circle-check fa-lg text-black"onclick="marcarRealizada(<?=$tarefa->id?>)"></i>
                                        <?php } ?>
                                        </div>
									</div>

								<?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>