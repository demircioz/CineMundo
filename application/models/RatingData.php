<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'models/elements/Rating.php');
require_once(APPPATH . 'models/elements/tvshow/TVShow.php');
require_once(APPPATH . 'models/elements/user/User.php');

class RatingData extends CI_Model
{

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->dbforge();

        $this->initTable();
    }

    private function initTable(): void {
        if ($this->db->table_exists('rating')) return;

        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'tvShowId' => [
                'type' => 'INT',
                'null' => true,
            ],
            'seasonId' => [
                'type' => 'INT',
                'null' => true,
            ],
            'userId' => [
                'type' => 'INT',
                'null' => false,
            ],
            'score' => [
                'type' => 'INT',
                'null' => false,
            ],
            'comment' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'date' => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => 'CURRENT_TIMESTAMP',

            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('rating');
    }

    /**
     * @return Rating[]
     */
    public function getAllRatings(): array {
        return $this->db->get('rating')->result('Rating');
    }

    /**
     * @param int $id
     * @return Rating[]
     */
    public function getTvShowRatings(int $id): array {
        return $this->db->get_where('rating', ['tvShowId' => $id])->result('Rating');
    }

    /**
     * @param int $id
     * @return Rating[]
     */
    public function getSeasonRatings(int $id): array {
        return $this->db->get_where('rating', ['seasonId' => $id])->result('Rating');
    }

    public function getRatingOwnerById(Rating $rating): ?User {
        return $this->db->select('user.*')
            ->from('user')
            ->join('rating', 'rating.userId = user.id')
            ->where('rating.id', $rating->getId())
            ->get()->result('User')[0] ?? null;
    }

    public function addRating(?int $tvShowId, ?int $seasonId, int $userId, int $score, string $comment): void {
        $this->db->insert('rating', [
            'tvShowId' => $tvShowId,
            'seasonId' => $seasonId,
            'userId' => $userId,
            'score' => $score,
            'comment' => $comment
        ]);
    }
}