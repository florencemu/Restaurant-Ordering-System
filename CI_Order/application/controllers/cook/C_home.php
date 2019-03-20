<?php

class C_home extends CI_Controller {

/*厨师主页*/
    public function index()
    {
    	$this->load->model('C_model','C_model');
      $data['food'] = $this->C_model->show_food();
 		  $this->load->view('cook/c_home.html',$data);
    }

/*完成菜品*/
    public function finish_food(){
      $id = $this->input->get('id');
      $this->load->model('C_model','C_model');
      $result = $this->C_model->finish_food($id);
      if($result)
        echo "<script>alert('出菜成功！');parent.location.href='/cook/C_home';</script>";
    	
   			
   		}
     
 

}


?>
