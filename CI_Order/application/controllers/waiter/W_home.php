<?php
ini_set("display_errors", 0);
error_reporting(E_ALL ^ E_NOTICE);

class W_home extends CI_Controller {
/*前台主页*/
    public function index()
    {
    	
 		$this->load->view('waiter/w_home.html');
    }

/*前台登录*/
    public function login(){
      $info = file_get_contents("php://input");
      $result =json_decode($info,TRUE);
      $id = $result['id'];
      $pwd = $result['pwd'];
      $this->load->model('W_model','W_model');
      $result = $this->W_model->login($id);
      $repwd = $result->admin_pwd;
      $type = $result->type;
      if($pwd==$repwd&&$type==0)
        echo 0;
      if($pwd==$repwd&&$type==1)
        echo 1;
      else echo -1;

    }
/*座位一览*/
    public function show_table(){
        $this->load->model('W_model','W_model');
        $data['table'] = $this->W_model->show_table();
        $this->load->view('waiter/w_table.html',$data);

    }

 /*选座位*/
   
  public function choose_table(){
        $table_id = $this->input->get('id');
        if($table_id>=1 && $table_id<=10)
        $type = 'a'; 
        else if($table_id>=11 && $table_id<=20)
        $type = 'b'; 
        else if($table_id>=21 && $table_id<=30)
        $type = 'c'; 
        else if($table_id>=31 && $table_id<=40)
        $type = 'd';
        $this->load->model('W_model','W_model');
        $result= $this->W_model->choose_table($type,$table_id);
        if($result>0)
           echo "<script>alert('排座成功！');parent.location.href='/waiter/W_home/show_table';</script>";
        else 
          echo "<script>alert('该区目前没有等待用户，无法排座！');parent.location.href='/waiter/W_home/show_table';</script>";


  } 

/*显示账单*/
    public function show_bill()
    {
      // $result = file_get_contents("php://input");
      $id = $this->input->get('id');
      $this->load->model('W_model','W_model');
      $info = $this->W_model->sel_info($id);
      $this->load->library('session');
      $this->session->set_userdata('table',$id);
      $this->session->set_userdata('id',$info->id);
      $this->session->set_userdata('name',$info->name);
      /*这里的time在提交点餐时更新*/
      $this->session->set_userdata('time',$info->time);
      $foodlist = explode(',', $info->food_list,-1);
      $i = count($foodlist);
      /*统计菜品数量*/
      $num = array_count_values($foodlist);
      /*拼接sql*/
      while($foodlist[$i-1]){
        $sql.="`food_id`="."'".$foodlist[$i-1]."'"." or ";
        --$i;
        }
      $sql = substr($sql,0,strlen($sql)-3);
      $foodinfo = $this->W_model->show_bill($sql);
      $newnum = array();
      /*问题：不按id点餐顺序错乱*/
      foreach ($num as $a) {
              $newnum[]=$a;
      }
      foreach($newnum as $k=>$v){
              $foodinfo[$k]['num'] = $v;
      } 
      $data['food_info'] = $foodinfo;
      var_dump($data);
      // $this->load->view('waiter/w_check.html',$data);   
    }
  
    

/*收银*/
public function check_out(){




}

/*历史账单*/

// public function bill(){


  
// }
   
}


?>
