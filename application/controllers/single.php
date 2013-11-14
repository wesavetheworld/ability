<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-13
 * Time: 下午10:35
 */
class Single extends MY_Controller {
    function index () {
        $this->about();
    }

    function about () {
        $this->load->view("single/about");
    }
}