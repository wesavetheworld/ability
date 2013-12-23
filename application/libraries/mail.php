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

    public static function send_regist ($user_email, $username,  $token) {
        self::$CI->email->from(self::$master_email, self::$master_name);
        self::$CI->email->to($user_email);
        self::$CI->email->subject('激活邮件');
        $html = '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"></head><body>';
        self::$CI->email->message('请点击如下的链接地址，如果不能点击，请复制以后在浏览器中打开:<a href="'.site_url('member/active/'.$username.'/'.$token).'">'.site_url('member/active/'.$username.'/'.$token)."</a></body></html>");
        return self::$CI->email->send();
    }

}