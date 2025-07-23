<?php
class Pessoa {
  private $conexao;
  private $nome_tabela = "pessoas";
  public $id, $nome, $idade;

  public function __construct($db) {
      $this->conexao = $db;
  }

  public function criar() {
      $query = "INSERT INTO {$this->nome_tabela} (nome, idade) VALUES (:nome, :idade)";
      $stmt = $this->conexao->prepare($query);
      $this->nome = htmlspecialchars(strip_tags($this->nome));
      $this->idade = filter_var($this->idade, FILTER_VALIDATE_INT);
      if ($this->idade === false) return false;
      $stmt->bindParam(':nome', $this->nome);
      $stmt->bindParam(':idade', $this->idade, PDO::PARAM_INT);
      return $stmt->execute();
  }

  public function ler() {
      return $this->conexao->query("SELECT * FROM {$this->nome_tabela}");
  }

  public function atualizarIdade($novaIdade) {
      $query = "UPDATE {$this->nome_tabela} SET idade = :idade WHERE id = :id";
      $stmt = $this->conexao->prepare($query);
      $novaIdade = filter_var($novaIdade, FILTER_VALIDATE_INT);
      if ($novaIdade === false) return false;
      $stmt->bindParam(':idade', $novaIdade, PDO::PARAM_INT);
      $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
      return $stmt->execute();
  }
}
