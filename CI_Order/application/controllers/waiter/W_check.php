<?php
ini_set("display_errors", 0);
error_reporting(E_ALL ^ E_NOTICE);


class W_check extends CI_Controller {
/*显示账单*/
    public function index()
    {
    	// $this->load->model('W_model','W_model');
    	// $data['bill'] = $this->W_model->bill();
    	$this->load->view('waiter/w_check.html');	


    	
    }
/*收银*/
    public function take_num(){

   
}     
/*历史记录*/
	public function history(){




	}
}


?>



