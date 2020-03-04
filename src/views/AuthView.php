<?php

namespace src\views;

use src\controllers\BaseController;

class AuthView extends BaseController
{
    public function getTitle()
    {
        return $this->getSourceLang()['title_auth'];
    }

    /**
     * @return mixed|void
     */
    public function getBody()
    {
        return $this->getSourceLang();
    }
}

