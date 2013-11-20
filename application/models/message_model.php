<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-11
 * Time: 下午10:18
 */
class Message_model extends CI_Model {
    public $msg_id;
    public $parent_id = 0;
    public $forum_id = 0;
    public $user_id = 0;
    public $subject = '';
    public $msg_text = '';
    public $msg_date = '';

    private $table_name = 'forum_message';

    public function get_message($mid) {
        $query = $this->db->get_where($this->table_name, array('msg_id'=>$mid));
        return $query->num_rows() > 0 ? $query->row("message_model") : false;
    }

    public function add_message() {
        $this->db->insert($this->table_name, $this);
        return $this->db->insert_id();
    }

    public function update_message() {
        $this->db->where('msg_id', $this->msg_id);
        return $this->db->update($this->table_name, $this);
    }

    public function save() {
        if ($this->msg_id > 0) {
            return $this->update_message() ? $this->msg_id : false;
        } else {
            return $this->add_message();
        }
    }

    public function get_messages_by_forum_id ($fid) {
        $this->db->where ("forum_id", $fid);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    public function get_messages ($start = 0, $offset = 20) {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->join('forum', 'forum.forum_id = '.$this->table_name.'.forum_id');

        $query = $this->db->get();
        return $query->result('message_model');
    }
}