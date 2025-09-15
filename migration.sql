ALTER TABLE `plans` ADD `service_amount` INT(11) NOT NULL DEFAULT '0' AFTER `regain_amount`;

CREATE TABLE `admin_income` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `pay_reason_id` int(11) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `widtdrawal_status` varchar(15) NOT NULL DEFAULT '0',
  `message` varchar(200) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB;

ALTER TABLE `users` DROP `upgrade`;

ALTER TABLE `admin_income` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);
ALTER TABLE `plans` ADD `upgrade_amount` VARCHAR(20) NULL DEFAULT NULL AFTER `upline_amount`;
ALTER TABLE `global_regain` ADD `widtdrawal_status` VARCHAR(20) NOT NULL DEFAULT '0' AFTER `amount`;
ALTER TABLE `users` ADD `accountNo` INT(50) NULL DEFAULT NULL AFTER `message`;
ALTER TABLE `users` ADD `bankName` VARCHAR(50) NULL DEFAULT NULL AFTER `message`;
ALTER TABLE `users` ADD `bankBranch` VARCHAR(50) NULL DEFAULT NULL AFTER `message`;
ALTER TABLE `users` ADD `ifscCode` VARCHAR(30) NULL DEFAULT NULL AFTER `fcm_token`;
ALTER TABLE `users` ADD `aadharNo` VARCHAR(50) NULL DEFAULT NULL AFTER `bankName`;
ALTER TABLE `users` ADD `pancardNo` VARCHAR(50) NULL DEFAULT NULL AFTER `ifscCode`;



CREATE TABLE `plan_payment_request` ( 
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL, 
  `user_id` int(11) NOT NULL, 
  `image` varchar(200) DEFAULT NULL, 
  `status` int(11) NOT NULL DEFAULT 0, 
  `created_at` datetime NOT NULL, 
  PRIMARY KEY (`id`) 
  ) ENGINE=InnoDB;