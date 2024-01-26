<div id="capa_filtros" class="capa-filtros bg-main hide"></div>
<div id="capa_lista" class="capa-main bg-main hide"></div>
<div id="capa_ficha" class="capa-main bg-main">
<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");

if($identificacion_acceso_sys == true) {
    $errores = 0;
    $tabla = "idiomas";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `idioma` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
            `bandera` VARCHAR(100) NOT NULL COLLATE 'utf8_spanish_ci',
            `updated` VARCHAR(12) NOT NULL COLLATE 'utf8_spanish_ci',
            `lang` VARCHAR(2) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `locale` VARCHAR(5) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `activo` TINYINT(1) NULL DEFAULT '1',
            `principal` TINYINT(1) NULL DEFAULT '0',
        PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla IDIOMAS</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla IDIOMAS</div></div>";
            $errores += 1;
        }
    }

    $tabla = "categorias";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_idioma` INT(11) UNSIGNED NOT NULL DEFAULT '0',
            `descripcion` VARCHAR(60) NOT NULL COLLATE 'utf8_spanish_ci',
            `descripcion_url` VARCHAR(60) NOT NULL COLLATE 'utf8_spanish_ci',
            `titulo_meta` VARCHAR(60) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `descripcion_meta` VARCHAR(160) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `imagen` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `updated` VARCHAR(12) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `alt` VARCHAR(60) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `tittle` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `texto_inicio` TEXT NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `de` INT(11) NULL DEFAULT '0',
            `inactiva` TINYINT(4) NULL DEFAULT '0',
            `orden` INT(11) NOT NULL DEFAULT '0',
            `inicio` TINYINT(4) NOT NULL DEFAULT '0',
            `orden_inicio` TINYINT(4) NOT NULL DEFAULT '0',
            `mostrar_buscador` TINYINT(1) NOT NULL DEFAULT '0',
            `link` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `link_externo` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `texto_titulo` TEXT NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
        UNIQUE INDEX `id` (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla CATEGORÍAS</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla CATEGORÍAS</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_idioma` INT(11) NOT NULL DEFAULT '0',
            `descripcion` VARCHAR(100) NOT NULL COLLATE 'utf8_spanish_ci',
            `tipo_producto` TINYINT(1) NOT NULL DEFAULT '0',
            `id_iva` INT(11) NOT NULL DEFAULT '0',
            `imagen` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `updated` VARCHAR(12) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `alt` VARCHAR(60) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `tittle` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
        PRIMARY KEY (`id`) USING BTREE,INDEX `id_categoria` (`id_categoria`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_categorias";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_categoria` INT(11) NOT NULL DEFAULT '0',
            `id_producto` INT(11) NOT NULL DEFAULT '0',
            `descripcion_larga` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `descripcion_url` VARCHAR(100) NOT NULL COLLATE 'utf8_spanish_ci',
            `titulo_meta` VARCHAR(60) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `descripcion_meta` VARCHAR(160) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `id_observaciones` INT(11) NOT NULL DEFAULT '0',
            `activo` TINYINT(1) NOT NULL DEFAULT '1',
            `fecha_alta` DATE NULL DEFAULT NULL,
            `fecha_modificacion` DATE NULL DEFAULT NULL,
        PRIMARY KEY (`id`) USING BTREE,INDEX `id_categoria` (`id_categoria`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS CATEGORIAS</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS CATEGORIAS</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_proveedores";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_producto` INT(11) NOT NULL DEFAULT '0',
            `id_proveedor` INT(11) NOT NULL DEFAULT '0',
            `dias_entrega` INT(11) NOT NULL DEFAULT '0',
            `id_observaciones` INT(11) NOT NULL DEFAULT '0',
            `fecha_alta` DATE NULL DEFAULT NULL,
            `fecha_modificacion` DATE NULL DEFAULT NULL,
        PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS PROVEEDORES</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS PROVEEDORES</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_proveedores_costes";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_producto_proveedor` INT(11) NOT NULL DEFAULT '0',
            `fecha` DATE NULL DEFAULT NULL,
            `coste` DOUBLE(15,5) NULL DEFAULT '0.00000',
        PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto_proveedor` (`id_producto_proveedor`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS PROVEEDORES COSTES</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS COSTES</div></div>";
            $errores += 1;
        }
    }

    $tabla = "ofertas";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_idioma` INT(11) NOT NULL DEFAULT '0',
            `descripcion` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
            `activo` TINYINT(1) NULL DEFAULT NULL,
        PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla OFERTAS</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla OFERTAS</div></div>";
            $errores += 1;
        }
    }

    $tabla = "tarifas";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_idioma` INT(11) NOT NULL DEFAULT '0',
            `descripcion` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
            `prioritaria` TINYINT(4) NOT NULL DEFAULT '0',
            `activa` TINYINT(4) NOT NULL DEFAULT '1',
            `orden` VARCHAR(20) NOT NULL COLLATE 'utf8_spanish_ci',
        PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla TARIFAS</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla TARIFAS</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_pvp";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_producto` INT(11) NOT NULL DEFAULT '0',
            `id_productos_detalles_relacion` INT(11) NOT NULL DEFAULT '0',
            `id_tarifa` INT(11) NOT NULL DEFAULT '0',
            `margen` DOUBLE(15,5) NULL DEFAULT '0.00000',
            `pvp` DOUBLE(15,5) NULL DEFAULT '0.00000',
            `fecha_modificacion` DATE NULL DEFAULT NULL,
            `id_ofertas` INT(11) NOT NULL DEFAULT '0',
            `oferta_desde` DATE NULL DEFAULT NULL,
            `oferta_hasta` DATE NULL DEFAULT NULL,
            `pvp_oferta` DOUBLE(15,5) NULL DEFAULT '0.00000',
        PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS PVP</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS PVP</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_stock_lotes_series";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_producto` INT(11) NOT NULL DEFAULT '0',
            `id_productos_detalles_relacion` INT(11) NOT NULL DEFAULT '0',
            `numero_serie` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `lote` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `caducidad` DATE NULL DEFAULT NULL,
            `control_stock` TINYINT(1) NOT NULL DEFAULT '0',
            `stock` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
            `fecha_alta` DATE NULL DEFAULT NULL,
            `fecha_modificacion` DATE NULL DEFAULT NULL,
        PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS STOCK LOTES SERIES</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS STOCK LOTES SERIES</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_detalles";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_idioma` INT(11) NOT NULL DEFAULT '0',
            `id_enlace_productos_detalles` INT(11) NOT NULL DEFAULT '0',
            `detalle` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `activo` TINYINT(1) NOT NULL DEFAULT '1',
        PRIMARY KEY (`id`) USING BTREE,INDEX `id_categoria` (`id_categoria`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS DETALLES</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS DETALLES</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_detalles_datos";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_productos_detalles` INT(11) NOT NULL DEFAULT '0',
            `detalle` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `activo` TINYINT(1) NOT NULL DEFAULT '1',
            PRIMARY KEY (`id`) USING BTREE,INDEX `id_productos_detalles` (`id_productos_detalles`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS DETALLES DATOS</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS DETALLES DATOS</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_detalles_relacion";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_producto` INT(11) NOT NULL DEFAULT '0',
            `id_observaciones` INT(11) NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS DETALLES RELACION</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS DETALLES RELACION</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_detalles_relacion_datos";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_productos_detalles_relacion` INT(11) NOT NULL DEFAULT '0',
            `id_productos_detalles` INT(11) NOT NULL DEFAULT '0',
            `id_productos_detalles_datos` INT(11) NOT NULL DEFAULT '0',
            `activo` TINYINT(1) NOT NULL DEFAULT '1',
            `fecha_alta` DATE NULL DEFAULT NULL,
            `fecha_modificacion` DATE NULL DEFAULT NULL,
        PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS DETALLES RELACION</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS DETALLES RELACION</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_relacionados";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_producto` INT(11) UNSIGNED NOT NULL,
            `id_relacionado` INT(11) UNSIGNED NOT NULL,
            `id_grupo` INT(11) UNSIGNED NULL DEFAULT '0',
            `cantidad` DOUBLE(15,5) NULL DEFAULT '0.00000',
            `sumar_importe` TINYINT(1) NULL DEFAULT '0',
            `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
        PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS RELACIONADOS</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS RELACIONADOS</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_grupos";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_idioma` INT(11) UNSIGNED NOT NULL DEFAULT '0',
            `descripcion` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
        PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS GRUPOS</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS GRUPOS</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_observaciones";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `observacion` TEXT NOT NULL COLLATE 'utf8_spanish_ci',
        PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS OBSERVACIONES</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS OBSERVACIONES</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_images";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_producto` INT(11) NULL DEFAULT NULL,
            `id_productos_detalles_relacion` INT(11) NULL DEFAULT NULL,
            `imagen` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `updated` VARCHAR(12) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `alt` VARCHAR(60) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `tittle` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `orden` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `activo` TINYINT(1) NOT NULL DEFAULT '1',
        PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS IMAGES</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS IMAGES</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_iva";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE IF NOT EXISTS `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `iva` DOUBLE(7,2) NULL DEFAULT NULL,
            `recargo` DOUBLE(7,2) NULL DEFAULT NULL,
            `prioritario` TINYINT(1) NOT NULL DEFAULT '0',
            `activo` TINYINT(1) NOT NULL DEFAULT '1',
        PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS IVA</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS IVA</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_sku";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_producto` INT(11) NOT NULL DEFAULT '0',
            `id_productos_detalles_relacion` INT(11) NOT NULL DEFAULT '0',
            `codigo_barras` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `referencia` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `fecha_alta` DATE NULL DEFAULT NULL,
            `fecha_modificacion` DATE NULL DEFAULT NULL,
        PRIMARY KEY (`id`) USING BTREE,INDEX `codigo_barras` (`codigo_barras`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS SKU</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS SKU</div></div>";
            $errores += 1;
        }
    }

    $tabla = "productos_otros";
    $result = $conn->query("SELECT count(*) AS existe FROM information_schema.TABLES WHERE TABLE_SCHEMA='" . $nombre_base_sys . "' AND TABLE_NAME='" . $tabla . "'");
    if ($result[0]['existe'] == 0) {
        $result = $conn->query("CREATE TABLE `" . $tabla . "` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_producto` INT(11) NOT NULL DEFAULT '0',
            `id_productos_detalles_relacion` INT(11) NOT NULL DEFAULT '0',
            `tienda` TINYINT(1) NOT NULL DEFAULT '0',
            `url_externa` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_spanish_ci',
            `disponibilidad` TINYINT(1) NOT NULL DEFAULT '1',
            `fecha_modificacion` DATE NULL DEFAULT NULL,
            `enviar` INT(11) NOT NULL DEFAULT '0',
            `manual` TINYINT(1) NOT NULL DEFAULT '0',
            `profesionales` TINYINT(1) NOT NULL DEFAULT '0',
            `peso` DOUBLE(15,5) NULL DEFAULT '0.00000',
            `bultos` DOUBLE(15,5) NULL DEFAULT '0.00000',
            `gastos` DOUBLE(15,5) NULL DEFAULT '0.00000',
            `envio_gratis` TINYINT(1) NOT NULL DEFAULT '0',
            `aplicar_descuento` TINYINT(1) NOT NULL DEFAULT '0',
            `descuento_maximo` DOUBLE(15,5) NULL DEFAULT '0.00000',
        PRIMARY KEY (`id`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;");
        if($result) {
            echo "<div class='grid-1'><div class='row aviso-ok'>Creada nueva tabla PRODUCTOS IVA</div></div>";
        }else {
            echo "<div class='grid-1'><div class='row aviso-error'>No se ha podido crear la nueva tabla PRODUCTOS IVA</div></div>";
            $errores += 1;
        }
    }

    unset($conn);

    $conn = new db(0);
    $conn->query("SET NAMES 'utf8'");

    $result = $conn->query("UPDATE identificacion_panel SET revisar_tablas=0 WHERE id=" . $id_panel_sys . " LIMIT 1");
    unset($conn);

    if($errores == 0) {
        $mensaje = "TABLAS ACTUALIZADAS CORRECTAMENTE.";
    }else {
        $mensaje = "NO SE HAN PODIDO ACTUALIZAR LAS TABLAS CORRECTAMENTE.";
    }
    ?>
    <div class="grid-1"><div class='row aviso'><?PHP echo $mensaje; ?></div></div>
    <div class="grid-1">
        <div class="row">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/" class="botones-apartados text-center">
                CONTINUAR
            </a>
        </div>
    </div>
    <?php
}
?>
</div>
<div id="info-main" class="text-center hide"></div>
