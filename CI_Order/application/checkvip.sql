CREATE PROCEDURE `checkvip1`()
BEGIN    
	 DECLARE nowtime timestamp;
     time = current_timestamp();
     select `phone`,`time`FROM `guest` WHERE `vip`=1 DISTINCT;
     select timestampdiff(MONTH,"nowtime","time") as timestamodiff;
     if(timestamodiff>3)
     DELETE * from `guest`,`orderlist` WHERE `phone`=phone AND guest.id=orderlist.id;    
END;
