<?php
require_once 'conexao.php';
require_once 'pessoa.php';

$db = (new BancoDeDados())->obterConexao();
$pessoa = new Pessoa($db);

$id = $_GET['id'] ?? null;
$mensagem = '';

if ($id && is_numeric($id)) {
    $pessoa->id = $id;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $novaIdade = $_POST['idade'] ?? null;

        if (is_numeric($novaIdade)) {
            if ($pessoa->atualizarIdade($novaIdade)) {
                $mensagem = "<p class='success'>Idade atualizada com sucesso!</p>";
            } else {
                $mensagem = "<p class='error'>Erro ao atualizar idade.</p>";
            }
        } else {
            $mensagem = "<p class='error'>Idade inválida.</p>";
        }
    }
} else {
    $mensagem = "<p class='error'>ID inválido ou não informado.</p>";
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
  <h1>Editar Idade da Pessoa ID <?= htmlspecialchars($id ?? 'Desconhecido') ?></h1>

  <?= $mensagem ?>

  <?php if ($id && is_numeric($id)): ?>
    <form method="POST">
      <label for="idade">Nova Idade:</label>
      <input type="number" name="idade" id="idade" required>
      <button type="submit">Atualizar</button>
    </form>
  <?php endif; ?>

  <div style="text-align: center; margin-top:1rem;">
    <a href="listar.php" class="btn">Voltar</a>
  </div>
</body>
</html>

