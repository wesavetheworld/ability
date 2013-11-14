<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-2
 * Time: 下午3:40
 */
class User {
    private $CI = null;
    function __construct() {
       $this->CI = & get_instance();
       $this->CI->load->model("Users_model");
    }

    public function regist ($data) {
        if ($this->CI->Users_model->get_user_info_by_name($data['user_name'])) {
            return array("success"=>false, 'failDesc'=>'用户已经存在');
        }

        if (!$this->validate_user_name($data['user_name'])) {
            return array("success"=>false, 'failDesc'=>'用户名不符合规范');
        }

        if (!$this->validate_email_address($data['email'])) {
            return array("success"=>false, 'failDesc'=>'邮件地址不正确');
        }
        $this->CI->Users_model->username = $data['user_name'];
        $this->CI->Users_model->password = md5($data['pass_word']);
        $this->CI->Users_model->email = $data['email'];
        if (!$this->CI->Users_model->set_out_active()) {
            return array("success"=>false, 'failDesc'=>"注册失败");
        }

        return array("success"=>true);
    }

    public function login ($user_data) {

        if ($user_info = $this->CI->Users_model->get_user_info_by_name($user_data['user_name'])) {
            if ($user_info->password == md5($user_data['pass_word'])) {
                return $user_info;
            }
        }

        return false;
    }

    public  function validate_user_name ($user_name) {
        return preg_match('/^[A-Z0-9a-z]{3,20}$/i', $user_name);
    }
    public  function validate_email_address ($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function get_user ($user_id) {
        if ($row = $this->CI->Users_model->get_user_info_by_id($user_id)) {
            $this->CI->Users_model = $this->set_self($row);
        }
        return $this->CI->Users_model;
    }


    private function set_self ($row) {
        $this->CI->Users_model->set_user_id($row->id);
        $this->CI->Users_model->username = $row->username;
        $this->CI->Users_model->password = $row->password;
        $this->CI->Users_model->email = $row->email;
        $this->CI->Users_model->is_active = $row->is_active;
        $this->CI->Users_model->permission = $row->permission;
        return $this->CI->Users_model;
    }
}