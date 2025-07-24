<?php
class Produto {
    private $conexao;
    private $nome_tabela = "produtos";
    public $id, $nome, $preco;

    public function __construct($db) {
        $this->conexao = $db;
    }

    public function criar() {
        
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        
        $precoValido = filter_var($this->preco, FILTER_VALIDATE_FLOAT);
        if ($precoValido === false) {
            return false;
        }
        $this->preco = $precoValido;

        $query = "INSERT INTO {$this->nome_tabela} SET nome = :nome, preco = :preco";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindValue(':preco', $this->preco);
        return $stmt->execute();
    }

    public function ler() {
        $query = "SELECT id, nome, preco FROM {$this->nome_tabela} ORDER BY nome ASC";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function atualizarPreco($novoPreco) {
        $precoValido = filter_var($novoPreco, FILTER_VALIDATE_FLOAT);
        if ($precoValido === false) {
            return false;
        }
        $this->preco = $precoValido;

        $query = "UPDATE {$this->nome_tabela} SET preco = :preco WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':preco', $this->preco);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>

