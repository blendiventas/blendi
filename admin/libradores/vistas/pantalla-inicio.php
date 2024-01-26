<?php
if (!isset($tipo_libradores_url) || ($tipo_libradores_url !== 'cli' && $tipo_libradores_url !== 'pro' && $tipo_libradores_url !== 'cre')) {
    throw new Exception('Un librador debe ser cliente, proveedor o creditor.');
}
if(!isset($id_url)) {
    ?>
    <div id="capa_filtros" class="capa-filtros bg-main">
        <?php
        require($_SERVER['DOCUMENT_ROOT'] . "/admin/libradores/vistas/pantalla-filtros.php");
        ?>
    </div>
    <div id="capa_lista" class="capa-main bg-main">
        <?php
        require($_SERVER['DOCUMENT_ROOT'] . '/admin/libradores/vistas/pantalla-lista.php');
        ?>
    </div>
    <div id="capa_ficha" class="capa-main bg-main hide"></div>
    <div id="info-main" class="text-center"></div>
    <?php
}else {
    ?>
    <div id="capa_filtros" class="capa-filtros bg-main hide"></div>
    <div id="capa_lista" class="capa-main bg-main hide"></div>
    <div id="capa_ficha" class="capa-main bg-main">
        <?php
        require($_SERVER['DOCUMENT_ROOT'] . "/admin/libradores/vistas/pantalla-ficha.php");
        ?>
    </div>
    <div id="info-main" class="text-center"></div>
    <?php
}