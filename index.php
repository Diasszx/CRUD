<?php
session_start(); 
require_once "conn.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
  <body>
    <?php include('navbar.php');?>
    <div class="container mt-4">
        <?php include('mensagem.php')?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Usuários
                        <a href="usuario-create.php" class="btn btn-primary float-end">Adicionar usuário</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Data Nascimento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $stmt = $conn->query("SELECT * FROM usuario");
                                    
                                    if($stmt->rowCount() > 0 ){
                                        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach($usuarios as $usuario){
                                ?>
                                <tr>
                                    <td><?=$usuario['id']?></td>
                                    <td><?=$usuario['nome']?></td>
                                    <td><?=$usuario['email']?></td>
                                    <td><?=date('d/m/Y',strtotime($usuario['data_nascimento']))?></td>
                                    <td>
                                        <a href="usuario-view.php?id=<?=$usuario['id']?>" class="btn btn-secondary btn-sm"><span class="bi-eye-fill"></span>&nbsp;Visualizar</a> 
                                        <a href="usuario-edit.php?id=<?=$usuario['id']?>" class="btn btn-success btn-sm"><span class="bi-pencil-fill"></span>&nbsp;Editar</a> 
                                        <form action="acoes.php" method="POST" class="d-inline" onsubmit="return confirmDelete();">
                                            <button type="submit" name="delete_usuario" value="<?=$usuario['id']?>" class="btn btn-danger btn-sm"><span class="bi-trash-fill"></span>&nbsp;Excluir</button>
                                        </form> 
                                        <script>
                                            function confirmDelete(){
                                                return confirm("Você tem certeza que deseja excluir este usuário?")
                                            }
                                        </script>
                                        </td>
                                        </tr>
                                        <?php
                                        }
                                    }else {
                                        echo '<h5>Nenhum usuário encontrado</h5>';
                                    }
                                    ?>
                                        <td>
                                    </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>