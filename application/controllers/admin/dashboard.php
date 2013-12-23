<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-12-19
 * Time: 上午10:36
 */
class Dashboard extends Admin_Controller {
    function  index() {
        $this->view('board');
    }
}