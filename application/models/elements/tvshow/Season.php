<?php

class Season {

    private int $id;
    private int $tvShowId;
    private string $name;
    private int $seasonNumber;
    private ?int $posterId;

    /**
     * @var Episode[]
     */
    private array $episodes;
    private ?Poster $poster = null;


    public function getId(): int {
        return $this->id;
    }

    public function getTvShowId(): int {
        return $this->tvShowId;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSeasonNumber(): int {
        return $this->seasonNumber;
    }

    public function getPosterId(): ?int {
        return $this->posterId;
    }

    /**
     * @return Episode[]
     */
    public function getEpisodes(): array {
        return $this->episodes;
    }

    /**
     * @param Episode[] $episodes
     * @return void
     */
    public function setEpisodes(array $episodes): void {
        $this->episodes = $episodes;

        usort($this->episodes, function ($a, $b) {
            return $a->getEpisodeNumber() <=> $b->getEpisodeNumber();
        });
    }

    public function getPoster(): ?Poster {
        return $this->poster;
    }

    public function setPoster(?Poster $poster): void {
        $this->poster = $poster;
    }
}   