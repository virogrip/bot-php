<?php

namespace App;

use OpenAI;
use OpenAI\Client as OpenAIClient;

class OpenAIService {
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
        ["role" => "user", "content" => $question]
      ]
    ]);

    return $result['choices'][0]['message']['content'];
  }
}