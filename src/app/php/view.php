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

// =====================================================
// AMBIENTE
// =====================================================

// true no local, false na hospedagem
$devEnabled = ($_SERVER['HTTP_HOST'] === 'localhost:8000');

// webroot real (public no local, www na hospedagem)
$documentRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/');

// =====================================================
// VITE
// =====================================================

// onde o build fica publicamente
$buildPublicPath = '/build';

// caminho real do manifest (SEM hardcode de public)
$manifestPath = $documentRoot . $buildPublicPath . '/.vite/manifest.json';

$manifest = new ViteManifest(
    devEnabled: $devEnabled,
    manifestPath: $manifestPath,
    serverUrl: 'http://localhost:5173/',
    basePath: $devEnabled ? '' : $buildPublicPath . '/',
);

$twigVite = new ViteTwigExtension($manifest);

// =====================================================
// TWIG
// =====================================================

// templates sempre relativos ao src
$loader = new FilesystemLoader(__DIR__ . '/../templates');

$twig = new Environment($loader, [
    'cache' => false, // pode ativar depois
]);

$twig->addExtension($twigVite);

// =====================================================
// VARIÁVEIS GLOBAIS
// =====================================================

// caminhos públicos
$twig->addGlobal('images', '/dist/images');

// links
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

// =====================================================
// GTM
// =====================================================

$isProduction = ($_SERVER['HTTP_HOST'] === 'webmaissistemas.com.br');

$twig->addGlobal('is_production', $isProduction);
$twig->addGlobal('gtm_id', 'GTM-K5ZVS8N');

// =====================================================
// FUNÇÃO DE RENDER
// =====================================================

function view(string $template, array $data = [])
{
    global $twig;
    echo $twig->render($template, $data);
}