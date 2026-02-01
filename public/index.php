<?php

require_once __DIR__ . '/../src/vendor/autoload.php';
require_once __DIR__ . '/../src/app/php/view.php';

// ==========================
// RESOLVE SLUG
// ==========================
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// remove barras extras
$slug = trim($uri, '/');

// home
if ($slug === '') {
  $slug = 'home';
}

// ==========================
// CARREGA DADOS
// ==========================
$pageData = loadPageData($slug);

// 404 simples
if (empty($pageData)) {
  http_response_code(404);
  view('pages/404.twig');
  exit;
}

// ==========================
// DEFINE TEMPLATE
// ==========================
$template = match ($pageData['type'] ?? 'default') {
  'institucional' => 'pages/institutional.twig',
  'segment'       => 'pages/segment.twig',
  default         => 'pages/default.twig',
};

// ==========================
// RENDER
// ==========================
view($template, [
  'page' => $pageData
]);
