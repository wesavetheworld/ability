<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-6
 * Time: 下午5:26
 */
class Base_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        define("JS_PATH", $this->config->item('js_path'));
        define("IMAGE_PATH", $this->config->item("image_path"));
        define("CSS_PATH", $this->config->item("css_path"));
        define("EDITER_PATH", $this->config->item("editer_path"));
    }
}
class Front_Controller extends Base_Controller {
    function __construct() {
        parent::__construct();
        //$this->check_user();

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
        if (in_array($user_id.".jpg", $map)) {
            define("AVATAR_IMAGE", base_url().IMAGE_PATH.'avatars/'.$user_id.'.jpg');
        } else {
            define("AVATAR_IMAGE", base_url().IMAGE_PATH.'avatars/default.jpg');
        }
    }
}

class Admin_Controller extends Base_Controller
{

    private $template;

    function __construct()
    {
        parent::__construct();

    }

    function view($view, $vars = array(), $string=false)
    {
        //if there is a template, use it.
        $template	= '';
        if($this->template)
        {
            $template	= $this->template.'_';
        }

        if($string)
        {
            $result	= $this->load->view('admin/'.$view, $vars, true);
            return $result;
        }
        else
        {
            $this->load->view('admin/'.$template.'header', $vars);
            $this->load->view('admin/'.$view, $vars);
            $this->load->view('admin/'.$template.'footer', $vars);
        }

        //reset $this->template to blank
        $this->template	= false;
    }

    /* Template is a temporary prefix that lasts only for the next call to view */
    function set_template($template)
    {
        $this->template	= $template;
    }
}