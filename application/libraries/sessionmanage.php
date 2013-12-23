<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-3
 * Time: 下午7:15
 */
class Sessionmanage {
    private static $CI;
    function __construct () {
        self::$CI = & get_instance();
    }
    public static function is_login () {
        return self::get_user_id() ? true : false;
    }

    public static function set_login ($user_id) {
        self::$CI->session->set_userdata("user_id", $user_id);
    }

    public static function unset_login () {
        self::$CI->session->unset_userdata("user_id");
    }
    public static function get_user_id () {
        return self::$CI->session->userdata("user_id");
    }

    public static function set_captcha_code ($code) {
        self::$CI->session->set_userdata("captcha", $code);
    }

    public static function get_captcha_code () {
        return self::$CI->session->userdata("captcha");
    }

    public static function set_user_info($user_info) {
        self::set_login($user_info->id);
        self::$CI->session->set_userdata("user_info", $user_info->username);
    }

    public static function get_user_info() {
        return self::$CI->session->userdata("user_info");
    }
}