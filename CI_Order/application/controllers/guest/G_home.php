<?php
ini_set("display_errors", 0);
error_reporting(E_ALL ^ E_NOTICE);


class G_home extends CI_Controller {
/*取号主页*/
    public function index()
    {
    	
 		$this->load->view('guest/g_home.html');
    }
/*排队取号*/
    public function take_num(){

      $info = file_get_contents("php://input");
      $result =json_decode($info,TRUE);
      $name = $result['name'];
      $phone = $result['con'];
      $num = (int)$result['sel'];
      $this->load->model('G_model','G_model');
      $a = $this->G_model->check_phone($phone);
      if(!$a){
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
   		$result = $this->G_model->take_num($name,$phone,$type);

   		if($result){
   			
   			$phone = $this->session->userdata('phone');
   			$w_num = $this->G_model->check_num($phone);   	
        echo $w_num;
   			
   		}
    }
    else echo -1;
}     
 
/*状态查询*/



    public function check_num(){
		  $this->load->model('G_model','G_model');
      $info = file_get_contents("php://input");
   		$w_num = $this->G_model->check_num($info);
   	  $statu = $this->G_model->take_table($info);
      $table = $statu->table_id;
       if($w_num == 0 && $table) 
        echo $table;
   		 else if($w_num==(-1)) echo 0;
   		 /*缺少等候人数为0但未排座的判断*/
       else echo 0-$w_num;  
      }

}

?>



