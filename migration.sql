
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;









//////////////////////////////////////






ALTER TABLE `users` ADD `theme` VARCHAR(10) NULL AFTER `fcm_token`;

CREATE TABLE `plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT ,
  `plan_name` varchar(20) DEFAULT NULL,
  `plan_amount` varchar(20) DEFAULT NULL,
  `sponser_amount` varchar(20) DEFAULT NULL,
  `level_amount` varchar(20) DEFAULT NULL,
  `upline_amount` varchar(20) DEFAULT NULL,
  `regain_amount` varchar(20) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


ALTER TABLE `users` ADD `referral_id` INT(10) NULL DEFAULT NULL AFTER `id`;

CREATE TABLE `user_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

ALTER TABLE `users` DROP `usertype_id`;
ALTER TABLE `users` ADD `user_type_id` INT(10) NULL DEFAULT NULL AFTER `referral_id`;

ALTER TABLE `users`
  DROP `dob`,
  DROP `otp`,
  DROP `gender`,
  DROP `login_id`,
  DROP `plan_end_date`,
  DROP `referred_by`;
ALTER TABLE `users` ADD `referral_id` VARCHAR(30) NULL DEFAULT NULL AFTER `fcm_token`, ADD `referred_by` VARCHAR(30) NULL DEFAULT NULL AFTER `referral_id`;

ALTER TABLE `users` CHANGE `user_code` `user_code` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `users` ADD `wallet` VARCHAR(10.2) NOT NULL DEFAULT '0.00' AFTER `cpassword`;

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `pay_typ_id` int(11) DEFAULT NULL,
  `amount` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `payment_reason` varchar(1000) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `pay_date` varchar(50) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;
ALTER TABLE `users` ADD `wallet_address` VARCHAR(50) NULL DEFAULT NULL AFTER `address`;

CREATE TABLE payments (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  project_id varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  old_balance varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  paid_amound varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  new_balance varchar(10) DEFAULT NULL,
  payment_method varchar(100) DEFAULT NULL,
  message varchar(1000) DEFAULT NULL,
  credit_or_debit varchar(20) DEFAULT NULL,
  reason varchar(20) DEFAULT NULL,
  status varchar(10) DEFAULT NULL,
  from_image varchar(200) DEFAULT NULL,
  paid_date varchar(50) DEFAULT NULL,
  log_id int(11) DEFAULT NULL,
  expense_type tinyint(4) DEFAULT 0,
  employee_id int(11) DEFAULT 0,
  PRIMARY KEY ('id')
) ENGINE=InnoDB;

ALTER TABLE `users` ADD `referral_code` VARCHAR(30) NULL AFTER `theme`;

ALTER TABLE `user_plan` ADD `amount` VARCHAR(30) NULL AFTER `plan_id`;

