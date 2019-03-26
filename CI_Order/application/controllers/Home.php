<?php

class Home extends CI_Controller {

    public function index()
    {
    	$userip = $this->input->ip_address();
        $this->input->set_cookie("userip",$userip,60);
        var_dump($userip);die;
        $this->load->view('home.html');

    }
}


?>
