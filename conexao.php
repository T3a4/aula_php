<?php
class BancoDeDados {
  private $hostname = "ftpupload.net";
  private $nome_banco = "aula_php";
  private $usuario = "if0_39541530";
  private $senha = "Shakyra27";
  private $conexao;

  public function obterConexao() {
    $this->conexao = null;
    try {
      $mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
      
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

