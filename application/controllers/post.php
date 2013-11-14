<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-6
 * Time: 下午5:14
 */
class Post extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("post_model");
    }
    function index () {
        $posts = $this->post_model->get_all ();
        $data = array("posts" => $posts);
        $this->load->view("post/index", $data);
    }

    function add () {
        if ($this->input->post("submitted")) {

            $post_data = array();
            $post_data['title'] = $this->input->post("title");
            $post_data['content'] = $this->input->post("content");
            $ret = $this->post_model->add($post_data);
            if ($ret > 0) {
                redirect("post/index");
            }
            redirect("post/add");
        } else {
            $this->load->view("post/add");
        }
    }

    function show ($pid) {
        if (!$pid) {
            redirect("post/index");
        }

        $post = $this->post_model->get_post_info_by_id($pid);
        $data = array("post"=>$post);
        $this->load->view("post/show", $data);
    }
}