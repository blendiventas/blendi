<div id="capa_filtros" class="capa-filtros bg-main">
    <?php
    require($_SERVER['DOCUMENT_ROOT']."/admin/documentos/vistas/pantalla-filtros.php");
    ?>
</div>
<div id="capa_tpv" class="capa-main bg-main">
    <?php
    echo "TPV";

    echo "<br /><br />Acción: ".$accion_url."<br />";
    echo "Librado: ".$librado_url."<br />";
    echo "Documento: ".$documento_url."<br />";
    ?>
</div>