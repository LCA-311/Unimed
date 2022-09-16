<?php
class Db
{

  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $port = 3306;
  private $dbn = "UNIMED";
  public $conn;

  function __construct()
  {
    $this->conn = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbn", $this->username, $this->password);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  function __destruct()
  {
  }
  public function inserir($nome, $plano, $precoT, $precoD, $total)
  {
    try {
      $sql = "INSERT INTO PLANOS(NOME,PLANO,PRECO_TITULAR,PRECO_DEPENDENTES,TOTAL,DT_CONTRATO) VALUES (:nome,:plano,:precoT,:precoD,:total,:dtc)";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':nome', $nome);
      $stmt->bindParam(':plano', $plano);
      $stmt->bindParam(':precoT', $precoT);
      $stmt->bindParam(':precoD', $precoD);
      $stmt->bindParam(':total', $total);
      $data = date("Y-m-d");
      $stmt->bindParam(':dtc', $data);
      $stmt->execute();
      if ($stmt->rowCount())
        echo "Registrado com sucesso!";
    } catch (PDOException $th) {
      echo $th->getMessage();
    }
  }
}
