<?php
$result = $conn->query("ALTER TABLE `documentos_enviar_terminales`
	ADD COLUMN `id_documentos_combo` INT(11) NOT NULL AFTER `id_documento_2`;");
