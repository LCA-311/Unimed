<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unimed</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

  <div class="container">
    <img src="img/img.png">

    <div class="texto">
      <h3>Cuidar de voçê, esse é nosso plano</h3>
      <h4>Quer contratar um plano, Venha simular agora </h4>
    </div>
    <form method="POST" action="#">
      Nome do titular: <input type="text" name="nome" placeholder="Ex: Lucas"><br><br>
      Idade do titular: <input type="number" name="idadeT" placeholder="Ex: 20"><br><br>
      Planos:<br>
      <input type="radio" name="tipoPlano" value="enfermaria">Enfermaria
      <input type="radio" name="tipoPlano" value="apartamento">Apartamento<br><br>
      Quantidade de dependente(s):
      <input type="number" name="qtdDP" value="0" placeholder="Ex: 2"><br><br>
      Idade(s) do(s) dependente(s):
      <input type="text" name="idadeDP" value="0" placeholder="Ex: 30 30"><br><br>
      <input type="submit" value="Calcular" name="btCalcular">
      <input type="reset" value="Cancelar">
      <br><br>
      <input type="submit" value="Continuar" name="btContinuar">
      <br><br>
      <input type="submit" value="Tabela" name="tabela">
    </form>

    <?php

    if (isset($_POST['btCalcular'])) {

      require "Planos.php";
      require "Titular.php";

      $planos = new Planos();
      $titular = new Titular();

      $titular->nome = $_POST['nome'];
      $titular->idade = $_POST['idadeT'];
      $titular->qtdDependentes = $_POST['qtdDP'];
      $planos->tipoPlano = $_POST['tipoPlano'];
      $titular->idadesDP = explode(" ", $_POST['idadeDP']);


      if ($planos->tipoPlano == "enfermaria") {
        $planos->planoEnfermaria($titular->idade);
        for ($i = 0; $i < $titular->qtdDependentes; $i++) {
          $planos->planoEnfermaria($titular->idadesDP[$i]);
        }
      } else {
        $planos->planoApartamento($titular->idade);
        for ($i = 0; $i < $titular->qtdDependentes; $i++) {
          $planos->planoApartamento($titular->idadesDP[$i]);
        }
      }
      $planos->calcularPrecoFinal();
      echo "Preco do Titular = " . $planos->precos[1] . "<br>";
      echo "Preco dos Dependentes = " . $planos->precos[2] . "<br>";
      echo "Preco total a pagar = " . $planos->precos[0] . "<br><br>";
      echo "Para concluir o contrato, por favor inserir os dados novamente e clique no continuar";
    } elseif (isset($_POST['btContinuar'])) {

      require "Planos.php";
      require "Titular.php";

      $planos = new Planos();
      $titular = new Titular();

      $titular->nome = $_POST['nome'];
      $titular->idade = $_POST['idadeT'];
      $titular->qtdDependentes = $_POST['qtdDP'];
      $planos->tipoPlano = $_POST['tipoPlano'];
      $titular->idadesDP = explode(" ", $_POST['idadeDP']);

      if ($planos->tipoPlano == "enfermaria") {
        $planos->planoEnfermaria($titular->idade);
        for ($i = 0; $i < $titular->qtdDependentes; $i++) {
          $planos->planoEnfermaria($titular->idadesDP[$i]);
        }
      } else {
        $planos->planoApartamento($titular->idade);
        for ($i = 0; $i < $titular->qtdDependentes; $i++) {
          $planos->planoApartamento($titular->idadesDP[$i]);
        }
      }
      require "Db.php";
      $planos->calcularPrecoFinal();
      $db = new Db();
      $db->inserir($titular->nome, $planos->tipoPlano, $planos->precos[1], $planos->precos[2], $planos->precos[0]);
    } elseif (isset($_POST['tabela'])) {
      include 'vizualizarDB.php';
    }


    ?>
</body>


</html>
