<?php

class User
{
    private int $id;
    private string $username;
    private string $password;
    private string $last_connection;

    public function __construct($id = 0, $username = "test", $password = "default_password", $last_connection = "now XD")
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->last_connection = $last_connection;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getLastConnection(): string
    {
        return $this->last_connection;
    }

    public function setLastConnection(string $last_connection): void
    {
        $this->last_connection = $last_connection;
    }
}