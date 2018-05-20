TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `trigger_add_emp` AFTER INSERT ON `nhan_vien` FOR EACH ROW BEGIN\n	DECLARE t_role VARCHAR(45);\n    SET t_role = (SELECT `role`\n                  FROM `user`\n                  WHERE `user`.`id`= NEW.`MA_SO_NHAN_VIEN`);\n    IF t_role = \'Shipper\' THEN\n    	INSERT INTO `NHAN_VIEN_SHIPPER`(`MA_SO_NHAN_VIEN`)\n        VALUE(NEW.`MA_SO_NHAN_VIEN`);\n    ELSEIF role = \'Chief\' THEN\n    	INSERT INTO NHAN_VIEN_BEP(MA_SO_NHAN_VIEN)\n        VALUE(NEW.`MA_SO_NHAN_VIEN`);\n    ELSEIF role = \'Orderman\' THEN\n    	INSERT INTO NHAN_VIEN_BOI_BAN(MA_SO_NHAN_VIEN)\n        VALUE(NEW.`MA_SO_NHAN_VIEN`);\n    ELSEIF role = \'Accountant\' THEN\n    	INSERT INTO NHAN_VIEN_KE_TOAN(MA_SO_NHAN_VIEN)\n        VALUE(NEW.`MA_SO_NHAN_VIEN`);\n    ELSEIF role = \'Manager\' THEN\n    	INSERT INTO NHAN_VIEN_QUAN_LI(MA_SO_NHAN_VIEN)\n        VALUE(NEW.`MA_SO_NHAN_VIEN`);\n    ELSEIF role = \'Waiter\' THEN\n    	INSERT INTO NHAN_VIEN_BOI_BAN(MA_SO_NHAN_VIEN)\n        VALUE(NEW.`MA_SO_NHAN_VIEN`);\n    ELSE\n    	INSERT INTO `NHAN_VIEN_THU_NGAN`(`MA_SO_NHAN_VIEN`)\n        VALUE(NEW.`MA_SO_NHAN_VIEN`);\n    END IF;\nEND'
sql_modes=1342177280
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='utf8_unicode_ci'
