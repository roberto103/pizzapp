<?php 

  require_once 'Sessao.php';
  require_once 'conexao.php';
  require_once 'util.php';

    if (!Sessao::estaLogado()) {
      header('Location: login.php');
    }

    // Listar todos os produtos que estão na tabela pedidos
    $sql = $pdo->prepare('SELECT * FROM pedidos ORDER BY hora ASC');
    $sql->execute();

    $registros = $sql->fetchAll(PDO::FETCH_OBJ);

    // Listar todos os usuários
    $usr = $pdo->prepare('SELECT * FROM usuarios');
    $usr->execute();

    $usuarios = $usr->fetchAll(PDO::FETCH_OBJ);

    // Listar todos os produtos
    $produto = $pdo->prepare('SELECT * FROM produtos ORDER BY prod_nome ASC');
    $produto->execute();

    $listarProdutos = $produto->fetchAll(PDO::FETCH_OBJ);

    // Listar todas as promoção
    $promocao = $pdo->prepare('SELECT * FROM promocoes ORDER BY id ASC');
    $promocao->execute();

    $listarPromocao = $promocao->fetchAll(PDO::FETCH_OBJ);

    // Listar todos os comentários
    $comment = $pdo->prepare('SELECT * FROM comentarios ORDER BY data ASC');
    $comment->execute();

    $comentarios = $comment->fetchAll(PDO::FETCH_OBJ);

    // Listar todas as pizzas
    $pizza = $pdo->prepare('SELECT * FROM pizzas ORDER BY id ASC');
    $pizza->execute();

    $pizza = $pizza->fetchAll(PDO::FETCH_OBJ);

 ?>