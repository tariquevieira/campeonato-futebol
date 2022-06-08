<?php

namespace App\Services\Utils\Dominio;

class GeradorDeGolsService
{
  private String $caminhoRaiz;
  private String $caminhoScript;


  public function __construct()
  {
    $this->caminhoRaiz = realpath(dirname(__FILE__));
    $nomeScript = 'teste.py';
    $this->caminhoScript = $this->caminhoRaiz . '/script/' . $nomeScript;
  }
  public function getGols(): array
  {
    $output = shell_exec("python3 $this->caminhoScript");
    $split = preg_split('/\s/', $output);

    return [
      'golTime1' => $split[0],
      'golTime2' => $split[1],
    ];
  }
}