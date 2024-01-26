<?php
if(isset($id_productos_relacionados_grupos) && $categorias_mostrar == true && $tipo_librador != "pro" && $tipo_librador != "cre") {
    ?>
    <div class="flex w-full h-8 bg-white">
        <a href="#" onmousedown="startScroll('capas-categorias-general','-');" onmouseup="stopScroll();" class="hidden sm:block h-8 items-center">
            <div class="px-4 hover:border-b-2 hover:border-b-blendi-700 h-8 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </div>
        </a>
        <div class="whitespace-nowrap overflow-x-auto flex grow h-10 items-center" id="capas-categorias-general">
            <?php
            $clase = "botones-categorias-grupos";
            if($_SESSION[$id_sesion_js]['id_productos_relacionados_grupos'] == 0){
                $clase = "botones-categorias-grupos-sel bg-blendi-35 font-bold";
            }
            ?>
            <button class="<?php echo $clase; ?> text-sm px-4 h-8" id="boton-categorias-grupos_0" onclick="establecerIdProductosRelacionadosGrupos(0);">POR DEFECTO</button>
            <?php
            foreach ($id_productos_relacionados_grupos as $key_id_productos_relacionados_grupos => $valor_id_productos_relacionados_grupos) {
                $clase = "botones-categorias-grupos";
                if($_SESSION[$id_sesion_js]['id_productos_relacionados_grupos'] == $valor_id_productos_relacionados_grupos){
                    $clase = "botones-categorias-grupos-sel bg-blendi-35 font-bold";
                }
                ?>
                <button class="<?php echo $clase; ?> text-sm px-4 h-8" id="boton-categorias-grupos_<?php echo $valor_id_productos_relacionados_grupos; ?>" onclick="establecerIdProductosRelacionadosGrupos(<?php echo $valor_id_productos_relacionados_grupos; ?>);"><?php echo strtoupper($grupos_productos_relacionados_grupos[$key_id_productos_relacionados_grupos]); ?></button>
                <?php
            }
            if($interface == "tpv" && $id_usuario == 1) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-productos-grupos" class="text-decoration-none px-4 mx-6 text-blendi-600 h-8 flex items-center" title="Grupos" target="_self">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </a>
                <?php
            }
            ?>
        </div>
        <a href="#" onmousedown="startScroll('capas-categorias-general','+');" onmouseup="stopScroll();" class="hidden sm:block h-8 items-center">
            <div class="px-4 hover:border-b-2 hover:border-b-blendi-700 h-8 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </div>
        </a>
    </div>
    <?php
}
if(count($categorias['id'])) {
    /*
    $tipus_menu_web_superior = "scroll-horizontal";
    $tipus_menu_web_superior = "normal";
    */
    if($tipus_menu_web_superior == "scroll-horizontal") {
        ?>
        <div class="capa-botones-familias-scroll-horizontal flex w-full bg-blendi-35" id="capa-botones-familias">
            <?php
            $mostrar_familias_anterior = $mostrar_familias;
            $mostrar_familias = "superior";
            ?>
            <a href="#" onmousedown="startScroll('capa_categorias_superior','-');" onmouseup="stopScroll();" class="hidden sm:block h-8 items-center">
                <div class="px-4 hover:border-b-2 hover:border-b-blendi-700 h-8 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </div>
            </a>
            <div id="capa_categorias_superior" class="whitespace-nowrap overflow-x-auto flex h-10 items-center">
                <?php
                if ($mostrar_mas_vendidos) {
                    $class_enlace = "";
                    if(empty($id_categoria_mostrar)) {
                        $class_enlace = "font-bold border-b-2 border-b-blendi-700";
                    }
                    ?>
                    <a href="#" title="Más vendidos" onclick="cargarCategoria('-inicio')" class="<?php echo $class_enlace; ?> inline-block text-sm px-4 h-8 flex items-center categoria_menu">
                        MÁS VENDIDOS
                    </a>
                    <?php
                }
                require("categorias_superior.php");
                if($interface == "tpv" && $id_usuario == 1) {
                    ?>
                    <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-categorias" class="inline-block h-8 flex items-center" title="Categorías" target="_self">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </a>
                    <?php
                }
                ?>
            </div>
            <a href="#" onmousedown="startScroll('capa_categorias_superior','+');" onmouseup="stopScroll();" class="hidden sm:block h-8 items-center">
                <div class="px-4 hover:border-b-2 hover:border-b-blendi-700 h-8 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
            <?php
            $mostrar_familias = $mostrar_familias_anterior;
            ?>
        </div>
        <?php
    }else {
        ?>
        <div class="flex flex-wrap w-full justify-center bg-blendi-35 h-10 items-center" id="capa-botones-familias" style="height: <?php echo 2 * $filas_menu_superior; ?>rem; overflow-y: auto;">
            <?php
            if ($mostrar_mas_vendidos) {
                $class_enlace = "";
                if(empty($id_categoria_mostrar)) {
                    $class_enlace = "font-bold border-b-2 border-b-blendi-700";
                }
                ?>
                <a href="#" title="Más vendidos" onclick="cargarCategoria('-inicio')" class="<?php echo $class_enlace; ?> uppercase inline-block text-sm px-4 h-8 flex items-center categoria_menu">
                    MÁS VENDIDOS
                </a>
                <?php
            }
            require("categorias_superior.php");
            if($interface == "tpv" && $id_usuario == 1) {
                ?>
                <a href="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/admin/gestion-categorias" class="text-blendi-600 h-8 flex items-center" title="Categorías" target="_self">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </a>
                <?php
            }
            ?>
        </div>
        <?php
    }
}