<?php
if ($interface === 'web' && $insert_inicial == true) {
    $logs->insert_1 = "";

    $result = $conn->query("INSERT INTO documentos_".$ejercicio."_libradores_envio VALUES(
            NULL,
            '".$id_documento_1."',
            '".$fecha_documento."',
            'NULL',
            'NULL',
            '".$id_librador."',
            '".addslashes($nombre_envio_documento)."',
            '".addslashes($apellido_1_documento)."',
            '".addslashes($apellido_2_documento)."',
            '".addslashes($razon_social_envio_documento)."',
            '".addslashes($razon_comercial_envio_documento)."',
            '".addslashes($direccion_envio_documento)."',
            '".addslashes($numero_direccion_envio_documento)."',
            '".addslashes($escalera_direccion_envio_documento)."',
            '".addslashes($piso_direccion_envio_documento)."',
            '".addslashes($puerta_direccion_envio_documento)."',
            '".addslashes($localidad_envio_documento)."',
            '".addslashes($codigo_postal_envio_documento)."',
            '".addslashes($provincia_envio_documento)."',
            '".addslashes($zona)."',
            '".addslashes($telefono_1_documento)."',
            '".addslashes($telefono_2_documento)."',
            '".addslashes($mobil_envio_documento)."',
            '".addslashes($persona_contacto_documento)."',
            '".addslashes($observaciones_envio_documento)."')");
} else if ($interface === 'web') {
    $logs->update_1 = "";

    $result = $conn->query("UPDATE documentos_".$ejercicio."_libradores_envio SET 
            fecha_documento='".$fecha_documento."',
            id_librador='".$id_librador."',
            nombre='".addslashes($nombre_envio_documento)."',
            apellido_1='".addslashes($apellido_1_documento)."',
            apellido_2='".addslashes($apellido_2_documento)."',
            razon_social='".addslashes($razon_social_envio_documento)."',
            razon_comercial='".addslashes($razon_comercial_envio_documento)."',
            direccion='".addslashes($direccion_envio_documento)."',
            numero='".addslashes($numero_direccion_envio_documento)."',
            escalera='".addslashes($escalera_direccion_envio_documento)."',
            piso='".addslashes($piso_direccion_envio_documento)."',
            puerta='".addslashes($puerta_direccion_envio_documento)."',
            localidad='".addslashes($localidad_envio_documento)."',
            codigo_postal='".addslashes($codigo_postal_envio_documento)."',
            provincia='".addslashes($provincia_envio_documento)."',
            zona='".addslashes($zona)."',
            telefono_1='".addslashes($telefono_1_documento)."',
            telefono_2='".addslashes($telefono_2_documento)."',
            mobil='".addslashes($mobil_envio_documento)."',
            persona_contacto='".addslashes($persona_contacto_documento)."',
            observaciones='".addslashes($observaciones_envio_documento)."' 
            WHERE id_documentos_1=".$id_documento_1." LIMIT 1");
} else if($insert_inicial == true) {
    $logs->insert_1 = "";

    $result = $conn->query("INSERT INTO documentos_".$ejercicio."_libradores_envio VALUES(
            NULL,
            '".$id_documento_1."',
            '".$fecha_documento."',
            'NULL',
            'NULL',
            '".$id_librador."',
            '".addslashes($nombre_documento)."',
            '".addslashes($apellido_1_documento)."',
            '".addslashes($apellido_2_documento)."',
            '".addslashes($razon_social_documento)."',
            '".addslashes($razon_comercial_documento)."',
            '".addslashes($direccion_documento)."',
            '".addslashes($numero_direccion_documento)."',
            '".addslashes($escalera_direccion_documento)."',
            '".addslashes($piso_direccion_documento)."',
            '".addslashes($puerta_direccion_documento)."',
            '".addslashes($localidad_documento)."',
            '".addslashes($codigo_postal_documento)."',
            '".addslashes($provincia_documento)."',
            '".addslashes($zona)."',
            '".addslashes($telefono_1_documento)."',
            '".addslashes($telefono_2_documento)."',
            '".addslashes($mobil_documento)."',
            '".addslashes($persona_contacto_documento)."',
            '".addslashes($observaciones_envio_documento)."')");
}else{
    $logs->update_1 = "";

    $result = $conn->query("UPDATE documentos_".$ejercicio."_libradores_envio SET 
            fecha_documento='".$fecha_documento."',
            id_librador='".$id_librador."',
            nombre='".addslashes($nombre_documento)."',
            apellido_1='".addslashes($apellido_1_documento)."',
            apellido_2='".addslashes($apellido_2_documento)."',
            razon_social='".addslashes($razon_social_documento)."',
            razon_comercial='".addslashes($razon_comercial_documento)."',
            direccion='".addslashes($direccion_documento)."',
            numero='".addslashes($numero_direccion_documento)."',
            escalera='".addslashes($escalera_direccion_documento)."',
            piso='".addslashes($piso_direccion_documento)."',
            puerta='".addslashes($puerta_direccion_documento)."',
            localidad='".addslashes($localidad_documento)."',
            codigo_postal='".addslashes($codigo_postal_documento)."',
            provincia='".addslashes($provincia_documento)."',
            zona='".addslashes($zona)."',
            telefono_1='".addslashes($telefono_1_documento)."',
            telefono_2='".addslashes($telefono_2_documento)."',
            mobil='".addslashes($mobil_documento)."',
            persona_contacto='".addslashes($persona_contacto_documento)."',
            observaciones='".addslashes($observaciones_envio_documento)."' 
            WHERE id_documentos_1=".$id_documento_1." LIMIT 1");
}