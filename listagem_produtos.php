<?php
include_once 'conexao.php';
include_once 'produto.php';

$database = new Conexao();
$db = $database->getConexao();

$produto_obj = new Produto($db);
$lista_produtos = $produto_obj->listar(); // Supondo que tenha esse método
?>

<h2>Lista de Produtos</h2>

<?php if (isset($_GET['msg'])): ?>
    <p style="color: green;"><?= htmlspecialchars($_GET['msg']) ?></p>
<?php endif; ?>

<?php foreach ($lista_produtos as $produto): ?>
    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <p><strong>Produto:</strong> <?= htmlspecialchars($produto['nome']) ?></p>
        <p><strong>Preço:</strong> R$ <?= htmlspecialchars($produto['preco']) ?></p>
        <form method="POST" action="excluir_produto.php" onsubmit="return confirm('Excluir este produto?');">
            <input type="hidden" name="id" value="<?= $produto['id'] ?>">
            <button type="submit" style="color: white; background: red; border: none; padding: 5px 10px;">
                Excluir Produto
            </button>
        </form>
    </div>
<?php endforeach; ?>
