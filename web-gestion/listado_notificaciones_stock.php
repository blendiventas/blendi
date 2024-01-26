<?php
header('Content-Type: application/json');
session_start();
require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");
require($_SERVER['DOCUMENT_ROOT']."/assets/modulos/notificaciones/modelo/repositorio/ListadoNotificacionesStockRepositorio.php");

$post = $_POST['notificacion'];
$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$query = /** @lang string */
    "SELECT id,sector FROM identificacion_panel WHERE web_blendi='%s' LIMIT 1";
$query = sprintf($query, addslashes($post['tienda']));
$result = $conn->query($query);
$panel = new stdClass();
$row = array_shift($result);
$panel->id = $row['id'];
$panel->sector = $row['sector'];

$payload = new stdClass();
$payload->id_librador = null;
$payload->email = null;
if (!isset($post['id_producto'])){
    throw new Exception('id_producto is required');
}
$payload->id_producto = $post['id_producto'] ?? null;
$payload->notificado = 0;

$conn = new db($panel->id);
$conn->query("SET NAMES 'utf8'");
$where = '';
if (isset($post['id_librador'])) {
    $where = " id = %d ";
    $where = sprintf($where, addslashes($post['id_librador']));
}
if (isset($post['email'])) {
    $where = " email = '%s' ";
    $where = sprintf($where, addslashes($post['email']));
}

if (!empty($where)) {
    $query = /** @lang string */
        "select id,email from libradores where %s limit 1;";
    $query = sprintf($query, $where);
    $result = $conn->query($query);
    $row = array_shift($result);
    if (empty($row)){
        $payload->email = trim($post['email']);
    }
    if ($row) {
        $payload->id_librador = $row['id'];
        $payload->email = $row['email'];
    }
}

$listadoNotificacionesStockRepositorio = new ListadoNotificacionesStockRepositorio($conn);
if ($listadoNotificacionesStockRepositorio->hasNotificacionStock($payload->id_producto, $payload->email)) {
    echo json_encode([
        'message' => 'Ya estás suscrito a este producto'
    ]);
    exit;
}

$columns = [];
$values = [];
foreach ($payload as $column=>$v){
    if (!empty($v)){
        $columns[] = $column;
        $values[] = "'".$v."'";
    }
}
$id = $listadoNotificacionesStockRepositorio->addNotificacion($columns, $values);
echo json_encode([$id, 'message'=>'Te avisaremos cuando el producto vuelva a estar disponible.']);
exit;