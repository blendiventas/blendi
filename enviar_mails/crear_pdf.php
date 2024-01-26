<?php

require("../web-gestion/documento_actualizar_datos.php");

$plantilla = '';
if ($tipo_documento == 'ped' && isset($tienda) && !empty($tienda)) {
    $recargo_incluido = false;
    $recargo_total = 0;
    if (!empty($importe_recargo)) {
        foreach ($importe_recargo as $importe_recargo_tramo) {
            if ($importe_recargo_tramo > 0) {
                $recargo_incluido = true;
                $recargo_total += $importe_recargo_tramo;
            }
        }
    }

    $logoPath = "https://" . $_SERVER['SERVER_NAME'] . '/images/datos_empresa/' . $logo_datos_empresa;
    $plantilla .= '
        <div style="background-color: #ffffff">
            <table border="0" width="675" cellspacing="0" cellpadding="0" align="center">
                <tbody>
                    <tr>
                        <td style="height: 100px; padding-left: 20px">
                            <a href="http://' . $_SERVER['SERVER_NAME'] . ((empty($tienda))? '' : '/web/' . $tienda) . '" rel="noreferrer" target="_blank">
                                <img style="width: auto; height: 80%" src="' . $logoPath . '" />
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="min-width: 300px; vertical-align: middle" colspan="2">
                            <div style="padding: 20px; width: 95%; height: auto; border-radius: 8px; background-color: #f5f5f5; box-shadow: 0px 0px 5px 5px #E5E4E3;">
                                <table style="width: 95%" align="center">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <p style="color: #333231; line-height: 20px; font-weight: 400; font-family: Arial, Helvetica, sans-serif; font-size: 9pt; margin: 0px">
                                                Hola <strong>'.$nombre_librador.'</strong><br />Gracias por confiar en <strong>' . ((empty($tienda))? $_SERVER['SERVER_NAME'] : $tienda) . '</strong>. Esta es una confirmación automática del pedido que acaba de enviarnos, si tiene cualquier duda o desea hacer alguna modificación recuerde que debe contactar con nosotros antes de 24 horas. Repase con especial atención los datos personales que ha incluido (dirección,email,etc...) para verificar que está todo correcto. Gracias por confiar en nuestros servicios y hasta pronto!
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="width: 95%; height: auto; background: #FFF none repeat scroll 0% 0%; border-radius: 10px; padding: 2%">
                                                <table style="table-layout: fixed; font-family: Arial, Helvetica, sans-serif; font-size: 9pt; width: 99%; border: 0" cellspacing="0" cellpadding="4">
                                                    <tbody>
                                                    <tr>
                                                        <td style="color: crimson; line-height: 20px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 10pt; margin: 0px">
                                                            SU PEDIDO
                                                        </td>
                                                        <td>
                                                            <strong>Número de Pedido:&nbsp;
                                                                <a href="https://' . $_SERVER['SERVER_NAME'] . ((empty($tienda))? '' : '/web/' . $tienda) . '" rel="noreferrer" target="_blank">
                                                                    '.$numero_documento.'
                                                                </a>
                                                            </strong>
                                                        </td>
                                                        <td>
                                                            <strong>Fecha del Pedido:</strong>&nbsp;'.date("d-m-Y").'
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="width: 95%; height: auto; background: #FFF none repeat scroll 0% 0%; border-radius: 10px; padding: 2%">
                                                <p style="color: crimson; line-height: 20px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 10pt; margin: 0px; margin-left: 5px;">
                                                    SU CESTA
                                                </p>
                                                <div style="margin: 5px auto; width: 95%">
                                                    <table style="table-layout: fixed; font-family: Arial, Helvetica, sans-serif; font-size: 9pt; width: 99%; border: 0" cellspacing="0" cellpadding="4">
                                                        <tbody>';

    $color_fondo = "#f5f5f5";
    $subtotal = 0;
    foreach ($id_documento_2 as $key_id_documento_2 => $valor_id_documento_2) {
        $plantilla .= '
            <tr style="background: '.$color_fondo.'">
                <td style="width: 10%">
                    <img src="'.$imagen_producto[$key_id_documento_2].'" width="44" height="44" />
                </td>
                <td style="width: 7%; text-align: right;">
                    '.number_format($cantidad[$key_id_documento_2],$decimales_cantidades,',','.').' x
                </td>
                <td style="width: 60%">
                    <a href="https://' . $_SERVER['SERVER_NAME'] . ((empty($tienda))? '' : '/web/' . $tienda) . '/categoria/' . $slug[$key_id_documento_2] . '" rel="noreferrer" target="_blank">
                        '.$descripcion_producto[$key_id_documento_2].'
                    </a>
                    <div style="text-align: center; padding-top: 8px;">
                        (Fecha aproximada de entrega: '.$fecha[$key_id_documento_2].')
                    </div>
                    <div style="text-align: center; padding-top: 8px;">
                        '.$detalles_producto[$key_id_documento_2].'
                    </div>
                </td>
                <td style="width: 15%" align="right">
                    '.number_format(($total_despues_descuento[$key_id_documento_2]), 2, ',', '.').' &euro;
                </td>
            </tr>';
        if($color_fondo == "#f5f5f5") {
            $color_fondo = "#ffffff";
        }else {
            $color_fondo = "#f5f5f5";
        }
    }
    $plantilla .= '
        <tr>
            <td colspan="4" style="height: 5px"><hr></td>
        </tr>
        <tr>
            <td style="border-top: 2% solid #333231; border-bottom: 2% solid #333231; margin: 1%" colspan="4">
                <table style="font-family: Arial, Helvetica, sans-serif; font-size: 9pt; table-layout: fixed; width: 100%; border: 0" cellspacing="0" cellpadding="4">
                    <tbody>
                    <tr>
                        <td style="width: 70%" align="right">Subtotal:</td>
                        <td style="width: 25%" align="right">'.number_format($base, 2, ',', '.').' &euro;</td>
                    </tr>';
    if(!empty($importe_descuento_librador)) {
        $plantilla .= '
            <tr>
                <td style="width: 70%" align="right">Descuento cliente:</td>
                <td style="width: 25%" align="right">'.number_format($importe_descuento_librador, 2, ',', '.').' &euro;</td>
            </tr>';
    }
    if(!empty($importe_descuento_pp)) {
        $plantilla .= '
            <tr>
                <td style="width: 70%" align="right">Descuento p.p.:</td>
                <td style="width: 25%" align="right">'.number_format($importe_descuento_pp, 2, ',', '.').' &euro;</td>
            </tr>';
    }
    if(isset($tramite_duanero)) {
        $plantilla .= '
            <tr>
                <td style="width: 70%" align="right">Trámite duanero:</td>
                <td style="width: 25%" align="right">'.$tramite_duanero.' &euro;</td>
            </tr>';
    }
    if(!empty($recargo_incluido)) {
        $plantilla .= '
            <tr>
                <td style="width: 70%" align="right">R.E.:</td>
                <td style="width: 25%" align="right">'.number_format($recargo_total, 2, ',', '.').' &euro;</td>
            </tr>';
    }
    $plantilla .= '
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <table style="font-family: Arial, Helvetica, sans-serif; font-size: 9pt; table-layout: fixed; width: 100%; border: 0" cellspacing="0" cellpadding="4">
                    <tbody>
                    <tr>
                        <td style="width: 70%" align="right"><strong>Total:</strong></td>
                        <td style="width: 25%" align="right"><strong>'.number_format($total, 2, ',', '.').' &euro;</strong></td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>';
    $plantilla .= '
                            </tbody>
                        </table>
                    </div>
                </div>
            </td>
        </tr>';
    $plantilla .= '
        <tr>
            <td>
                <table style="width: 100%">
                    <tbody>
                    <tr>
                        <td colspan="2">
                            <div style="padding: 2%; border-radius: 10px; background: #fff">
                                <p style="color: crimson; line-height: 20px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 10pt; margin: 0; margin-left: 5px;">
                                    DATOS
                                </p>
                                <p style="color: #333231; line-height: 20px; font-weight: 400; font-family: Arial, Helvetica, sans-serif; font-size: 9pt; margin: 0; margin-left: 5px;">
                                    <table style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 9pt;">
                                        <tbody>
                                            <tr>
                                                <td style="background: #f5f5f5;">Número de pedido</td>
                                                <td style="background: #fdf9f9;">
                                                    '.$numero_documento.'
                                                </td>
                                                <td style="background: #f5f5f5;">Primer pedido</td>
                                                <td style="background: #fdf9f9;">-</td>
                                            </tr>
                                            <tr>
                                                <td style="background: #f5f5f5;">Núm. de cliente</td>
                                                <td style="background: #fdf9f9;">-</td>
                                                <td style="background: #f5f5f5;">E-mail</td>
                                                <td style="background: #fdf9f9;">'.$email_librador.'</td>
                                            </tr>
                                            <tr>
                                                <td style="background: #f5f5f5;">Nombre</td>
                                                <td style="background: #fdf9f9;">'.$nombre_librador.'</td>
                                                <td style="background: #f5f5f5;">Primer apellido</td>
                                                <td style="background: #fdf9f9;">'.$apellido_1_librador.'</td>
                                            </tr>
                                            <tr>
                                                <td style="background: #f5f5f5;">Segundo apellido</td>
                                                <td style="background: #fdf9f9;">'.$apellido_2_librador.'</td>
                                                <td style="background: #f5f5f5;">DNI</td>
                                                <td style="background: #fdf9f9;">'.$nif_librador.'</td>
                                            </tr>
                                            <tr>
                                                <td style="background: #f5f5f5;">Dirección</td>
                                                <td style="background: #fdf9f9;">'.$direccion_librador.'</td>
                                                <td style="background: #f5f5f5;">N°</td>
                                                <td style="background: #fdf9f9;">'.$numero_librador.'</td>
                                            </tr>
                                            <tr>
                                                <td style="background: #f5f5f5;">Escalera</td>
                                                <td style="background: #fdf9f9;">'.$escalera_librador.'</td>
                                                <td style="background: #f5f5f5;">Piso</td>
                                                <td style="background: #fdf9f9;">'.$piso_librador.'</td>
                                            </tr>
                                            <tr>
                                                <td style="background: #f5f5f5;">Puerta</td>
                                                <td style="background: #fdf9f9;">'.$puerta_librador.'</td>
                                                <td style="background: #f5f5f5;">Código postal</td>
                                                <td style="background: #fdf9f9;">'.$codigo_postal_librador.'</td>
                                            </tr>
                                            <tr>
                                                <td style="background: #f5f5f5;">Localidad</td>
                                                <td style="background: #fdf9f9;">'.$localidad_librador.'</td>
                                                <td style="background: #f5f5f5;">Provincia</td>
                                                <td style="background: #fdf9f9;">'.$provincia_librador.'</td>
                                            </tr>
                                            <tr>
                                                <td style="background: #f5f5f5;">País</td>
                                                <td style="background: #fdf9f9;">-</td>
                                                <td style="background: #f5f5f5;">Teléfono</td>
                                                <td style="background: #fdf9f9;">'.$movil_librador.'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>';
    if(!empty($observaciones)) {
        $plantilla .= '
            <tr>
                <td>
                    <div style="padding: 2%; border-radius: 10px; background: #fff">
                        <p style="color: crimson; line-height: 20px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 10pt; margin: 0; margin-left: 5px;">
                            OBSERVACIONES
                        </p>
                        <p style="color: #333231; line-height: 20px; font-weight: 400; font-family: Arial, Helvetica, sans-serif; font-size: 9pt; margin: 0; margin-left: 5px;">
                            '.$nota_documento.'<br />
                        </p>
                    </div>
                </td>
            </tr>';
    }
    $plantilla .= '
                                    <tr>
                                        <td style="padding-top: 10px">
                                            <div style="width: 95%; height: auto; background: #FFF none repeat scroll 0% 0%; border-radius: 10px; padding: 2%">
                                                <table style="table-layout: fixed; font-family: Arial, Helvetica, sans-serif; font-size: 9pt; width: 99%; border: 0" cellspacing="0" cellpadding="4">
                                                    <tbody>
                                                    <tr>
                                                        <td style="color: crimson; line-height: 20px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 10pt; margin: 0px">
                                                            INFORMACIÓN LEGAL
                                                        </td>
                                                        <td>
                                                            <a href="https://' . $_SERVER['SERVER_NAME'] . ((empty($tienda))? '' : '/web/' . $tienda) . '/condiciones-uso" rel="noreferrer" target="_blank">
                                                                Condiciones de Uso
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="margin: 10px 0px 0px 20px; float: left; width: 95%; height: auto">
                                                <p style="color: #333231; line-height: 20px; font-weight: 400; font-family: Arial, Helvetica, sans-serif; font-size: 9pt; margin: 0px">
                                                    Esperamos que su experiencia de compra en <strong>' . ((empty($tienda))? $_SERVER['SERVER_NAME'] : $tienda) . '</strong> haya sido satisfactoria y pronto vuelva a confiar en nosotros. Le esperamos.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>';
}

