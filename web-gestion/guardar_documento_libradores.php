<?php
if($insert_inicial == true) {
    $logs->insert_1 = "";

    $id_tarifa_web_guardar = 1;
    $id_tarifa_tpv_guardar = 1;
    if(isset($id_librador)) {
        $result_tarifas = $conn->query("SELECT id_tarifa_web,id_tarifa_tpv FROM libradores WHERE id='".$id_librador."' LIMIT 1");
        if($conn->registros() == 1) {
            $id_tarifa_web_guardar = $result_tarifas[0]['id_tarifa_web'];
            $id_tarifa_tpv_guardar = $result_tarifas[0]['id_tarifa_tpv'];
        }
    }else {
        $result_tarifas = $conn->query("SELECT id FROM tarifas WHERE prioritaria=1 LIMIT 1");
        if($conn->registros() == 1) {
            $id_tarifa_web_guardar = $result_tarifas[0]['id'];
            $id_tarifa_tpv_guardar = $result_tarifas[0]['id'];
        }
    }

    $result = $conn->query("INSERT INTO documentos_".$ejercicio."_libradores VALUES(
            NULL,
            '".$id_documento_1."',
            '".addslashes($codigo_librador_documento)."',
            '".addslashes($nombre_documento)."',
            '".addslashes($apellido_1_documento)."',
            '".addslashes($apellido_2_documento)."',
            '".addslashes($razon_social_documento)."',
            '".addslashes($razon_comercial_documento)."',
            '".addslashes($nif_documento)."',
            '".addslashes($direccion_documento)."',
            '".addslashes($numero_direccion_documento)."',
            '".addslashes($escalera_direccion_documento)."',
            '".addslashes($piso_direccion_documento)."',
            '".addslashes($puerta_direccion_documento)."',
            '".addslashes($localidad_documento)."',
            '".addslashes($codigo_postal_documento)."',
            '".addslashes($provincia_documento)."',
            '".addslashes($telefono_1_documento)."',
            '".addslashes($telefono_2_documento)."',
            '".addslashes($fax_documento)."',
            '".addslashes($mobil_documento)."',
            '".addslashes($email_documento)."',
            '".addslashes($persona_contacto_documento)."',
            '',
            '',
            '',
            '',
            '',
            '',
            '".$id_tarifa_web_guardar."',
            '".$id_tarifa_tpv_guardar."')");
}else {
    $logs->update_libradores = "UPDATE documentos_".$ejercicio."_libradores SET 
            codigo_librador='".addslashes($codigo_librador_documento)."',
            nombre='".addslashes($nombre_documento)."',
            apellido_1='".addslashes($apellido_1_documento)."',
            apellido_2='".addslashes($apellido_2_documento)."',
            razon_social='".addslashes($razon_social_documento)."',
            razon_comercial='".addslashes($razon_comercial_documento)."',
            nif='".addslashes($nif_documento)."',
            direccion='".addslashes($direccion_documento)."',
            numero='".addslashes($numero_direccion_documento)."',
            escalera='".addslashes($escalera_direccion_documento)."',
            piso='".addslashes($piso_direccion_documento)."',
            puerta='".addslashes($puerta_direccion_documento)."',
            localidad='".addslashes($localidad_documento)."',
            codigo_postal='".addslashes($codigo_postal_documento)."',
            provincia='".addslashes($provincia_documento)."',
            telefono_1='".addslashes($telefono_1_documento)."',
            telefono_2='".addslashes($telefono_2_documento)."',
            fax='".addslashes($fax_documento)."',
            mobil='".addslashes($mobil_documento)."',
            email='".addslashes($email_documento)."',
            persona_contacto='".addslashes($persona_contacto_documento)."' 
            WHERE id_documentos_1=".$id_documento_1." LIMIT 1";

    $result = $conn->query("UPDATE documentos_".$ejercicio."_libradores SET 
            codigo_librador='".addslashes($codigo_librador_documento)."',
            nombre='".addslashes($nombre_documento)."',
            apellido_1='".addslashes($apellido_1_documento)."',
            apellido_2='".addslashes($apellido_2_documento)."',
            razon_social='".addslashes($razon_social_documento)."',
            razon_comercial='".addslashes($razon_comercial_documento)."',
            nif='".addslashes($nif_documento)."',
            direccion='".addslashes($direccion_documento)."',
            numero='".addslashes($numero_direccion_documento)."',
            escalera='".addslashes($escalera_direccion_documento)."',
            piso='".addslashes($piso_direccion_documento)."',
            puerta='".addslashes($puerta_direccion_documento)."',
            localidad='".addslashes($localidad_documento)."',
            codigo_postal='".addslashes($codigo_postal_documento)."',
            provincia='".addslashes($provincia_documento)."',
            telefono_1='".addslashes($telefono_1_documento)."',
            telefono_2='".addslashes($telefono_2_documento)."',
            fax='".addslashes($fax_documento)."',
            mobil='".addslashes($mobil_documento)."',
            email='".addslashes($email_documento)."',
            persona_contacto='".addslashes($persona_contacto_documento)."' 
            WHERE id_documentos_1=".$id_documento_1." LIMIT 1");
}