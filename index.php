<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Cadastro de Pessoas</h1>

  <form method="POST" action="">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="number" name="idade" placeholder="Idade" required>
    <button type="submit">Cadastrar</button>
  </form>

  <?php
  require_once 'conexao.php';
  require_once 'pessoa.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $db = (new BancoDeDados())->obterConexao();
      $pessoa = new Pessoa($db);

      $pessoa->nome = $_POST['nome'] ?? null;
      $pessoa->idade = $_POST['idade'] ?? null;

      if ($pessoa->nome && $pessoa->idade) {
          if ($pessoa->criar()) {
              echo "<p class='success'>Cadastro realizado com sucesso!</p>";
          } else {
              echo "<p class='error'>Erro ao cadastrar.</p>";
          }
      } else {
          echo "<p class='error'>Preencha todos os campos.</p>";
      }
  }
  ?>
</body>
</html>
