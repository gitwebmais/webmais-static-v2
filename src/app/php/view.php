<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../helpers/globalData.php';
require_once __DIR__ . '/../helpers/pageData.php';
require_once __DIR__ . '/../helpers/slider.php';
require_once __DIR__ . '/../helpers/links.php';

use UserFrosting\ViteTwig\ViteManifest;
use UserFrosting\ViteTwig\ViteTwigExtension;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\TwigFunction;


$devEnabled = true; // Mude para true no desenvolvimento

$manifest = new ViteManifest(
    devEnabled: $devEnabled,
    manifestPath: __DIR__ . '/../../../public/build/.vite/manifest.json',
    serverUrl: 'http://localhost:5173/',
    // Aqui está a chave: se não for dev, o basePath PRECISA ser /build/
    // para que o HTML final fique <script src="/build/assets/main.js">
    basePath: $devEnabled ? '' : '/build/', 
);

$extension = new ViteTwigExtension($manifest);

// loader aponta para onde ficam os templates
$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader, [
    'cache' => false, // depois você pode ativar
]);
$twig->addExtension($extension);

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

// função de renderização
function view(string $template, array $data = [])
{
    global $twig;

    echo $twig->render($template, $data);
}