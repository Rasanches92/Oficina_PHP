<?php

require_once("../../conexao.php"); 

$nome = $_POST['nome_mec'];
$telefone = $_POST['telefone_mec'];
$cpf = $_POST['cpf_mec'];
$email = $_POST['email_mec'];
$endereco = $_POST['endereco_mec'];

$antigo = $_POST['antigo'];
$id = $_POST['txtid2'];
$antigo2 = $_POST['antigo2'];

if($nome == ""){
    echo 'O nome é obrigatório!';
    exit();
}

if($email == ""){
    echo 'O email é obrigatório!';
    exit();
}

if($cpf == ""){
    echo 'O CPF é obrigatório!';
    exit();
}

//VERIFICAR SE O REGISTRO JÁ EXISTE NO BANCO
if($antigo != $cpf){
    $query = $pdo->query("SELECT * FROM mecanicos where cpf = '$cpf'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){
        echo 'O CPF já está Cadastrado';
        exit();
    }
}

//VERIFICAR SE O REGISTRO COM MESMO E-MAIL JÁ EXISTE NO BANCO
if($antigo2 != $email){
    $query = $pdo->query("SELECT * FROM mecanicos where email = '$email'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){
        echo 'O e-mail já está Cadastrado';
        exit();
    }
}


if($id == ""){
    $res = $pdo->prepare("INSERT INTO mecanicos SET nome = :nome, cpf = :cpf, email = :email, endereco = :endereco, telefone = :telefone");

} else {
    $res = $pdo->prepare("UPDATE mecanicos SET nome = :nome, cpf = :cpf, email = :email, endereco = :endereco, telefone = :telefone WHERE id = :id");
    $res->bindValue(":id",$id); 
}

$res->bindValue(":nome",$nome); 
$res->bindValue(":cpf",$cpf); 
$res->bindValue(":email",$email); 
$res->bindValue(":endereco",$endereco); 
$res->bindValue(":telefone",$telefone);
$res->execute();  

echo 'Salvo com Sucesso!';


?>
