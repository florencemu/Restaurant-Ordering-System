CREATE PROCEDURE `checkvip1`()
BEGIN    
	 DECLARE nowtime timestamp;
     nowtime = current_timestamp();
     select DISTINCT `phone`,MAX(time) FROM `guest` WHERE `vip`=1 group by `phone` 
     select timestampdiff(MONTH,'nowtime','time') as timestamodiff;
     if(timestamodiff>3)
     DELETE * from `guest`,`orderlist` WHERE `phone`=phone AND guest.id=orderlist.id;    
END;

CREATE PROCEDURE `checkvip2`()
BEGIN    
	 DECLARE nowtime timestamp;
     nowtime = current_timestamp();
     select DISTINCT `phone`,MAX(time) FROM `guest` WHERE `vip`=1 group by `phone` 
     select timestampdiff(MONTH,'nowtime','time') as timestamodiff;
     if(timestamodiff>6)
     DELETE * from `guest`,`orderlist` WHERE `phone`=phone AND guest.id=orderlist.id;    
END;


CREATE PROCEDURE `checkvip3`()
BEGIN    
	 DECLARE nowtime timestamp;
     nowtime = current_timestamp();
     select DISTINCT `phone`,MAX(time) FROM `guest` WHERE `vip`=1 group by `phone` 
     select timestampdiff(MONTH,'nowtime','time') as timestamodiff;
     if(timestamodiff>12)
     DELETE * from `guest`,`orderlist` WHERE `phone`=phone AND guest.id=orderlist.id;    
END;


