<?php

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Nome</th><th>Plano</th><th>Preco Titular</th><th>Preco Dependentes</th><th>Total a Pagar</th></tr>";

class TableRows extends RecursiveIteratorIterator
{
  function __construct($it)
  {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current()
  {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current() . "</td>";
  }

  function beginChildren()
  {
    echo "<tr>";
  }

  function endChildren()
  {
    echo "</tr>" . "\n";
  }
}

try {
  require "Db.php";
  $bd = new Db();
  $sql = "SELECT * FROM PLANOS";
  $stmt = $bd->conn->prepare($sql);
  $stmt->execute();

  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
    echo $v;
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
echo "</table>";
