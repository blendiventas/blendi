<?php
if($acceso_correcto_sys != 1) {
    throw new Exception("Acceso no autorizado.");
}

$fechaRevision = new DateTime($revisar_tablas_sys);

$actualizaciones = [];

$cdir = scandir("./versiones/0_1");
foreach ($cdir as $key => $value)
{
    if (!in_array($value,array(".","..","actualizaciones.php")))
    {
        $actualizacion = new stdClass();
        $actualizacion->folder = '0_1/';
        $fecha = substr($value, 0, 4) . '/' . substr($value, 4, 2) . '/' . substr($value, 6, 2) . ' ' . substr($value, 8, 2) . ':' . substr($value, 10, 2) . ':' . substr($value, 12, 2);
        $fechaDatetime = new DateTime($fecha);
        $actualizacion->fecha = $fechaDatetime;
        $actualizaciones[] = $actualizacion;
    }
}
$cdir = null;
$cdir = scandir("./versiones/0_2");
foreach ($cdir as $key => $value)
{
    if (!in_array($value,array(".","..","actualizaciones.php")))
    {
        $actualizacion = new stdClass();
        $actualizacion->folder = '0_2/';
        $fecha = substr($value, 0, 4) . '/' . substr($value, 4, 2) . '/' . substr($value, 6, 2) . ' ' . substr($value, 8, 2) . ':' . substr($value, 10, 2) . ':' . substr($value, 12, 2);
        $fechaDatetime = new DateTime($fecha);
        $actualizacion->fecha = $fechaDatetime;
        $actualizaciones[] = $actualizacion;
    }
}
sort($actualizaciones);

foreach ($actualizaciones as $actualizacion) {
    if ($fechaRevision < $actualizacion->fecha) {
        require ($actualizacion->folder . $actualizacion->fecha->format('YmdHis') . '.php');
    }
}