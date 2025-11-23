<?php

require_once(APPPATH . "models/elements/Rating.php");

class TVShow {

    private int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    private ?int $posterId;

    /**
     * @var Season[]
     */
    private array $seasons;
    private ?Poster $poster = null;
    private ?Genre $genre = null;

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getOriginalName(): string {
        return $this->originalName;
    }

    public function getHomePage(): string {
        return $this->homepage;
    }

    public function getOverview(): string {
        return $this->overview;
    }

    public function getPosterId(): ?int {
        return $this->posterId;
    }

    /**
     * @return Season[]
     */
    public function getSeasons(): array {
        return $this->seasons;
    }

    /**
     * @param Season[] $seasons
     * @return void
     */
    public function setSeasons(array $seasons): void {
        $this->seasons = $seasons;

        usort($this->seasons, function ($a, $b) {
            return $a->getSeasonNumber() <=> $b->getSeasonNumber();
        });
    }

    public function getPoster(): ?Poster {
        return $this->poster;
    }

    public function setPoster(?Poster $poster): void {
        $this->poster = $poster;
    }

    public function getGenre(): ?Genre {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): void {
        $this->genre = $genre;
    }
}