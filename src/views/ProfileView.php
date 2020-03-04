<?php

namespace src\views;

use src\controllers\BaseController;

class ProfileView extends BaseController
{
    public function getTitle()
    {
        return $this->getSourceLang()['title_profile'];
    }

    public function getHeader()
    {
        return $this->getSourceLang()['header_logout'];
    }

    /**
     * @return mixed|void
     */
    public function getBody()
    {
        $user = unserialize($_SESSION["user"]);
        $result['image'] = $user->getImage();
        $result['name'] = $user->getName();
        $result['email'] = $user->getEmail();
        $result['phone'] = $user->getPhone();

        return $result;
    }
}
