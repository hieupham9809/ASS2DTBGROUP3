TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `trigger_calc_price_insert` BEFORE INSERT ON `item` FOR EACH ROW SET NEW.`GIA_CU_THE` = (SELECT `FACTOR` FROM `SIZE_PRICE` WHERE `SIZE_PRICE`.`SIZE` = NEW.`KICH_CO`)*(SELECT `GIA_THAM_KHAO` FROM `MON` WHERE `MON`.`MA_MON` = NEW.`MA_MON`)' 'CREATE DEFINER=`root`@`localhost` TRIGGER `trigger_calc_price_update` BEFORE UPDATE ON `item` FOR EACH ROW SET NEW.`GIA_CU_THE` = (SELECT `FACTOR` FROM `SIZE_PRICE` WHERE `SIZE_PRICE`.`SIZE` = NEW.`KICH_CO`)*(SELECT `GIA_THAM_KHAO` FROM `MON` WHERE `MON`.`MA_MON` = NEW.`MA_MON`)' 'CREATE DEFINER=`root`@`localhost` TRIGGER `trigger_del_item` BEFORE DELETE ON `item` FOR EACH ROW DELETE FROM `HOA_DON-ITEM`\nWHERE `HOA_DON-ITEM`.`MA_ITEM` = OLD.`MA_ITEM`'
sql_modes=1342177280 1342177280 1342177280
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8_unicode_ci' 'utf8_unicode_ci' 'utf8_unicode_ci'
