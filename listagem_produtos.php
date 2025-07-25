<?php
include_once 'conexao.php';
include_once 'produto.php';

$banco = new BancoDeDados();
$conexao = $banco->obterConexao();

$lista_produtos = [];

if ($conexao) {
    $produto_obj = new Produto($conexao);
    $lista_produtos = $produto_obj->ler(); // Certifique-se de que esse método exista
} else {
    echo "Erro ao conectar ao banco de dados.";
    exit;
}
?>

<h2>Lista de Produtos</h2>

<?php if (isset($_GET['msg'])): ?>
    <p style="color: green;"><?= htmlspecialchars($_GET['msg']) ?></p>
<?php endif; ?>

<?php if (empty($lista_produtos)): ?>
    <p>Nenhum produto cadastrado.</p>
<?php else: ?>
    <?php foreach ($lista_produtos as $produto): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <p><strong>Produto:</strong> <?= htmlspecialchars($produto['nome']) ?></p>
            <p><strong>Preço:</strong> R$ <?= htmlspecialchars(number_format($produto['preco'], 2, ',', '.')) ?></p>
            <form method="POST" action="excluir_produto.php" onsubmit="return confirm('Excluir este produto?');">
                <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                <button type="submit" style="color: white; background: red; border: none; padding: 5px 10px;">
                    Excluir Produto
                </button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div style="margin-top: 20px;">
    <a href="listar.php" 
        style="background-color: #f39c12; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px;" 
        class="btn">Atualizar</a>
</div>    

