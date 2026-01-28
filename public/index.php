<?php

$app = require __DIR__ . '/../bootstrap.php';

$question = trim($_POST["question"]);
$response = null;

$method = $_SERVER["REQUEST_METHOD"];

if ($method === "POST" && !empty($question)) {
  $response = $app->getResponse($question);
}
?>

<form method="POST">
  <label for="question"> Question: </label>
  <input type="text" id="question" name="question" value="<?= htmlspecialchars($question) ?>">
  <input type="submit" value="Ask">
</form>

<p>
  <strong>Response:</strong>
  <?= $response ?>
</p>