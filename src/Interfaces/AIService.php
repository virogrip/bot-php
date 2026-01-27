<?php

namespace App\Interfaces;

interface AIService {
  public function ask(string $question): string;
}