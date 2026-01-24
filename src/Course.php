<?php

namespace App;

use App\CourseValidator;

class Course {
  private ?string $title = null;
  private ?string $description = null;
  private ?float $price = null;
  private ?string $publication = null;
  private ?string $status = null;
  private ?string $level = null;
  private ?array $tags = null;
  private CourseType $type = CourseType::PAID;
  private CourseValidator $validator;

  public function __construct(
    array $data,
    ?CourseValidator $validator = null
  ){
    $this->validator = $validator ?? new CourseValidator();
    foreach($data as $key => $value){
      $this->__set($key, $value);
    }
  }

  public function __set(string $name, mixed $value){
    if (!property_exists($this, $name)) {
      throw new \InvalidArgumentException(
        "La propiedad {$name} no existe en la clase Course"
      );
    }

    $validated = $this->validator->validate($name, $value);
    $this->$name = $validated;
  }

  public function __get($name){
    return $this->$name ?? null;
  }
}