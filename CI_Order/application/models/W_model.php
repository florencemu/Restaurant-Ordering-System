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

/*查询待结帐信息*/

public function sel_info($id){
  $sql = "SELECT guest.id,guest.name,orderlist.time,orderlist.food_list FROM `guest`,`orderlist` WHERE guest.table_id = '$id'AND orderlist.id = guest.id AND guest.statu = '2' ";
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
public function check_out($id,$price,$admin){
  $sql = "UPDATE `orderlist`,`guest` SET orderlist.total_price='$price',orderlist.waiter_id='$admin',guest.statu = 3 WHERE orderlist.id='$id'AND orderlist.id=guest.id";
  $result = $this->db->query($sql);
  if($result){
    $sql1 = "UPDATE `tablelist` SET `table_statu` = 0,`guest_id` = NULL WHERE guest_id = '$id'";
    $result1 = $this->db->query($sql1);
  }
  return $result1;
}

/*历史账单*/
  public function history(){
    $sql = "SELECT guest.id,guest.name,guest.phone,guest.table_id,orderlist.total_price,orderlist.time,orderlist.discount,orderlist.waiter_id FROM `guest`,`orderlist` WHERE guest.id = orderlist.id";
    $result = $this->db->query($sql)->result_array();
    return $result;
  }
/*查询顾客账单信息*/
  public function guest_bill($id){
    $sql = "SELECT guest.name,orderlist.time,orderlist.food_list FROM `guest`,`orderlist` WHERE guest.id = '$id'AND orderlist.id = guest.id AND guest.statu = '3' ";
  $result = $this->db->query($sql)->row();
  return $result;







  }




}










?>