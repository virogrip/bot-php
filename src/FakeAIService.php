<?php

namespace App;

use App\Interfaces\AIService;

class FakeAIService implements AIService {

  public function __construct(
    public ?string $username = null,
    public ?Colors $colors = null
  ) {
    $this->colors = $colors ?? new Colors();
  }

  public function ask(string $question): string {
    $this->simulateThinking();

    if (str_contains($question, "hola")) {
      return $this->greet();
    }

    if (str_contains($question, "tu nombre") || str_contains($question, "te llamas")) {
      return "Botcito: Me llamo Botcito, tu asistente experimental en PHP.\n";
    }

    if (str_contains($question, "hora")) {
      return "Botcito: Son las " . date("H:i:s") . ". ¡El tiempo vuela!\n";
    }

    return "Botcito: " . $this->getRandomResponse($question);
    
  }

  public function simulateThinking()
  {
    echo $this->colors::YELLOW . "Pensando..." . $this->colors::RESET;

    for ($i = 0; $i < 3; $i++) {
      echo ".";
      usleep(300000);
    }
    echo "\n";
  }

  public function greet(): string
  {

    if ($this->username) {
      return "Botcito: ¡Hola de nuevo, $this->username! ¿En qué puedo ayudarte hoy?\n";
    } else {
      echo "Botcito: ¡Holaaa!, soy Botcito. ¿Cómo te llamas?\n";
      $this->username = readline("Tu nombre: ");
      return "Botcito: ¡Qué nombre tan genial, $this->username! Un gusto conocerte.\n";
    }
  }

  public function getRandomResponse(string $question): string
  {
    $responses = [
      "Interesante lo que dices: '$question'",
      "No estoy seguro de entenderlo al 100%, pero suena profundo.",
      "¡Qué curioso! Cuéntame más sobre eso.",
      "AI: $question (Sigo aprendiendo, ¡tenme paciencia!)"
    ];

    return "Botcito: " . $responses[array_rand($responses)] . PHP_EOL;
  }
}