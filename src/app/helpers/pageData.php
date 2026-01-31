<?php

function loadPageData(string $slug): array
{
  $basePath = __DIR__ . "/../../app/data/pages/{$slug}";

  // padrão principal
  $dataFile = "{$basePath}/data.json";

  if (!file_exists($dataFile)) {
    return [];
  }

  $data = json_decode(file_get_contents($dataFile), true);

  // garante que sempre seja array
  return is_array($data) ? $data : [];
}