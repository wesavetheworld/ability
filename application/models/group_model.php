<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-19
 * Time: 上午9:46
 */
class Group_model extends CI_Model {
    public $group_id;
    public $group_name;
    public $permission;
    public $is_valid = 1;

    private $table_name = 'user_groups';

    public function get_all() {
        $query = $this->db->get($this->table_name);
        return $query->result("group_model");
    }

    public function add () {
        $this->db->insert($this->table_name, $this);
        return $this->db->insert_id();
    }
}