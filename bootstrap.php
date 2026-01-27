<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$aiService = new App\FakeAIService();
// $AI = new App\OllamaService();
// $AI = new App\OpenAIService();

return new App\Chat($aiService);