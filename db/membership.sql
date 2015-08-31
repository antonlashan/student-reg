ALTER TABLE `pmp_user`
	ADD COLUMN `is_public` TINYINT(4) NULL DEFAULT '0' AFTER `is_admin`;