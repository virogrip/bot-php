<?php

namespace App;

use App\Interfaces\AIService;

class Chat {
  public function __construct(
    private AIService $AIService
  ){}

  public function start()
  {
    echo Colors::CYAN . "=== Bienvenido a Botcito v2.0 ===" . Colors::RESET . "\n";
    echo "Escribe 'salir' para terminar.\n\n";

    while (true) {
      $prompt = $this->AIService->username ? Colors::GREEN . "$this->AIService->username >" . Colors::RESET : Colors::GREEN . ">" . Colors::RESET;
      $input = readline($prompt);
      $cleanInput = strtolower(trim($input));

      if (in_array($cleanInput, ["salir", "cancelar"])) {
        echo Colors::YELLOW . "Botcito: ¡Adiós! Que tengas un gran día." . Colors::RESET . "\n";
        break;
      }

      $response = $this->AIService->ask($cleanInput);

      echo $response;
    }
  }
}