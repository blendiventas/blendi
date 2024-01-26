<?php
header('Content-Type: application/json');
foreach ($_POST as $key => $valor) {
    if($key == "importe_iva") {
        foreach ($_POST ["importe_iva"] as $key_importe_iva => $valor_importe_iva) {
            echo "Import IVA: ".$key_importe_iva . " = " . $valor_importe_iva . "<br />";
        }
    }else if($key == "recargo") {
        foreach ($_POST ["recargo"] as $key_recargo => $valor_recargo) {
            echo "Recargo: ".$key_recargo . " = " . $valor_recargo . "<br />";
        }
    }else if($key == "importe_recargo") {
        foreach ($_POST ["importe_recargo"] as $key_importe_recargo => $valor_importe_recargo) {
            echo "Import recargo: ".$key_importe_recargo . " = " . $valor_importe_recargo . "<br />";
        }
    }else {
        echo $key . " = " . $valor . "<br />";
    }
}