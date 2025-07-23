<?php
class Produto {
  private $conexao;
  private $nome_tabela = "produtos";

  public $id;
  public $nome;
  public $preco;

  public function __construct($db) {
    $this->conexao = $db;
  }

  public function criar() {
    $query = "INSERT INTO " . $this->nome_tabela . " SET nome=:nome, preco=:preco";
    $stmt = $this->conexao->prepare($query);

    $this->nome = htmlspecialchars(strip_tags($this->nome));
    $this->preco = htmlspecialchars(strip_tags($this->preco));

    $stmt->bindParam(":nome", $this->nome);
    $stmt->bindParam(":preco", $this->preco);

    return $stmt->execute();
  }

  public function ler() {
    $query = "SELECT id, nome, preco FROM " . $this->nome_tabela . " ORDER BY nome ASC";
    $stmt = $this->conexao->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  public function atualizarPreco($novoPreco) {
    $query = "UPDATE " . $this->nome_tabela . " SET preco = :preco WHERE id = :id";
    $stmt = $this->conexao->prepare($query);

    $stmt->bindParam(":preco", $novoPreco);
    $stmt->bindParam(":id", $this->id);

    return $stmt->execute();
  }
}
?>
