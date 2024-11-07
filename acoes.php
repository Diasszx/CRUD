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

// UPDATE
try{

    if(isset($_POST['update_usuario'])){
        $usuario_id = $_POST['id'];
        //$hashedPassword = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $fields = ['nome' => $_POST['nome'], 'email' => $_POST['email'], 'data_nascimento' => $_POST['data_nascimento']];
        $query = "UPDATE usuario SET nome = :nome, email = :email, data_nascimento = :data_nascimento";
        
        //$hashedPassword = '';
        if (!empty($_POST['senha'])) {
            $fields['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $query .= ", senha = :senha";
        }
        
        $query .= " WHERE id = :id";
        $fields['id'] = $usuario_id;
        
        // $stmt = $conn->prepare("UPDATE usuario SET nome = ?, email = ?, data_nascimento = ?, senha = ? WHERE id = ?");
        // $result = $stmt->execute([$_POST['nome'],$_POST['email'],$_POST['data_nascimento'], $hashedPassword ?: null, $usuario_id]);
        $stmt = $conn->prepare($query);
        $result = $stmt->execute($fields);
    
        if($result){
            $_SESSION['mensagem'] = "Usuário atualizado com sucesso!";
            header('Location: index.php');
            exit;
        }else{
            $_SESSION['mensagem'] = "Erro ao atulizar usuário!";
            header('Location: index.php');
            exit;
        }
    }
    } catch(PDOException $e){
        echo 'Error' . $e->getMessage();
    } 

    if (isset($_POST['delete_usuario'])) {
        $usuario_id = $_POST['delete_usuario'];
    
        // Prepara e executa o comando DELETE usando PDO
        $stmt = $conn->prepare("DELETE FROM usuario WHERE id=:id");
        $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Verifica se houve linhas afetadas
        if ($stmt->rowCount() > 0) {
            $_SESSION['message'] = 'Usuário deletado com sucesso';
        } else {
            $_SESSION['message'] = 'Usuário não foi deletado';
        }
    
        // Redireciona para index.php após o processo
        header('Location: index.php');
        exit;
    }
    
    //$result = $stmt->execute([$_POST['nome'],$_POST['email'],$_POST['data_nascimento'], $hashedPassword])
