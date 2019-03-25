CREATE EVENT IF NOT EXISTS checkvip   
    ON SCHEDULE EVERY 1 DAY STARTS '2019-03-25 00:00:00' 
    ON COMPLETION PRESERVE ENABLE   
    DO
    BEGIN
    CALL checkvip1(); 
    CALL checkvip2(); 
    CALL checkvip3();
    END 