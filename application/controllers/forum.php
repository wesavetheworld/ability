<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-11
 * Time: 下午4:22
 */

class Forum extends MY_Controller {
    private $user_info = null;
    function __construct() {
        parent::__construct();
        $this->load->library("forums");
    }

    function index () {
        $forums = $this->forums->get_forums();
        $data = array("forums"=>$forums);
        $this->load->view("forum/index", $data);
    }

    function add() {
        $errors = array();
        //todo 权限控制
        if ($this->input->post("submitted")) {
            //todo 插入数据库操作
            $forum_data = array();
            $forum_data['forum_name'] = $this->input->post("forum_name");
            $forum_data['forum_desc'] = $this->input->post("forum_desc");
            if ($forum_data['forum_name'] && $forum_data['forum_desc']) {
                if ($pid = $this->forums->add_forum($forum_data)) {
                    redirect("forum");
                } else {
                    $errors['add'] = "新建板块失败";
                }
            } else {
                $errors['argv'] = "请填写表单中内容";
            }
        }
        //print_r($errors);
        $forums = $this->forums->get_forums();
        $data = array("forums"=>$forums);
        $this->load->view("forum/add", $data);
    }

    function add_post($fid = 0) {
        //todo 权限控制
        $data = array();
        $forum = $fid > 0 ? $this->forums->get_forum($fid) : null;
        $data['forum'] = $forum;
        //var_dump($forum);

        if ($this->input->post("submitted")) {
            $data = array();
            $data['subject'] = $this->input->post("msg_subject");
            $data['msg_text'] = $this->input->post('msg_text');
            $data['user_id'] = $this->sessionmanage->get_user_id();
            $data['forum_id'] = $this->input->post('forum_id');
            $data['parent_id'] = 0;
            if ($mid = $this->forums->add_message($data) ) {
                redirect("forum/show/".$fid."/".$mid);
            }
        }
        $forums = $this->forums->get_forums();
        $data = array("forums"=>$forums);
        $this->load->view("forum/add_post", $data);
    }

    public function show ($fid = 0, $msg_id = 0) {
        $forums = array();
        if ($fid) {
            $forums[] = $this->forums->get_forum($fid);
        } else {
            $forums = $this->forums->get_forums();
        }

        $messages = array();
        if ($msg_id > 0) {
            $messages[] = $this->forums->get_message($msg_id);
        } else {
            $messages = $this->forums->get_messages_by_forum_id ($fid);
        }
        $data = array(
            'forums' =>  $forums,
            'messages' => $messages,
            'fid' => $fid,
            'msg_id' => $msg_id
        );
        $this->load->view("forum/show", $data);
    }
}