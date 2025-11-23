<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notices extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserData');
    }

    public function index() : void {
        $this->load->view('header', ['user' => $this->UserData->getSessionUser()]);
        $this->load->view('legal_notices');
        $this->load->view('footer');
    }
}