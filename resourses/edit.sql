ALTER TABLE `comp` ADD `preregistration_open` TINYINT(4) NOT NULL AFTER `open_result`, ADD `preregistration_visible` TINYINT(4) NOT NULL AFTER `preregistration_open`;
ALTER TABLE `comp` ADD `comp_edit` TINYINT(4) NOT NULL AFTER `preregistration_visible`;
