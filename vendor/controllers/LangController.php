<?php
namespace vendor\controllers;
require_once '../../autoloader.php';


class Controller
{
    public function get_locale()
    {
        return \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    }
}
$languages = array(
    'ru-RU',
    'en-US',
);

function get_locale()
{
    return \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
}

