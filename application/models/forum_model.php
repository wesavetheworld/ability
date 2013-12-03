<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-11
 * Time: 下午4:46
 */
class Forum_model extends CI_Model {
    public $forum_id;
    public $forum_name;
    public $discription;
    public $image;

    private $table_name = 'forum';

    public function set_forum_id ($id) {
        $this->forum_id = $id;
    }

    public function get_forum_id () {
        return $this->forum_id;
    }

    public function add_forum () {
        $this->db->insert($this->table_name, $this);
        return $this->db->insert_id();
    }

    public function get_forum ($fid) {

        $query = $this->db->get_where($this->table_name, array("forum_id" => $fid));
        return $query->num_rows() > 0 ? $query->row(0,"forum_model") : null;
    }
    public function get_all_forums() {
        $query = $this->db->get($this->table_name);
        return $query->result("forum_model");
    }

}