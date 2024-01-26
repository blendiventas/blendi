<div class="grid grid-cols-12 items-center h-10 bg-gray-50 sm:mx-5 mt-3 dark:text-white">
    <div class="text-center hidden sm:block sm:col-span-2 px-3">
        Bloqueado
    </div>
    <div class="px-3 col-span-3 sm:col-span-4">
        Usuario
    </div>
    <div class="hidden col-span-4 sm:block px-3">
        Terminal asignado
    </div>
    <div class="text-center px-3 col-span-2">
        Ficha
    </div>
</div>
<?php
$select_sys = "listado-filtrado";
require($_SERVER['DOCUMENT_ROOT']."/admin/usuarios/gestion/datos-select-php.php");
if(isset($matriz_id_usuarios)) {
    ?>
    <div id="capa_listado_resultados" class="overflow-y-auto bg-white sm:mx-5">
        <?php
        foreach ($matriz_id_usuarios as $key => $valor) {
            ?>
            <div class="grid grid-cols-12 items-center h-14 bg-white border-2 border-gray-50" id="linea_<?php echo $valor; ?>">
                <div class="hidden sm:block sm:col-span-1 px-3" id="capa_img_activo_<?php echo $valor; ?>">
                    <input type="checkbox" class="block w-7 h-7 mx-auto text-blendi-600" id="habilitar_<?php echo $valor; ?>"
                        <?php echo ($matriz_bloqueo_usuarios[$key] == 1)? ' checked ' : ''; ?>
                           onmouseover="this.style.cursor='pointer'" onclick="toogleHabilitar('<?php echo $valor; ?>', 'usuarios');" />
                </div>
                <div class="hidden sm:block sm:col-span-1 px-3">
                    <img src="../../../avatars/avatar<?php echo $matriz_avatar_usuarios[$key]; ?>.svg?ver=1" class="w-12 p-2">
                </div>
                <div class="px-3 col-span-3 sm:col-span-4"><?php echo $matriz_usuario_usuarios[$key]; ?></div>
                <div class="hidden col-span-4 sm:block px-3"><?php echo $matriz_descripcion_terminal[$key]; ?></div>
                <div class="col-span-2 px-3">
                    <a href="#" class="botones-apartados" title="<?php echo $matriz_usuario_usuarios[$key]; ?>" onclick="abrirFicha(<?php echo $valor; ?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </a>
                </div>
            </div>
            <?php
        }
        unset($matriz_id_usuarios);
        unset($matriz_usuario_usuarios);
        unset($matriz_descripcion_terminal);
        unset($matriz_bloqueo_usuarios);
        ?>
    </div>
    <?php
    require($_SERVER['DOCUMENT_ROOT'] . "/admin/componentes/footer-listados.php");
}else {
    ?>
    <div class="flex items-center justify-center h-10 bg-white mx-5">
        <div class="text-center grow px-3">
            No existen usuarios definidos.
        </div>
    </div>
    <?php
}
?>
