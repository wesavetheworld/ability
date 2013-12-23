<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-12-20
 * Time: 上午9:29
 */
class Ajax extends Admin_Controller {
    function users () {
        $limit = $this->input->get('start');
        $offset = $this->input->get('step');

        $this->load->library('user');
        $users = $this->user->get_users(($limit - 1 ) * $offset, $offset);

        echo json_encode($users);
    }
}