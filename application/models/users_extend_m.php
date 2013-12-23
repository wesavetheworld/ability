<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-12-19
 * Time: 下午3:35
 */
class Users_extend_m extends CI_Model {
    public $user_id;
    public $token;
    public $create_date;
    private $table_name = 'pending';

    public function add_pending () {
        $this->_random_token();
        $data = array("user_id"=>$this->user_id, "token"=>$this->token);
        return $this->db->insert($this->table_name, $data) ? $this->token : false;
    }

    public function get_pending_info_by_token ($token) {
        $data = array("token"=>$token, "user_id"=>$this->user_id);
        $query = $this->db->get_where($this->second_table, $data);
        return $query->num_rows() > 0 ? $query->row() : false;
    }

    public function get_user_token ($user_id) {

        $data = array(
            "user_id" => $user_id
        );
        $this->db->where($data);
        $this->db->from($this->table_name);

        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->row(0, "Users_extend_m") : false;

    }
    private function _random_token () {
        $this->load->helper('string');
        $this->token = random_string('alnum', 5);
    }


}