<?php
$result = $conn->query("ALTER TABLE `modalidades_envio`
    ADD COLUMN `id_iva` INT(10) NOT NULL DEFAULT 0 AFTER `explicacion`,
    ADD COLUMN `incremento_pvp` DOUBLE(4,2) NOT NULL DEFAULT 0 AFTER `id_iva`;");