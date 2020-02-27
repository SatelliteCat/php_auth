<?php

namespace vendor\models;

class User extends BaseModel
{
    private $id = NULL;
    private $name = NULL;
    private $email = NULL;
    private $phone = NULL;
    private $password = NULL;
    private $image = NULL;

    private $mysqli;

    /**
     * New user registration
     *
     * Upon successful creation, the user will have an id
     * Else id = -1
     */
    public function create()
    {
        $this->mysqli = $this->getMysqli();

        if (!$this->mysqli->connect_errno) {
            $check_phone_query = "SELECT NOT EXISTS (SELECT `id` FROM `users` WHERE phone = '$this->phone')";

            $result = $this->mysqli->query($check_phone_query);
            if ($result && current($result->fetch_assoc())) {
                $result->close();

                $this->password = password_hash($this->password, PASSWORD_DEFAULT);
                $query = "INSERT INTO `users` (`name`, `email`, `phone`, `image`, `password`) 
                    VALUES ('$this->name', '$this->email', '$this->phone', '$this->image', '$this->password')";

                if ($this->mysqli->query($query))
                    $this->id = $this->mysqli->insert_id;

            } else
                $this->id = -1;

            $this->mysqli->close();
        }
    }

    /**
     * Receiving user data
     * @param $phone
     * @param $password
     * @return bool
     */
    function getUser($phone, $password)
    {
        $this->mysqli = $this->getMysqli();

        if (!$this->mysqli->connect_errno) {
            $query = "SELECT
                    `id`,
                    `name`,
                    `email`,
                    `password`,
                    `image`
                    FROM `users` WHERE `phone` = '$phone'";

            if ($result = $this->mysqli->query($query)) {
                if ($result->num_rows) {
                    $user = $result->fetch_assoc();

                    if (password_verify($password, $user['password'])) {
                        $this->id = $user['id'];
                        $this->name = $user['name'];
                        $this->email = $user['email'];
                        $this->phone = $phone;
                        $this->image = $user['image'];
                    }
                }

                $result->close();
            }

            $this->mysqli->close();
        }

        return ($this->id) ? true : false;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param null $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param null $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param null $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @param null $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}