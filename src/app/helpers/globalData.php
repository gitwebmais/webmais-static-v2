<?php

function loadJson(string $file)
{
  $path = __DIR__ . "/../../app/data/globals/{$file}.json";

  if (!file_exists($path)) {
    return [];
  }

  return json_decode(file_get_contents($path), true);
}