CREATE TABLE `tfc`.`payment_reason` (`id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(200) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `payments` CHANGE `pay_typ_id` `pay_reason_id` INT(11) NULL DEFAULT NULL;

ALTER TABLE `payments` DROP `payment_reason`;

ALTER TABLE `payments` ADD `plan_id` INT(11) NULL AFTER `id`;

ALTER TABLE `payments`
  DROP `time`,
  DROP `pay_date`;

  ALTER TABLE `payments` ADD `created_at` DATETIME NULL AFTER `log_id`;

CREATE TABLE `withdrawal` (
  `id` int(11) NOT NULL AUTO_INCREMENT, 
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `tds_amount` decimal(10,2) NOT NULL,
  `youwillget` double(8,2) NOT NULL,
  `withdrawal_amount` decimal(10,2) NOT NULL,
  `new_balance` decimal(10,2) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `transfer_password` varchar(20) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;
ALTER TABLE `users` ADD `upgrade_amount` DECIMAL(10,2) NULL AFTER `referral_code`;


ALTER TABLE `withdrawal` ADD `log_id` INT(11) NULL DEFAULT NULL;

ALTER TABLE `users` CHANGE `user_code` `user_name` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

CREATE TABLE `global_regain` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `sponsor_user_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `plan_id` varchar(3) NOT NULL,
  `current_date` varchar(30) NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB;


ALTER TABLE `users` ADD `global_rebirth_amount` DECIMAL(10,2) NULL AFTER `upgrade_amount`;
ALTER TABLE `users` ADD `travel_allownace` DECIMAL(10,2) NULL AFTER `global_rebirth_amount`, ADD `travel_amount` DECIMAL(10,2) NULL AFTER `travel_allownace`, ADD `upgrade` DECIMAL(10,2) NULL AFTER `travel_amount`;

ALTER TABLE `users` ADD `travel_international_tour` DECIMAL(10,2) NULL AFTER `upgrade`, ADD `travel_national_tour` DECIMAL(10,2) NULL AFTER `travel_international_tour`, ADD `travel_local_tour` DECIMAL(10,2) NULL AFTER `travel_national_tour`;

ALTER TABLE `users` ADD `ta_international_tour` DECIMAL(10,2) NULL AFTER `travel_local_tour`, ADD `ta_national_tour` DECIMAL(10,2) NULL AFTER `ta_international_tour`, ADD `ta_local_tour` DECIMAL(10,2) NULL AFTER `ta_national_tour`;

//server


INSERT INTO `payment_reason` (`id`, `name`) VALUES
(1, 'Sponser'),
(2, 'Global Rebirth'),
(3, 'Level'),
(4, 'Upline Sponser');
(5, 'Upgrade'),
(6, 'Travel Amount'),
(7, 'Travel Allownace'),
(8, 'Admin'),
INSERT INTO `payment_reason` (`id`, `name`) VALUES (NULL, 'ta_international'), (NULL, 'ta_national')
INSERT INTO `payment_reason` (`id`, `name`) VALUES (NULL, 'ta_local'), (NULL, 't_international'), (NULL, 't_national'), (NULL, 't_local');

ALTER TABLE `users` ADD `global_id` INT(11) NULL DEFAULT NULL AFTER `id`;



ALTER TABLE `users` CHANGE `wallet` `wallet` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `global_rebirth_amount` `global_rebirth_amount` VARCHAR(10) NULL DEFAULT NULL, CHANGE `travel_allownace` `travel_allownace` VARCHAR(10) NULL DEFAULT NULL, CHANGE `travel_amount` `travel_amount` VARCHAR(10) NULL DEFAULT NULL, CHANGE `upgrade` `upgrade` VARCHAR(10) NULL DEFAULT NULL, CHANGE `travel_international_tour` `travel_international_tour` VARCHAR(10) NULL DEFAULT NULL, CHANGE `travel_national_tour` `travel_national_tour` VARCHAR(10) NULL DEFAULT NULL, CHANGE `travel_local_tour` `travel_local_tour` VARCHAR(10) NULL DEFAULT NULL, CHANGE `ta_international_tour` `ta_international_tour` VARCHAR(10) NULL DEFAULT NULL, CHANGE `ta_national_tour` `ta_national_tour` VARCHAR(10) NULL DEFAULT NULL, CHANGE `ta_local_tour` `ta_local_tour` VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE `payments` ADD `user_type_id` INT(11) NULL DEFAULT NULL AFTER `plan_id`;


ALTER TABLE `plans` ADD `shib_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `regain_amount`,
 ADD `pepe_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `shib_coin`, ADD `bonk_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `pepe_coin`,
  ADD `floki_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `bonk_coin`, ADD `btt_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `floki_coin`,
   ADD `baby_doge_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `btt_coin`, ADD `tfc_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `baby_doge_coin`;

ALTER TABLE `users` ADD `shib_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `upgrade_amount`,
 ADD `pepe_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `shib_coin`, ADD `bonk_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `pepe_coin`,
  ADD `floki_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `bonk_coin`, ADD `btt_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `floki_coin`,
   ADD `baby_doge_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `btt_coin`, ADD `tfc_coin` VARCHAR(20) NULL DEFAULT NULL AFTER `baby_doge_coin`;
   
   
   ALTER TABLE `users` CHANGE `shib_coin` `shib_coin` INT(10) NULL DEFAULT '0', CHANGE `pepe_coin` `pepe_coin` INT(10) NULL DEFAULT '0', CHANGE `bonk_coin` `bonk_coin` INT(10) NULL DEFAULT '0', CHANGE `floki_coin` `floki_coin` INT(10) NULL DEFAULT '0', CHANGE `btt_coin` `btt_coin` INT(10) NULL DEFAULT '0', CHANGE `baby_doge_coin` `baby_doge_coin` INT(10) NULL DEFAULT '0', CHANGE `tfc_coin` `tfc_coin` INT(10) NULL DEFAULT '0';


CREATE TABLE countries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    iso2 CHAR(2) NOT NULL,
    iso3 CHAR(3) NOT NULL,
    phone_code VARCHAR(10) NOT NULL
);

INSERT INTO countries (name, iso2, iso3, phone_code) VALUES
('Afghanistan', 'AF', 'AFG', '93'),
('Albania', 'AL', 'ALB', '355'),
('Algeria', 'DZ', 'DZA', '213'),
('Andorra', 'AD', 'AND', '376'),
('Angola', 'AO', 'AGO', '244'),
('Argentina', 'AR', 'ARG', '54'),
('Armenia', 'AM', 'ARM', '374'),
('Australia', 'AU', 'AUS', '61'),
('Austria', 'AT', 'AUT', '43'),
('Azerbaijan', 'AZ', 'AZE', '994'),
('Bahamas', 'BS', 'BHS', '1-242'),
('Bahrain', 'BH', 'BHR', '973'),
('Bangladesh', 'BD', 'BGD', '880'),
('Belarus', 'BY', 'BLR', '375'),
('Belgium', 'BE', 'BEL', '32'),
('Belize', 'BZ', 'BLZ', '501'),
('Benin', 'BJ', 'BEN', '229'),
('Bhutan', 'BT', 'BTN', '975'),
('Bolivia', 'BO', 'BOL', '591'),
('Bosnia and Herzegovina', 'BA', 'BIH', '387'),
('Botswana', 'BW', 'BWA', '267'),
('Brazil', 'BR', 'BRA', '55'),
('Brunei', 'BN', 'BRN', '673'),
('Bulgaria', 'BG', 'BGR', '359'),
('Burkina Faso', 'BF', 'BFA', '226'),
('Burundi', 'BI', 'BDI', '257'),
('Cambodia', 'KH', 'KHM', '855'),
('Cameroon', 'CM', 'CMR', '237'),
('Canada', 'CA', 'CAN', '1'),
('Chile', 'CL', 'CHL', '56'),
('China', 'CN', 'CHN', '86'),
('Colombia', 'CO', 'COL', '57'),
('Costa Rica', 'CR', 'CRI', '506'),
('Croatia', 'HR', 'HRV', '385'),
('Cuba', 'CU', 'CUB', '53'),
('Cyprus', 'CY', 'CYP', '357'),
('Czech Republic', 'CZ', 'CZE', '420'),
('Denmark', 'DK', 'DNK', '45'),
('Djibouti', 'DJ', 'DJI', '253'),
('Dominican Republic', 'DO', 'DOM', '1-809'),
('Ecuador', 'EC', 'ECU', '593'),
('Egypt', 'EG', 'EGY', '20'),
('El Salvador', 'SV', 'SLV', '503'),
('Estonia', 'EE', 'EST', '372'),
('Ethiopia', 'ET', 'ETH', '251'),
('Finland', 'FI', 'FIN', '358'),
('France', 'FR', 'FRA', '33'),
('Georgia', 'GE', 'GEO', '995'),
('Germany', 'DE', 'DEU', '49'),
('Ghana', 'GH', 'GHA', '233'),
('Greece', 'GR', 'GRC', '30'),
('Greenland', 'GL', 'GRL', '299'),
('Guatemala', 'GT', 'GTM', '502'),
('Honduras', 'HN', 'HND', '504'),
('Hong Kong', 'HK', 'HKG', '852'),
('Hungary', 'HU', 'HUN', '36'),
('Iceland', 'IS', 'ISL', '354'),
('India', 'IN', 'IND', '91'),
('Indonesia', 'ID', 'IDN', '62'),
('Iran', 'IR', 'IRN', '98'),
('Iraq', 'IQ', 'IRQ', '964'),
('Ireland', 'IE', 'IRL', '353'),
('Israel', 'IL', 'ISR', '972'),
('Italy', 'IT', 'ITA', '39'),
('Jamaica', 'JM', 'JAM', '1-876'),
('Japan', 'JP', 'JPN', '81'),
('Jordan', 'JO', 'JOR', '962'),
('Kazakhstan', 'KZ', 'KAZ', '7'),
('Kenya', 'KE', 'KEN', '254'),
('Kuwait', 'KW', 'KWT', '965'),
('Kyrgyzstan', 'KG', 'KGZ', '996'),
('Laos', 'LA', 'LAO', '856'),
('Latvia', 'LV', 'LVA', '371'),
('Lebanon', 'LB', 'LBN', '961'),
('Libya', 'LY', 'LBY', '218'),
('Lithuania', 'LT', 'LTU', '370'),
('Luxembourg', 'LU', 'LUX', '352'),
('Macau', 'MO', 'MAC', '853'),
('Malaysia', 'MY', 'MYS', '60'),
('Maldives', 'MV', 'MDV', '960'),
('Mali', 'ML', 'MLI', '223'),
('Malta', 'MT', 'MLT', '356'),
('Mexico', 'MX', 'MEX', '52'),
('Moldova', 'MD', 'MDA', '373'),
('Monaco', 'MC', 'MCO', '377'),
('Mongolia', 'MN', 'MNG', '976'),
('Montenegro', 'ME', 'MNE', '382'),
('Morocco', 'MA', 'MAR', '212'),
('Mozambique', 'MZ', 'MOZ', '258'),
('Myanmar', 'MM', 'MMR', '95'),
('Namibia', 'NA', 'NAM', '264'),
('Nepal', 'NP', 'NPL', '977'),
('Netherlands', 'NL', 'NLD', '31'),
('New Zealand', 'NZ', 'NZL', '64'),
('Nicaragua', 'NI', 'NIC', '505'),
('Nigeria', 'NG', 'NGA', '234'),
('North Korea', 'KP', 'PRK', '850'),
('Norway', 'NO', 'NOR', '47'),
('Oman', 'OM', 'OMN', '968'),
('Pakistan', 'PK', 'PAK', '92'),
('Panama', 'PA', 'PAN', '507'),
('Paraguay', 'PY', 'PRY', '595'),
('Peru', 'PE', 'PER', '51'),
('Philippines', 'PH', 'PHL', '63'),
('Poland', 'PL', 'POL', '48'),
('Portugal', 'PT', 'PRT', '351'),
('Qatar', 'QA', 'QAT', '974'),
('Romania', 'RO', 'ROU', '40'),
('Russia', 'RU', 'RUS', '7'),
('Saudi Arabia', 'SA', 'SAU', '966'),
('Serbia', 'RS', 'SRB', '381'),
('Singapore', 'SG', 'SGP', '65'),
('Slovakia', 'SK', 'SVK', '421'),
('Slovenia', 'SI', 'SVN', '386'),
('Somalia', 'SO', 'SOM', '252'),
('South Africa', 'ZA', 'ZAF', '27'),
('South Korea', 'KR', 'KOR', '82'),
('Spain', 'ES', 'ESP', '34'),
('Sri Lanka', 'LK', 'LKA', '94'),
('Sudan', 'SD', 'SDN', '249'),
('Sweden', 'SE', 'SWE', '46'),
('Switzerland', 'CH', 'CHE', '41'),
('Syria', 'SY', 'SYR', '963'),
('Taiwan', 'TW', 'TWN', '886'),
('Tajikistan', 'TJ', 'TJK', '992'),
('Tanzania', 'TZ', 'TZA', '255'),
('Thailand', 'TH', 'THA', '66'),
('Tunisia', 'TN', 'TUN', '216'),
('Turkey', 'TR', 'TUR', '90'),
('Turkmenistan', 'TM', 'TKM', '993'),
('Uganda', 'UG', 'UGA', '256'),
('Ukraine', 'UA', 'UKR', '380'),
('United Arab Emirates', 'AE', 'ARE', '971'),
('United Kingdom', 'GB', 'GBR', '44'),
('United States', 'US', 'USA', '1'),
('Uruguay', 'UY', 'URY', '598'),
('Uzbekistan', 'UZ', 'UZB', '998'),
('Venezuela', 'VE', 'VEN', '58'),
('Vietnam', 'VN', 'VNM', '84'),
('Yemen', 'YE', 'YEM', '967'),
('Zambia', 'ZM', 'ZMB', '260'),
('Zimbabwe', 'ZW', 'ZWE', '263');


ALTER TABLE `users` ADD `whatsapp_number` VARCHAR(20) NULL DEFAULT NULL AFTER `phone`;

ALTER TABLE `global_regain` ADD `status` INT(11) NOT NULL DEFAULT '0' AFTER `log_id`;



INSERT INTO `payment_reason` (`id`, `name`) VALUES (NULL, 'Travel Allowance International'), (NULL, 'Travel Allowance National'), (NULL, 'Travel Local'), (NULL, 'Travel International'), (NULL, 'Travel National'), (NULL, 'Travel Local') 


ALTER TABLE `global_regain` ADD `global_regain_amount` INT(11) NULL DEFAULT '0' AFTER `message`;
ALTER TABLE `users` ADD `pop_status` INT(11) NOT NULL DEFAULT '0' AFTER `tfc_coin`;

//////

ALTER TABLE `level_income` ADD `widtdrawal_status` VARCHAR(15) NULL DEFAULT '0' AFTER `payment_status`;

ALTER TABLE `sponser_income` ADD `widtdrawal_status` VARCHAR(15) NOT NULL DEFAULT '0' AFTER `payment_status`;


CREATE TABLE `wallet` (
  `id` int(15) NOT NULL  AUTO_INCREMENT,
  `user_id` int(20) DEFAULT NULL,
  `wallet_amount` varchar(20) DEFAULT NULL,
  `type` VARCHAR(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `created_at` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


//////mlm /////////

ALTER TABLE `users` ADD `id` INT(30) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);