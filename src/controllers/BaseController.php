<?php

namespace src\controllers;


abstract class BaseController
{
    /**
     * return label header home page link
     * @return mixed
     */
    public function getHeaderHomePage(){
        return $this->source_lang['header_home'];
    }

    /**
     * return page title
     */
    public function getTitle()
    {
    }

    /**
     * return page header
     */
    public function getHeader()
    {
    }

    /**
     * return page body
     */
    public function getBody()
    {
    }

    public $source_lang;
    private $languages = array(
        'en',
        'ru',
    );

    /**
     * BaseController constructor.
     * User language definition
     */
    public function __construct()
    {
        $header_lang = \Locale::getPrimaryLanguage($_SERVER['HTTP_ACCEPT_LANGUAGE']);

        if ($_POST)
            $default_language = $_SESSION['lang'];
        elseif (in_array($header_lang, $this->languages) && !isset($_GET['hl']))
            $default_language = $header_lang;
        elseif (isset($_GET['hl']) && in_array($_GET['hl'], $this->languages))
            $default_language = $_GET['hl'];

        $_SESSION['lang'] = $default_language;

        $name_file = '/src/languages/' . $default_language . '.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . $name_file;
        $this->source_lang = $lang;
    }

    /**
     * Getting user language
     * @return mixed
     */
    public function getSourceLang()
    {
        return $this->source_lang;
    }
}