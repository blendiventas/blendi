<?php
require("../web-gestion/documento_actualizar_datos.php");

//$pdf = new FPDI();
//$pdf = new FPDF('P', 'mm', array(80,110));
$pdf = new FPDI('P', 'mm', array(80,110));

foreach ($id_documento_2 as $key_id_documento_2 => $valor_id_documento_2) {
    $pdf->AddPage();
    $pdf->setSourceFile($raiz . "/etiqueta.pdf");
    $tplIdx = $pdf->importPage(1);
    $pdf->useTemplate($tplIdx);

    $altura = 45;

    $pdf->SetFont('Arial', '', 10);

    $pdf->setXY(2,$altura);
    $str = iconv('UTF-8', 'windows-1252', $descripcion_producto[$key_id_documento_2]);
    $pdf->Cell(66, 5, $str, 0, 1, 'L');

    if (!empty($referencia_producto[$key_id_documento_2])) {
        $altura += 5;
        $pdf->setXY(2,$altura);
        $str = iconv('UTF-8', 'windows-1252', "Referencia: " . $referencia_producto[$key_id_documento_2]);
        $pdf->Cell(66, 5, $str, 0, 1, 'L');
    }

    if (!empty($lote_producto[$key_id_documento_2])) {
        $altura += 5;
        $pdf->setXY(2,$altura);
        $str = iconv('UTF-8', 'windows-1252', "Lote: " . $lote_producto[$key_id_documento_2]);
        $pdf->Cell(66, 5, $str, 0, 1, 'L');
    }

    $altura += 5;
    $pdf->setXY(2,$altura);
    $codigo_barras = $cantidad[$key_id_documento_2] . ' ' . $codigo_barras_producto[$key_id_documento_2];
    $str = iconv('UTF-8', 'windows-1252', "Código barras: " . $codigo_barras);
    $pdf->Cell(66, 5, $str, 0, 1, 'L');

    // Insert a logo in the top-left corner at 300 dpi
    //try {
    //    $pdf->Image('../images/logo.png', 10, 10, -300);
    //} catch (Exception $e) {
    //var_dump($e->getMessage());
    //}

    // Insert a dynamic image from a URL
    try {
        $ua = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13';
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $host . 'barcode.php?codetype=Code39&size=40&text=' . urlencode($codigo_barras) . '&print=true');

        curl_setopt($ch, CURLOPT_HEADER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        //curl_setopt($ch, CURLOPT_COOKIE, 'NID=67=pdjIQN5CUKVn0bRgAlqitBk7WHVivLsbLcr7QOWMn35Pq03N1WMy6kxYBPORtaQUPQrfMK4Yo0vVz8tH97ejX3q7P2lNuPjTOhwqaI2bXCgPGSDKkdFoiYIqXubR0cTJ48hIAaKQqiQi_lpoe6edhMglvOO9ynw; PREF=ID=52aa671013493765:U=0cfb5c96530d04e3:FF=0:LD=en:TM=1370266105:LM=1370341612:GM=1:S=Kcc6KUnZwWfy3cOl; OTZ=1800625_34_34__34_; S=talkgadget=38GaRzFbruDPtFjrghEtRw; SID=DQAAALoAAADHyIbtG3J_u2hwNi4N6UQWgXlwOAQL58VRB_0xQYbDiL2HA5zvefboor5YVmHc8Zt5lcA0LCd2Riv4WsW53ZbNCv8Qu_THhIvtRgdEZfgk26LrKmObye1wU62jESQoNdbapFAfEH_IGHSIA0ZKsZrHiWLGVpujKyUvHHGsZc_XZm4Z4tb2bbYWWYAv02mw2njnf4jiKP2QTxnlnKFK77UvWn4FFcahe-XTk8Jlqblu66AlkTGMZpU0BDlYMValdnU; HSID=A6VT_ZJ0ZSm8NTdFf; SSID=A9_PWUXbZLazoEskE; APISID=RSS_BK5QSEmzBxlS/ApSt2fMy1g36vrYvk; SAPISID=ZIMOP9lJ_E8SLdkL/A32W20hPpwgd5Kg1J');

        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 20);

        $data = curl_exec($ch);
        curl_close($ch);

        $nombreEtiquetaCodigoBarras = 'ficheros/' . $id_panel . '/etiqueta' . $key_id_documento_2 . '.png';
        file_put_contents($nombreEtiquetaCodigoBarras, $data);
        $pdf->Image($nombreEtiquetaCodigoBarras, 2, 70, 64, 20);

    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
}

$pdf->Output('F', $nombre_archivo, true);

require("unset_arrays.php");