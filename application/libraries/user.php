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
        $this->CI->load->model("users_m");
        $this->CI->load->model('group_model');
    }

    public function regist ($data) {
        if ($this->CI->users_m->get_user_info_by_name($data['user_name'])) {
            return array("success"=>false, 'failDesc'=>'用户已经存在');
        }

        if (!$this->validate_user_name($data['user_name'])) {
            return array("success"=>false, 'failDesc'=>'用户名不符合规范');
        }

        if (!$this->validate_email_address($data['email'])) {
            return array("success"=>false, 'failDesc'=>'邮件地址不正确');
        }
        $this->CI->users_m->username = $data['user_name'];
        $this->CI->users_m->password = md5($data['pass_word']);
        $this->CI->users_m->email = $data['email'];
        $token = $this->CI->users_m->set_out_active();
        if (!$token) {
            return array("success"=>false, 'failDesc'=>"注册失败");
        }

        return array("success"=>true, "pkey" =>md5($token));
    }

    public function login ($user_data) {

        if ($user_info = $this->CI->users_m->get_user_info_by_name($user_data['user_name'])) {
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

    public function get_user ($user_data) {
        if (((int) $user_data) > 0 ) {
            $user_id = (int) $user_data;
            return $this->CI->users_m->get_user_info_by_id($user_id);
        } else {
            $user_name = $user_data;
            return $this->CI->users_m->get_user_info_by_name($user_name);
        }

    }


    public function get_all_groups () {
        return $this->CI->group_model->get_all();
    }

    public function add_group ($group_data) {
        $this->CI->group_model->group_name = $group_data['group_name'];
        $this->CI->group_model->permission = serialize($group_data['permission']);
        return $this->CI->group_model->add();
    }

    public function get_users ($limit = 0, $offset = 0, $where = array(), $order_by = 'id desc') {
        return $this->CI->users_m->get_users($limit, $offset, $where, $order_by);
    }

    public function get_count_of_users ($where = array()) {
        return $this->CI->users_m->count_of_users($where);
    }

    /**
     * 编辑用户信息
     * @author : shy
     */
    public function edit($user_data) {
        $this->CI->users_m = $this->get_user($user_data['id']);
        $this->CI->users_m->email = $user_data['email'];
        $this->CI->users_m->blog = $user_data['blog'];
        $this->CI->users_m->contact = $user_data['contact'];
        $this->CI->users_m->introduction = $user_data['intro'];
        return $this->CI->users_m->save();
    }
}