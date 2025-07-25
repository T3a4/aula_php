<?php
include_once 'conexao.php';
include_once 'pessoa.php';

$banco = new BancoDeDados();
$conexao = $banco->obterConexao();

$lista_pessoas = [];

if ($conexao) {
    $pessoa_obj = new Pessoa($conexao);
    $lista_pessoas = $pessoa_obj->ler(); // Certifique-se de que esse método exista
} else {
    echo "Erro ao conectar ao banco de dados.";
    exit;
}
?>

<h2>Lista de Pessoas</h2>

<?php if (isset($_GET['msg'])): ?>
    <p style="color: green;"><?= htmlspecialchars($_GET['msg']) ?></p>
<?php endif; ?>

<?php if (empty($lista_pessoas)): ?>
    <p>Nenhuma pessoa cadastrada.</p>
<?php else: ?>
    <?php foreach ($lista_pessoas as $pessoa): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <p><strong>Nome:</strong> <?= htmlspecialchars($pessoa['nome']) ?></p>
            <p><strong>Idade:</strong> <?= htmlspecialchars($pessoa['idade']) ?></p>
            <form method="POST" action="excluir_pessoa.php" onsubmit="return confirm('Excluir esta pessoa?');">
                <input type="hidden" name="id" value="<?= $pessoa['id'] ?>">
                <button type="submit" style="color: white; background: red; border: none; padding: 5px 10px;">
                    Excluir Pessoa
                </button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div style="margin-top: 20px;">
    <a href="listar.php" 
        style="background-color: #f39c12; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px;" class="btn">Atualizar</a>
</div>    
