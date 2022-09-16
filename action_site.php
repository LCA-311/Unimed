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
  echo "Preco total a pagar = " . $planos->precos[0] . "<br>";
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
  $planos->calcularPrecoFinal();
  require "Db.php";
  $bd = new Db();
  $bd->inserir($titular->nome, $planos->tipoPlano, $planos->precos[1], $planos->precos[2], $planos->precos[0]);
} elseif (isset($_POST['tabela'])) {
  include_once 'vizualizarDB.php';
}
