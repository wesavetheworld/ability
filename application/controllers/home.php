<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Front_Controller {

	public function index()
	{
        //所有的分类
        $this->load->library('forums');
        $forums = $this->forums->get_messages();
        $data['forums'] = $forums ? $forums : array();

        //最近注册的10个用户
        $this->load->library('user');
        $users = $this->user->get_users(10, 0);
        $data['users'] = $users ? $users : array();
		$this->load->view('index', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */