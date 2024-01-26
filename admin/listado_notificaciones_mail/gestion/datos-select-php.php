<?php
$conn = new db($id_panel_sys);
$conn->query("SET NAMES 'utf8'");

require($_SERVER['DOCUMENT_ROOT']."/admin/accesos/identificacion.php");
require($_SERVER['DOCUMENT_ROOT']."/assets/modulos/notificaciones/modelo/repositorio/ListadoNotificacionesStockRepositorio.php");

function getProducto($conn, $productoId)
{
    $query = /** @lang text */
        "SELECT * FROM productos WHERE id = $productoId";
    $result = $conn->query($query);
    return  array_shift($result);
}

function getLibrador($conn, $libradorId)
{
    $query = /** @lang text */
        "SELECT * FROM libradores WHERE id = $libradorId";
    $result = $conn->query($query);
    return  array_shift($result);
}

if($identificacion_acceso_sys == true) {
    switch ($select_sys) {
        case "listado-filtrado":
            $listadoNotificacionesStockRepositorio = new ListadoNotificacionesStockRepositorio($conn);
            $results = $listadoNotificacionesStockRepositorio->getSearch();
            $notificationsStock = [];
            foreach ($results as $item ){
                $producto = getProducto($conn, intval($item['id_producto']));
                $libradorId = $item['id_librador'];
                $librador = '';
                $tipo = '';
                if (!empty($libradorId)) {
                    $librador = getLibrador($conn, intval($libradorId));
                    $libradorId = $librador['id'];
                    $librador = $librador['nombre'];
                    $tipo = $librador['tipo'];
                }
                $notify = new stdClass();
                $notify->id = $item['id'];
                $notify->id_librador = $libradorId;
                $notify->tipo = $tipo;
                $notify->librador = $librador;
                $notify->producto = $producto['descripcion'];
                $notify->email = $item['email'];
                $notify->notificado = $item['notificado'];
                $notificationsStock[] = $notify;
            }

            if (!empty($descarga_url) && $descarga_url == 'csv') {
                $return = 'Librador;Producto;Email;Abierto';

                foreach ($notificationsStock as $notify) {
                    $return .= "\n";
                    $return .= $notify->librador . ';' . $notify->producto . ';' . $notify->email . ';' . $notify->notificado;
                }

                header("Content-Type: text/csv");
                header("Content-Disposition: attachment; filename=notifiacionesStock.csv");
                echo $return;
            }

            if (isset($ajax_sys)) {
                echo json_encode([
                    'notificationsStock' => $notificationsStock
                ]);
            }
            break;
    }
}