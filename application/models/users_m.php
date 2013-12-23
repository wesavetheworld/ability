<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-2
 * Time: 下午3:44
 */
class Users_m extends CI_Model {

    public  $id;
    public  $username;
    public  $password;
    public  $email;
    public  $is_active;
    public  $permission;
    public  $blog;
    public  $contact;
    public  $introduction;
    private $table_name = 'users';

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_extend_m');
    }

    public function set_user_id ($user_id) {
        if (!$user_id) {
            return false;
        }
        $this->id = $user_id;
    }

    public function add_user () {
        $this->db->insert($this->table_name, $this);
        return $this->db->insert_id();
    }

    public function get_user_info_by_id ($user_id) {
        $data = array(
            "id" => $user_id
        );
        $this->db->where($data);
        $this->db->from($this->table_name);

        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->row(0, "Users_m") : false;
    }

    public function get_user_info_by_name ($user_name) {
        $data = array(
            "username" => $user_name
        );
        $this->db->where($data);
        $this->db->from($this->table_name);

        $query = $this->db->get();

        return $query->num_rows() > 0 ? $query->row(0, "Users_m") : false;
    }

    public function update () {
        $this->db->where("id", $this->id);
        return $this->db->update($this->table_name, $this);
    }

    public function get_user_token () {
        $extend = $this->users_extend_m->get_user_token($this->id);
        return $extend ? $extend->token : "";
    }
    public function del_pending_by_token ($token) {
        $data = array("token"=>$token, "user_id"=>$this->user_id);
        return $this->db->delete($this->second_table, $data);
    }

    public function save () {
        if ($this->id <= 0) {
            $this->id = $this->add_user();
            return $this->id  > 0 ? true : false;

        } else {
            return $this->update();
        }
    }

    public function set_out_active () {
        $this->is_active = 0;
        if ($this->save()) {
            $this->users_extend_m->user_id = $this->id;
            return $this->users_extend_m->add_pending();
        }
        return false;
    }

    public function set_active () {
        $this->is_active = 1;
        return $this->save();
    }

    public function set_password ($password) {
        $this->password = md5($password);
    }
    public function get_users ($limit = 0, $offset = 0, $where = array(), $order_by = 'id desc') {
        if (!empty ($where)) {
            $this->db->where($where);
        }
        $this->db->order_by($order_by);

        if ($limit >=0 && $offset >= 0) {
            $this->db->limit($limit, $offset);
        }
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->result('Users_m') : false;
    }

    public function count_of_users ($where = array()) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->from ($this->table_name);
        return $this->db->count_all_results();
    }
}