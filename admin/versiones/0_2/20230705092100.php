<?php
$result = $conn->query("CREATE TABLE `libradores_historico_correos` (
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`id_librador` INT(10) UNSIGNED NOT NULL DEFAULT '0',
`tipo_librador` VARCHAR(3) NOT NULL DEFAULT 'cli',
`tipo_documento` VARCHAR(3) NOT NULL DEFAULT 'fac',
`numero_documento` VARCHAR(25) NOT NULL DEFAULT '',
`visto` TINYINT(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8_spanish_ci'
ENGINE=MyISAM
AUTO_INCREMENT=1;");
