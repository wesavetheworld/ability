<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-2
 * Time: 下午3:44
 */
class Users_model extends CI_Model {

    public  $user_id;
    public  $username = "";
    public  $password = "";
    public  $email = "";
    public  $is_active = 0;
    public  $permission = 0;
    private $table_name = 'users';
    private $second_table = 'pending';

    function __construct()
    {
        parent::__construct();
    }

    public function set_user_id ($user_id) {
        if (!$user_id) {
            return false;
        }
        $this->user_id = $user_id;
    }

    public function add_user () {
        $this->db->insert($this->table_name, $this);
        return $this->db->insert_id();
    }

    public function get_user_info_by_id ($user_id) {
        $data = array(
            "id" => $user_id
        );
        $query = $this->db->get_where($this->table_name, $data);
        return $query->num_rows() > 0 ? $query->row() : false;
    }

    public function get_user_info_by_name ($user_name) {
        $data = array(
            "username" => $user_name
        );
        $query = $this->db->get_where($this->table_name, $data);
        return $query->num_rows() > 0 ? $query->row() : false;
    }

    public function update () {
        $this->db->where("id", $this->user_id);
        return $this->db->update($this->table_name, $this);
    }

    public function add_pending () {
        $this->load->helper('string');
        $token = random_string('alnum', 5);
        $data = array("user_id"=>$this->user_id, "token"=>$token);
        return $this->db->insert($this->second_table, $data) ? $token : false;
    }

    public function get_pending_info_by_token ($token) {
        $data = array("token"=>$token, "user_id"=>$this->user_id);
        $query = $this->db->get_where($this->second_table, $data);
        return $query->num_rows() > 0 ? $query->row() : false;
    }

    public function del_pending_by_token ($token) {
        $data = array("token"=>$token, "user_id"=>$this->user_id);
        return $this->db->delete($this->second_table, $data);
    }

    public function save () {
        if ($this->user_id <= 0) {
            $this->user_id = $this->add_user();
            return $this->user_id  > 0 ? true : false;

        } else {
            return $this->update();
        }
    }

    public function set_out_active () {
        $this->is_active = 0;
        if ($this->save()) {
            return $this->add_pending();
        }
        return false;
    }

    public function set_active ($token) {
        if ($this->get_pending_info_by_token($token)) {
            if ($this->del_pending_by_token($token)) {
                $this->is_active = 1;
                return $this->save();
            }
        }
        return false;
    }

    public function set_password ($password) {
        $this->password = md5($password);
    }

}