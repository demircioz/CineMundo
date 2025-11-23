<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'models/elements/tvshow/TVShow.php');
require_once(APPPATH . 'models/elements/tvshow/Season.php');
require_once(APPPATH . 'models/elements/tvshow/Episode.php');
require_once(APPPATH . 'models/elements/tvshow/Poster.php');
require_once(APPPATH . 'models/elements/tvshow/Genre.php');


/**
 * Class TVShowData
 *
 * Model handling retrieval and mapping of TV show data in CodeIgniter 3.
 *
 * Responsibilities:
 *  - Fetch all TV shows or a single show by its identifier.
 *  - Search shows by name prefix.
 *  - Retrieve related seasons, episodes, posters, and genre information.
 *
 * @package     Application\Models
 * @subpackage  TVShowData
 */
class TVShowData extends CI_Model {

    /**
     * @var TVShow[]
     */
    private array $tvShowData = [];

    /**
     * TVShowData constructor.
     *
     * Loads the database connection.
     */
    public function __construct() {
        parent::__construct();

        $this->load->database();

        $this->initTable();
    }

    private function initTable(): void {
        $tvShows = $this->db->get("tvshow")->result('TVShow');
        $seasons = $this->db->get("season")->result('Season');
        $episodes = $this->db->get("episode")->result('Episode');
        $posters = $this->db->get("poster")->result('Poster');
        $genres = $this->db->get("genre")->result('Genre');
        $tvShowGenres = $this->db->get("tvshow_genre")->result('array');

        foreach ($tvShows as $tvShow) {
            $tvShowSeasons = [];
            foreach ($seasons as $season) {
                if ($tvShow->getId() === $season->getTvShowId()) $tvShowSeasons[] = $season;
            }

            foreach ($tvShowSeasons as $tvShowSeason) {
                $seasonEpisodes = [];
                foreach ($episodes as $episode) {
                    if ($tvShowSeason->getId() === $episode->getSeasonId()) $seasonEpisodes[] = $episode;
                }

                $tvShowSeason->setEpisodes($seasonEpisodes);

                foreach ($posters as $poster) {
                    if ($poster->getId() === $tvShowSeason->getPosterId()) {
                        $tvShowSeason->setPoster($poster);
                        break;
                    }
                }
            }

            foreach ($posters as $poster) {
                if ($tvShow->getPosterId() === $poster->getId()) {
                    $tvShow->setPoster($poster);
                    break;
                }
            }

            foreach ($tvShowGenres as $tvShowGenre) {
                foreach ($genres as $genre) {
                    if ((int)$tvShowGenre['genreId'] == $genre->getId() && (int)$tvShowGenre['tvShowId'] === $tvShow->getId()) {
                        $tvShow->setGenre($genre);
                        break;
                    }
                }

                if ($tvShow->getGenre() !== null) break;
            }

            $tvShow->setSeasons($tvShowSeasons);
        }

        $this->tvShowData = $tvShows;
    }

    /**
     * Get all TV shows from the database.
     *
     * @return TVShow[] List of Details objects.
     */
    public function getAllTvShows(): array {
        return $this->tvShowData;
    }

    /**
     * Get a TV show by its ID.
     * Returns null if no TV show is found.
     *
     * @param int $id ID of the TV show.
     * @return TVShow|null Details object or null.
     */
    public function getTvShowById(int $id): ?TVShow {
        foreach ($this->tvShowData as $tvShow) {
            if ($tvShow->getId() === $id) return $tvShow;
        }

        return null;
    }

    /**
     * Searches for TV shows whose names start with the given prefix.
     *
     * @param string $prefix The prefix to search for.
     * @return TVShow[] An array of Details objects matching the prefix.
     */
    public function searchTvShowsByPrefix(string $prefix): array {
        $searchedTvShows = [];
        foreach ($this->tvShowData as $tvShow) {
            if (str_contains(strtolower($tvShow->getName()), strtolower($prefix))) $searchedTvShows[] = $tvShow;
        }

        return $searchedTvShows;
    }

    public function searchTvShowsByGenre(int $genreId): array {
        if ($genreId == 0) return $this->tvShowData;

        $searchedTvShows = [];
        foreach ($this->tvShowData as $tvShow) {
            if ($tvShow->getGenre()?->getId() === $genreId) $searchedTvShows[] = $tvShow;
        }

        return $searchedTvShows;
    }

    public function getAllGenres(): array {
        return $this->db->get('genre')->result('Genre');
    }

    public function getGenreById(int $id): ?Genre {
        return $this->db->get_where("genre", ['id' => $id])->result('Genre')[0] ?? null;
    }

    public function getTvShowsOrderedByName() : array {
        usort($this->tvShowData, function ($a, $b) {
            return $a->getName() <=> $b->getName();
        });

        return $this->tvShowData;
    }

    public function getTvShowOrderedByNumberOfSeasons() : array {
        usort($this->tvShowData, function ($a, $b) {
            return count($a->getSeasons()) <=> count($b->getSeasons());
        });

        return $this->tvShowData;
    }
}
