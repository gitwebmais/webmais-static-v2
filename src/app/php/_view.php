<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../helpers/globalData.php';
require_once __DIR__ . '/../helpers/pageData.php';
require_once __DIR__ . '/../helpers/slider.php';
require_once __DIR__ . '/../helpers/links.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\TwigFunction;

// loader aponta para onde ficam os templates
$loader = new FilesystemLoader(__DIR__ . '/../templates');

$twig = new Environment($loader, [
    'cache' => false, // depois você pode ativar
]);

// funções do Vite
$twig->addFunction(
    new TwigFunction('vite_js', 'vite_js', ['is_safe' => ['html']])
);

$twig->addFunction(
    new TwigFunction('vite_css', 'vite_css', ['is_safe' => ['html']])
);

// variáveis globais
$twig->addGlobal('images', 'dist/images');
$twig->addGlobal('links', loadGlobalLinks());

// dados JSON
$twig->addGlobal('videos', loadJson('video'));
$twig->addGlobal('segmentos', loadJson('segmentos'));
$twig->addGlobal('ferramentas', loadJson('ferramentas'));
$twig->addGlobal('blogs', loadJson('blog'));
$twig->addGlobal('faqs', loadJson('faqs'));
$twig->addGlobal('forms', loadJson('form'));

// sliders
$twig->addGlobal('clients', loadSlider('clients'));
$twig->addGlobal('testimonials', loadSlider('testimonials'));
$twig->addGlobal('setores', loadSlider('setores'));

// GTM
// Define se o ambiente é produção (ajuste a URL para a sua)
$isProduction = ($_SERVER['HTTP_HOST'] === 'webmaissistemas.com.br');

$twig->addGlobal('is_production', $isProduction);
$twig->addGlobal('gtm_id', 'GTM-K5ZVS8N');

// registra o helper no Twig
$twig->addFunction(
    new TwigFunction('vite', 'vite', ['is_safe' => ['html']])
);

// função de renderização
function view(string $template, array $data = [])
{
    global $twig;

    echo $twig->render($template, $data);
}