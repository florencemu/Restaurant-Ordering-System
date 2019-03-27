<?php

class G_model extends CI_Model{

	/*判断重复取号*/
	public function check_phone($phone){

		$sql = "SELECT `id` FROM `guest` WHERE `phone`='$phone'AND `statu`<3 ";
		$result = $this->db->query($sql)->row();
		return $result;
	}
	
	/*取号*/
	
	public function take_num($name,$phone,$type,$vip,$userip){
		$sql = "INSERT INTO `guest`(`name`,`phone`,`type`,`statu`,`vip`,`ip`) VALUES ('$name','$phone','$type','0','$vip','$userip')";
		$result = $this->db->query($sql); 
		return $result;

	}
	/*判断ip是否匹配*/

	public function check_ip($ip){
		$sql = "SELECT `phone` FROM `guest` WHERE `ip`='$ip'";
		$result = $this->db->query($sql)->row();
		return $result;
	}

	/*查询就餐记录*/

	public function get_vip($phone){
		$sql = "SELECT `phone`,count(*) as `total` from `guest` where `phone`='$phone' group by `phone` having count(1)>0 ";
		$result = $this->db->query($sql)->row();
		return $result;

	}

	/*更新会员*/

	public function update_vip($phone,$vip){
		$sql = "UPDATE `guest` SET `vip` ='$vip' WHERE `phone`='$phone'";
		$result = $this->db->query($sql);
		return $result;
	}
	/*查询会员*/
	public function show_vip($id){
		$sql = "SELECT `vip` FROM `guest` WHERE `id`='$id'";
		$result = $this->db->query($sql)->row();
		return $result;

	}
	/*状态查询*/
	public function check_num($phone){
		$sql = "SELECT time,type FROM `guest` WHERE `phone` = '$phone' AND `statu`<3 ";
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
		if($result->table_id){
			$sql1 ="UPDATE `guest`SET `table_id`='$result->table_id' WHERE `phone`='$phone'";
			$result1 = $this->db->query($sql1);
		}
		return $result;
	} 
/*更新桌号*/
	/*点餐*/

	// public function order($food_id){





	// }
	
	



	// }





}










?>