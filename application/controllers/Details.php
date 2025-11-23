<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Details extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('TVShowData');
        $this->load->model('UserData');
        $this->load->model('RatingData');
        $this->load->helper('url');
    }

    public function tvshow(?int $tvShowId = null) : void {
        if ($tvShowId === null) {
            redirect(site_url());
        }
        $tvshow = $this->TVShowData->getTvShowById($tvShowId);
        if (!$tvshow) {
            show_404();
            return;
        }
        $seasons = $tvshow->getSeasons();
        $user = $this->UserData->getSessionUser();

        $ratings = $this->RatingData->getTvShowRatings($tvshow->getId());
        $ratingsData = [];
        foreach ($ratings as $rating) {
            $ratingsData[] = [
                'rating' => $rating,
                'user'   => $this->RatingData->getRatingOwnerById($rating)
            ];
        }

        $this->load->view('header', ['user' => $user]);
        $this->load->view('tvshow_details', [
            'tvshow'      => $tvshow,
            'seasons'     => $seasons,
            'ratingsData' => $ratingsData,
            'user' => $this->UserData->getSessionUser()
        ]);
        $this->load->view('footer');
        $this->load->view('back_button');
    }

    public function season(?int $seasonId = null) : void {
        if ($seasonId === null) {
            redirect(site_url());
        }

        $found = null;
        foreach ($this->TVShowData->getAllTvShows() as $tv) {
            foreach ($tv->getSeasons() as $s) {
                if ($s->getId() === (int)$seasonId) {
                    $found = [
                        'season' => $s,
                        'tvshow' => $tv
                    ];
                    break 2;
                }
            }
        }
        if (!$found) {
            show_404();
            return;
        }

        $season = $found['season'];
        $tvshow = $found['tvshow'];

        $ratings = $this->RatingData->getSeasonRatings($seasonId);
        $ratingsData = [];
        foreach ($ratings as $rating) {
            $ratingsData[] = [
                'rating' => $rating,
                'user'   => $this->RatingData->getRatingOwnerById($rating)
            ];
        }

        $this->load->view('header', ['user' => $this->UserData->getSessionUser()]);
        $this->load->view('season_details', [
            'season'      => $season,
            'tvshow'      => $tvshow,
            'ratingsData' => $ratingsData,
            'user' => $this->UserData->getSessionUser()
        ]);
        $this->load->view('footer');
        $this->load->view('back_button');
    }

    public function comment() : void {
        $tvShowId = $this->input->post('tvShowId');
        $seasonId = $this->input->post('seasonId');
        $userId   = $this->UserData->getSessionUser()->getId();
        $score    = $this->input->post('score');
        $comment  = $this->input->post('comment');

        $this->RatingData->addRating($tvShowId, $seasonId, $userId, $score, $comment);

        if ($tvShowId !== null) {
            redirect(site_url('details/tvshow/' . $tvShowId));
        } else {
            redirect(site_url('details/season/' . $seasonId));
        }
    }
}
