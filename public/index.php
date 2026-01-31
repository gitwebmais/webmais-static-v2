<?php

// ==========================
// BOOTSTRAP
// ==========================
require_once __DIR__ . '/../src/vendor/autoload.php';
require_once __DIR__ . '/../src/app/php/view.php';

// ==========================
// DADOS DA PÁGINA
// ==========================
$pageData = loadPageData('home');

// ==========================
// RENDER
// ==========================
view('pages/home.twig', [
  'page' => $pageData
]);