<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-2
 * Time: 下午4:27
 */
class Member extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library("User");
    }
    function index () {
        $user_id = $this->sessionmanage->get_user_id();
        $user_info = $this->user->get_user($user_id);
        $this->load->view("member/index", $user_info);
    }

    function signin () {
        $error = array();
        if ($this->input->post("submitted")) {
            if(strtolower($this->input->post("captcha_code")) != $this->sessionmanage->get_captcha_code()) {
                $error['capcha'] = "验证码输入有误";
            }

            $user_info = array();
            $user_info['user_name'] = $this->input->post("username");
            $user_info['pass_word'] = $this->input->post("password");
            $user_info['email'] = $this->input->post("email");
            $ret = $this->user->regist ($user_info);

            if ($ret['success']) {
                $this->load->library("mail");
                if ($this->mail->send_regist($user_info['email'])) {
                    echo "请查收邮件，进行进一步的激活";
                } else {
                    echo "验证邮件发送失败，请连续我们";
                }

            } else {
                echo $ret['failDesc'];
            }
        }

        $this->load->view("member/regist");
    }

    function logon() {
        if ($this->sessionmanage->is_login()) {
            redirect(base_url());
        }
        $errors = array();
        if ($this->input->post("submitted")) {
            $user_info = array();
            $user_info['user_name'] = $this->input->post("username");
            $user_info['pass_word'] = $this->input->post("password");

            if ($this->user->validate_user_name($user_info['user_name'])) {
                $ret = $this->user->login($user_info);
                if ($ret) {
                    $this->sessionmanage-> set_login($ret->id);
                    $this->sessionmanage->set_user_info($ret);
                    $from_url = $this->input->server('HTTP_REFERER') ? $this->input->server('HTTP_REFERER') : base_url();
                    redirect($from_url);
                } else {
                    $this->sessionmanage-> unset_login();
                    $errors['name_or_pass'] = '用户名或者密码错误';
                }

            } else {
                $errors['user_name'] = "用户名称不符合规范";
            }

        }

        print_r($errors);
        $this->load->view("member/logon");

    }

    function logout () {
        if ($this->sessionmanage->is_login()) {
            $this->sessionmanage->unset_login();
        }
        $from_url = $this->input->server('HTTP_REFERER') ? $this->input->server('HTTP_REFERER') : base_url();
        redirect($from_url);
    }

    function change () {
        $user_id = $this->sessionmanage->get_user_id();
        $error = array();
        $user = $this->user->get_user($user_id);
        if ($this->input->post("submitted")) {
            if(strtolower($this->input->post("captcha_code")) != $this->sessionmanage->get_captcha_code()) {
                $error['capcha'] = "验证码输入有误";
            }
            $user->set_password($this->input->post("password"));
            if ($user->save()) {
                redirect("member");
            }
        }
        print_r($error);
        $this->load->view("member/regist", $user);
    }
}