<?php

namespace App;

use OpenAI;
use App\Interfaces\AIService;
use OpenAI\Client as OpenAIClient;

class OpenAIService implements AIService {
  private OpenAIClient $client;
  
  public function __construct(
    public ?string $username = null
  ){
    $this->client = OpenAI::client($_ENV["OPENAI_API_KEY"]);
  }

  public function ask(string $question): string {
    $result = $this->client->chat()->create([
      "model" => "gpt-4o-mini",
      "messages" => [
        ["role" => "system", "content" => <<<EOT
          Eres un asistente especializado exclusivamente en PHP.
          - Si te preguntan algo que no esté relacionado con PHP, responde "No puedo ayudarte con eso".
          - Si te preguntan algo relacionado con PHP, responde de manera breve, concisa y sin rodeos.
         EOT
        ],
        ["role" => "user", "content" => $question]
      ]
    ]);

    return $result['choices'][0]['message']['content'];
  }
}