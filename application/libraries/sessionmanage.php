<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-3
 * Time: 下午7:15
 */
class Sessionmanage {
    private static $CI;
    private static $user_id = null;
    function __construct () {
        self::$CI = & get_instance();
        if (self::$CI->session->userdata("user_id")) {
            self::$user_id = self::$CI->session->userdata("user_id");
        }
    }
    public static function is_login () {
        return self::$user_id ? true : false;
    }

    public static function set_login ($user_id) {
        if (!$user_id) {
            return false;
        }

        self::$CI->session->set_userdata("user_id", $user_id);
    }

    public static function unset_login () {
        self::$CI->session->unset_userdata("user_id");
    }
    public static function get_user_id () {
        return self::$user_id;
    }

    public static function set_captcha_code ($code) {
        self::$CI->session->set_userdata("captcha", $code);
    }

    public static function get_captcha_code () {
        return self::$CI->session->userdata("captcha");
    }

    public static function set_user_info($user_info) {
        self::$CI->session->set_userdata("user_info", $user_info);
    }

    public static function get_user_info() {
        return self::$CI->session->userdata("user_info");
    }
}