<?php
session_start(); // começa uma sessão

# conecta com o BD
$server = 'localhost';
$user = 'root';
$psw = '';
$dbase = 'loja';
$db = mysqli_connect($server, $user, $psw, $dbase);

# inicializa variáveis
$nome = "";
$descricao = "";
$id = 0;
$update = false;

# adiciona produto -> CREATE
if (isset($_POST['adiciona'])) {
  
  # Validando os campos de entrada
  $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
  $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);

  # se $nome e $descricao estiverem vazios
  if ( ($nome) && ($descricao) ) {

    # recebe os valores do formulario e faz o INSERT no BD
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    mysqli_query($db, "INSERT INTO produtos (nome, descricao) VALUES ('$nome', '$descricao')");

    # grava mensagem na sessão
    $_SESSION['message'] = "Produto adicionado!";
    header('location: produtos.php');

  } else {
    
    # grava mensagem na sessão
    $_SESSION['error'] = "Você não preencheu todos os campos!";
    header('location: produtos.php');

  }

}

# altera produto -> UPDATE
if (isset($_POST['altera'])) {

  # Validando os campos de entrada
  $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
  $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);

  # se $nome e $descricao estiverem vazios
  if ( ($nome) && ($descricao) ) {

    # recebe os valores do formulario e faz o UPDATE no BD
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    mysqli_query($db, "UPDATE produtos SET nome ='$nome', descricao = '$descricao' WHERE id = $id");

    # grava mensagem na sessão
    $_SESSION['message'] = "Produto alterado!";
    header('location: produtos.php');

  } else {

    # grava mensagem na sessão
    $_SESSION['error'] = "Você não preencheu todos os campos!";
    header('location: produtos.php');

  }

}

# remove produto -> DELETE
if (isset($_GET['del'])) {

  # recebe o valor pelo GET e faz o DELETE no BD
  $id = $_GET['del'];
  mysqli_query($db, "DELETE FROM produtos WHERE id=$id");

  # grava mensagem na sessão
  $_SESSION['message'] = "Produto removido!";
  header('location: produtos.php');

}