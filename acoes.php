<?php
session_start();
require_once "conn.php";

if(isset($_POST['create_usuario'])){
    $nome = mysqli_real_escape_string($con, trim($_POST['nome']));
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $data_nascimento = mysqli_real_escape_string($con, trim($_POST['data_nascimento']));
    $senha = isset($_POST['senha']) ? mysqli_real_escape_string($con, trim($_POST['senha'])) : '';

    $stmt = $con->prepare("INSERT INTO usuarios(nome,email,data_nascimento,senha) VALUES ('$nome','$email','$data_nascimento','$senha')");
    $result = $stmt->execute();

   // mysqli_query($con,$sql);
}
