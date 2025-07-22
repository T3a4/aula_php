<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Produto</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Cadastro de Produtos</h1>

  <form method="POST" action="produto_cadastro.php">
    <input type="text" name="nome" placeholder="Nome do Produto" required>
    <input type="number" step="0.01" name="preco" placeholder="Preço" required>
    <button type="submit">Cadastrar Produto</button>
  </form>

  <?php
  require_once 'conexao.php';
  require_once 'produto.php';

  $db = (new BancoDeDados())->obterConexao();
  $produto = new Produto($db);

  $produto->nome = $_POST['nome'] ?? null;
  $produto->preco = $_POST['preco'] ?? null;

  if ($produto->nome && $produto->preco) {
    if ($produto->criar()) {
      echo "<p class='success'>Produto cadastrado com sucesso!</p>";
    } else {
      echo "<p class='error'>Erro ao cadastrar produto.</p>";
    }
  }
  ?>
</body>
</html>