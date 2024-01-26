<?php

require($_SERVER['DOCUMENT_ROOT']."/assets/conn/ddbb.php");

$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$result = $conn->query("SELECT id_panel FROM identificacion_accesos WHERE sesion='" . $id_sesion . "' ORDER BY id DESC LIMIT 1");
if($conn->registros() == 1) {
    $id_panel = $result[0]['id_panel'];
}else {
    throw new Exception("Acceso no permitido.");
}
unset($conn);

$raiz = $_SERVER['DOCUMENT_ROOT'] . '/enviar_mails/ficheros/' . $id_panel;
if ( !is_dir( $raiz ) ) {
    mkdir( $raiz );
}

$conn = new db($id_panel);
$conn->query("SET NAMES 'utf8'");

$result = $conn->query("SELECT decimales_cantidades,decimales_importes FROM configuracion LIMIT 1");
if($conn->registros() == 1) {
    $decimales_cantidades = $result[0]['decimales_cantidades'];
    $decimales_importes = $result[0]['decimales_importes'];
}

$funcion_origen = "imprimirDocumento";
require("../web-gestion/documento_actualizar_datos.php");

require_once('fpdf/fpdf.php');
require_once('fpdf/fpdi.php');

$result = $conn->query("SELECT nombre_fiscal FROM datos_empresa LIMIT 1");
$empresa = stripslashes($result[0]['nombre_fiscal']);

$uniqueId = uniqid();
$nombre_archivo = $raiz . "/documento_" . $id_documento_1 . "_" . $uniqueId . ".pdf";
$nombre_pdf = "documento_" . $id_documento_1 . "_" . $uniqueId . ".pdf";

$pdf = new FPDI();

$pdf->AddPage('P', [60, 80 + (10 * count($id_documento_2))]);
$pdf->SetFont('Arial', 'B', 6);
$pdf->setXY(0,0);
$pdf->SetLeftMargin(0);
$pdf->SetRightMargin(0);

$str = iconv('UTF-8', 'windows-1252', $nombre_comercial);
$pdf->Cell(0,3,$str,0,1,'C');
$str = iconv('UTF-8', 'windows-1252', $nombre_fiscal);
$pdf->Cell(0,3,$str,0,1,'C');
$str = iconv('UTF-8', 'windows-1252', $nif);
$pdf->Cell(0,3,$str,0,1,'C');
$str = iconv('UTF-8', 'windows-1252', $direccion);
$pdf->Cell(0,3,$str,0,1,'C');
$str = iconv('UTF-8', 'windows-1252', $codigo_postal . ' ' . $poblacion);
$pdf->Cell(0,3,$str,0,1,'C');
$str = iconv('UTF-8', 'windows-1252', $provincia);
$pdf->Cell(0,3,$str,0,1,'C');
if (!empty($tel1)) {
    $str = iconv('UTF-8', 'windows-1252', $tel1);
    $pdf->Cell(0,3,$str,0,1,'C');
}
if (!empty($tel2)) {
    $str = iconv('UTF-8', 'windows-1252', $tel2);
    $pdf->Cell(0,3,$str,0,1,'C');
}
if (!empty($movil)) {
    $str = iconv('UTF-8', 'windows-1252', $movil);
    $pdf->Cell(0,3,$str,0,1,'C');
}
if (!empty($fax)) {
    $str = iconv('UTF-8', 'windows-1252', $fax);
    $pdf->Cell(0,3,$str,0,1,'C');
}
if (!empty($email)) {
    $str = iconv('UTF-8', 'windows-1252', $email);
    $pdf->Cell(0,3,$str,0,1,'C');
}
$str = '';
$pdf->Cell(0,1,$str,'B',1,'C');

