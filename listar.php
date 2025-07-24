<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista de Pessoas e Produtos</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Pessoas Cadastradas</h1>

  <?php
  require_once 'conexao.php';
  require_once 'pessoa.php';
  require_once 'produto.php';

  $db = (new BancoDeDados())->obterConexao();

  // --- Listar Pessoas ---
  $pessoa = new Pessoa($db);
  $stmtPessoas = $pessoa->ler();
  $numPessoas = $stmtPessoas->rowCount();

  if ($numPessoas > 0) {
    while ($linha = $stmtPessoas->fetch(PDO::FETCH_ASSOC)) {
      echo "<div class='card'>";
      echo "<p><strong>ID:</strong> " . htmlspecialchars($linha['id']) . "</p>";
      echo "<p><strong>Nome:</strong> " . htmlspecialchars($linha['nome']) . "</p>";
      echo "<p><strong>Idade:</strong> " . htmlspecialchars($linha['idade']) . "</p>";
      echo "<a href='editar.php?id=" . urlencode($linha['id']) . "' class='btn'>Editar Idade</a>";
      echo "</div>";
    }
  } else {
    echo "<p class='error'>Nenhuma pessoa encontrada.</p>";
  }

  // --- Listar Produtos ---
  echo "<h1>Produtos Cadastrados</h1>";

  $produto = new Produto($db);
  $stmtProdutos = $produto->ler();
  $numProdutos = $stmtProdutos->rowCount();

  if ($numProdutos > 0) {
    while ($linha = $stmtProdutos->fetch(PDO::FETCH_ASSOC)) {
      echo "<div class='card'>";
      echo "<p><strong>ID:</strong> " . htmlspecialchars($linha['id']) . "</p>";
      echo "<p><strong>Nome:</strong> " . htmlspecialchars($linha['nome']) . "</p>";
      echo "<p><strong>Preço:</strong> R$ " . number_format($linha['preco'], 2, ',', '.') . "</p>";
      echo "</div>";
    }
  } else {
    echo "<p class='error'>Nenhum produto encontrado.</p>";
  }
  ?>
</body>
</html>



