<?php

namespace vendor\views;

use vendor\controllers\BaseController;


class ProfileView extends BaseController
{
    public function getTitle()
    {
        echo $this->getSourceLang()['title_profile'];
    }

    public function getHeader()
    {
        echo '<li class="navbar-li" style="float:right">
            <a class="active navbar-a btn-logout" href="#">
                '.$this->getSourceLang()['header_logout'].'
            </a>
        </li>';
    }

    public function getBody()
    {
        $user = unserialize($_SESSION["user"]);
        $image = $user->getImage();
        $name = $user->getName();
        $email = $user->getEmail();
        $phone = $user->getPhone();

        echo
            '<div class="card">
            <div class="card-header" style="background-image: url('. $image .')">
                <div class="card-header-slanted-edge">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 200">
                        <path class="polygon" d="M-20,200,1000,0V200Z"/>
                    </svg>
                </div>
            </div>
        
            <div class="card-body">
                <h2 class="name">' . $name . '</h2>
                <div class="bio">
                    <p>' . $email . '</p>
                    <p>' . $phone . '</p>
                </div>
                <div class="social-accounts">
                    <a href="mailto: ' . $email . '"><img
                                src="https://img.icons8.com/material-outlined/48/000000/email.png"></a>
                    <a href="tel: ' . $phone . '"><img
                                src="https://img.icons8.com/material-outlined/48/000000/phone.png"></a>
                </div>
            </div>
        </div>';
    }
}
