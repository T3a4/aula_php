<?php
require_once 'conexao.php';
require_once 'pessoa.php';
require_once 'produto.php';

$mensagem = '';
$dados = null;
$id = $_GET['id'] ?? null;

try {
    $db = (new BancoDeDados())->obterConexao();
    $pessoa = new Pessoa($db);

    if ($id && is_numeric($id)) {
        $pessoa->id = $id;

        // Buscar dados da pessoa
        $stmt = $db->prepare("SELECT nome, idade FROM pessoas WHERE id = ?");
        $stmt->execute([$id]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            $mensagem = "<p class='error'>Pessoa não encontrada com ID {$id}.</p>";
            $id = null; // Evita mostrar o formulário
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $novaIdade = $_POST['idade'] ?? null;

            if (is_numeric($novaIdade)) {
                if ($pessoa->atualizarIdade($novaIdade)) {
                    $mensagem = "<p class='success'>Idade atualizada com sucesso!</p>";
                    $dados['idade'] = $novaIdade; // Atualiza para exibir
                } else {
                    $mensagem = "<p class='error'>Erro ao atualizar idade.</p>";
                }
            } else {
                $mensagem = "<p class='error'>Idade inválida. Informe um número.</p>";
            }
        }
    } else {
        $mensagem = "<p class='error'>ID inválido ou não informado.</p>";
    }

} catch (PDOException $e) {
    $mensagem = "<p class='error'>Erro de conexão: " . htmlspecialchars($e->getMessage()) . "</p>";
    $id = null; // Evita continuar a execução
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
  <h1>Editar Idade da Pessoa ID e Editar Preço do Produto ID<?= htmlspecialchars($id ?? 'Desconhecido') ?></h1>

  <?= $mensagem ?>

  <?php if ($id && $dados): ?>
    <p><strong>Nome:</strong> <?= htmlspecialchars($dados['nome']) ?></p>
    <p><strong>Idade atual:</strong> <?= htmlspecialchars($dados['idade']) ?></p>
    <p><strong>Nome do preço:</strong> <?= htmlspecialchars($dados['nome do preco']) ?></p>
    <p><strong>Preço Atual:</strong> R$ <?= htmlspecialchars($dados['preco']) ?></p>

    <form method="POST">
      <label for="idade">Novo Preço:</label>
      <input type="number" name="idade" id="idade" required>
      <button type="submit">Atualizar</button>
      <label for="preco">Novo Preço:</label>
      <input type="number" step="0.01" name="preco" id="preco" required>
      <button type="submit">Atualizar</button>
    </form>
  <?php endif; ?>

  <div style="margin-top: 20px;">
    <a href="listar.php" class="btn">Atualizar</a>
    <a href="listar.php" class="btn">Atualizar</a>
  </div>
</body>
</html>












