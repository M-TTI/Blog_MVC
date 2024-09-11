<?php

class User
{
    private int $id;
    private string $username;
    private string $password;
    private string $last_connection;

    public function __construct(
        $id = 0,
        $username = "test",
        $password = "default_password",
        $last_connection = "now XD")
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->last_connection = $last_connection;
    }

    public function __get($attr): string
    {
        switch($attr)
        {
            case 'id':
                return $this->id;
            case 'username':
                return $this->username;
            case 'password':
                return $this->password;
            case 'last_connection':
                return $this->last_connection;
            default:
                die('Error, no attribute named '.$attr);
        }
    }

    public function __set(string $attr, string $value): void
    {
        switch($attr)
        {
            case 'id':
                $this->id = $value;
                break;
            case 'username':
                $this->username = $value;
                break;
            case 'password':
                $this->password = $value;
                break;
            case 'last_connection':
                $this->last_connection = $value;
                break;
            default:
                die('Error, no attribute named '.$attr);
        }
    }

    public function __toString(): string
    {
        return "User id : ".$this->id.
            "\nusername : ".$this->username.
            "\npassword : ".$this->password.
            "\nlast_connection".$this->last_connection."\n";
    }
}