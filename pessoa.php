<?php
class Pessoa {
  // Conexão com o banco de dados
  private $conexao;

  // Nome da tabela
  private $nome_tabela = "pessoas";

  // Atributos públicos (colunas da tabela)
  public $id;
  public $nome;
  public $idade;

  // Construtor com a conexão PDO
  public function __construct($db) {
    $this->conexao = $db;
  }

  // Cria um novo registro
  public function criar() {
    $query = "INSERT INTO {$this->nome_tabela} (nome, idade) VALUES (:nome, :idade)";
    $stmt = $this->conexao->prepare($query);

    // Sanitiza os dados
    $this->nome = htmlspecialchars(strip_tags($this->nome));
    $this->idade = filter_var($this->idade, FILTER_VALIDATE_INT);

    if ($this->idade === false) return false; // Idade inválida

    // Associa os parâmetros
    $stmt->bindParam(':nome', $this->nome);
    $stmt->bindParam(':idade', $this->idade, PDO::PARAM_INT);

    // Executa a query
    try {
      return $stmt->execute();
    } catch (PDOException $e) {
      error_log("Erro ao criar pessoa: " . $e->getMessage());
      return false;
    }
  }

  // Lê todas as pessoas cadastradas
  public function ler() {
    $query = "SELECT id, nome, idade FROM {$this->nome_tabela} ORDER BY nome ASC";
    $stmt = $this->conexao->prepare($query);

    try {
      $stmt->execute();
      return $stmt;
    } catch (PDOException $e) {
      error_log("Erro ao ler pessoas: " . $e->getMessage());
      return false;
    }
  }

  // Atualiza a idade de uma pessoa com base no ID
  public function atualizarIdade($novaIdade) {
    $novaIdade = filter_var($novaIdade, FILTER_VALIDATE_INT);
    $this->id = filter_var($this->id, FILTER_VALIDATE_INT);

    if ($novaIdade === false || $this->id === false) return false;

    $query = "UPDATE {$this->nome_tabela} SET idade = :idade WHERE id = :id";
    $stmt = $this->conexao->prepare($query);

    $stmt->bindParam(':idade', $novaIdade, PDO::PARAM_INT);
    $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

    try {
      return $stmt->execute();
    } catch (PDOException $e) {
      error_log("Erro ao atualizar idade: " . $e->getMessage());
      return false;
    }
  }
}
?>

