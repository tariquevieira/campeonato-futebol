<?php

namespace App\Services\Utils\Dominio\GeradorDeGols;

class GeradorDeGolsPython implements GeradorDeGolsService
{
  private String $caminhoRaiz;
  private String $caminhoScript;


  public function __construct()
  {
    $this->caminhoRaiz = realpath(dirname(__FILE__));
    $nomeScript = 'teste.py';
    $this->caminhoScript = $this->caminhoRaiz . '/script/' . $nomeScript;
  }

  /**
   * Retorna nnúmero de gols gerato aleatoriamente através de um script python
   *
   * @return array
   */
  public function getGolsJogo(): array
  {
    $output = shell_exec("python3 $this->caminhoScript");
    $split = preg_split('/\s/', $output);

    return [
      'time_mandante' => $split[0],
      'time_visitante' => $split[1],
    ];
  }
}