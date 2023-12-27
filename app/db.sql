ALTER TABLE `service_appointments` ADD `edit_reason` VARCHAR(255) NULL DEFAULT NULL AFTER `status`;

CREATE TABLE `hospital`.`password_resets` ( `id` INT NOT NULL AUTO_INCREMENT , `reset_code` VARCHAR(20) NOT NULL , `user_id` INT NOT NULL , `status` INT NOT NULL DEFAULT '0' , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `services` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES (NULL, 'Pills', 'Vidonge vya majira', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP), (NULL, 'Implants', 'Vipandikizi/vijiti)', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO `services` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES (NULL, 'Condoms', 'Condomu', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP), (NULL, 'Injectable', 'Sindano za Majira', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO `services` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES (NULL, 'Intra-Uterine Devices', 'Kitanzi', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

