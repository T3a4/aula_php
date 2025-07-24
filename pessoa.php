<?php
require_once 'pessoa.php'; // Certifique-se de que a classe Pessoa esteja corretamente definida aqui ou incluída

// Configurações de conexão
$dsn = "mysql:host=localhost;dbname=seu_banco_de_dados;charset=utf8";
$usuario = "root";
$senha = "";

try {
    // Criar conexão
    $conexao = new PDO($dsn, $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Instanciar objeto Pessoa
    $pessoa = new Pessoa($conexao);

    // Obter lista de pessoas
    $stmt = $pessoa->ler();

    // Verificar se há resultados
    if ($stmt->rowCount() > 0) {
        foreach ($stmt as $linha) {
            $id = htmlspecialchars($linha['id']);
            $nome = htmlspecialchars($linha['nome']);
            $idade = htmlspecialchars($linha['idade']);

            echo "ID: {$id} - Nome: {$nome} - Idade: {$idade}<br>";
        }
    } else {
        echo "Nenhuma pessoa encontrada.";
    }

} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>
