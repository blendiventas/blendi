<?php
/*
$familias['id'][]
$familias['descripcion'][]
$familias['foto'][]

<ul>
    <li>
        <a href="#">
            <img class="icono" src="icons/System/search-line.svg" alt="My Happy SVG" />Dashboard
        </a>
    </li>
*/
function linea_familias($host,$id_familia,$familia,$de,$descripcion_url,$alt,$ids,$descripciones,$descripciones_url,$alts,$des) {
    $clase_boton = "botones-familias";
    if($de != 0) {
        $clase_boton = "botones-subfamilias";
    }
    foreach ($ids as $key => $valor) {
        if($des[$key] == $id_familia) {
            if(!isset($subfamilias_descripcion)) {
                ?>
                <a class="<?php echo $clase_boton; ?>" onclick="collapseCapa('capa-familias-<?php echo $id_familia; ?>');">
                    <?php echo $familia; ?>
                </a>
                <?php
            }
            $subfamilias_id[] = $valor;
            $subfamilias_descripcion[] = $descripciones[$key];
            $subfamilias_de[] = $des[$key];
            $subfamilias_descripcion_url[] = $descripciones_url[$key];
            $subfamilias_alt[] = $alts[$key];
        }
    }
    if(!isset($subfamilias_descripcion)) {
        ?>
        <a href="<?php echo $host_url.$descripcion_url; ?>" class="<?php echo $clase_boton; ?>" title="<?php echo $alt; ?>">
            <?php echo $familia; ?>
        </a>
        <?php
    }else {
        ?>
        <div id="capa-familias-<?php echo $id_familia; ?>" class="capa-familias">
            <?php
            foreach ($subfamilias_descripcion as $key_sub => $valor_sub) {
                linea_familias($host,$subfamilias_id[$key_sub],$valor_sub,$subfamilias_de[$key_sub],$subfamilias_descripcion_url[$key_sub],$subfamilias_alt[$key_sub],$ids,$descripciones,$descripciones_url,$alts,$des);
            }
            ?>
        </div>
        <?php
    }
    unset($subfamilias_id);
    unset($subfamilias_descripcion);
    unset($subfamilias_descripcion_url);
    unset($subfamilias_alt);
}
foreach ($familias['id'] as $key => $valor) {
    if($familias['de'][$key] == 0) {
        linea_familias($host,$valor,$familias['descripcion'][$key],$familias['de'][$key],$familias['descripcion_url'][$key],$familias['alt'][$key],$familias['id'],$familias['descripcion'],$familias['descripcion_url'],$familias['alt'],$familias['de']);
    }
}
echo "FAMILIAS--------------------------------------------------------------------------------------------";