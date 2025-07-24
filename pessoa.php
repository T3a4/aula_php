<?php
class Pessoa {
    private $conexao;
    private $nome_tabela = "pessoas"; // Nome da tabela no banco
    public $id, $nome, $idade;

    public function __construct($db) {
        $this->conexao = $db;
    }

    // Criar uma nova pessoa
    public function criar() {
        // Sanitizar entrada
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $idadeValida = filter_var($this->idade, FILTER_VALIDATE_INT);
        if ($idadeValida === false) {
            return false;
        }
        $this->idade = $idadeValida;

        $query = "INSERT INTO {$this->nome_tabela} SET nome = :nome, idade = :idade";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindValue(':idade', $this->idade, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Ler todas as pessoas ordenadas por nome
    public function ler() {
        $query = "SELECT id, nome, idade FROM " . $this->nome_tabela . " ORDER BY nome ASC";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Atualizar idade de uma pessoa pelo id
    public function atualizarIdade($novaIdade) {
        $idadeValida = filter_var($novaIdade, FILTER_VALIDATE_INT);
        if ($idadeValida === false) {
            return false;
        }
        $this->idade = $idadeValida;

        $query = "UPDATE {$this->nome_tabela} SET idade = :idade WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':idade', $this->idade, PDO::PARAM_INT);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function excluir() {
        $query = "DELETE FROM " . $this->nome_tabela . " WHERE id = :id";
        $stmt = $this->conexao->prepare($query);

        $this->id = htmlsspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
    // Você pode adicionar outros métodos conforme precisar, como deletar, buscar por id, etc.
}
?>
