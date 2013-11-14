<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-6
 * Time: 下午5:26
 */
class MY_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->check_user();
        define("JS_PATH", $this->config->item('js_path'));
        define("IMAGE_PATH", $this->config->item("image_path"));
        define("CSS_PATH", $this->config->item("css_path"));
        define("EDITER_PATH", $this->config->item("editer_path"));
        $this->define_avatar();
    }

    private function check_user() {
        if ($this->sessionmanage->is_login()) {
            //echo "_Yes_";
        } else {
            //todo未登录的解决办法，跳转到登录页面
            if (stripos(current_url(), "logon") === false) {
                redirect(site_url("member/logon"));
            }

        }
    }

    private function define_avatar () {
        $this->load->helper('directory');
        $map = directory_map('./'.IMAGE_PATH.'avatars/');
        $user_id = $this->sessionmanage->get_user_id();
        if (in_array($user_id."jpg", $map)) {
            define("AVATAR_IMAGE", base_url().IMAGE_PATH.'avatars/'.$user_id.'jpg');
        } else {
            define("AVATAR_IMAGE", base_url().IMAGE_PATH.'avatars/default.jpg');
        }
    }
}