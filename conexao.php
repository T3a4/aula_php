<?php
class BancoDeDados {
  private $hostname = "sql205.infinityfree.com";
  private $nome_banco = "aula_php";
  private $usuario = "if0_39541530";
  private $senha = "Shakyra27";
  private $conexao;

  public function obterConexao() {
    $this->conexao = null;
    try {
      $dsn = "mysql:host={$this->host};dbname={$this->nome_banco};charset=utf8";
      
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
