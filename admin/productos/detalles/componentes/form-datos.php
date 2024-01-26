<?php
if(isset($id_productos_detalles_url)) {
    // creamos la variable para usar en los <select> de atributos y checks de datos
    $id_productos_detalles_sys = $id_productos_detalles_url;
    $id_productos_detalles_url = 0;
}
/*
Creamos las matrices con todos los datos disponibles
*/
$select_sys = "listado-filtrado-detalles";
require($_SERVER['DOCUMENT_ROOT']."/admin/productos/detalles/gestion/datos-select-php.php");
/*
Obtenemos todos los atributos disponibles para el idioma por defecto
o el atributo concreto de $id_productos_detalles_url
if(empty($id_productos_detalles_url)) {
    SELECT id,detalle FROM productos_detalles WHERE id_idioma=" . $id_idioma_sys . " AND activo=1
        ORDER BY orden
}else {
    SELECT id,detalle FROM productos_detalles
        WHERE id_idioma=" . $id_idioma_sys . " AND id<>'" . $id_productos_detalles_url . "' AND activo=1
        ORDER BY orden
}
$matriz_id_productos_detalles[]
$matriz_detalle_productos_detalles[]
*/
if(isset($matriz_id_productos_detalles)) {
    foreach ($matriz_id_productos_detalles as $key_productos_detalles => $valor_productos_detalles) {
        /*
        $atributos_disponibles[id de productos_detalles] = descripción de productos detalles;
        */
        $atributos_disponibles[$valor_productos_detalles] = $matriz_detalle_productos_detalles[$key_productos_detalles];

        $id_productos_detalles_url = $valor_productos_detalles;
        $select_sys = "listado-filtrado-datos";
        require($_SERVER['DOCUMENT_ROOT'] . "/admin/productos/detalles/gestion/datos-select-php.php");
        /*
        Obtenemos los datos del atributo $id_productos_detalles_url
        SELECT id,detalle,orden,activo FROM productos_detalles_datos
            WHERE id_productos_detalles=" . $id_productos_detalles_url . " ORDER BY orden
        $matriz_id_productos_detalles_datos[]
        $matriz_detalle_productos_detalles_datos[]
        $matriz_orden_productos_detalles_datos[]
        $matriz_activo_productos_detalles_datos[]
        */
        if(isset($matriz_id_productos_detalles_datos)) {
            foreach ($matriz_id_productos_detalles_datos as $key_productos_detalles_datos => $valor_productos_detalles_datos) {
                $datos_atributos_disponibles[$valor_productos_detalles][$valor_productos_detalles_datos] = $matriz_detalle_productos_detalles_datos[$key_productos_detalles_datos];
            }
            unset($matriz_id_productos_detalles_datos);
            unset($matriz_detalle_productos_detalles_datos);
            unset($matriz_orden_productos_detalles_datos);
            unset($matriz_activo_productos_detalles_datos);
        }
    }
    unset($matriz_id_productos_detalles);
    unset($matriz_detalle_productos_detalles);
    /*
    //Mostramos los datos obtenidos
    if(isset($atributos_disponibles)) {
        foreach ($atributos_disponibles as $key_atributos_disponibles => $valor_atributos_disponibles) {
            echo "(" . $key_atributos_disponibles . ")" . $valor_atributos_disponibles . ":<br />";
            if(isset($datos_atributos_disponibles)) {
                foreach ($datos_atributos_disponibles[$key_atributos_disponibles] as $key_datos_atributos_disponibles => $valor_datos_atributos_disponibles) {
                    echo "(" . $key_datos_atributos_disponibles . ")=" . $valor_datos_atributos_disponibles . "<br />";
                }
            }
        }
    }
    */
}