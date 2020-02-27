<?php

namespace vendor\controllers;
require_once '../../autoloader.php';

use vendor\models\User;

session_start();


class RegisterController extends BaseController
{
    public function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $image = $_FILES['image'];
        $response = array('status' => false);
        $image_types = array(
            'image/png',
            'image/jpeg',
            'image/gif'
        );

        if (!preg_match('/^([\w\-_]+\s?)+$/ui', $name))
            $response['message'] = $this->source_lang['error_name'];
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $response['message'] = $this->source_lang['error_email'];
        elseif (!preg_match('/^\+\d{4,20}$/i', $phone))
            $response['message'] = $this->source_lang['error_phone'];
        elseif (!in_array($image['type'], $image_types))
            $response['message'] = $this->source_lang['error_image_type'];
        elseif ($image['size'] > 10000000)
            $response['message'] = $this->source_lang['error_image_size'];
        elseif (strlen($password) < 6 || strlen($password) > 30)
            $response['message'] = $this->source_lang['error_password'];
        elseif ($password !== $password_confirm)
            $response['message'] = $this->source_lang['error_password_conf'];
        else {
            $upload_path = 'uploads/' . time() . rand(100, 1000) . '.' . explode('/', $image['type'])[1];

            if (!move_uploaded_file($image['tmp_name'], '../../' . $upload_path) && $image['error'])
                $response['message'] = $this->source_lang['error_image_upload'];
            else {
                $user = new User();
                $user->setName($name);
                $user->setEmail($email);
                $user->setPhone($phone);
                $user->setPassword($password);
                $user->setImage($upload_path);

                $res = $user->create();

                if (!$res)
                    $response['message'] = $this->source_lang['error_user_create'];
                elseif ($user->getId() === -1)
                    $response['message'] = $this->source_lang['error_phone_exist'];
                else {
                    $_SESSION['user'] = serialize($user);
                    $response['status'] = true;
                }
            }
        }

        return $response;
    }
}

$response = (new RegisterController)->register();
echo json_encode($response);
