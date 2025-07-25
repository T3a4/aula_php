<!-- listagem_pessoas.php -->
<?php
include_once 'conexao.php';
include_once 'pessoa.php';

$database = new Conexao();
$db = $database->getConexao();

$pessoa_obj = new Pessoa($db);
$lista_pessoas = $pessoa_obj->listar(); // Supondo que exista um método listar()
?>

<h2>Lista de Pessoas</h2>

<?php if (isset($_GET['msg'])): ?>
    <p style="color: green;"><?= htmlspecialchars($_GET['msg']) ?></p>
<?php endif; ?>

<?php foreach ($lista_pessoas as $pessoa): ?>
    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <p><strong>Nome:</strong> <?= htmlspecialchars($pessoa['nome']) ?></p>
        <form method="POST" action="excluir_pessoa.php" onsubmit="return confirm('Excluir esta pessoa?');">
            <input type="hidden" name="id" value="<?= $pessoa['id'] ?>">
            <button type="submit" style="color: white; background: red; border: none; padding: 5px 10px;">
                Excluir Pessoa
            </button>
        </form>
    </div>
<?php endforeach; ?>
