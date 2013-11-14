<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-11-8
 * Time: 上午10:43
 */
class Captcha extends MY_Controller {
    function index() {
        $this->load->helper('captcha');
        $vals = array(
            'img_path' => './public_files/captcha/',
            'img_url' => base_url() .'/public_files/captcha/',
            'img_width' => '60',
            'img_height' => 20,
            'str_len' => 4,
            'expiration' => 7200
        );

        $cap = create_captcha($vals);
        $this->sessionmanage->set_captcha_code($cap['word']);
        header("Content-type: image/png");
        imagepng($cap['source']);
    }
}