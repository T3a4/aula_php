<?php
require_once 'conexao.php';
require_once 'pessoa.php';

$db = (new BancoDeDados())->obterConexao();
$pessoa = new Pessoa($db);

// Verifica se ID foi enviado
$id = $_GET['id'] ?? null;

if (!$id) {
  echo "<p class='error'>ID inválido.</p>";
  exit;
}

// Atribui o ID à instância
$pessoa->id = $id;

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $novaIdade = $_POST['idade'] ?? null;

  if ($novaIdade !== null && is_numeric($novaIdade)) {
    if ($pessoa->atualizarIdade($novaIdade)) {
      echo "<p class='success'>Idade atualizada com sucesso!</p>";
    } else {
      echo "<p class='error'>Erro ao atualizar idade.</p>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Idade</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Editar Idade da Pessoa ID <?= htmlspecialchars($id) ?></h1>

  <form method="POST">
    <label for="idade">Nova Idade:</label>
    <input type="number" name="idade" id="idade" required>
    <button type="submit">Atualizar</button>
  </form>

  <div style="text-align: center; margin-top:1rem;">
    <a href="listar.php" class="btn">Voltar</a>
  </div>
</body>
</html>