<?php
$result = $conn->query("CREATE TABLE IF NOT EXISTS `metodos_pago_bans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_metodo_pago` int(11) NOT NULL DEFAULT '0',
  `correo` VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;");
