<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
ini_set("display_errors", 0);
error_reporting(E_ALL ^ E_NOTICE);

/*补充内容：
====================VIP特权=======================
1.一次就餐完毕升级vip1，可享受预约提前(保留3month)
2.两次就餐完毕升级vip2，可享受预约提前+95折扣(保留6month)
3.十次就餐完毕升级vip3,可享受预约提前+85折扣(保留1year)
4.二十次就餐完毕升级vip4,可享受预约提前+永久75折扣
5.会员查询在顾客每次就餐完毕后审核并写入表中，进行定期更新。
=================================================
*/
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
      $userip = $this->input->ip_address();
      $this->load->model('G_model','G_model');
      $a = $this->G_model->check_phone($phone);
      if(!$a){
/*读取并更新会员信息*/
      $res = $this->G_model->get_vip($phone);
      $num = $res->total;
      $num==1?$vip=1:($num>=2&&$num<10?$vip=2:($num>=10&&$num<20?$vip=3:($num>20?$vip=4:$vip=0)));
      $this->G_model->update_vip($vip);
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
   		$result = $this->G_model->take_num($name,$phone,$type,$vip,$userip);
   		if($result){
   			
   			$phone = $this->session->userdata('phone');
   			$w_num = $this->G_model->check_num($phone);
        /*利用ip+cookie标识用户*/
        $this->input->set_cookie("userip",$userip,3600);	
        echo $w_num;
   			
   		}
    }
    else echo -1;
}  
 
/*状态查询*/
    public function check_num(){
       $info = file_get_contents("php://input");
      $ip = $this->input->cookie("userip");
		  $this->load->model('G_model','G_model');
      $reid = $this->G_model->check_ip($ip);
   		$w_num = $this->G_model->check_num($info);
      if($w_num==(-1)){
        echo "error";
        exit;
      }
      else{
        if($reid->phone==$info){
   	    $statu = $this->G_model->take_table($info);
        $table = $statu->table_id;
        if($w_num == 0 && $table) {
        $this->load->library('session');
        $this->session->set_userdata('guestid',$info);
        echo $table;
          }
        else echo 0-$w_num;  
        }  
    else echo "iperror";
    }
}
}


?>



