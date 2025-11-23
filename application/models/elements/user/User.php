<?php

require_once(APPPATH . "models/elements/Rating.php");

class User {

    private int $id;
    private string $email;
    private string $password;
    private string $username;
    private string $date;

    public function getId(): int {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getCreatedDate(): string {
        return (new DateTime($this->date))->format('d-m-Y H:i');
    }
}