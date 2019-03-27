<?php

class Food_model extends CI_Model{
	

	public function show_food(){
		$sql = "SELECT `food_id`,`food_name`,`food_price`,`food_stock`,`type` FROM `menu`";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}


















}




















?>