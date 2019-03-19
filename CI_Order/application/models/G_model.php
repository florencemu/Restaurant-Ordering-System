<?php

class G_model extends CI_Model{
	
	
	public function take_num($name,$phone,$type){
		$sql = "INSERT INTO `guest`(`name`,`phone`,`type`,`statu`) VALUES ('$name','$phone','$type','0')";
		$result = $this->db->query($sql); 
		return $result;

	}

	public function check_num($phone){
		$sql = "SELECT time,type FROM `guest` WHERE `phone` = '$phone'";
		$result = $this->db->query($sql)->row();
		if($result===NULL) return -1;
		$time = $result->time;
		$type = $result->type;	
		$sql1 = "SELECT id FROM `guest` WHERE `type` = '$type' AND `time` < '$time'";
		$result1 = $this->db->query($sql1)->num_rows();
		return $result1;


	}
	
	



	// }





}










?>