<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$AI = new App\FakeAIService();
// $AI = new App\OllamaService();
// $AI = new App\OpenAIService();