#!/usr/bin/env php
<?php
require __DIR__ . '/../bootstrap.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

use App\Colors;

echo Colors::CYAN . "=== Bienvenido a Botcito v2.0 ===" . Colors::RESET . "\n";
echo "Escribe 'salir' para terminar.\n\n";

while (true) {
  $prompt = $AI->username ? Colors::GREEN . "$AI->username >" . Colors::RESET : Colors::GREEN . ">" . Colors::RESET;
  $input = readline($prompt);
  $cleanInput = strtolower(trim($input));

  if (in_array($cleanInput, ["salir", "cancelar"])) {
    echo Colors::YELLOW . "Botcito: ¡Adiós! Que tengas un gran día." . Colors::RESET . "\n";
    break;
  }

  $response = $AI->ask($cleanInput);

  echo $response;
}
