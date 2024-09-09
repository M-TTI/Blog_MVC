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

        $user = $req->fetch();

        if (!$user)
        {
            echo 'this user doesnt exist';
        }
        else
        {
            if($user['password'] == $password)
            {
                $sql = 'UPDATE users SET last_connection = NOW() WHERE username = ?';
                $req = $this->db->prepare($sql);
                $req->execute([$username]);

                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['last_connection'] = $user['last_connection'];

                return true;
            }
        }
        return false;
    }
}