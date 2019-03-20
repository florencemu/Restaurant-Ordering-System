<?php

class C_model extends CI_Model{
	
	/*显示待做列表*/
	
	public function show_food(){
		$sql = "SELECT menu.food_name,menu.food_id,cook.to_do FROM `cook`,`menu` WHERE menu.food_id = cook.food_id AND cook.to_do>0 ";
		$result = $this->db->query($sql)->result_array(); 
		return $result;

	}
	/*完成菜品*/

	public function finish_food($id){
		$sql = "UPDATE `cook` SET `to_do` = `to_do`-1 WHERE `food_id` = '$id'";
		$result = $this->db->query($sql);
		return $result;


	}
	




}










?>