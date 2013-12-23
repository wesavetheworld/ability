<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-12-19
 * Time: 下午12:12
 */
class Users extends Admin_Controller {
    function index () {
        $this->load->library('user');
        $data = array();


        $data['user_count'] = $this->user->get_count_of_users();
        echo $this->view('users', $data, true);
    }
}