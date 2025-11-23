<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'models/elements/user/User.php');

/**
 * Class UserData
 *
 * Model responsible for user management and session handling in CodeIgniter 3.
 *
 * - Ensures the `user` table exists, creating it if necessary.
 * - Registers new users with hashed passwords.
 * - Authenticates users and manages their session data.
 *
 * @package     Application\Models
 * @subpackage  UserData
 */
class UserData extends CI_Model {
    /**
     * UserData constructor.
     * Loads the session library, database and database_forge, then initializes the `user` table.
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('session');

        $this->load->database();
        $this->load->dbforge();

        $this->initTable();
    }

    /**
     * Initializes the `user` table schema using DB Forge if it does not already exist.
     *
     * This method checks for the presence of the `user` table and,
     * if absent, defines the fields and primary key before creating it.
     *
     * Fields:
     *  - email     VARCHAR(254) PRIMARY KEY
     *  - password  VARCHAR(72) NOT NULL
     *  - username  VARCHAR(16) NOT NULL UNIQUE
     *
     * @return void
     */
    private function initTable(): void {
        if ($this->db->table_exists('user')) return;

        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 254,
                'unique' => true,
                'null' => false
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 72,
                'null' => false,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
                'unique' => true,
                'null' => false,
            ],
            'date' => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => 'CURRENT_TIMESTAMP',
            ]
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user');
    }

    /**
     * Creates a new user account.
     *
     * Hashes the password, inserts user data into the database,
     * and stores the User object in the session under 'user_data'.
     *
     * @param string $email User's email address.
     * @param string $password Plain-text password provided by the user.
     * @param string $username Unique username.
     * @return bool             TRUE on successful insertion, FALSE otherwise.
     */
    public function createAccount(string $email, string $password, string $username): bool {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->db->insert('user', [
            'email' => $email,
            'password' => $password,
            'username' => $username
        ]);

        if ($query) {
            $this->session->set_userdata('user_id', $this->db->insert_id());
        }

        return $query;
    }

    public function userExistsWithEmail(string $email): bool {
        return count($this->db->get_where('user', ['email' => $email])->result()) > 0;
    }

    public function userExistsWithUsername(string $username): bool {
        return count($this->db->get_where('user', ['username' => $username])->result()) > 0;
    }

    /**
     * Authenticates an existing user.
     *
     * Retrieves the user by email, verifies the password,
     * and stores the User object in the session on success.
     *
     * @param string $email User's email address.
     * @param string $password Plain-text password to verify.
     * @return bool             TRUE on successful authentication, FALSE otherwise.
     */
    public function loginAccount(string $email, string $password): bool {
        $query = $this->db->get_where('user', ['email' => $email])->result('User');
        if (!password_verify($password, ($user = $query[0])->getPassword())) return false;

        $this->session->set_userdata('user_id', $user->getId());

        return true;
    }

    /**
     * Retrieves the current user from the session.
     *
     * @return User|null       User object stored in session, or NULL if no user is logged in.
     */
    public function getSessionUser(): ?User {
        return $this->db->get_where('user', ['id' => $this->session->userdata('user_id')])->result('User')[0] ?? null;
    }

    /**
     * Logs out the current user by destroying the session.
     *
     * All session data is removed and the session cookie is invalidated.
     *
     * @return void
     */
    public function disconnectSession(): void {
        $this->session->sess_destroy();
    }
}
