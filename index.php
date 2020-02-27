<?php
session_start();

use vendor\views\AuthView;
use vendor\views\ProfileView;

require_once 'autoloader.php';

if (!isset($_SESSION['user'])) {
    $view = new AuthView();
} else {
    $view = new ProfileView();
}
?>


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/auth.css">
    <title><?= $view->getTitle(); ?></title>
</head>
<body>

<header>
    <ul class="navbar-ul">
        <li class="navbar-li"><a class="navbar-a" href="/"><?= $view->getSourceLang()['header_home']; ?></a></li>
        <div class="dropdown" style="float:right">
            <button class="dropbtn">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     width="20"
                     viewBox="0 0 172 172"
                     style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M28.68066,21.5c-7.90483,0 -14.33333,6.4285 -14.33333,14.33333v86c0,7.90483 6.4285,14.33333 14.33333,14.33333h100.33333l28.66667,28.66667l-0.08399,-129.014c-0.00717,-7.90483 -6.43567,-14.31934 -14.33333,-14.31934zM28.68066,35.83333h114.59668l0.04199,94.38444l-8.37044,-8.38444h-106.26823zM110.43945,43.09798v7.34863h-17.27278v9.40625h33.78972c0,18.13166 -14.97722,29.17057 -14.97722,29.17057c0,0 -10.17611,-5.6928 -10.17611,-17.2168h-8.63639c0,14.104 9.02832,21.02409 9.02832,21.02409c0,0 -3.99016,5.03906 -9.02832,5.03906v9.63021c9.847,0 18.42058,-7.95052 18.42057,-7.95052c0,0 6.16659,7.95052 17.48275,7.95052v-9.63021c-4.27133,0 -6.73275,-4.8291 -6.73275,-4.8291c0,0 13.82943,-12.7055 13.82943,-33.18783v-9.40625h-17.27278v-7.34863zM55.82161,50.16667l-19.98828,57.33333h11.75781l3.72331,-11.86979h19.21843l3.70931,11.86979h11.75781l-19.98828,-57.33333zM60.91667,64.72396l6.66276,21.5h-13.32552z"></path></g></g></svg>
            </button>
            <div class="dropdown-content">
                <a href="/?hl=en">English</a>
                <a href="/?hl=ru">Русский</a>
            </div>
        </div>
        <?= $view->getHeader(); ?>
    </ul>
</header>

<?= $view->getBody(); ?>

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script type="module" src="/assets/js/validate-form.js"></script>
<script type="module" src="/assets/js/lang.js"></script>
<script type="module" src="/assets/js/form.js"></script>

</body>
</html>