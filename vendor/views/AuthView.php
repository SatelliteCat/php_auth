<?php

namespace vendor\views;

use vendor\controllers\BaseController;

class AuthView extends BaseController
{
    public function getTitle()
    {
        echo $this->getSourceLang()['title_auth'];
    }

    public function getBody()
    {
        echo
            '<div class="login-page">
                <div class="form">
                    <p class="msg"></p>
                    <form class="register-form">
                        <input type="text" placeholder="' . $this->getSourceLang()['placeholder_name'] . '" name="name"/>
                        <input type="email" placeholder="' . $this->getSourceLang()['placeholder_email'] . '" name="email"/>
                        <input type="text" placeholder="' . $this->getSourceLang()['placeholder_phone'] . ' (+745134567)" name="phone"/>
                        <input type="file" placeholder="Image" accept=".png, .jpg, .jpeg, gif" name="image"/>
                        <input type="password" placeholder="' . $this->getSourceLang()['placeholder_password'] . '" name="password"/>
                        <input type="password" placeholder="' . $this->getSourceLang()['placeholder_password_conf'] . '" name="password_confirm"/>
                        <button type="submit" class="btn-reg">' . $this->getSourceLang()['btn_register'] . '</button>
                        <p class="message">' . $this->getSourceLang()['link_signin_text'] . ' <a href="#">' . $this->getSourceLang()['link_signin'] . '</a></p>
                    </form>
                    <form class="login-form">
                        <input type="text" placeholder="' . $this->getSourceLang()['placeholder_phone'] . ' (+14513412309)" name="phone_log"/>
                        <input type="password" placeholder="' . $this->getSourceLang()['placeholder_password'] . '" name="password_log"/>
                        <button type="submit" class="btn-login">' . $this->getSourceLang()['btn_login'] . '</button>
                        <p class="message">' . $this->getSourceLang()['link_signup_text'] . ' <a href="#">' . $this->getSourceLang()['link_signup'] . '</a></p>
                    </form>
                </div>
            </div>';
    }
}

