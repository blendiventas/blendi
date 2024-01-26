<?php
require_once('/pdf/fpdf.php');
require_once('/pdf/fpdi.php');

class PDF_EAN13 extends FPDF
{
    function EAN13($x, $y, $barcode, $h=16, $w=.35)
    {
        $this->Barcode($x,$y,$barcode,$h,$w,13);
    }

    function UPC_A($x, $y, $barcode, $h=16, $w=.35)
    {
        $this->Barcode($x,$y,$barcode,$h,$w,12);
    }

    function GetCheckDigit($barcode)
    {
        //Compute the check digit
        $sum=0;
        for($i=1;$i<=11;$i+=2)
            $sum+=3*$barcode[$i];
        for($i=0;$i<=10;$i+=2)
            $sum+=$barcode[$i];
        $r=$sum%10;
        if($r>0)
            $r=10-$r;
        return $r;
    }

    function TestCheckDigit($barcode)
    {
        //Test validity of check digit
        $sum=0;
        for($i=1;$i<=11;$i+=2)
            $sum+=3*$barcode[$i];
        for($i=0;$i<=10;$i+=2)
            $sum+=$barcode[$i];
        return ($sum+$barcode[12])%10==0;
    }

    function Barcode($x, $y, $barcode, $h, $w, $len)
    {
        //Padding
        $barcode=str_pad($barcode,$len-1,'0',STR_PAD_LEFT);
        if($len==12)
            $barcode='0'.$barcode;
        //Add or control the check digit
        if(strlen($barcode)==12)
            $barcode.=$this->GetCheckDigit($barcode);
        elseif(!$this->TestCheckDigit($barcode))
            $this->Error('Incorrect check digit');
        //Convert digits to bars
        $codes=array(
            'A'=>array(
                '0'=>'0001101','1'=>'0011001','2'=>'0010011','3'=>'0111101','4'=>'0100011',
                '5'=>'0110001','6'=>'0101111','7'=>'0111011','8'=>'0110111','9'=>'0001011'),
            'B'=>array(
                '0'=>'0100111','1'=>'0110011','2'=>'0011011','3'=>'0100001','4'=>'0011101',
                '5'=>'0111001','6'=>'0000101','7'=>'0010001','8'=>'0001001','9'=>'0010111'),
            'C'=>array(
                '0'=>'1110010','1'=>'1100110','2'=>'1101100','3'=>'1000010','4'=>'1011100',
                '5'=>'1001110','6'=>'1010000','7'=>'1000100','8'=>'1001000','9'=>'1110100')
        );
        $parities=array(
            '0'=>array('A','A','A','A','A','A'),
            '1'=>array('A','A','B','A','B','B'),
            '2'=>array('A','A','B','B','A','B'),
            '3'=>array('A','A','B','B','B','A'),
            '4'=>array('A','B','A','A','B','B'),
            '5'=>array('A','B','B','A','A','B'),
            '6'=>array('A','B','B','B','A','A'),
            '7'=>array('A','B','A','B','A','B'),
            '8'=>array('A','B','A','B','B','A'),
            '9'=>array('A','B','B','A','B','A')
        );
        $code='101';
        $p=$parities[$barcode[0]];
        for($i=1;$i<=6;$i++)
            $code.=$codes[$p[$i-1]][$barcode[$i]];
        $code.='01010';
        for($i=7;$i<=12;$i++)
            $code.=$codes['C'][$barcode[$i]];
        $code.='101';
        //Draw bars
        for($i=0;$i<strlen($code);$i++)
        {
            if($code[$i]=='1')
                $this->Rect($x+$i*$w,$y,$w,$h,'F');
        }
        //Print text uder barcode
        $this->SetFont('Arial','',12);
        $this->Text($x,$y+$h+11/$this->k,substr($barcode,-$len));
    }
}

//$pdf = new FPDI();
$pdf = new PDF_EAN13('P','mm','A4');

//$pdf->SetMargins(float left, float top [, float right]);
$pdf->SetAutoPageBreak(false ,0);

define('EURO', chr(128));

$pdf->AddPage();

$margenes = $_POST['margenes'];
$columnas = $_POST['columnas'];

$fila_inicial = $_POST['fila_inicial'] - 1;
$columna_inicial = $_POST['columna_inicial'] - 1;

$alto_etiqueta = $_POST['alto_etiqueta'];
$ancho_etiqueta = $_POST['ancho_etiqueta'];

$alto_contenido = $alto_etiqueta - $margenes;
$ancho_contenido = $ancho_etiqueta - $margenes;

$alto_inicial = $_POST['alto_inicial'];
$ancho_inicial = $_POST['ancho_inicial'];

$posicion_alto = $alto_inicial + ($alto_etiqueta * $fila_inicial);
$posicion_ancho = $ancho_inicial + ($ancho_etiqueta * $columna_inicial);

$columnas_impresas = $columna_inicial;

foreach ($producto as $key => $valor) {
    for($bucle = 1 ; $bucle <= $stock[$key] ; $bucle++) {
        $pdf->SetFont('Arial', '', 5);
        $pdf->SetXY($posicion_ancho, $posicion_alto);
        $pdf->cell($ancho_contenido, 3, $valor, 0, 0, "L");

        $pdf->EAN13($posicion_ancho, ($posicion_alto + (($alto_etiqueta / 2) - 4)), trim($codigo_barras[$key]), 6, .24);

        $pdf->SetFont('Arial', '', 5);
        $pdf->SetXY($posicion_ancho + ($ancho_contenido / 2), $posicion_alto + ($alto_etiqueta / 4));
        $pdf->cell(($ancho_contenido / 2), 3, $referencia[$key], 0, 0, "R");

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY($posicion_ancho + ($ancho_contenido / 2), $posicion_alto + ($alto_etiqueta / 2));
        $pdf->cell(($ancho_contenido / 2), 3, "P.V.P.: " . $pvp[$key] . " " . EURO, 0, 0, "R");

        $posicion_ancho += ($ancho_etiqueta);

        $columnas_impresas += 1;

        if ($columnas_impresas == $columnas) {
            $columnas_impresas = 0;
            $posicion_alto += $alto_etiqueta;
            $posicion_ancho = $ancho_inicial;
            if ($posicion_alto >= (297 - $alto_etiqueta)) {
                $pdf->AddPage();
                $posicion_alto = $alto_inicial;
            }
        }
    }
}

$pdf->Output();