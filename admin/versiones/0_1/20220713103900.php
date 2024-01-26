<?php
$result = $conn->query("ALTER TABLE `categorias`
ADD COLUMN `id_grupo` INT(11) NOT NULL DEFAULT '0' AFTER `tittle`;");