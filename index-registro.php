<!-- Inicio Registro -->
<div class="callout" id="callout-iniciar">
    <div class="callout-header">
        <div class="grid-2-dis bg-header web-header">
            <div class="box bg-header">
                <img src="<?php echo $host; ?>images/logo_cuidatumusica_300.png" id="imagen-logo" class="w-70 img"
                     alt=""
                     title="">
            </div>
            <div class="row font-bold">
                INICIAR SESIÓN
            </div>
        </div>
    </div>
    <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('bg-main').style.display='block';">×</span>
    <div class="callout-container">
        <div class="grid-2">
            <div class="row text-center">
                <div class="grid-2 m1">
                    <div class="row m1 text-right">
                        <label class="titulos-productos" for="email_iniciar">Email</label>
                    </div>
                    <div class="row m1 text-left">
                        <input type="email" name="email_iniciar" id="email_iniciar" value="" />
                    </div>
                </div>
                <div class="grid-2 m1">
                    <div class="row m1 text-right">
                        <label class="titulos-productos" for="password_iniciar">Password</label>
                    </div>
                    <div class="row m1 text-left">
                        <input type="password" name="password_iniciar" id="password_iniciar" />
                    </div>
                </div>
                <div class="grid-1 m1">
                    <div class="row m1 text-center">
                        <button class="menu" onclick="identificar('1');">Iniciar sesión</button>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <?php
                $seleted_cli = "";
                $seleted_pro = "";
                $seleted_cre = "";
                if($tipo_librador == "cli") { $seleted_cli = " selected"; }
                if($tipo_librador == "pro") { $seleted_pro = " selected"; }
                if($tipo_librador == "cre") { $seleted_cre = " selected"; }
                $seleted_pre = "";
                $seleted_ped = "";
                $seleted_alb = "";
                $seleted_fac = "";
                $seleted_tiq = "";
                if($tipo_documento == "pre") { $seleted_pre = " selected"; }
                if($tipo_documento == "ped") { $seleted_ped = " selected"; }
                if($tipo_documento == "alb") { $seleted_alb = " selected"; }
                if($tipo_documento == "fac") { $seleted_fac = " selected"; }
                if($tipo_documento == "tiq") { $seleted_tiq = " selected"; }
                ?>
                <div class="grid-1 m1">
                    <div class="row m1 text-center">
                        <label for="tipo_librador_seleccionar">Tipo librado:</label><br />
                        <select id="tipo_librador_seleccionar" name="librado" onchange="seleccionarTipoLibrador(this.value);">
                            <option value="cli"<?php echo $seleted_cli; ?>>Clientes</option>
                            <option value="pro"<?php echo $seleted_pro; ?>>Proveedores</option>
                            <option value="cre"<?php echo $seleted_cre; ?>>Creditores</option>
                        </select>
                    </div>
                </div>
                <div class="grid-1 m1">
                    <div class="row m1 text-center">
                        <label for="tipo_documento_seleccionar">Documento:</label><br />
                        <select id="tipo_documento_seleccionar" name="tipo_documento_seleccionar">
                            <option value="pre"<?php echo $seleted_pre; ?>>Presupuestos</option>
                            <option value="ped"<?php echo $seleted_ped; ?>>Pedidos</option>
                            <option value="alb"<?php echo $seleted_alb; ?>>Albaranes</option>
                            <option value="fac"<?php echo $seleted_fac; ?>>Facturas</option>
                            <option value="tiq"<?php echo $seleted_tiq; ?>>Tiquets</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id_librador_seleccionar" id="id_librador_seleccionar" value="<?php echo $id_librador; ?>" />
                <?php
                $hide = " hidden";
                if($tipo_librador == "cli") {
                    $hide = "";
                }
                ?>
                <div class="m1<?php echo $hide; ?>" id="capa_librador_seleccionar_cli">
                    <label for="id_librador_seleccionar_cli">Cliente:</label><br />
                    <select id="id_librador_seleccionar_cli" name="id_librador_seleccionar_cli" onchange="document.getElementById('id_librador_seleccionar').value=this.value; identificar('3');">
                        <?php
                        foreach ($matriz_id_libradores_seleccionar as $key_id_libradores_seleccionar => $valor_id_libradores_seleccionar) {
                            if($matriz_tipo_libradores_seleccionar[$key_id_libradores_seleccionar] == "cli") {
                                ?>
                                <option value="<?php echo $valor_id_libradores_seleccionar; ?>"><?php echo $matriz_nombre_libradores_seleccionar[$key_id_libradores_seleccionar]; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <?php
                $hide = " hidden";
                if($tipo_librador == "pro") {
                    $hide = "";
                }
                ?>
                <div class="m1<?php echo $hide; ?>" id="capa_librador_seleccionar_pro">
                    <label for="id_librador_seleccionar_pro">Proveedor:</label><br />
                    <select id="id_librador_seleccionar_pro" name="id_librador_seleccionar_pro" onchange="document.getElementById('id_librador_seleccionar').value=this.value; identificar('3');">
                        <?php
                        foreach ($matriz_id_libradores_seleccionar as $key_id_libradores_seleccionar => $valor_id_libradores_seleccionar) {
                            if($matriz_tipo_libradores_seleccionar[$key_id_libradores_seleccionar] == "pro") {
                                ?>
                                <option value="<?php echo $valor_id_libradores_seleccionar; ?>"><?php echo $matriz_nombre_libradores_seleccionar[$key_id_libradores_seleccionar]; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <?php
                $hide = " hidden";
                if($tipo_librador == "cre") {
                    $hide = "";
                }
                ?>
                <div class="m1<?php echo $hide; ?>" id="capa_librador_seleccionar_cre">
                    <label for="id_librador_seleccionar_cre">Creditor:</label><br />
                    <select id="id_librador_seleccionar_cre" name="id_librador_seleccionar_cre" onchange="document.getElementById('id_librador_seleccionar').value=this.value; identificar('3');">
                        <?php
                        foreach ($matriz_id_libradores_seleccionar as $key_id_libradores_seleccionar => $valor_id_libradores_seleccionar) {
                            if($matriz_tipo_libradores_seleccionar[$key_id_libradores_seleccionar] == "cre") {
                                ?>
                                <option value="<?php echo $valor_id_libradores_seleccionar; ?>"><?php echo $matriz_nombre_libradores_seleccionar[$key_id_libradores_seleccionar]; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Final registro -->
<!-- Crear Registro -->
<div class="callout" id="callout-crear">
    <div class="callout-header">
        <div class="grid-2-dis bg-header web-header">
            <div class="box bg-header">
                <img src="<?php echo $host; ?>images/logo_cuidatumusica_300.png" id="imagen-logo" class="w-70 img"
                     alt=""
                     title="">
            </div>
            <div class="row font-bold">
                CREAR CUENTA
            </div>
        </div>
    </div>
    <span class="closebtn" onclick="this.parentElement.style.display='none'; document.getElementById('bg-main').style.display='block';">×</span>
    <div class="callout-container">
        <div class="grid-2 m1">
            <div class="row m1 text-right">
                <label class="titulos-productos" for="nombre_registro">Nombre</label>
            </div>
            <div class="row m1 text-left">
                <input type="text" name="nombre_registro" id="nombre_registro" value="" />
            </div>
        </div>
        <div class="grid-2 m1">
            <div class="row m1 text-right">
                <input type="radio" id="crear_cuenta_tipo_persona" name="crear_cuenta_tipo" value="persona">
            </div>
            <div class="row m1 text-left">
                <label for="crear_cuenta_tipo_persona">Persona</label>
            </div>
        </div>
        <div class="grid-2 m1">
            <div class="row m1 text-right">
                <input type="radio" id="crear_cuenta_tipo_empresa" name="crear_cuenta_tipo" value="empresa">
            </div>
            <div class="row m1 text-left">
                <label for="crear_cuenta_tipo_empresa">Empresa</label>
            </div>
        </div>
        <div class="grid-2 m1">
            <div class="row m1 text-right">
                <label class="titulos-productos" for="email_crear">Email</label>
            </div>
            <div class="row m1 text-left">
                <input type="email" name="email_crear" id="email_crear" value="" />
            </div>
        </div>
        <div class="grid-2 m1">
            <div class="row m1 text-right">
                <label class="titulos-productos" for="password_crear">Contraseña</label>
            </div>
            <div class="row m1 text-left">
                <input type="password" name="password_crear" id="password_crear" />
            </div>
        </div>
        <div class="grid-2 m1">
            <div class="row m1 text-right">
                <label class="titulos-productos" for="repetir_password_crear">Repetir contraseña</label>
            </div>
            <div class="row m1 text-left">
                <input type="password" name="repetir_password_crear" id="repetir_password_crear" />
            </div>
        </div>
        <div class="grid-1 m1">
            <div class="row m1 text-center">
                <button class="menu" onclick="identificar('2');">Crear cuenta</button>
            </div>
        </div>
    </div>
</div>
<!-- Crear registro -->