$id_modelo = (empty($_POST['modelo_documento']))? null : $_POST['modelo_documento'];

$modelCondicion = '';
if ($id_modelo) {
    $modelCondicion = 'id = ' . $id_modelo . ' AND ';
}

$query = "SELECT id,ancho,alto,interlineado,marcar_lineas,lineas_pagina FROM modelos_impresion_1 WHERE " . $modelCondicion . "tipo_documento='" . $tipo_documento . "' AND serie='" . $serie_documento . "' LIMIT 1";
$result_modelos_1 = $conn->query($query);

$query = "SELECT * FROM modelos_impresion_2 WHERE id_modelos_impresion_1=" . $result_modelos_1[0]['id'] . " AND mostrar=1 ORDER BY inicio_alto,inicio_ancho";
$result_modelos_2 = $conn->query($query);

if($select_sys == "enviar-documentos" || $select_sys == "imprimir-documento") {
    $pdf = new FPDI();
}
$pdf->AddPage();
$pdf->setSourceFile($raiz . "/modelos_impresion_" . $result_modelos_1[0]['id'] . ".pdf");
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx);
$alto_linea = 0;
$lineas_pagina = $result_modelos_1[0]['lineas_pagina'];

require("crear_pdf_cabecera.php");
require("crear_pdf_cuerpo.php");
require("crear_pdf_pie.php");

if($select_sys == "enviar-documentos" || $select_sys == "imprimir-documento") {
    $pdf->Output('F', $nombre_archivo, true);
}

require("unset_arrays.php");