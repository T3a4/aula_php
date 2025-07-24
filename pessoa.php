<?php
// (sua classe Pessoa continua aqui...)

class Pessoa {
    // ... seu código aqui ...
}

// TESTE DE EXIBIÇÃO
// Arquivo de conexão (você deve criar ou ajustar conforme seu ambiente)
$dsn = "mysql:host=localhost;dbname=seu_banco_de_dados;charset=utf8";
$usuario = "root";
$senha = "";

try {
    $conexao = new PDO($dsn, $usuario, $senha);
    $pessoa = new Pessoa($conexao);

    // Exibir todas as pessoas
    $stmt = $pessoa->ler();
    foreach ($stmt as $linha) {
        echo "ID: {$linha['id']} - Nome: {$linha['nome']} - Idade: {$linha['idade']}<br>";
    }

} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>
