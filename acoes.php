<?php
session_start(); 
require_once "conn.php";

//CREATE
try{
if(isset($_POST['create_usuario'])){
$hashedPassword = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO usuario (nome, email, data_nascimento, senha) VALUES (?,?,?,?)");
$result = $stmt->execute([$_POST['nome'],$_POST['email'],$_POST['data_nascimento'], $hashedPassword]);

    if($stmt->rowCount() > 0 ){
        $_SESSION['mensagem'] = "Usuário criado com sucesso!";
        header('Location: index.php');
        exit;
    }else{
        $_SESSION['mensagem'] = "Usuário não foi criado!";
        header('Location: index.php');
        exit;
    }
}
} catch(PDOException $e){
    echo 'Error' . $e->getMessage();
}



