<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
ini_set("display_errors", 0);
error_reporting(E_ALL ^ E_NOTICE);

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

/*点餐*/

	public function order(){
		// $result = file_get_contents("php://input");
		// $info = json_decode($result);
		$result = '{"info": [{"id": "1","num": "2"}, {"id": "2","num": "3"}, {"id": "6","num": "1"}]}';
	$info = json_decode($result);
	
	/*取id，循环num次写入array()，取下一个*/
		$list[] = array();
		foreach ($info->info as $a) {
			for($i=0;$i<$a->num;$i++){
				$list[$i] = $a->id; 
				$foodlist.=$list[$i].",";
			}
			
		}
		var_dump($foodlist);
		$this->load->model('Food_model'，'Food_model');
		$result = $this->food_model->order($id,$foodlist);
		if($result) echo 1;
		else echo 0;
		

	}

}




?>