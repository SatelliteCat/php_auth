<?php
session_start();

require_once 'autoloader.php';
require_once 'vendor/autoload.php';

use src\views\AuthView;
use src\views\ProfileView;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('assets/templates');
$twig = new Environment($loader);
$user = NULL;

if (!isset($_SESSION['user'])) {
    $view = new AuthView();
} else {
    $view = new ProfileView();
    $user = $_SESSION['user'];
}

$headerHomePage = $view->getHeaderHomePage();
$title = $view->getTitle();
$header = $view->getHeader();
$context = $view->getBody();

echo $twig->render('index.html', [
    'title' => $title,
    'header' => $header,
    'headerHomePage' => $headerHomePage,
    'context' => $context,
    'user' => $user
]);
