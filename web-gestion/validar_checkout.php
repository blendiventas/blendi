<?php
require $_SERVER['DOCUMENT_ROOT'] . '/assets/conn/ddbb.php';
function validarImporteDisponibilidad($conn, $value)
{
    $actionArray = [];
    $select_sys = 'web-producto';
    $id_producto_sys = $value['id_producto'];
    $ejercicio = date('Y');
    require 'datos-productos.php';
    try{
         $tarifaPrioritaria = $conn->query("SELECT id FROM tarifas  order by prioritaria desc, id;");
        if (empty($tarifaPrioritaria)) {
            throw new Exception('No hay tarifas disponibles.');
        }
        $tarifaId = $tarifaPrioritaria[0]['id'];
        $productoPvp = $conn->query("SELECT * FROM productos_pvp WHERE id_producto = {$id_producto_sys}  AND id_tarifa = {$tarifaId} limit 1;");
        if (empty($productoPvp)) {
            throw new Exception('No hay pvp disponibles.');
        }
        unset($conn);
    } catch (Exception $e){
        echo json_encode(['error' => $e->getMessage()]);
    }
    $pvp_producto = $productoPvp[0]['pvp'];
    $disponibilidad =  array_shift($producto_stock);
    $cantidad = $value['cantidad'];
    $pvp_unidad = $value['pvp_unidad'];

    if ($disponibilidad == 0) {
        $actionArray['delete'] = 'delete';
    } else if ($cantidad > $disponibilidad) {
        $actionArray['update'] = 'update';
        $cantidad = $disponibilidad;
    } else if ($pvp_unidad != $pvp_producto) {
        $actionArray['update'] = 'update';
        $pvp_unidad = $pvp_producto;
    }
    if (empty($actionArray)){
        return [];
    }

    return  [
        'id_linea' => $value['id_linea'],
        'slug'=> $value['slug'],
        'id_producto' => $id_producto_sys,
        'cantidad' => $cantidad,
        'pvp_unidad' => $pvp_unidad,
        'action' => implode(',', $actionArray)
    ];
}

/**
 * @param string $tienda
 * @param array $filters
 * @throws Exception
 */
function validarCheckout(string $tienda, $filters = []): void
{
    $data = [];
    $conn = new db(0);
    $query = /** @lang string */
        "SELECT id,sector FROM identificacion_panel WHERE web_blendi='" . addslashes($tienda) . "' LIMIT 1;";
    $panel = $conn->query($query);
    if ($conn->registros() == 1) {
        $id_panel = $panel[0]['id'];
    } else {
        throw new Exception('Negocio no encontrado.');
    }
    $conn = new db($id_panel);
    $conn->query("SET NAMES 'utf8'");

    if (!empty($filters['id_documento_1'])) {
        $id_documento_1 = $filters['id_documento_1'];
        $sql = /** @lang string */
            "SELECT dt2.id as id_linea, dt2.slug, dt2.id_producto, dt2.cantidad, dt2.pvp_unidad FROM documentos_temp_2 as dt2 left join documentos_temp_1 as dt1 on dt1.id = dt2.id_documentos_1 WHERE dt1.id = " . $id_documento_1 . ";";
        $result = $conn->query($sql);
        if (!empty($result)) {
            $data['valid'] = [];
            foreach ($result as $value) {
                $validarDisponibilidad = validarImporteDisponibilidad($conn, $value);
                if (!empty($validarDisponibilidad)) {
                    $data['valid'][] = $validarDisponibilidad;
                }
            }
        }
        $data['carrito'] = $result;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}

$filters = [];
$payload = $_POST;
$tienda = $payload['tienda'];
$filters['id_documento_1'] = $payload['id_documento_1'];
validarCheckout($tienda, $filters);