ALTER TABLE `pmp_user`
	DROP COLUMN `is_public`;

ALTER TABLE `pmp_user_detail`
	ADD COLUMN `payment_due_date` DATETIME NULL AFTER `professional_qualifications`,
	ADD COLUMN `payment_overdue` TINYINT NULL AFTER `payment_due_date`,
	ADD COLUMN `visibility_email` TINYINT NULL DEFAULT '1' AFTER `payment_overdue`,
	ADD COLUMN `visibility_official_address` TINYINT NULL DEFAULT '1' AFTER `visibility_email`,
	ADD COLUMN `visibility_permanent_address` TINYINT NULL DEFAULT '1' AFTER `visibility_official_address`,
	ADD COLUMN `visibility_phone_office` TINYINT NULL DEFAULT '1' AFTER `visibility_permanent_address`,
	ADD COLUMN `visibility_phone_residence` TINYINT NULL DEFAULT '1' AFTER `visibility_phone_office`,
	ADD COLUMN `visibility_phone_mobile` TINYINT NULL DEFAULT '1' AFTER `visibility_phone_residence`;

ALTER TABLE `pmp_user_detail`
	CHANGE COLUMN `payment_due_date` `payment_due_date` DATE NULL DEFAULT NULL AFTER `professional_qualifications`;