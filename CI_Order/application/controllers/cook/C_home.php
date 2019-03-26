
<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


class C_home extends CI_Controller {

/*厨师主页*/
    public function index()
    {

 		  $this->load->view('cook/chushi.html');
    }

    public function show(){
      $this->load->model('C_model','C_model');
      $data['food']= $this->C_model->show_food();
      $res = json_encode($data,JSON_UNESCAPED_UNICODE);
       echo $res;
    }

/*完成菜品*/
    public function finish_food(){
      $info = file_get_contents("php://input");
      $data = json_decode($info);
      $id = $data->food_id;
      $num = $data->to_do;
      $this->load->model('C_model','C_model');
      $result = $this->C_model->finish_food($id,$num);
      if($result)
        echo 1;
      else echo 0;
    	
   			
   		}
     
 

}


?>
