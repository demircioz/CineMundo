<?php

class Rating
{

    private int $id;
    private ?int $tvShowId;
    private ?int $seasonId;
    private int $userId;
    private int $score;
    private string $comment;
    private string $date;

    public function getId(): int {
        return $this->id;
    }

    public function getTvShowId(): ?int {
        return $this->tvShowId;
    }

    public function getSeasonId(): ?int {
        return $this->seasonId;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function getScore(): int {
        return $this->score;
    }

    public function getComment(): string {
        return $this->comment;
    }

    public function getDate(): string {
        return (new DateTime($this->date))->format('d-m-Y H:i');
    }
}