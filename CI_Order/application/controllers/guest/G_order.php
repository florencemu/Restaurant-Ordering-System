<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

class G_order extends CI_Controller{
	
/*菜单页面*/
	public function index(){
 		$this->load->library('session');
 		$guest_id=$this->session->userdata('guestid');
 		echo "你好，".$guest_id."，请开始点餐";
 		$this->load->model('Food_model','Food_model');
 		$food[] = $this->Food_model->show_food();
		$this->load->view('guest/g_order.html');

	}

/*点餐（登录状态下基于session，类似购物车）*/

	public function order(){
		// $result = file_get_contents("php://input");
		// $info = json_decode($result);
		/*
	




		*/
		$ 








	}





}





?>