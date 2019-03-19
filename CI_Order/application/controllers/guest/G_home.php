<?php

class G_home extends CI_Controller {

    public function index()
    {
    	
 		$this->load->view('guest/g_home.html');
    }

    public function take_num(){

    	$name = $this->input->post('name');
    	$phone = $this->input->post('phone');
   		$num = $this->input->post('num');
   		$this->load->library('session');
        $this->session->set_userdata('phone',$phone);
   		switch ($num) {
   			case '1':
   				$type = "a";break;
   			case '6':
   				$type = "b";break;
   			case '11':
   				$type = "c";break;
   				break;
   			default:
   				$type = "d";
   				break;
   		}
   		$this->load->model('G_model','G_model');
   		$result = $this->G_model->take_num($name,$phone,$type);
   		if($result){
   			
   			$phone = $this->session->userdata('phone');
   			$w_num = $this->G_model->check_num($phone);
   			if($w_num == 0)
   			{


   				echo "<script>alert('您已完成排队，请开始点餐！');parent.location.href='/guest/g_order';</script>";

   			}
   		
   			echo "<script>alert('您前方还有".$w_num."人在排队，请耐心等待！');parent.location.href='/guest/g_order';</script>";
   			
   		}
  
    
 


    }

    public function select(){
		$this->load->model('G_model','G_model');
    	$phone = $this->input->post('phone');
   		$w_num = $this->G_model->check_num($phone);
   		if($w_num == 0)
   		echo "<script>alert('您已完成排队，请开始点餐！');parent.location.href='/guest/g_order';</script>";
   		else if($w_num==(-1))
   		echo "<script>alert('您还未取号，请返回填写相关信息');parent.location.href='/guest/g_home';</script>";

   		echo "<script>alert('您前方还有".$w_num."人在排队，请耐心等待！');parent.location.href='/guest/g_home';</script>";


    }
}


?>
