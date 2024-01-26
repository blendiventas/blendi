<?php
$result = $conn->query("ALTER TABLE `documentos_enviar_terminales`
    CHANGE COLUMN `hora` `hora_entrada` DATETIME NOT NULL AFTER `alertar`,
    ADD COLUMN `hora_visto` DATETIME NOT NULL AFTER `hora_entrada`,
    ADD COLUMN `hora_acabado` DATETIME NOT NULL AFTER `hora_visto`,
    DROP COLUMN `cantidad_modificada`;");