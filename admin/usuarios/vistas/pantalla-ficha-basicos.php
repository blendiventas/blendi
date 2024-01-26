<div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3">
    <div>
        <label for="usuario_usuarios">Nombre usuario:</label>
        <input type="text" name="usuario_usuarios" id="usuario_usuarios" placeholder="Nombre usuario" class="w-full" value="<?php echo $usuario_usuarios; ?>" maxlength="50" required />
    </div>
    <div>
        <label for="password_usuarios">Contraseña acceso:</label>
        <input type="text" name="password_usuarios" id="password_usuarios" placeholder="Contraseña acceso" class="w-full" value="<?php echo $password_usuarios; ?>" maxlength="20" required />
    </div>
</div>
<?php
if (empty($id_url)) {
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 mt-3 items-center space-x-3">
        <div>
            <label for="usuario_usuarios">Permisos:</label><br>
            <select name="permisos_usuarios">
                <option value="1" selected>Gerente</option>
                <option value="2">Barra</option>
                <option value="3">Camarero</option>
                <option value="4">Cocina</option>
            </select>
        </div>
    </div>
    <?php
}
?>
<div class="grid grid-cols-1 sm:grid-cols-4 mt-3 items-center space-x-3">
    <div>
        <label for="avatar">Avatar:</label>
        <input type="hidden" name="avatar_usuarios" id="avatar_usuarios" value="<?php echo $avatar; ?>" />
        <img src="../../../avatars/avatar<?php echo $avatar; ?>.svg?ver=1" id="id_avatar_usuario" class="w-full p-2">
    </div>
    <div class="text-center">
        <button type="button" id="boton_editar_avatar" class="text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" onclick="document.getElementById('capa_avatares').style.display='block'; document.getElementById('boton_editar_avatar').style.display='none'; document.getElementById('boton_listo_avatar').style.display='block';">Editar avatar</button>
        <button type="button" id="boton_listo_avatar" class="hidden text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5" onclick="document.getElementById('capa_avatares').style.display='none'; document.getElementById('boton_editar_avatar').style.display='block'; document.getElementById('boton_listo_avatar').style.display='none';">Listo</button>
    </div>
    <div class="hidden text-center" id="capa_avatares">
        <?php
        $avatares = 0;
        for ($bucle1 = 1 ; $bucle1 <= 4 ; $bucle1++) {
            ?>
            <div class="grid grid-cols-3 sm:grid-cols-6 mt-3 items-center">
                <?php
                for ($bucle2 = 1 ; $bucle2 <= 6 ; $bucle2++) {
                    ?>
                    <div>
                        <img src="../../../avatars/avatar<?php echo $avatares; ?>.svg?ver=1" class="w-full p-2" onclick="document.getElementById('id_avatar_usuario').src='../../../avatars/avatar<?php echo $avatares; ?>.svg?ver=1'; document.getElementById('avatar_usuarios').value=<?php echo $avatares; ?>">
                    </div>
                    <?php
                    $avatares += 1;
                    if($avatares == 21) {
                        break;
                    }
                }
                ?>
            </div>
            <?php
            if($avatares == 21) {
                break;
            }
        }
        ?>
    </div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label>Bloqueado:</label><br>
        <div class="flex flex-wrap">
            <div onclick="activarElementoUnicoFicha('activo_usuarios_1', 'capa_activo_usuarios_1', 'capa_unicos_activo_usuarios')" id="capa_activo_usuarios_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_usuarios poin">
                <div class="font-bold text-left mr-2">
                    Si
                </div>
                <div id="contracheck_activo_usuarios_1" class="hidden w-6 h-6 contracheck_capa_unicos_activo_usuarios">
                    &nbsp;
                </div>
                <div id="check_activo_usuarios_1" class="hidden check_capa_unicos_activo_usuarios">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="activo_usuarios" id="activo_usuarios_1" value="1" class="hidden" />
                <?php
                if ($bloqueo_usuarios == 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('activo_usuarios_1', 'capa_activo_usuarios_1', "capa_unicos_activo_usuarios");
                    </script>
                    <?php
                }
                ?>
            </div>
            <div onclick="activarElementoUnicoFicha('activo_usuarios_2', 'capa_activo_usuarios_2', 'capa_unicos_activo_usuarios')" id="capa_activo_usuarios_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_activo_usuarios">
                <div class="font-bold text-left mr-2">
                    No
                </div>
                <div id="contracheck_activo_usuarios_2" class="hidden w-6 h-6 contracheck_capa_unicos_activo_usuarios">
                    &nbsp;
                </div>
                <div id="check_activo_usuarios_2" class="hidden check_capa_unicos_activo_usuarios">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="activo_usuarios" id="activo_usuarios_2" value="0" class="hidden" />
                <?php
                if ($bloqueo_usuarios != 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('activo_usuarios_2', 'capa_activo_usuarios_2', "capa_unicos_activo_usuarios");
                    </script>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 mt-3 items-center space-x-3">
    <div>
        <label>Night:</label><br>
        <div class="flex flex-wrap">
            <div onclick="activarElementoUnicoFicha('dark_usuarios_1', 'capa_dark_usuarios_1', 'capa_unicos_dark_usuarios')" id="capa_dark_usuarios_1" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_dark_usuarios poin">
                <div class="font-bold text-left mr-2">
                    Si
                </div>
                <div id="contracheck_dark_usuarios_1" class="hidden w-6 h-6 contracheck_capa_unicos_dark_usuarios">
                    &nbsp;
                </div>
                <div id="check_dark_usuarios_1" class="hidden check_capa_unicos_dark_usuarios">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="dark_usuarios" id="dark_usuarios_1" value="1" class="hidden" />
                <?php
                if ($dark_usuarios == 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('dark_usuarios_1', 'capa_dark_usuarios_1', "capa_unicos_dark_usuarios");
                    </script>
                    <?php
                }
                ?>
            </div>
            <div onclick="activarElementoUnicoFicha('dark_usuarios_2', 'capa_dark_usuarios_2', 'capa_unicos_dark_usuarios')" id="capa_dark_usuarios_2" class="rounded border-2 border-gray-400 p-3 flex items-center mt-1 h-11 leading-5 ml-3 cursor-pointer capa_unicos_dark_usuarios">
                <div class="font-bold text-left mr-2">
                    No
                </div>
                <div id="contracheck_dark_usuarios_2" class="hidden w-6 h-6 contracheck_capa_unicos_dark_usuarios">
                    &nbsp;
                </div>
                <div id="check_dark_usuarios_2" class="hidden check_capa_unicos_dark_usuarios">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blendi-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <input type="radio" name="dark_usuarios" id="dark_usuarios_2" value="0" class="hidden" />
                <?php
                if ($dark_usuarios != 1) {
                    ?>
                    <script type="text/javascript">
                        activarElementoUnicoFicha('dark_usuarios_2', 'capa_dark_usuarios_2', "capa_unicos_dark_usuarios");
                    </script>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 mt-3 items-center space-x-3">
    <div>
        <label for="id_terminal_usuarios">Acceso restringido al terminal:</label>
        <select id="id_terminal_usuarios" name="id_terminal_usuarios" class="w-full" required>
            <?php
            $selected_sys = "";
            if($id_terminal_usuarios == -1) {
                $selected_sys = " selected";
            }
            ?>
            <option value="-1"<?php echo $selected_sys; ?>>Sin restricciones</option>
            <?php
            if($id_usuarios_url != 1) {
                $select_sys = "listado-filtrado-activos";
                require($_SERVER['DOCUMENT_ROOT']."/admin/terminales/gestion/datos-select-php.php");
                if(isset($matriz_id_terminales)) {
                    foreach ($matriz_id_terminales as $key_id_terminales => $valor_id_terminales) {
                        $selected_sys = "";
                        if($valor_id_terminales == $id_terminal_usuarios) {
                            $selected_sys = " selected";
                        }
                        ?>
                        <option value="<?php echo $valor_id_terminales; ?>"<?php echo $selected_sys; ?>><?php echo $matriz_descripcion_terminales[$key_id_terminales]; ?></option>
                        <?php
                    }
                    unset($matriz_id_terminales);
                    unset($matriz_descripcion_terminales);
                }
            }
            ?>
        </select>
    </div>
</div>
<script type="text/javascript">
    activarBotonesPorDefectoFicha();
</script>
