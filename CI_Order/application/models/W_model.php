<?php

class W_model extends CI_Model{
  
  /*前台登录*/
  
  public function login($id){
    $sql = "SELECT admin_pwd,type FROM `admin` WHERE `admin_id` = '$id'";
    $result = $this->db->query($sql)->row();
    return $result;

  }
  
  /*座位一览*/
  public function show_table(){
   $sql = "SELECT table_id,table_statu,guest_id FROM `tablelist`";
   $result = $this->db->query($sql)->result_array();
   return $result;
  }

  /*排座*/

  public function choose_table($type,$table_id){
   $sql = "SELECT id FROM `guest` WHERE `time`=(SELECT MIN(time) FROM `guest` WHERE `type`='$type' AND `statu` = '0' ) ";
   $result = $this->db->query($sql)->row();
   $id = $result->id;
   if($id === NULL ) return -1;
   else{
    $sql1 = "UPDATE `tablelist`  SET `guest_id` = '$id' WHERE `tablelist`.`table_id` = '$table_id'";
    $result1 = $this->db->query($sql1);
      if($result1){
        $sql2 = "UPDATE `tablelist` a,`guest` b SET a.table_statu = '1',b.statu ='1' WHERE a.table_id = '$table_id' AND a.guest_id = b.id ";
        $result2 = $this->db->query($sql2);
       
      } 
  }
   return $result2;
    
  }

/*查询信息*/

public function sel_info($id){
  $sql = "SELECT `id`,`name`,`time`,`food_list` FROM `guest` WHERE `table_id` = '$id'";
  $result = $this->db->query($sql)->row();
  return $result;
}

/*显示账单明细*/

public function show_bill($str){
  $sql = "SELECT `food_id`,`food_name`,`food_price`,`type` FROM `menu` WHERE $str ";
  $result = $this->db->query($sql)->result_array();
  return $result;
}
 
/*收银*/
// public function check_out(){
  




// }


/*历史账单*/
  // public function history(){




  // }




}










?>