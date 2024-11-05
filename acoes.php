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

