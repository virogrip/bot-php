<?php

namespace App;

use App\Interfaces\AIService;

class Chat {
  public function __construct(
    private AIService $AIService
  ){}

  private function welcome()
  {
    echo Colors::CYAN . "=== Bienvenido a Botcito v2.0 ===" . Colors::RESET . "\n";
    echo "Escribe 'salir' para terminar.\n\n";
  }

  public function start()
  {
    $this->welcome();

    while (true) {
      $prompt = $this->AIService->username ? Colors::GREEN . "{$this->AIService->username} >" . Colors::RESET : Colors::GREEN . ">" . Colors::RESET;
      $input = readline($prompt);
      $cleanInput = strtolower(trim($input));

      if ($this->exit($cleanInput)) {
        echo Colors::YELLOW . "Botcito: ¡Adiós! Que tengas un gran día." . Colors::RESET . "\n";
        break;
      }

      $response = $this->AIService->ask($cleanInput);

      $this->output($response);
    }
  }

  private function output(string $response)
  {
    echo $response . PHP_EOL;
  }

  private function exit(string $input)
  {
    return in_array($input, ["salir", "cancelar"]);
  }
}