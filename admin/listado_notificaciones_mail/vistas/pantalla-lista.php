<?php
$select_sys = "listado-filtrado";
require_once($_SERVER['DOCUMENT_ROOT']."/admin/listado_notificaciones_mail/gestion/datos-select-php.php");
?>
<div class="grid grid-cols-12 items-center bg-gray-50 sm:mx-5 dark:text-white">
    <div class="text-center col-span-1 px-3">
        Tipo
    </div>
    <div class="text-center col-span-1 px-3">
        Librador
    </div>
    <div class="text-center col-span-4 px-3">
        Producto
    </div>
    <div class="text-center col-span-2 px-3">
        E-mail
    </div>
    <div class="text-center col-span-1 px-3">
        Abierto
    </div>
</div>
<hr />
<?php
if(!empty($notificationsStock)) {
    ?>
    <div id="capa_listado_resultados" class="overflow-y-auto bg-white sm:mx-5">
        <?php
        foreach ($notificationsStock as $item) {
            ?>
            <div class="grid grid-cols-12 items-center bg-white border-2 border-gray-50" id="linea_<?php echo $item->id_librador; ?>">
                <div class="col-span-1 px-3">
                    <?php echo $item->tipo;?>
                </div>
                <div class="col-span-1 px-3">
                    <?php echo $item->librador;?>
                </div>
                <div class="px-3 col-span-4 text-center">
                    <?php echo $item->producto;?>
                </div>
                <div class="px-3 col-span-2 text-center">
                    <?php if(!empty($item->id_librador)){?>
                    <a href="#" onclick="abrirFichaEnNuevaPestana(<?php echo $item->id_librador;?>, window.location.origin + '/admin/gestion-libradores/tipo=cli')"
                       class="underline-offset-1"
                    >
                        <span class="flex justify-center items-center">
                        <?php echo $item->email; ?>
                        <svg class="ml-1" width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 4L12 12M20 4V8.5M20 4H15.5M19 12.5V16.8C19 17.9201 19 18.4802 18.782 18.908C18.5903 19.2843 18.2843 19.5903 17.908 19.782C17.4802 20 16.9201 20 15.8 20H7.2C6.0799 20 5.51984 20 5.09202 19.782C4.71569 19.5903 4.40973 19.2843 4.21799 18.908C4 18.4802 4 17.9201 4 16.8V8.2C4 7.0799 4 6.51984 4.21799 6.09202C4.40973 5.71569 4.71569 5.40973 5.09202 5.21799C5.51984 5 6.07989 5 7.2 5H11.5" stroke="#000000" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        </span>
                    </a>
                    <?php }else{
                        echo $item->email;
                    } ?>
                </div>
                <div class="px-3 col-span-1 text-center"><?php echo $item->notificado; ?></div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="hidden">
        <?php
        require_once($_SERVER['DOCUMENT_ROOT'] . "/admin/componentes/footer-listados.php");
        ?>
    </div>
    <?php
}else {
    ?>
    <div class="flex items-center justify-center h-10 bg-white mx-5">
        <div class="text-center grow px-3">
            No existen datos para este listado de mails. Ajuste los filtros para mostrar resultados.
        </div>
    </div>
    <?php
}
?>