<?php

function loadGlobalLinks() {
  $baseUrl = "https://webmaissistemas.com.br/";
  $slugs = loadJson('links'); //carrega o json dos loadGlobalLinks

  $prepareLinks = function($items) use (&$prepareLinks, $baseUrl) {
    $result = [];
    foreach ($items as $key => $value) {
      if (is_array($value)) {
        $result[$key] = $prepareLinks($value);
      }else{
        //limpa espaços e barras extras
        $slug = trim($value, '/');

        //Define a URL base sempre com uma barra
        $urlBase = rtrim($baseUrl, '/') . '/';

          if(empty($slug)) {
            // Se o slug for vazio (caso da Home), o resultado é apenas a URL base com /
            $result[$key] = $urlBase;
          } elseif (str_contains($slug, '#')) {
            // se tiver âncora, mantém como está, por exemplo /sistema/#compras
            $result[$key] = $urlBase . $slug;
          } else {
            // para os demais, garante que termina com /
            $result[$key] = $urlBase . $slug . '/';
          }
        }
      }
      return $result;
    };
    return $prepareLinks($slugs);
  }