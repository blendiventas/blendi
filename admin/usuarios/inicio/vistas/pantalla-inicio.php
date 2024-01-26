<div id="capa_filtros" class="capa-filtros bg-main hide"></div>
<div id="capa_lista" class="capa-main bg-main px-3">
    <?php
    // Mañana: de 6 a 12, Tarde: de 12 a 19 ,Noche: de 19 a 24 y Madrugada de 24 a 6.
    /*
    madrugada: de la medianoche al amanecer (00:00 a ~06:00)
    mañana: del amanecer al mediodía (06:00 a 12:00)
    tarde: del mediodía al atardecer (12:00 a ~18.00)
    noche: del atardecer a la medianoche (~18.00 a 24:00)
    */
    ?>
    <div class="pt-3 pb-12 text-white font-medium">
        <div class="text-[2rem] mb-6">
            <?php
            if (date('H:i:s') >='06:00:00' && date('H:i:s') <'12:00:00') {
                echo 'Buenos días, ';
            }else if (date('H:i:s') >='12:00:00' && date('H:i:s') <'19:00:00') {
                echo 'Buenas tardes, ';
            }else {
                echo 'Buenas noches, ';
            }
            ?>
            estamos encantados de volver a verte
        </div>
        <div class="text-[1.1rem]" >
            Por favor, selecciona e introduce tus credenciales para acceder a tu perfil
        </div>
    </div>
    <?php

    $select_sys = "inicio";
    require($_SERVER['DOCUMENT_ROOT']."/admin/usuarios/gestion/datos-select-php.php");
    ?>
    <div class="flex flex-wrap space-x-3">
        <?php
        foreach ($matriz_id_usuarios as $key => $valor) {
            ?>
            <div class="px-2" style="width: 220px;">
                <?php
                $avatar = (empty($matriz_avatar_usuarios[$key]))? null : $matriz_avatar_usuarios[$key];
                if (!$avatar) {
                    $avatar = substr($valor, strlen($valor) - 1, 1);
                }
                if ($avatar == 0) {
                    $avatar = 1;
                }
                ?>
                <img src="../../../avatars/avatar<?php echo $avatar; ?>.svg?ver=1" class="w-full" style="height: 220px;">
                <form  class="formulario" id="identificacion_usuario_<?php echo $valor; ?>" target="_self" method="post" onsubmit="event.preventDefault(); document.getElementById('conectar_<?php echo $valor; ?>').click();">
                    <label for="password_usuarios_<?php echo $valor; ?>" style="color: white; font-size: 1.4rem; font-weight: 500;"><?php echo $matriz_usuario_usuarios[$key]; ?></label><br />
                    <!--
                    <button class="submit" type="button" id="conectar_<?php echo $valor; ?>" onclick="identificarUsuario('<?php echo $valor; ?>');">
                        Conectar
                    </button>
                    -->
                    <?php
                    if ($matriz_password_usuarios[$key] === '1234') {
                        ?>
                            <button type="button" id="conectar_<?php echo $valor; ?>" class="submit text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5 mt-2 w-full" onclick="identificarUsuario('<?php echo $valor; ?>');">
                                Acceder
                            </button>
                            <input type="hidden" name="password_usuarios_<?php echo $valor; ?>" id="password_usuarios_<?php echo $valor; ?>" value="1234" />
                        <?php
                    } else {
                        ?>
                        <button type="button"
                                class="submit text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5 mt-2 w-full"
                                onclick="toggleFormIdentificarUsuario(this,'FormIdentificarUsuario<?php echo $valor; ?>');">
                            Acceder
                        </button>
                        <div id="FormIdentificarUsuario<?php echo $valor; ?>" class="hidden">
                            <button type="button" id="conectar_<?php echo $valor; ?>"
                                    class="submit text-white bg-gray-650 border border-gray-650 text-sm font-medium px-5 py-2.5 mt-2 w-full"
                                    onclick="identificarUsuario('<?php echo $valor; ?>');">
                                Acceder
                            </button>
                            <div style="color: white; font-size: 1rem; font-weight: 500;">Contraseña</div>
                            <div class="flex items-center">
                                <div class="relative w-full">
                                    <input type="password" name="password_usuarios_<?php echo $valor; ?>"
                                           class="grow rounded bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blendi-600 focus:border-blendi-600 block w-full p-2.5 js-virtual-keyboard"
                                           data-kioskboard-type="all" data-kioskboard-placement="bottom"
                                           data-kioskboard-specialcharacters="true"
                                           id="password_usuarios_<?php echo $valor; ?>"
                                           required/>
                                    <a tabindex="-1" id="showPasswordLogin_<?php echo $valor; ?>"
                                       onclick="toogleShowPasswordLogin('password_usuarios_<?php echo $valor; ?>','showPasswordLogin_<?php echo $valor; ?>')"
                                       type="button"
                                       class="text-white absolute right-0.5 bottom-1 bg-gray-650 hover:bg-gray-700 focus:ring-1 focus:outline-none focus:ring-gray-650 font-medium rounded-lg text-xs px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 cursor-pointer">Mostrar</a>
                                </div>
                            </div>
                            <a class="text-xs text-white"
                               onclick="loadKeyboard('password_usuarios_<?php echo $valor; ?>')" href="javascript:;">
                                Mostrar teclado
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </form>
            </div>
            <?php
        }
        if (isset($matriz_id_usuarios[0])) {
            ?>
            <script type="application/javascript">
                document.getElementById('password_usuarios_<?php echo $matriz_id_usuarios[0]; ?>').focus();
            </script>
            <?php
        }
        unset($matriz_id_usuarios);
        unset($matriz_usuario_usuarios);
        unset($matriz_avatar_usuarios);
        ?>
        <div style="clear: both;">&nbsp;</div>
    </div>
</div>
<div id="capa_ficha" class="capa-main inline-flex bg-main hide"></div>
<div id="info-main" class="text-center hide"></div>