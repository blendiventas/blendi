<?php
$id_categoria_padre_mostrar = 0;
$qtySubfamilies = 0;
if ($id_categoria_mostrar) {
    foreach ($categorias['id'] as $key => $valor) {
        if($categorias['de'][$key] == $id_categoria_mostrar) {
            $qtySubfamilies++;
        }
        if ($valor == $id_categoria_mostrar) {
            $id_categoria_padre_mostrar = $categorias['de'][$key];
        }
    }
}
if ($id_categoria_padre_mostrar != 0) {
    if($tipus_menu_web_superior == "scroll-horizontal") {
        ?>
        <div class="capa-botones-familias-scroll-horizontal flex w-full bg-blendi-35" id="capa-botones-subfamilias">
            <a href="#" onmousedown="startScroll('capa_subcategorias_superior','-');" onmouseup="stopScroll();" class="hidden sm:block">
                <div class="px-4 hover:border-b-2 hover:border-b-blendi-700 h-11 mt-2 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </div>
            </a>
            <div id="capa_subcategorias_superior" class="whitespace-nowrap overflow-x-auto flex">
                <?php
                require("subcategorias_superior.php");
                ?>
            </div>
            <a href="#" onmousedown="startScroll('capa_subcategorias_superior','+');" onmouseup="stopScroll();" class="hidden sm:block">
                <div class="px-4 hover:border-b-2 hover:border-b-blendi-700 h-11 mt-2 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
        </div>
        <?php
    }else {
        ?>
        <div class="mt-2 flex flex-wrap w-full justify-center bg-blendi-35" id="capa-botones-subfamilias" style="height: <?php echo 3.25 * $filas_menu_superior; ?>rem; overflow-y: auto;">
            <?php
            require("subcategorias_superior.php");
            ?>
        </div>
        <?php
    }
}
if(!empty($id_categoria_mostrar) && $qtySubfamilies > 0) {
    $id_categoria_padre_mostrar = $id_categoria_mostrar;
    if($tipus_menu_web_superior == "scroll-horizontal") {
        ?>
        <div class="capa-botones-familias-scroll-horizontal flex w-full bg-blendi-35" id="capa-botones-subfamilias2">
            <a href="#" onmousedown="startScroll('capa_subcategorias2_superior','-');" onmouseup="stopScroll();" class="hidden sm:block">
                <div class="px-4 hover:border-b-2 hover:border-b-blendi-700 h-11 mt-2 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </div>
            </a>
            <div id="capa_subcategorias2_superior" class="whitespace-nowrap overflow-x-auto flex">
                <?php
                require("subcategorias_superior.php");
                ?>
            </div>
            <a href="#" onmousedown="startScroll('capa_subcategorias2_superior','+');" onmouseup="stopScroll();" class="hidden sm:block">
                <div class="px-4 hover:border-b-2 hover:border-b-blendi-700 h-11 mt-2 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
        </div>
        <?php
    }else {
        ?>
        <div class="mt-2 flex flex-wrap w-full justify-center bg-blendi-35" id="capa-botones-subfamilias2" style="height: <?php echo 3.25 * $filas_menu_superior; ?>rem; overflow-y: auto;">
            <?php
            require("subcategorias_superior.php");
            ?>
        </div>
        <?php
    }
}