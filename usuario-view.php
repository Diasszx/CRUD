<?php
session_start(); 
require_once "conn.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários - Visualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php include('navbar.php');?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Visualizar Usuário
                <a href="index.php" class="btn btn-danger float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
                <?php
            if(isset($_GET['id'])){
                $usuario_id = $_GET['id'];
                $stmt = $conn->prepare("SELECT * FROM usuario WHERE id=:id");
                $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);
                $stmt->execute();

                if($stmt->rowCount() > 0){
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                   
                ?>
                <div class="mb-3">
                  <label>Nome</label>
                  <p class="form-control">
                        <?=$usuario['nome'];?>
                    </p>
                </div>
                <div class="mb-3"> 
                    <label>Email</label>
                    <p class="form-control">
                        <?=$usuario['email'];?>
                    </p>
                </div>
                <div class="mb-3">
                    <label>Data de Nascimento</label>
                    <p class="form-control">
                        <?=date('d/m/Y', strtotime($usuario['data_nascimento']));?>                      
                    </p>
                </div>
                <?php
                } else {
                    echo "<h5>Usuário não encontrado</5>";
                }
            }
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>