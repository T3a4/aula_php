<?php
class Pessoa {
  // Conexão com o banco de dados
  private $conexao;

  // Nome da tabela
  private $nome_tabela = "pessoas";

  // Atributos públicos que representam colunas da tabela
  public $id;
  public $nome;
  public $idade;

  // Construtor recebe a conexão PDO
  public function __construct($db) {
    $this->conexao = $db;
  }

  // Cria novo registro
  public function criar() {
    $query = "INSERT INTO {$this->nome_tabela} (nome, idade) VALUES (:nome, :idade)";
    $stmt = $this->conexao->prepare($query);

    // Sanitiza os dados
    $this->nome = htmlspecialchars(strip_tags($this->nome));
    $this->idade = (int) $this->idade; // Garante que seja número inteiro

    // Associa os parâmetros
    $stmt->bindParam(':nome', $this->nome);
    $stmt->bindParam(':idade', $this->idade, PDO::PARAM_INT);

    // Executa e retorna se deu certo
    return $stmt->execute();
  }

  // Lê todas as pessoas cadastradas
  public function ler() {
    $query = "SELECT id, nome, idade FROM {$this->nome_tabela} ORDER BY nome ASC";
    $stmt = $this->conexao->prepare($query);
    $stmt->execute();

    return $stmt;
  }

  // Atualiza a idade de uma pessoa com base no ID
  public function atualizarIdade($novaIdade) {
    $query = "UPDATE {$this->nome_tabela} SET idade = :idade WHERE id = :id";
    $stmt = $this->conexao->prepare($query);

    $novaIdade = (int) $novaIdade; // Garante que seja número inteiro
    $this->id = (int) $this->id;

    $stmt->bindParam(':idade', $novaIdade, PDO::PARAM_INT);
    $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

    return $stmt->execute();
  }
}
?>

