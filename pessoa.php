<?php
// Declara a classe Pessoa – estrutura de POO
class Pessoa {
  // Propriedade privada para guardar a conexão com o banco
  private $conexao;

  // Nome da tabela usada no banco
  private $nome_tabela = "pessoas";

  // Propriedades públicas que representam os campos da tabela
  public $id;
  public $nome;
  public $idade;

  // Construtor: recebe a conexão PDO e armazena
  public function __construct($db) {
    $this->conexao = $db;
  }

  // Método para criar um novo registro de pessoa no banco
  public function criar() {
    // Monta a query SQL para inserção
    $query = "INSERT INTO " . $this->nome_tabela . " SET nome=:nome, idade=:idade";
    $stmt = $this->conexao->prepare($query);

    // Limpa os dados para evitar injeção de código
    $this->nome = htmlspecialchars(strip_tags($this->nome));
    $this->idade = htmlspecialchars(strip_tags($this->idade));

    // Associa os valores aos parâmetros
    $stmt->bindParam(":nome", $this->nome);
    $stmt->bindParam(":idade", $this->idade);

    // Executa a query
    return $stmt->execute();
  }

  // Método para buscar e retornar todos os registros
  public function ler() {
    $query = "SELECT id, nome, idade FROM " . $this->nome_tabela . " ORDER BY nome ASC";
    $stmt = $this->conexao->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  // Novo método: atualiza a idade de uma pessoa pelo ID
  public function atualizarIdade($novaIdade) {
    $query = "UPDATE " . $this->nome_tabela . " SET idade = :idade WHERE id = :id";
    $stmt = $this->conexao->prepare($query);

    $stmt->bindParam(":idade", $novaIdade);
    $stmt->bindParam(":id", $this->id);

    return $stmt->execute();
  }
}
?>