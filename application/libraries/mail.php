<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-8
 * Time: 下午10:32
 */
class Mail  {
    private static $CI;
    private static $master_email = "huayin1018@126.com";
    private static $master_name = "sihuayin";
    function __construct () {
        self::$CI = & get_instance();
        self::$CI->load->library('email');
    }

    public static function send_regist ($user_email) {
        self::$CI->email->from(self::$master_email, self::$master_name);
        self::$CI->email->to($user_email);
        self::$CI->email->subject('激活邮件');
        self::$CI->email->message('Testing the email class.');
        return self::$CI->email->send();
    }

}