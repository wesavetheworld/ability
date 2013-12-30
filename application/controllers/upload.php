<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-12-2
 * Time: 下午10:52
 */
class Upload extends Front_Controller {
    private $user_id = 0;
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form'));
        $this->user_id = $this->sessionmanage->get_user_id();
        if ($this->user_id <= 0) {
            echo json_encode(array('success'=>false, 'failDesc'=>'请先登录'));exit;
        }
    }

    function index()
    {
        $this->load->view('upload_form', array('error' => ' ' ));
    }

    function avatar () {
        if (!$this->sessionmanage->is_login()) {
            return false;
        }
        $config['upload_path'] = BASEPATH.'../public_files/images/avatars/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = $this->sessionmanage->get_user_id().'.jpg';
        $config['overwrite'] = true;
        $config['max_size'] = '100';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        $this->do_upload($config);
    }

    private function do_upload($config) {

        $this->load->library('upload', $config);
        $this->load->library('user');

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());

            var_dump($error);
            return false;
        }
        else
        {
            $data = $this->upload->data();
            $user = $this->user->get_user($this->user_id);
            $user->avatar = $this->user_id.'.jpg';
            $user->save();
            $this->cute_pic($data['full_path'], 100, 100, $this->user_id);
            echo json_encode($data);
            return true;
        }
    }

    private function cute_pic ($image, $width, $height, $user_id = 0) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $image;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;
        $config['height'] = $height;

        $this->load->library('image_lib', $config);
        if ( ! $this->image_lib->resize())
        {
            echo json_encode($this->image_lib->display_errors());exit;
        }
        //zhong
        $config['width'] = 48;
        $config['height'] = 48;
        $config['create_thumb'] = true;
        $config['thumb_marker'] = '_middle';
        $this->image_lib->initialize($config);
        if ( ! $this->image_lib->resize())
        {
            echo json_encode($this->image_lib->display_errors());exit;
        }

        //zhong
        $config['width'] = 24;
        $config['height'] = 24;
        $config['create_thumb'] = true;
        $config['thumb_marker'] = '_small';
        $this->image_lib->initialize($config);
        if ( ! $this->image_lib->resize())
        {
            echo json_encode($this->image_lib->display_errors());exit;
        }
    }
}
?>