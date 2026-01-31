<?php

function loadSlider(string $name): array
{
  $path = __DIR__ . "/../../app/data/slides/{$name}.json";

  if (!file_exists($path)) {
    return [];
  }

  return json_decode(file_get_contents($path), true);
}