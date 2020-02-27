<?php

namespace vendor\controllers;


abstract class BaseController
{
    public function getTitle()
    {
    }

    public function getHeader()
    {
    }

    public function getBody()
    {
    }

    public $source_lang;
    private $languages = array(
        'en',
        'ru',
    );
    private $default_language = 'en';

    /**
     * BaseController constructor.
     * User language definition
     */
    public function __construct()
    {
        $header_lang = \Locale::getPrimaryLanguage($_SERVER['HTTP_ACCEPT_LANGUAGE']);
        if (in_array($header_lang, $this->languages) && $header_lang != $this->default_language)
            $this->default_language = $header_lang;
        if (isset($_GET['hl']) && in_array($_GET['hl'], $this->languages) && $_GET['hl'] != $this->default_language)
            $this->default_language = $_GET['hl'];

        $_SESSION['lang'] = 'hl=' . $this->default_language;

        $name_file = '/vendor/languages/' . $this->default_language . '.php';
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