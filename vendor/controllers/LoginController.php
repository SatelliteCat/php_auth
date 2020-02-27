<?php

namespace vendor\controllers;
session_start();

require_once '../../autoloader.php';
require_once '../languages/en.php';

use vendor\models\User;


class LoginController extends BaseController
{
    /**
     * Validation and authorisation
     * @return array
     */
    public function login()
    {
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $response = array('status' => false);

        if (!preg_match('/^\+\d{4,20}$/i', $phone))
            $response['message'] = $this->source_lang['error_phone'];
        elseif (strlen($password) < 6 || strlen($password) > 30)
            $response['message'] = $this->source_lang['error_password'];
        else {
            $user = new User();
            if (!$user->getUser($phone, $password))
                $response['message'] = $this->source_lang['error_user_login'];
            else {
                $_SESSION['user'] = serialize($user);
                $response['status'] = true;
            }
        }

        return $response;
    }
}

$response = (new LoginController)->login();
echo json_encode($response);
