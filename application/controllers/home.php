<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
        //所有的分类
        $this->load->library('forums');
        $forums = $this->forums->get_messages();
        $data = array("forums" => ($forums ? $forums : array()));
		$this->load->view('index', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */