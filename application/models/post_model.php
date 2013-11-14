<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-6
 * Time: 下午5:40
 */
class Post_model extends CI_Model {

    private $table_name = "posts";

    public function add ($post_data) {
        if (empty($post_data) || !$post_data['title']) {
            return false;
        }
        $data = array(
            "post_title" => $post_data['title'],
            "post_content" => $post_data['content'],
            'aid' => $this->sessionmanage->get_user_id(),
            "post_date" => date("Y-m-d H:i:s", time())
        );

        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function get_all () {
        $query = $this->db->get($this->table_name);
        return $query -> result();
    }

    public function get_post_info_by_id ($pid) {
        $data = array ("id"=>$pid);
        $query = $this->db->get_where($this->table_name, $data);
        return $query->num_rows() > 0 ? $query->row() : null;
    }
}