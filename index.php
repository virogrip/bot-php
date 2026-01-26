<?php
// require_once __DIR__ . '/vendor/autoload.php';

use App\Course;
use App\CourseType;

try {
  $archived = false;
  $dateFormatter = new IntlDateFormatter(
    'es-ES',
    IntlDateFormatter::LONG,
    IntlDateFormatter::NONE,
    new DateTimeZone("America/El_Salvador")
  );
  $yesterday = new DateTimeImmutable()->modify('-1 day');
  $level = 3;
  $levelText = match ($level) {
    1 => "Nivel básico",
    2 => "Nivel intermedio",
    3 => "Nivel avanzado"
  };

  $course = new Course([
    "title" => "Curso profesional de PHP",
    "description" => "Aprende desarrollo backend y crea aplicaciones web dinámicas.",
    "price" => 29.99,
    "publication" => $dateFormatter->format($yesterday),
    "status" => $archived ? "Archived" : "Activo",
    "level" => $levelText,
    "tags" => [
      "Backend",
      "Databases",
      "APIs",
      "MySQL"
    ],
  ]);
  $isFree = $course->type->value === CourseType::FREE->value;

} catch (\Exception $e) {
  echo "ERROR: {$e->getMessage()}";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> <?= $course->title ?> </title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .course-card {
      background: white;
      border-radius: 20px;
      padding: 30px;
      max-width: 350px;
      width: 100%;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .course-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
    }

    .course-header {
      position: relative;
      background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%);
      border-radius: 15px;
      padding: 25px;
      margin-bottom: 20px;
    }

    .course-title {
      font-size: 28px;
      font-weight: 700;
      color: white;
      margin-bottom: 5px;
    }

    .level {
      display: inline-block;
      font-size: 0.75rem;
      padding: 0.09rem 0.3rem;
      color: white;
      border: solid 1px white;
      border-radius: 20px;
      font-style: italic;
      margin-bottom: 5px;
    }

    .course-description {
      font-size: 1rem;
      color: rgba(255, 255, 255, 0.9);
      line-height: 1.5;
    }

    .course-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-bottom: 20px;
    }

    .tag {
      background: rgba(139, 92, 246, 0.15);
      color: #6D28D9;
      padding: 8px 16px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 500;
    }

    .tag.status {
      text-align: center;
      width: 30%;
      position: absolute;
      left: 50%;
      top: -11px;
      transform: translateX(-50%);
      background: rgb(255, 255, 255);
      border-radius: 15px;
      padding: 0.22rem;
    }

    .course-details {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .price {
      font-size: 32px;
      font-weight: 700;
      color: #1f2937;
    }

    .price-currency {
      font-size: 20px;
    }

    .date {
      text-align: right;
    }

    .date-label {
      font-size: 12px;
      color: #6b7280;
      margin-bottom: 4px;
    }

    .date-value {
      font-size: 14px;
      font-weight: 600;
      color: #1f2937;
    }

    .explore-button {
      width: 100%;
      background: #1f2937;
      color: white;
      border: none;
      padding: 15px;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: background 0.3s ease;
    }

    .explore-button:hover {
      background: #111827;
    }

    .arrow {
      font-size: 20px;
    }
  </style>
</head>

<body>
  <div class="course-card">
    <div class="course-header">
      <span class="tag status">
        <?= $course->status ?>
      </span>
      <h2 class="course-title">
        <?= $course->title ?>
      </h2>
      <span class="level">
        <?= $course->level ?>
      </span>
      <p class="course-description">
        <?= $course->description ?>
      </p>
    </div>

    <div class="course-tags">
      <?php foreach ($course->tags as $tag): ?>
        <span class="tag">
          <?= $tag ?>
        </span>
      <?php endforeach;  ?>
    </div>

    <div class="course-details">
      <div class="price">
        <?php if($isFree): ?>
          <span>
            <?= $course->type->description() ?>
          </span>

        <?php else: ?>
          <span class="price-currency">$</span>
          <?= $course->price ?>

        <?php endif; ?>
      </div>
      <div class="date">
        <div class="date-label">Publicado</div>
        <div class="date-value"> <?= $course->publication ?> </div>
      </div>
    </div>

    <button class="explore-button">
      <span>Explorar</span>
      <span class="arrow">→</span>
    </button>
  </div>
</body>

</html>