$str = iconv('UTF-8', 'windows-1252', $nombre_librador . " " . $apellido_1_librador . " " . $apellido_2_librador);
$pdf->Cell(0,3,$str,0,1,'L');
$str = iconv('UTF-8', 'windows-1252', $razon_social_librador);
$pdf->Cell(0,3,$str,0,1,'L');
if ($movil_librador) {
    $str = iconv('UTF-8', 'windows-1252', $movil_librador);
    $pdf->Cell(0,3,$str,0,1,'L');
}
if ($nif_librador) {
    $str = iconv('UTF-8', 'windows-1252', $nif_librador);
    $pdf->Cell(0,3,$str,0,1,'L');
}
if ($direccion_librador) {
    $str = iconv('UTF-8', 'windows-1252', $direccion_librador);
    $pdf->Cell(0,3,$str,0,1,'L');
}
if ($numero_librador) {
    $str = iconv('UTF-8', 'windows-1252', 'Número: ' . $numero_librador);
    $pdf->Cell(0,3,$str,0,1,'L');
}
if ($escalera_librador) {
    $str = iconv('UTF-8', 'windows-1252', 'Escalera: ' . $escalera_librador);
    $pdf->Cell(0,3,$str,0,1,'L');
}
if ($piso_librador) {
    $str = iconv('UTF-8', 'windows-1252', 'Piso: ' . $piso_librador);
    $pdf->Cell(0,3,$str,0,1,'L');
}
if ($puerta_librador) {
    $str = iconv('UTF-8', 'windows-1252', 'Puerta: ' . $puerta_librador);
    $pdf->Cell(0,3,$str,0,1,'L');
}
if ($codigo_postal_librador || $localidad_librador) {
    $str = iconv('UTF-8', 'windows-1252', $codigo_postal_librador . ' ' . $localidad_librador);
    $pdf->Cell(0,3,$str,0,1,'L');
}
$str = '';
$pdf->Cell(0,1,$str,'B',1,'C');
if ($nif_librador) {
    $titulo_documento = 'FACTURA';
} else {
    $titulo_documento = 'TICKET';
}
$pdf->Cell(29,3,$titulo_documento . ': ' . $numero_documento,0);
$pdf->Cell(29,3,'Camarero: ' . $usuario_documento,0, 0, 'R');
$pdf->Ln();
$pdf->Cell(29,3,$fecha_documento,0);
$pdf->Cell(29,3,'Pago: ' . $modalidad_pago,0, 0, 'R');
$pdf->Ln();
$str = '';
$pdf->Cell(0,1,$str,'B',1,'C');

$pdf->Cell(9,3,'Cant.',0,0,'R');
$pdf->Cell(40,3,'Producto',0);
$pdf->Cell(10,3,'PVP',0,0,'R');
$pdf->Ln();
foreach ($id_documento_2 as $key => $valor) {
    $pdf->Cell(9,3,$cantidad[$key] . 'x',0,0,'R');
    $str = iconv('UTF-8', 'windows-1252', $descripcion_producto[$key]);
    $pdf->Cell(40,3,$str,0);
    $str = iconv('UTF-8', 'windows-1252', number_format($total_despues_descuento[$key], 2, ',', '.') . '€');
    $pdf->Cell(10,3,$str,0,0,'R');
    $pdf->Ln();
}
$str = '';
$pdf->Cell(0,1,$str,'B',1,'C');

foreach ($iva as $key_iva_matriz => $valor_iva_matriz) {
    if ($importe_iva[$key_iva_matriz] > 0) {
        $str = iconv('UTF-8', 'windows-1252', $valor_iva_matriz . '% sobre ' . number_format($base_iva[$key_iva_matriz], 2, ',', '.') . '€: ' . number_format($importe_iva[$key_iva_matriz], 2, ',', '.') . '€');
        $pdf->Cell(59,3,$str,0,0,'R');
        $pdf->Ln();
    }
    if ($importe_recargo[$key_iva_matriz] > 0) {
        $str = iconv('UTF-8', 'windows-1252', $recargo[$key_iva_matriz] . '% sobre ' . number_format($base_iva[$key_iva_matriz], 2, ',', '.') . '€: ' . number_format($importe_recargo[$key_iva_matriz], 2, ',', '.') . '€');
        $pdf->Cell(59,3,$str,0,0,'R');
        $pdf->Ln();
    }
}
$pdf->SetFont('Arial', 'B', 10);
$str = iconv('UTF-8', 'windows-1252', 'TOTAL ' . $titulo_documento . ': ' . number_format($total, 2, ',', '.') . '€');
$pdf->Cell(59,3,$str,0,0,'R');
$pdf->Ln();

$pdf->Output('F', $nombre_archivo, true);
