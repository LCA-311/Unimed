<?php

class Planos
{
  public $tipoPlano;
  public $precos = [0, 0, 0];

  public function planoEnfermaria($idade)
  {
    $i = 1;
    if ($idade > 0 and $idade < 19)
      if ($this->precos[$i] == 0)
        $this->precos[$i] = 193.00;
      else
        $this->precos[++$i] += 193.00;
    elseif ($idade < 24)
      if ($this->precos[$i] == 0)
        $this->precos[$i] = 221.00;
      else
        $this->precos[++$i] += 221.00;
    elseif ($idade < 29)
      if ($this->precos[$i] == 0)
        $this->precos[$i] = 255.00;
      else
        $this->precos[++$i] += 255.00;
    elseif ($idade < 39)
      if ($this->precos[$i] == 0) {
        $this->precos[$i] = 337.00;
      } else {
        $this->precos[++$i] += 337.00;
      }
    elseif ($idade < 54)
      if ($this->precos[$i] == 0)
        $this->precos[$i] = 616.00;
      else
        $this->precos[++$i] += 616.00;
    else
      if ($this->precos[$i] == 0)
      $this->precos[$i] = 800.00;
    else
      $this->precos[++$i] += 800.00;
  }


  public function planoApartamento($idade)
  {
    $i = 1;
    if ($idade > 0 and $idade < 19)
      if ($this->precos[$i] == 0)
        $this->precos[$i] = 282.00;
      else
        $this->precos[++$i] += 282.00;
    elseif ($idade < 24)
      if ($this->precos[$i] == 0)
        $this->precos[$i] = 325.00;
      else
        $this->precos[++$i] += 325.00;
    elseif ($idade < 29)
      if ($this->precos[$i] == 0)
        $this->precos[$i] = 373.00;
      else
        $this->precos[++$i] += 373.00;
    elseif ($idade < 39)
      if ($this->precos[$i] == 0)
        $this->precos[$i] = 494.00;
      else
        $this->precos[++$i] += 494.00;
    elseif ($idade < 54)
      if ($this->precos[$i] == 0)
        $this->precos[$i] = 902.00;
      else
        $this->precos[++$i] += 902.00;
    else
      if ($this->precos[$i] == 0)
      $this->precos[$i] = 1200.00;
    else
      $this->precos[++$i] += 1200.00;
  }
  public function calcularPrecoFinal()
  {
    $i = 1;
    $this->precos[0] = $this->precos[$i] + $this->precos[++$i];
  }
}
