<?php
$result = $conn->query("ALTER TABLE `usuarios` ADD COLUMN `avatar` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `id_comercial`;");
