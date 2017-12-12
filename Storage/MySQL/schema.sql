DROP TABLE IF EXISTS `bono_module_cms_dictionary`;
CREATE TABLE `bono_module_cms_dictionary` (

 `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `alias` varchar(255) COMMENT 'ID alias'

) DEFAULT CHARSET = UTF8;

DROP TABLE IF EXISTS `bono_module_cms_dictionary_translations`;
CREATE TABLE `bono_module_cms_dictionary_translations` (

 `id` INT NOT NULL,
 `lang_id` INT NOT NULL COMMENT 'Language identificator of this page',
 `value` TEXT

) DEFAULT CHARSET = UTF8;
