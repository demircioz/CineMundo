<?php

class CustomError {

    public const USERNAME_ALREADY_TAKEN = 0;
    public const ALREADY_AN_ACCOUNT = 1;
    public const NO_ACCOUNT_FOUND = 2;
    public const INVALID_PASSWORD = 3;

    private int $id;

    public function __construct(int $id) {
        $this->id = $id;
    }

    public function getMessage(): string {
        return match ($this->id) {
            self::USERNAME_ALREADY_TAKEN => "This username is already taken",
            self::ALREADY_AN_ACCOUNT => "An account already exists with that email address.",
            self::NO_ACCOUNT_FOUND => "No account found with that email address.",
            self::INVALID_PASSWORD => "Invalid password.",
        };
    }
}