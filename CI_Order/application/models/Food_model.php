<?php

class Food_model extends CI_Model{
	
/*显示菜品信息*/
	public function show_food(){
		$sql = "SELECT `food_id`,`food_name`,`food_price`,`food_stock`,`type` FROM `menu`";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}
/*点餐*/
	public function order($id,$foodlist){
		$sql = "INSERT INTO `orderlist`(`id`,`foodlist`) VALUES ('$id','$foodlist')";
		$result = $this->db->query($sql);
		if($result){
			$sql1 = "UPDATE `guest` SET `statu` = 2";
			$result1 = $this->db->query($sql1);
			return $sql1;
		}

	}


















}




















?>