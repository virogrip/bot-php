<?php

class CourseValidator {
  private array $rules;

  public function __construct()
  {
    $this->rules = [
      "title" => [
        "check" => fn(string $title) => strlen($title) > 3 && strlen($title) <= 50,
        "error" => "El título debe tener entre 4 y 50 caracteres."
      ],
      "description" => [
        "check" => fn(string $desc) => strlen($desc) > 3 && strlen($desc) <= 200,
        "error" => "La descripción debe tener entre 4 y 200 caracteres."
      ],
      "price" => [
        "check" => fn(float $price) => is_float($price) && $price > 0,
        "error" => "El precio no puede ser menor o igual a cero."
      ],
      "status" => [
        "check" => fn(string $status) => in_array($status, ["Archivado", "Activo"]),
        "error" => 'El status solo puede ser "Archivado" o "Activo."'
      ],
      "level" => [
        "check" => fn(string $level) => strlen($level) > 10 && strlen($level) <= 20,
        "error" => "El nivel debe tener entre 11 y 20 caracteres."
      ]
    ];
  }

  public function validate(string $property, mixed $value){
    if (!isset($this->rules[$property])) {
      return $value;
    }

    $rule = $this->rules[$property];

    if (!$rule['check']($value)) {
      throw new InvalidArgumentException($rule['error']);
    }

    return $value;
  }
}