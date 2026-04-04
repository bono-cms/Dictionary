
DROP TABLE IF EXISTS `bono_module_cms_dictionary`;
CREATE TABLE `bono_module_cms_dictionary` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `alias` varchar(255) COMMENT 'ID alias',
    `wysiwyg` BOOLEAN NOT NULL COMMENT 'Whether enable wysiwyg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `bono_module_cms_dictionary_translations`;
CREATE TABLE `bono_module_cms_dictionary_translations` (
    `id` INT NOT NULL,
    `lang_id` INT NOT NULL COMMENT 'Language identificator of this page',
    `value` TEXT,

    FOREIGN KEY (id) REFERENCES bono_module_cms_dictionary(id) ON DELETE CASCADE,
    FOREIGN KEY (lang_id) REFERENCES bono_module_cms_languages(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4_unicode_ci;