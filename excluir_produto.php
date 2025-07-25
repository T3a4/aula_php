<?php
include_once 'conexao.php';
include_once 'produto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $banco = new BancoDeDados();
    $conexao = $banco->obterConexao();

    if ($conexao) {
        $produto = new Produto($conexao);
        $produto->id = $_POST['id'];

        if ($produto->excluir()) {
            header('Location: listagem_produtos.php?msg=Produto excluído com sucesso');
            exit;
        } else {
            echo "Erro ao excluir o produto.";
        }
    } else {
        echo "Erro ao conectar ao banco de dados.";
    }
} else {
    echo "ID inválido.";
}
?>

