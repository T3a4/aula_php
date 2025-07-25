<?php
include_once 'conexao.php';
include_once 'pessoa.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $database = new Conexao();
    $db = $database->getConexao();

    $pessoa = new Pessoa($db);
    $pessoa->id = $_POST['id'];

    if ($pessoa->excluir()) {
        header('Location: listagem_pessoas.php?msg=Pessoa excluída com sucesso');
        exit;
    } else {
        echo "Erro ao excluir a pessoa.";
    }
} else {
    echo "ID inválido.";
}
?>
