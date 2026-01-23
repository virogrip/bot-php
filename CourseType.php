<?php

enum CourseType: string {
  case FREE = "FREE";
  case PAID ="PAID";

  public function description(): string {
    return match ($this) {
      self::FREE => 'Curso gratuito',
      self::PAID => 'Curso de pago',
    };
  }
}