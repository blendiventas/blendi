<?php
if(!isset($id_url)) {
    ?>
    <div id="capa_filtros" class="capa-filtros bg-main">
        <?php
        require($_SERVER['DOCUMENT_ROOT']."/admin/grupos_clientes/vistas/pantalla-filtros.php");
        ?>
    </div>
    <div id="capa_lista" class="capa-main bg-main">
        <?php
        require($_SERVER['DOCUMENT_ROOT']."/admin/grupos_clientes/vistas/pantalla-lista.php");
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
        require($_SERVER['DOCUMENT_ROOT']."/admin/grupos_clientes/vistas/pantalla-ficha.php");
        ?>
    </div>
    <div id="info-main" class="text-center"></div>
    <?php
}