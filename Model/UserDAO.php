<?php

class UserDAO
{
    private PDO $db;


    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=blog',
                'itiz_mtti', 'password');
        } catch(Exception $e) {
            die('Error : '.$e->getMessage());
        }
    }

    public function connectUser($username, $password) : bool
    {
        $sql = 'SELECT * FROM users WHERE username = ?';
        $req = $this->db->prepare($sql);
        $req->execute([$username]);

        $userData = $req->fetch();

        if (!$userData)
        {
            echo 'this user doesnt exist';
        }
        else
        {
            if($userData['password'] == $password)
            {
                $sql = 'UPDATE users SET last_connection = NOW() WHERE username = ?';
                $req = $this->db->prepare($sql);
                $req->execute([$username]);

                $_SESSION['id'] = $userData['id'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['last_connection'] = $userData['last_connection'];
                $_SESSION['connected'] = true;

                return true;
            }
        }
        return false;
    }

    public function getByID(int $id) : User
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $req = $this->db->prepare($sql);
        $req->execute([$id]);
        $userData = $req->fetch();

        return new User($userData['id'], $userData['username'], $userData['password'], $userData['last_connection']);
    }

    public function getAll() : array
    {
        $sql = "SELECT * FROM users";
        $req = $this->db->prepare($sql);
        $req->execute();

        $userArray = [];
        while ($userData = $req->fetch())
        {
            $userArray[] += new User($userData['id'], $userData['username'], $userData['password'], $userData['last_connection']);
        }
        return $userArray;
    }

    public function create(User $user) : void
    {
        $sql = "INSERT INTO users VALUES(:id, :username, :password, :last_connection)";
        $req = $this->db->prepare($sql);
        $req->execute(['id' => $user->id, 'username' => $user->username, 'password' => $user->password,
            'last_connection' => $user->last_connection]);
    }

    public function update(int $id, User $user) : void
    {
        $sql = "UPDATE users SET id = :new_id, username = :username, password = :password, last_connection = :last_connection
WHERE id = :old_id";
        $req = $this->db->prepare($sql);
        $req->execute(['old_id' => $id,'new_id' => $user->id, 'username' => $user->username, 'password' => $user->password,
            'last_connection' => $user->last_connection]);
    }

    public function delete(int $id) : void
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $req = $this->db->prepare($sql);
        $req->execute([$id]);
    }
}