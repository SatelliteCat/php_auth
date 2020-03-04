<?php

namespace src\models;

class User extends BaseModel implements \Serializable
{
    private $id = NULL;
    private $name = NULL;
    private $email = NULL;
    private $phone = NULL;
    private $password = NULL;
    private $image = NULL;

    private $pdo;

    /**
     * New user registration
     *
     * Upon successful creation, the user will have an id
     * Else id = -1
     */
    public function create()
    {
        $this->pdo = $this->getPdo();
        $stmt = $this->pdo->prepare("SELECT NOT EXISTS (SELECT id FROM users WHERE phone = ?)");
        $stmt->execute([$this->phone]);
        $res = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (current($res)) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare("INSERT INTO users (name, email, phone, image, password) 
                    VALUES (:name, :email, :phone, :image, :password)");
            $params = [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'image' => $this->image,
                'password' => $this->password
            ];
            if ($stmt->execute($params)) {
                $lastId = $this->pdo->lastInsertId();

                if ($lastId)
                    $this->id = $lastId;
            }
        } else {
            $this->id = -1;
        }

        return ($this->id > 0) ? true : false;
    }

    /**
     * Receiving user data
     * @param $phone
     * @param $password
     * @return bool
     */
    public function getUser($phone, $password)
    {
        $this->pdo = $this->getPdo();
        $stmt = $this->pdo->prepare("SELECT id, name, email, password, image FROM users WHERE phone = ?");
        $stmt->execute([$phone]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            if (password_verify($password, $result['password'])) {
                $this->id = $result['id'];
                $this->name = $result['name'];
                $this->email = $result['email'];
                $this->phone = $phone;
                $this->image = $result['image'];
            }
        }

        return ($this->id) ? true : false;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize([$this->id, $this->name, $this->email, $this->phone, $this->image]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $this->id = unserialize($serialized)[0];
        $this->name = unserialize($serialized)[1];
        $this->email = unserialize($serialized)[2];
        $this->phone = unserialize($serialized)[3];
        $this->image = unserialize($serialized)[4];
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