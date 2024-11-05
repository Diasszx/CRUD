<?php
require_once "conn.php";

//CREATE
try{
if(isset($_POST['create_usuario'])){
$hashedPassword = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO usuario (nome, email, data_nascimento, senha) VALUES (?,?,?,?)");
$result = $stmt->execute([$_POST['nome'],$_POST['email'],$_POST['data_nascimento'], $hashedPassword]);

}
} catch(PDOException $e){
    echo 'Error' . $e->getMessage();
}



/*

    $nome = mysqli_real_escape_string(
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $data_nascimento = mysqli_real_escape_string($con, trim($_POST['data_nascimento']));
    $senha = isset($_POST['senha']) ? mysqli_real_escape_string($con, trim($_POST['senha'])) : '';

    $stmt = $con->prepare("INSERT INTO usuarios(nome,email,data_nascimento,senha) VALUES ('$nome','$email','$data_nascimento','$senha')");
    $result = $stmt->execute();

   // mysqli_query($con,$sql);*/

