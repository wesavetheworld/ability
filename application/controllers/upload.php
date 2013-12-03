<?php
/**
 * Created by PhpStorm.
 * User: sihuayin
 * Date: 13-12-2
 * Time: 下午10:52
 */
class Upload extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form'));
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

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());

            var_dump($error);
            return false;
        }
        else
        {
            $data = $this->upload->data();
            $this->cute_pic($data['full_path'], 120, 120);
            echo json_encode($data);
            return true;
        }
    }

    private function cute_pic ($image, $width, $height) {
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

    }
}
?>