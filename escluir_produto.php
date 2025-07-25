<?php
include_once 'conexao.php';
include_once 'produto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $database = new Conexao();
    $db = $database->getConexao();

    $produto = new Produto($db);
    $produto->id = $_POST['id'];

    if ($produto->excluir()) {
        header('Location: listagem_produtos.php?msg=Produto excluído com sucesso');
        exit;
    } else {
        echo "Erro ao excluir o produto.";
    }
} else {
    echo "ID inválido.";
}
?>
