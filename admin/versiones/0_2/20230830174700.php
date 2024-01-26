<?php
$result = $conn->query("ALTER TABLE `datos_empresa`
	ADD COLUMN `teminales_adicionales` INT(4) NULL DEFAULT '0' AFTER `iban`;");