<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-11
 * Time: 下午4:53
 */
class Forums {
    private $CI = null;
    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model("forum_model");
        $this->CI->load->model("message_model");
    }

    public function add_forum ($data) {
        $this->CI->forum_model->forum_name = $data['forum_name'];
        $this->CI->forum_model->discription = $data['forum_desc'];
        return $this->CI->forum_model->add_forum();
    }

    public function get_forum ($fid) {
        if ($fid <= 0) {
            return false;
        }
        return $this->CI->forum_model->get_forum($fid);
    }

    public function get_forums () {
        return $this->CI->forum_model->get_all_forums();
    }

    public function add_message($data) {
        $this->CI->message_model->parent_id = $data['parent_id'];
        $this->CI->message_model->forum_id = $data['forum_id'];
        $this->CI->message_model->user_id = $data['user_id'];
        $this->CI->message_model->subject = $data['subject'];
        $this->CI->message_model->msg_text = $data['msg_text'];
        $this->CI->message_model->msg_date = date("Y-m-d H:i:s");
        return $this->CI->message_model->add_message();
    }
    public function get_message ($mid) {
        $mid = (int) $mid;

        return $this->CI->message_model->get_message($mid);
    }

    public function get_messages_by_forum_id ($fid) {
        if ($fid <= 0) {
            return false;
        }

        return  $this->CI->message_model->get_messages_by_forum_id ($fid);

    }

    public function get_messages($start = 0, $offset = 20) {
        return $this->CI->message_model->get_messages($start, $offset);
    }

}