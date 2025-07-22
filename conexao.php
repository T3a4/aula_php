<?php
class BancoDeDados {
  private $host = "localhost";
  private $nome_banco = "aula_php";
  private $usuario = "root";
  private $senha = "";
  private $conexao;

  public function obterConexao() {
    $this->conexao = null;
    try {
      $dsn = "mysql:host={$this->host};port={$this->porta};dbname={$this->nome_banco};charset=utf8";
      
      $this->conexao = new PDO(
        $dsn,
        $this->usuario,
        $this->senha
      );

    
      $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
      echo "Erro de conexão: " . $e->getMessage();
      return null;
    }

    return $this->conexao;
  }
}
?>
