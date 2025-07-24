<?php
require_once 'conexao.php';
require_once 'produto.php';

$mensagem = '';
$dados = null;
$id = $_GET['id'] ?? null;

try {
    $db = (new BancoDeDados())->obterConexao();
    $produto = new Produto($db);

    if ($id && is_numeric($id)) {
        // Buscar dados do produto
        $stmt = $db->prepare("SELECT nome, preco FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            $mensagem = "<p class='erro'>Produto não encontrado com ID {$id}.</p>";
            $id = null; // Evita mostrar o formulário
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $novopreco = $_POST['preco'] ?? null;

            if (is_numeric($novopreco)) {
                if ($produto->atualizarPreco($id, $novopreco)) {
                    $mensagem = "<p class='sucesso'>Preço atualizado com sucesso!</p>";
                    $dados['preco'] = $novopreco; // Atualiza para exibir
                } else {
                    $mensagem = "<p class='erro'>Erro ao atualizar preço.</p>";
                }
            } else {
                $mensagem = "<p class='erro'>Preço inválido. Informe um número.</p>";
            }
        }
    } else {
        $mensagem = "<p class='erro'>ID inválido ou não informado.</p>";
    }
} catch (PDOException $e) {
    $mensagem = "<p class='erro'>Erro de conexão: " . htmlspecialchars($e->getMessage()) . "</p>";
    $id = null; // Evita continuar a execução
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Preço do Produto ID <?= htmlspecialchars($id ?? 'Desconhecido') ?></h1>

    <?= $mensagem ?>

    <?php if ($id && $dados): ?>
        <p><strong>Nome:</strong> <?= htmlspecialchars($dados['nome']) ?></p>
        <p><strong>Preço Atual:</strong> R$ <?= htmlspecialchars($dados['preco']) ?></p>

        <form method="POST">
            <label for="preco">Novo Preço:</label>
            <input type="number" step="0.01" name="preco" id="preco" required>
            <button type="submit">Atualizar</button>
        </form>
    <?php endif; ?>

    <div style="margin-top: 20px;">
        <a href="listar.php" class="btn">Atualizar</a>
    </div>
</body>
</html>
