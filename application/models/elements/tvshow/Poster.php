<?php

class Poster {

    public int $id;
    public string $jpeg;

    public function getId(): int {
        return $this->id;
    }

    public function getImage(): string {
        return $this->jpeg;
    }
}
