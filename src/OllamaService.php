<?php

namespace App;

use ArdaGnsrn\Ollama\Ollama;

class OllamaService {
  private Ollama $client;
  
  public function __construct(
    public ?string $username = null
  ){
    $this->client = Ollama::client();
  }

  public function ask(string $question): string {
    $result = $this->client->chat()->create([
      "model" => "deepseek-r1:1.5b",
      "messages" => [
        ["role" => "user", "content" => $question]
      ]
    ]);

    return $result->message->content;
  }
}