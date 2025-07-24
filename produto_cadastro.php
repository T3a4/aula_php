<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Produto</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Cadastro de Produtos</h1>

  <form method="POST" action="">
    <input type="text" name="nome" placeholder="Nome do Produto" required>
    <input type="number" step="0.01" name="preco" placeholder="Preço" required>
    <button type="submit">Cadastrar Produto</button>
  </form>

<?php
require_once 'conexao.php';
require_once 'produto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = (new BancoDeDados())->obterConexao();
    $produto = new Produto($db);

    $produto->nome = trim($_POST['nome'] ?? '');
    $produto->preco = $_POST['preco'] ?? null;

    if ($produto->nome && is_numeric($produto->preco)) {
        if ($produto->criar()) {
            echo "<p class='success'>Produto cadastrado com sucesso!</p>";
        } else {
            echo "<p class='error'>Erro ao cadastrar produto.</p>";
        }
    } else {
        echo "<p class='error'>Preencha todos os campos corretamente.</p>";
    }
}
?>
</body>
</html>

