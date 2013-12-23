<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-2
 * Time: 下午4:27
 */
class Member extends Front_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library("User");
    }

    /**
     * 个人信息首页，可以编辑个人信息
     */
    function index () {
        $user_id = $this->sessionmanage->get_user_id();
        if ($this->input->post('submitted')) {
            $user_data = array();
            $user_data['id'] = $user_id;
            $user_data['email'] = $this->input->post('email');
            $user_data['blog'] = $this->input->post('blog');
            $user_data['contact'] = $this->input->post('contact');
            $user_data['intro'] = $this->input->post('intro');
            $this->user->edit($user_data);
        }
        $user_info = $this->user->get_user($user_id);
        $this->load->view("member/index", $user_info);
    }

    function signin () {
        $error = array();
        if ($this->input->post("submitted")) {
            if(strtolower($this->input->post("captcha_code")) == strtolower($this->sessionmanage->get_captcha_code())) {
                $user_info = array();
                $user_info['user_name'] = $this->input->post("username");
                $user_info['pass_word'] = $this->input->post("password");
                $user_info['email'] = $this->input->post("email");
                $ret = $this->user->regist ($user_info);

                if ($ret['success']) {
                    $this->load->library("mail");
                    if ($this->mail->send_regist($user_info['email'], $user_info['user_name'], $ret['pkey'])) {
                        echo "请查收您" . $user_info['email'] . "邮箱的邮件，进行进一步的激活";
                    } else {
                        $error['email'] = "验证邮件发送失败，请联系我们";
                    }

                } else {
                    $error['add'] = $ret['failDesc'];
                }
            } else {
                $error['capcha'] = "验证码输入有误";
            }

        }

        $this->load->view("member/regist", array('errors' => $error));
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

    /**
     * 修改密码
     */
    function change () {
        $user_id = $this->sessionmanage->get_user_id();
        $error = array();
        $user = $this->user->get_user($user_id);
        if ($this->input->post("submitted")) {
            if ( md5($this->input->post("password")) == $user->password && $this->input->post("newpassword") == $this->input->post("newpassword2"))
            $user->set_password($this->input->post("newpassword"));
            if ($user->save()) {
                redirect("member");
            }
        }
        if (!empty($error)) {
            print_r($error);
        }
        $this->load->view("member/change", $user);
    }

    function group () {
        $groups = $this->user->get_all_groups ();
        //var_dump($groups);
        if ($this->input->post("submitted")) {
            $group_data = array();
            $group_data['group_name'] = $this->input->post('group_name');
            $group_data['permission'] = $this->input->post('permission');
            $this->user->add_group($group_data);
        }
        $this->load->view('member/group');
    }

    function active ($username, $token) {
        $user = $this->user->get_user ($username);
        $user_token = $user->get_user_token();
        if ($user->is_active > 0) {
            $this->sessionmanage->set_user_info($user);
            echo "激活成功！";exit;
        }

        if ($token != md5($user_token)) {
            echo "激活失败，请重新注册！";exit;
        }

        if ($user->set_active()) {
            $this->sessionmanage->set_user_info($user);
            echo "激活成功";exit;
        } else {
            echo "激活失败，请重新注册！";exit;
        }
    }
}