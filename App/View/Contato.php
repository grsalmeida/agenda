<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Guilherme Almeida</title>
        <link href="<?= self::asset("css/list.css") ?>" rel="stylesheet" type="text/css"/>
        <script src="<?= self::asset("js/jquery-2.2.4.min.js") ?>" type="text/javascript"></script>
        <script src="<?= self::asset("js/list.js") ?>" type="text/javascript"></script>
        <script src="<?= self::asset("js/modal.js") ?>" type="text/javascript"></script>
        <link href="<?= self::asset("componnets/font-awesome/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css"/> 
        <link href="<?= self::asset("css/modal.css") ?>" rel="stylesheet" type="text/css"/>
        <!--<script src="http://digitalbush.com/wp-content/uploads/2014/10/jquery.maskedinput.js"></script>-->

    </head>
    <body >
        <?php 
        session_start();
        if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
            header('Location: /');
            exit;
        }
        ?>
    <div class="title">
        <h2>Agenda Telefonica</h2>
    </div>
        <div class="content-div">
            <div>
                <div class="content-div-add" id="adicionar" title="Cadastrar novo contato"> 
                    <a href="/cadastro"><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i></a>
                </div>
                <div class="content-div-add" id="dash" title="Dashboard"> 
                    <i class="fa fa-pie-chart" aria-hidden="true"></i>
  
                </div>
                <table class="my-table">
                    <thead>
                        <tr >
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? var_dump($contato); exit;?>
                        <?php if (isset($dados) && count($dados)){ ?> 
                            <?php foreach ($dados as $contato){ ?>
                                <tr id="<?php echo $contato['id'] ?>" data-id="<?php echo $contato['id'] ?>">
                                    <td><?php echo $contato['str_nome'] ?></td>
                                    <td><?php echo $contato['str_telefone'] ?></td>
                                    <td><?php echo $contato['str_celular'] ?></td>
                                    <td><?php echo $contato['str_email'] ?></td>
                                    <td class="content-options">
                                        <div class="content-div-edit  editar" title="Editar" data-id="<?php echo $contato['id'] ?>">
                                            <i class="fa fa-pencil fa-lg"></i> 
                                        </div>
                                        <div class="content-div-remove deletar" title="Remover" data-id="<?php echo $contato['id'] ?>">
                                            <i class="fa fa-remove fa-lg"></i> 
                                        </div>
                                    </td>
                                </tr>
                            <?php }?> 
                        <?php }else{
                            echo "<tr id='td-vazio' class='vazio'>";
                                echo "<td colspan='5'>";
                                    echo "<h3> Nenhum contato cadastrado</h3>";
                                echo "</td>";
                            echo "</tr>";        
                            } ?> 
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal baseado no exemplo da w3scholl -->
        <div class="modal" id="divForm">
            <div class="modal-content">
                <span class="close">&times;</span>
                <br>
                <div id="form">
                    <input type="hidden" id="id" name="id">
                    <div>
                        <label for="nome">Nome</label>
                        <br>
                        <input type="text" id="str_nome" name="str_nome">
                    </div>
                    <br>
                    <div>
                        <label for="sobrenome">Telefone</label>
                        <br>
                        <input type="text" id="str_telefone" name="str_telefone">
                    </div>
                    <br>
                    <div>
                        <label for="endereco">Celular</label>
                        <br>
                        <input type="text" id="str_celular" name="str_celular">
                    </div>
                    <br>
                    <div>
                        <label for="endereco">Email</label>
                        <br>
                        <input type="text" id="str_email" name="str_email">
                    </div>
                    <br>
                    <div class="divButton">
                        <button class="cadastrar" id="cadastar">Cadastrar</button>
                        <button class="cancelar" id="cancelar">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="deletar" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <br>
                <div style="text-align: center;">
                    Você tem certeza que deseja deletar este contato?
                </div>
                <br><br>
                <input type="hidden" id="idDeletar" name="id">
                <div class="divButton">
                    <button id="cancelar">NÃO</button>
                    <button class="cadastrar" id="sim" >SIM</button>
                </div>
            </div>
        </div>
    </body>
</html>

