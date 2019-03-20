<?php

class W_home extends CI_Controller {
/*前台主页*/
    public function index()
    {
    	
 		$this->load->view('waiter/w_home.html');
    }

/*前台登录*/
    public function login(){

      $id = $this->input->post('id');
      $pwd = $this->input->post('pwd');
      $this->load->model('W_model','W_model');
      $result = $this->W_model->login($id);
      $repwd = $result->admin_pwd;

      if($pwd==$repwd)
        echo "<script>alert('登录成功！');parent.location.href='/waiter/W_home/show_table';</script>";
      else echo "<script>alert('密码错误！');parent.location.href='/waiter/W_home';</script>";

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

/*收银*/
// public function check_out(){




// }

/*历史账单*/

// public function bill(){


  
// }
   
}


?>
