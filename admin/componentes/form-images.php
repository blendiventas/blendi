<?php
/*
echo "3-Ruta: ".$ruta_sys."<br />";
echo "3-Destino: ".$destino_sys."<br />";
echo "3-Id image: ".$id_images_sys."<br />";
echo "3-Id producto: ".$id_productos_url."<br />";
echo "3-Id enlazado:".$id_productos_detalles_enlazado_url."<br />";
echo "3-Id multiple: ".$id_productos_detalles_multiples_url."<br />";
echo "3-Id pack: ".$id_pack_url."<br />";
*/
if(!isset($id_productos_detalles_enlazado_url)) {
    $id_productos_detalles_enlazado_url = 0;
}
if(!isset($id_productos_detalles_multiples_url)) {
    $id_productos_detalles_multiples_url = 0;
}
if(!isset($id_packs_url)) {
    $id_packs_url = 0;
}
$partes_nombre_imagen_mostrar = explode("-",$nombre_imagen_sys[0]);
if(count($partes_nombre_imagen_mostrar) > 1) {
    $nombre_imagen_mostrar = "";
    for ($bucle = 0; $bucle < count($partes_nombre_imagen_mostrar) - 1; $bucle++) {
        if (!empty($nombre_imagen_mostrar)) {
            $nombre_imagen_mostrar .= "-";
        }
        $nombre_imagen_mostrar .= $partes_nombre_imagen_mostrar[$bucle];
    }
}else{
    $nombre_imagen_mostrar = $partes_nombre_imagen_mostrar[0];
}
// Se ha decidido no habilitar el cambio de nombre de las imágenes.
if(!empty($imagen_sys)) {
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3 hidden">
        <div>
            <label for="nombre_imagen">Nombre imagen:</label><br>
            <input type="hidden" class="w-full" name="nombre_imagen" id="nombre_imagen" placeholder="Nombre imagen" maxlength="93" value="<?php echo $nombre_imagen_mostrar; ?>" onblur="filtrarKey('nombre_imagen',document.getElementById('nombre_imagen').value,'nombre_foto');" />
        </div>
        <div class="text-right" id="capa_boton_renombrar_imagen">
            <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="renombrarImagen('<?php echo $modulo_renombrar; ?>','<?php echo $tabla; ?>','<?php echo $etiqueta_id_retorno; ?>','<?php echo $id_renombrar; ?>','<?php echo $link_otros; ?>');">Renombrar imagen</button>
        </div>
        <div>
            <?php
            if (isset($eliminar_imagen_disabled) && $eliminar_imagen_disabled) {
                echo '&nbsp;';
            } else {
                ?>
                <button class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" type="button" onclick="guardarFicha('eliminar-imagen');">Eliminar imagen</button>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}else {
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3 hidden">
        <div>
            <label for="nombre_imagen">Nombre imagen:</label><br>
            <input type="text" name="nombre_imagen" id="nombre_imagen" placeholder="Nombre imagen" maxlength="93" value="<?php echo $nombre_imagen_mostrar; ?>" onblur="filtrarKey('nombre_imagen',document.getElementById('nombre_imagen').value,'nombre_foto');" />
        </div>
    </div>
    <?php
}
?>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label for="imagen">Imagen:</label>
        <div>
            <div>
                <?php
                if(!empty($imagen_sys)) {
                    if(strpos($imagen_sys, "www.")) {
                        $url_imagen = $imagen_sys;
                    }else {
                        $url_imagen = "/images/".$destino_sys."/".$imagen_sys;
                    }
                    ?>
                    <span id="imagen">
                        <img src="<?php echo $url_imagen."?updated=".$updated_sys; ?>" id="img-imagen" class="mw-50p" alt="<?php echo $alt_sys; ?>" title="<?php echo $tittle_sys; ?>" />
                    </span>
                    <?php
                }else {
                    echo "Sin imagen";
                }
                ?>
            </div>
        </div>
    </div>
    <div id="capa_boton_subir_imagen">
        <?php
        if (isset($username) && !empty($username) && isset($password) && !empty($password)) {
            ?>
            <input id="image-file" type="file" onchange="SavePhoto(this,'<?php echo $ruta_sys; ?>','<?php echo $destino_sys; ?>',document.getElementById('nombre_imagen').value,'<?php echo $id_images_sys; ?>','<?php echo $id_productos_url; ?>','<?php echo $id_productos_detalles_enlazado_url; ?>','<?php echo $id_productos_detalles_multiples_url; ?>','<?php echo $id_packs_url; ?>','<?php echo $username; ?>','<?php echo $password; ?>');" />
            <?php
        } else {
            ?>
            <input id="image-file" type="file" onchange="SavePhoto(this,'<?php echo $ruta_sys; ?>','<?php echo $destino_sys; ?>',document.getElementById('nombre_imagen').value,'<?php echo $id_images_sys; ?>','<?php echo $id_productos_url; ?>','<?php echo $id_productos_detalles_enlazado_url; ?>','<?php echo $id_productos_detalles_multiples_url; ?>','<?php echo $id_packs_url; ?>');" />
            <?php
        }
        ?>
    </div>
</div>
