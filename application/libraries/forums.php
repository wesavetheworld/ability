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
        $this->CI->load->model("message_m");
    }

    public function add_forum ($data) {
        $this->CI->forum_model->forum_name = $data['forum_name'];
        $this->CI->forum_model->discription = $data['forum_desc'];
        $this->CI->forum_model->image = $data['image'];
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
        $this->CI->message_m->parent_id = $data['parent_id'];
        $this->CI->message_m->forum_id = $data['forum_id'];
        $this->CI->message_m->user_id = $data['user_id'];
        $this->CI->message_m->subject = $data['subject'];
        $this->CI->message_m->msg_text = $data['msg_text'];
        $this->CI->message_m->msg_date = date("Y-m-d H:i:s");
        return $this->CI->message_m->add_message();
    }
    public function get_message ($mid) {
        $mid = (int) $mid;

        return $this->CI->message_m->get_message($mid);
    }

    public function get_messages_by_forum_id ($fid) {
        if ($fid <= 0) {
            return false;
        }

        return  $this->CI->message_m->get_messages_by_forum_id ($fid);

    }

    public function get_messages($start = 0, $offset = 20) {
        return $this->CI->message_m->get_messages($start, $offset);
    }

    /*
     * 访问次数添加
     */
    public function view_add ($msg_id) {
        $model = $this->get_message($msg_id);
        return $model->add_view_count();
    }
}