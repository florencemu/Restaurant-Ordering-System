<?php

class G_model extends CI_Model{
	
	/*取号*/
	
	public function take_num($name,$phone,$type){
		$sql = "INSERT INTO `guest`(`name`,`phone`,`type`,`statu`) VALUES ('$name','$phone','$type','0')";
		$result = $this->db->query($sql); 
		return $result;

	}
	/*状态查询*/

	public function check_num($phone){
		$sql = "SELECT time,type FROM `guest` WHERE `phone` = '$phone'";
		$result = $this->db->query($sql)->row();
		if($result===NULL) return -1;
		$time = $result->time;
		$type = $result->type;	
		$sql1 = "SELECT id FROM `guest` WHERE `type` = '$type' AND `time` < '$time'AND `statu`='0'";
		$result1 = $this->db->query($sql1)->num_rows();
		return $result1;


	}
	/*获取桌号*/
	public function take_table($phone){
		$sql = "SELECT tablelist.table_id FROM `tablelist`,`guest` WHERE tablelist.guest_id = guest.id AND guest.phone = '$phone'";
		$result = $this->db->query($sql)->row();
		return $result;
	} 

	/*点餐*/

	// public function order($food_id){





	// }
	
	



	// }





}










?>