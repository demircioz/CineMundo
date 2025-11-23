<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('UserData');
        $this->load->model('TVShowData');
        $this->load->model('RatingData');
    }

    public function index() : void {
        $tvShowsByPrefix = $this->TVShowData->searchTvShowsByPrefix($this->input->post('prefix') ?? "");
        $tvShowsByGenre  = $this->TVShowData->searchTvShowsByGenre($this->input->post('genre') ?? 0);

        $validTvShows = [];
        foreach ($tvShowsByPrefix as $tvShow) {
            if (in_array($tvShow, $tvShowsByGenre)) {
                $validTvShows[] = $tvShow;
            }
        }

        $this->load->view('header', ['user' => $this->UserData->getSessionUser()]);
        $this->load->view('home', [
            'tvShows' => $validTvShows,
            'genres'  => $this->TVShowData->getAllGenres(),
        ]);
        $this->load->view('footer');
        $this->load->view('back_button');
    }

    public function sort(string $sort, string $order) : void {
        $tvShows = match ($sort) {
            'alpha' => $this->TVShowData->getTvShowsOrderedByName(),
            'seasons' => $this->TVShowData->getTvShowOrderedByNumberOfSeasons()
        };

        $tvShows = $order === 'asc' ? $tvShows : array_reverse($tvShows);
        $nextOrder = $order === 'asc' ? 'desc' : 'asc';

        $this->load->view('header', ['user' => $this->UserData->getSessionUser()]);
        $this->load->view('home', [
            'tvShows' => $tvShows,
            'genres'  => $this->TVShowData->getAllGenres(),
            'sort' =>  $sort,
            'order' => $nextOrder
        ]);
        $this->load->view('footer');
        $this->load->view('back_button');
    }
}
