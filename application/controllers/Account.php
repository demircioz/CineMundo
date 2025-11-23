<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . "models/errors/CustomError.php");

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserData');
    }

    public function create() : void {
        if (count($this->input->post()) == 0) {
            $this->loadViews(['register']);
            return;
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $username = $this->input->post('username');

        if($this->UserData->userExistsWithEmail($email)) {
            $this->loadViews(['register' => ['error' => new CustomError(CustomError::ALREADY_AN_ACCOUNT)]]);
            return;
        }

        if($this->UserData->userExistsWithUsername($username)) {
            $this->loadViews(['register' => ['error' => new CustomError(CustomError::USERNAME_ALREADY_TAKEN)]]);
            return;
        }

        $this->UserData->createAccount($email, $password, $username);
        redirect(site_url());
    }

    public function login() : void {
        if (count($this->input->post()) == 0) {
            $this->loadViews(['login']);
            return;
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if(!$this->UserData->userExistsWithEmail($email)) {
            $this->loadViews(['login' => ['error' =>  new CustomError(CustomError::NO_ACCOUNT_FOUND)]]);
            return;
        }

        if(!$this->UserData->loginAccount($email, $password)) {
            $this->loadViews(['login' => ['error' =>  new CustomError(CustomError::INVALID_PASSWORD)]]);
            return;
        }

        redirect(site_url());
    }

    public function disconnect() : void {
        $this->UserData->disconnectSession();
        redirect(site_url());
    }

    public function index(): void {
        $user = $this->UserData->getSessionUser();

        if($user != null) {
            $this->loadViews([
                'account' => ['user' => $user],
            ]);
            return;
        }

        redirect(site_url('account/login'));
    }

    /**
     * Load views with optional data.
     * Accepts:
     *   - ['view_name']                 → loads view_name.php without data
     *   - ['view_name' => $dataArray]  → loads view_name.php with data
     */
    private function loadViews(array $views) : void {
        $this->load->view('header', ['user' => $this->UserData->getSessionUser()]);

        foreach ($views as $key => $value) {
            if (is_int($key)) {
                $this->load->view($value);
            } else {
                $this->load->view($key, $value);
            }
        }

        $this->load->view('footer');
        $this->load->view('back_button');
    }
}
