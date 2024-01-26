<div class="flex flex-wrap items-center justify-between">
    <form id="notificarmeStock<?php echo $result_categorias[$iterator]['id_producto']; ?>">
        <input type="hidden"
               value="<?php echo $tienda; ?>"
               name="notificacion[tienda]"/>
        <input type="hidden"
               value="<?php echo $result_categorias[$iterator]['id_producto']; ?>"
               name="notificacion[id_producto]"/>
        <?php if ($id_librador) { ?>
            <input type="hidden"
                   value="<?php echo $id_librador; ?>"
                   name="notificacion[id_librador]"/>
        <?php } else { ?>
            <input type="email" class="w-auto my-3 px-4 py-2 border rounded-md"
                   name="notificacion[email]"
                   placeholder="Email"/>
        <?php } ?>
        <button
            class="inline-block w-full md:w-auto mb-4 md:mb-0 md:mr-4 text-center bg-orange-300 hover:bg-orange-400 text-white font-bold font-heading py-4 px-8 rounded-md uppercase"
            type="button"
            onclick="notificarExistaStock('notificarmeStock<?php echo $result_categorias[$iterator]['id_producto']; ?>')">
            <svg id="spinnerIcon<?php echo $result_categorias[$iterator]['id_producto']; ?>" style="display: none;" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Notificarme si hay stock
        </button>
    </form>
</div>