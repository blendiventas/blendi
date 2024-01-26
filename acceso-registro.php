<div class="container">
    <div class="row m-1">
        <div class="col-12 text-center font-weight-bold mt-3 mb-1">
            <?php
            if ($idioma == "castellano") { echo "Para su comodidad, esta web guarda los pedidos para que los pueda recuperar en cualquier momento.<br />"; } else
            { echo "Per la vostra comoditat, aquest web guarda les comandes perquè les pugueu recuperar en qualsevol moment.<br />"; }
            ?>
        </div>
    </div>
    <div class="row m-1">
        <div class="col-12 text-center font-weight-bold mb-3">
            <?php
            if ($idioma == "castellano") { echo "Indique su email y contraseña, para REGISTRARSE o INICIAR SESIÓN.<br />"; } else
            { echo "Indiqui el seu email i contrasenya, per REGISTRAR-SE o INICIAR SESSIÓ.<br />"; }
            ?>
        </div>
    </div>
    <form action="<?php echo $url_mercado; ?>" id="formulario_sesion_registro" target="_self" method="post">
        <input type="hidden" id="id_documento_documento" name="id_documento_documento" value="<?php echo $id_documento; ?>">
        <input type="hidden" id="id_cliente_documento" name="id_cliente_documento" value="<?php echo $id_cliente; ?>">
        <input type="hidden" id="ip_cliente_documento" name="ip_cliente_documento" value="<?php echo $ip_cliente; ?>">
        <input type="hidden" id="url_mercado_documento" name="url_mercado_documento" value="<?php echo $url_mercado; ?>">
        <input type="hidden" id="id_empresa_documento" name="id_empresa_documento" value="<?php echo $id_empresa; ?>">
        <input type="hidden" id="id_exercici_documento" name="id_exercici_documento" value="<?php echo $exercici; ?>">
        <input type="hidden" id="idioma_documento" name="idioma_documento" value="<?php echo $idioma; ?>">
        <input type="hidden" id="seguir" name="seguir" value="<?php echo $seguir; ?>">

        <input type="hidden" name="acabar_documento" id="acabar_documento" value="<?php echo $acabar_documento; ?>">

        <div class="row mb-2">
            <div class="col-12 col-sm-6 font-weight-bold text-left">
                <?php
                if ($idioma == "castellano") { echo "Introduzca su email para identificar el pedido."; } else
                { echo "Introduïu el vostre email per identificar la comanda."; }
                ?>
            </div>
            <div class="col-12 col-sm-6 text-center">
                <?php
                if($idioma == "castellano") { $valor_idioma = "Email"; }else
                { $valor_idioma = "Email"; }
                ?>
                <input type="email" id="email_cliente" name="email_cliente" value="" placeholder="<?php echo $valor_idioma; ?>">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12 col-sm-6 text-left font-weight-bold">
                <?php
                if ($idioma == "castellano") { echo "Introduzca su contraseña para identificar el pedido."; } else
                { echo "Introduïu la vostra contrasenya per identificar la comanda."; }
                ?>
            </div>

            <div class="col-12 col-sm-6 text-center">
                <?php
                if($idioma == "castellano") { $valor_idioma = "Contraseña"; }else
                { $valor_idioma = "Contrasenya"; }
                ?>
                <input type="password" id="contrasenya" name="contrasenya" value="" placeholder="<?php echo $valor_idioma; ?>">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 text-left">
                <?php
                if ($idioma == "castellano") { echo "Si no recuerda su contraseña, pulse este enlace"; } else
                { echo "Si no recorda la seva contrasenya, premi aquest enllaç"; }
                ?>
                <span class="text-info" onclick="recordarContrasena('<?php echo $idioma; ?>');" onmouseover="this.style.cursor='pointer'">
                    <?php
                    if ($idioma == "castellano") { echo "recordar contraseña"; } else
                    { echo "recordar contrasenya"; }
                    ?>
                </span>
            </div>
        </div>
        <hr>
    </form>
    <div class="form-check text-center" id="check_guardar_acceso">
        <label class="form-check-label">
            <?php
            if($idioma == "castellano") { $valor_idioma = "Guardar los datos de acceso en este dispositivo."; }else
            { $valor_idioma = "Guardar les dades d'accés en aquest dispositiu."; }
            ?>
            <input type="checkbox" class="form-check-input" id="guardar_acceso" name="guardar_acceso" value="1"><?php echo $valor_idioma; ?>
        </label>
    </div>

    <div class="row" id="capa_confirmar_sesion_registro">
        <div class="col-12 text-center mt-3">
            <button type="button" class="btn colorBoton colorTextoBoton btn-sm" onclick="preEnviarDocumento();">
                <?php
                if ($idioma == "castellano") { echo "Confirmar"; } else
                { echo "Confirmar"; }
                ?>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mt-3" id="capa_mensaje_sesion_registro"></div>
    </div>

    <div class="row">
        <div class="col-12 text-center mt-3">
            <a id="linkVolver" class="btn btn-secondary btn-sm" href="<?php echo $url_mercado; ?>" target="_self">
                <?php
                if ($idioma == "castellano") { echo "Volver"; } else
                { echo "Tornar"; }
                ?>
            </a>
        </div>
    </div>

    <script>
        /*
        if(window.localStorage) {
            if(localStorage.getItem('email_cliente_acceso')) {
                document.getElementById("email_cliente").value = localStorage.getItem('email_cliente_acceso');
                document.getElementById("guardar_acceso").checked = true;
            }else {
                document.getElementById("guardar_acceso").checked = false;
            }
            if(localStorage.getItem('contrasenya_acceso')) {
                document.getElementById("contrasenya").value = localStorage.getItem('contrasenya_acceso');
            }
        } else {
            document.getElementById("check_guardar_acceso").style.display = "none";
        }
        */
        if(window.sessionStorage) {
            if(sessionStorage.getItem('email_cliente_acceso')) {
                document.getElementById("email_cliente").value = sessionStorage.getItem('email_cliente_acceso');
                document.getElementById("guardar_acceso").checked = true;
            }else {
                document.getElementById("guardar_acceso").checked = false;
            }
            if(sessionStorage.getItem('contrasenya_acceso')) {
                document.getElementById("contrasenya").value = sessionStorage.getItem('contrasenya_acceso');
            }
        } else {
            document.getElementById("check_guardar_acceso").style.display = "none";
        }
    </script>

</div>
<div class="size-10pt">
    <?php
    if(isset($info_acceso_registro)) {
        if(!empty($info_acceso_registro)) {
            ?>
            <div class="color-red font-bold">
                <?php echo $info_acceso_registro; ?>
            </div>
            <?php
        }
    }
    ?>
    <form action="index.php" method="post">
        <input type="hidden" name="accion" value="identificacion" />
        <b>E-mail:</b>&nbsp;
        <input type="text" name="mail" />&nbsp;&nbsp;
        <b>Password:</b>&nbsp;
        <input type="password" name="password_entrada" />&nbsp;
        <input type="submit" value="Identificarse" style="font-weight:bold" />
    </form>
</div>

<form name="form_dades" action="index.php" method="get" onsubmit="return enviarAccesoRegistro(this)" >
    <input type="hidden" name="accion" value="registro_persona" />
    <?php
    $accion_realizar = "alta";
    ?>
    <input type="hidden" name="accion_realizar" value="<?php echo $accion_realizar; ?>" />
    <div>
        <div>
            <div>
                Está en el área de PROFESIONALES, recuerde que únicamente tienen acceso PROFESIONALES.<br>
                Debe tener una tienda de discos, web, sello discográfico o ser vendedor Profesional de Ebay, Todocolección u otras webs para registrarse y tener la correspondiente licencia de venta (Alta Empresa o Autónomo, epígrafe venta de música) que le pediremos antes de activar su cuenta de comprador profesional.<br>
                Como cliente registrado tendrá acceso a IMPORTANTES DESCUENTOS sobre los precios habituales de la web.<br>
                <span style="color: red; font-size: 8pt;">
                    <strong>
                        SI USTED ES UN COLECCIONISTA PARTICULAR O VENDEDOR QUE NO DISPONE DE LA DOCUMENTACION NECESARIA PARA ABRIR SU CUENTA DE EMPRESA PROFESIONAL PUEDE HACER SUS COMPRAS EN NUESTRA WEB PERO SIN REGISTRASE
                    </strong>
                </span>
                <div style="color: black; font-size: 8pt;">
                    <strong>
                        Para finalizar su Alta envíenos email con la documentación de Empresa y / o Autónomo en donde conste el epígrafe de Venta de Música, Sello discográfico, etc...<br />
                        Hasta no recibir esta documentación no se tramitará su Alta de Profesional pero podrá hacer sus compras en nuestra web SIN registrarse.
                    </strong>
                </div>
            </div>
        </div>
        <div>
            <div style="font-weight:bold;">
                Formulario de registro:<br />
                <span style="font-size:10px;">Los campos marcados con <span style="color:#FF0000;">*</span> son obligatorios.</span>
            </div>
        </div>
        <div>
            <div style="font-weight:bold;">
                Datos para la entrega de los pedidos:<br />
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Nombre
            </div>
            <div>
                <center>
                    <input type="text" name="nom" maxlength="80" size="17" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Primer apellido
            </div>
            <div>
                <center>
                    <input type="text" name="cognoms" maxlength="30" size="22" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Segundo apellido
            </div>
            <div>
                <center>
                    <input type="text" name="cognoms2" maxlength="30" size="22" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;DNI
            </div>
            <div>
                <center>
                    <input type="text" name="dni" maxlength="15" size="13" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Dirección
            </div>
            <div>
                <center>
                    <?php
                    if (isset($format_movil))
                    {
                        ?>
                        <input type="text" name="adresa" maxlength="74" size="45" value="" />
                        <?php
                    }else
                    {
                        ?>
                        <input type="text" name="adresa" maxlength="74" size="72" value="" />
                        <?php
                    }
                    ?>
                </center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;N&ordm;
            </div>
            <div>
                <center>
                    <input type="text" name="numero" maxlength="7" size="7" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                Escalera
            </div>
            <div class="camp_formulari">
                <center>
                    <input type="text" name="escala" maxlength="15" size="7" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                Piso
            </div>
            <div>
                <center>
                    <input type="text" name="pis" maxlength="3" size="3" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                Puerta
            </div>
            <div>
                <center>
                    <input type="text" name="porta" maxlength="3" size="3" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Localidad
            </div>
            <div>
                <center>
                    <input type="text" name="localitat" maxlength="40" size="30" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Codigo postal
            </div>
            <div>
                <center>
                    <input type="text" name="codi_postal" onKeyPress="return acceptNum(event)" maxlength="7" size="7" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Provincia
            </div>
            <div>
                <center>
                    <input type="text" name="provincia" maxlength="23" size="22" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Zona
            </div>
            <div>
                <center>
                    <select name="pais" onchange="comprova_contrareembolso()" style="width:150px;">
                        <option value="" selected="selected">Elige zona</option>
                        <?php
                        /*
                        $link=conn($base);
                        if($link)
                        {
                            $result=mysql_query("SELECT * FROM pais_enviament WHERE prioritat='1' ORDER BY descripcio ASC", $link);
                            $result2=mysql_query("SELECT * FROM pais_enviament WHERE prioritat='0' ORDER BY descripcio ASC", $link);
                            $result3=mysql_query("SELECT defecte FROM pais_enviament WHERE prioritat='1' AND defecte='1'", $link);
                            if(mysql_num_rows($result3)!=0)
                            {
                                $defecte_paisp=1;
                                $defecte_pais=1;
                            }else
                            {
                                $result4=mysql_query("SELECT defecte FROM pais_enviament WHERE prioritat='0' AND defecte='1'", $link);
                                if(mysql_num_rows($result4)!=0)
                                {
                                    $defecte_paisp=1;
                                    $defecte_pais=1;
                                }else
                                {
                                    $defecte_paisp=0;
                                    $defecte_pais=1;
                                }
                            }
                            if(mysql_num_rows($result)!=0)
                            {
                                while($bucle=mysql_fetch_array($result))
                                {
                                    if($bucle['defecte']=="1")
                                    {
                                        ?>
                                        <option value="<?php echo $bucle['id'] ?>" ><?php echo strtoupper($bucle['descripcio']) ?></option>
                                        <?php
                                    }else
                                    {
                                        ?>
                                        <option value="<?php echo $bucle['id'] ?>" <?php if (empty($defecte_paisp)){ echo "selected='selected'"; } ?>><?php echo strtoupper($bucle['descripcio']) ?></option>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <optgroup label="------------"></optgroup>
                            <?php
                            if(mysql_num_rows($result2)!=0)
                            {
                                while($bucle2=mysql_fetch_array($result2))
                                {
                                    if($bucle2['defecte']=="1")
                                    {
                                        ?>
                                        <option value="<?php echo $bucle2['id'] ?>" selected="selected"><?php echo $bucle2['descripcio'] ?></option>
                                        <?php
                                    }else
                                    {
                                        ?>
                                        <option value="<?php echo $bucle2['id'] ?>" ><?php echo $bucle2['descripcio'] ?></option>
                                        <?php
                                    }
                                }
                            }
                        }else
                        {
                            die("Error");
                            exit();
                        }
                        */
                        ?>
                    </select>
                </center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Teléfono móvil
            </div>
            <div>
                <center>
                    <input type="text" name="mobil" onKeyPress="return acceptNum(event)" value="" maxlength="12" size="12" />
                </center>
            </div>
        </div>
        <div>
            <div>
                Teléfono fijo
            </div>
            <div>
                <center>
                    <input type="text" name="telefon" onKeyPress="return acceptNum(event)" value="" maxlength="12" size="12" />
                </center>
            </div>
        </div>
        <div>
            <div style="font-weight:bold;">
                Datos de facturación:<br />
                <span style="font-size:10px;">Atención solo debe rellenarse esta parte del formulario si los datos son distintos de los datos de envío.</span>
            </div>
        </div>
        <div>
            <div>
                Nombre completo
            </div>
            <div>
                <center>
                    <input type="text" name="nom_factu" maxlength="80" size="17" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                DNI
            </div>
            <div>
                <center>
                    <input type="text" name="dni_factu" maxlength="15" size="13" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                Dirección
            </div>
            <div>
                <center>
                    <?php
                    if (isset($format_movil))
                    {
                        ?>
                        <input type="text" name="adresa_factu" maxlength="74" size="45" value="" />
                        <?php
                    }else
                    {
                        ?>
                        <input type="text" name="adresa_factu" maxlength="74" size="72" value="" />
                        <?php
                    }
                    ?>
                </center>
            </div>
        </div>
        <div>
            <div>
                N&ordm;
            </div>
            <div>
                <center>
                    <input type="text" name="numero_factu" maxlength="7" size="7" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                Escalera
            </div>
            <div>
                <center>
                    <input type="text" name="escala_factu" maxlength="15" size="7" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                Piso
            </div>
            <div>
                <center>
                    <input type="text" name="pis_factu" maxlength="3" size="3" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                Puerta
            </div>
            <div>
                <center>
                    <input type="text" name="porta_factu" maxlength="3" size="3" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                Localidad
            </div>
            <div>
                <center>
                    <input type="text" name="localitat_factu" maxlength="40" size="30" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                Codigo postal
            </div>
            <div>
                <center>
                    <input type="text" name="codi_postal_factu" onKeyPress="return acceptNum(event)" maxlength="7" size="7" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                Provincia
            </div>
            <div>
                <center>
                    <input type="text" name="provincia_factu" maxlength="23" size="22" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                Zona
            </div>
            <div>
                <center>
                    <select name="pais_factu" onchange="comprova_contrareembolso()" style="width:150px;">
                        <option value="" selected="selected">Elige zona</option>
                        <?php
                        /*
                        $link=conn($base);
                        if($link)
                        {
                            $result=mysql_query("SELECT * FROM pais_enviament WHERE prioritat='1' ORDER BY descripcio ASC", $link);
                            $result2=mysql_query("SELECT * FROM pais_enviament WHERE prioritat='0' ORDER BY descripcio ASC", $link);
                            $result3=mysql_query("SELECT defecte FROM pais_enviament WHERE prioritat='1' AND defecte='1'", $link);
                            if(mysql_num_rows($result3)!=0)
                            {
                                $defecte_paisp=1;
                                $defecte_pais=1;
                            }else
                            {
                                $result4=mysql_query("SELECT defecte FROM pais_enviament WHERE prioritat='0' AND defecte='1'", $link);
                                if(mysql_num_rows($result4)!=0)
                                {
                                    $defecte_paisp=1;
                                    $defecte_pais=1;
                                }else
                                {
                                    $defecte_paisp=0;
                                    $defecte_pais=1;
                                }
                            }
                            if(mysql_num_rows($result)!=0)
                            {
                                while($bucle=mysql_fetch_array($result))
                                {
                                    if($bucle['defecte']=="1")
                                    {
                                        ?>
                                        <option value="<?php echo $bucle['id'] ?>" ><?php echo strtoupper($bucle['descripcio']) ?></option>
                                        <?php
                                    }else
                                    {
                                        ?>
                                        <option value="<?php echo $bucle['id'] ?>" <?php if (empty($defecte_paisp)){ echo "selected='selected'"; } ?>><?php echo strtoupper($bucle['descripcio']) ?></option>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <optgroup label="------------"></optgroup>
                            <?php
                            if(mysql_num_rows($result2)!=0)
                            {
                                while($bucle2=mysql_fetch_array($result2))
                                {
                                    if($bucle2['defecte']=="1")
                                    {
                                        ?>
                                        <option value="<?php echo $bucle2['id'] ?>" selected="selected"><?php echo $bucle2['descripcio'] ?></option>
                                        <?php
                                    }else
                                    {
                                        ?>
                                        <option value="<?php echo $bucle2['id'] ?>" ><?php echo $bucle2['descripcio'] ?></option>
                                        <?php
                                    }
                                }
                            }
                        }else
                        {
                            die("Error");
                            exit();
                        }
                        */
                        ?>
                    </select>
                </center>
            </div>
        </div>
        <div>
            <div>
                Teléfono móvil
            </div>
            <div>
                <center>
                    <input type="text" name="mobil_factu" onKeyPress="return acceptNum(event)" value="" maxlength="12" size="12" />
                </center>
            </div>
        </div>
        <div>
            <div>
                Teléfono fijo
            </div>
            <div>
                <center>
                    <input type="text" name="telefon_factu" onKeyPress="return acceptNum(event)" value="" maxlength="12" size="12" />
                </center>
            </div>
        </div>
        <div>
            <div style="font-weight:bold;">
                Más información sobre ti:<br />
                <span style="font-size:10px;">Queremos darte el mejor servicio y por eso queremos conocerte mejor.</span>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Nombre de la tienda
            </div>
            <div>
                <center>
                    <input type="text" name="nombre_tienda" maxlength="150" size="40" value="" />
                    <center>
            </div>
        </div>
        <div>
            <div>
                Pseudónimo/s en la red (ebay, TC, etc)
            </div>
            <div>
                <center>
                    <input type="text" name="pseudonimos" maxlength="150" size="40" value="" />
                    <center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Nombre de la Tienda o web de la empresa o web en donde eres vendedor
            </div>
            <div>
                <center>
                    <textarea name="webs" rows="3" cols="45"></textarea>
                    <center>
            </div>
        </div>
        <div>
            <div style="font-weight:bold;">
                Datos de identificación:
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;E-mail
            </div>
            <div>
                <center>
                    <input type="text" name="mail" maxlength="100" size="40" value="" />
                    <center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Repetir e-mail
            </div>
            <div>
                <center>
                    <input type="text" name="mail2" maxlength="100" size="40" value="" />
                </center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Password
            </div>
            <div>
                <center>
                    <input type="password" name="password" value="" maxlength="50" />
                </center>
            </div>
        </div>
        <div>
            <div>
                <span style="color:#FF0000;">*</span>&nbsp;&nbsp;Repetir password
            </div>
            <div>
                <center>
                    <input type="password" name="password2" value="" maxlength="50" />
                </center>
            </div>
        </div>
        <div>
            <div style="font-weight:bold;">
                Si hay algo que debas remarcar puedes hacerlo en este campo.
            </div>
        </div>
        <div>
            <div>
                Observaciones
            </div>
            <div>
                <center>
                    <textarea name="observaciones" rows="4" cols="45" style="width: 100%;"></textarea>
                </center>
            </div>
        </div>
        <div style="font-size:14px;">
            <div>
                <input type="checkbox" value="1" name="chec_condiciones_uso" />&nbsp;&nbsp;Pulsar el botón Registrarse confirma que has leido las <a href="index.php?accion=condicionsus" target="_blank" style="text-decoration:underline; color:#000000;" title="Condiciones de uso">Condiciones de Uso</a> y estás de acuerdo.
            </div>
        </div>

        <div style="font-size:14px;">
            <div>
                <input type="checkbox" value="1" name="chec_mailings" />&nbsp;&nbsp;Marca esta casilla para poder recibir nuestros emails con Ofertas y Descuentos para compradores Profesionales.
            </div>
        </div>

        <div>
            <div>
                <div style="color: red; font-size: 9pt;">
                    <strong>
                        Para finalizar su Alta envíenos email con la documentación de Empresa y / o Autónomo en donde conste el epígrafe de Venta de Música, Sello discográfico, etc...<br />
                        Hasta no recibir esta documentación no se tramitará su Alta de Profesional pero podrá hacer sus compras en nuestra web SIN registrarse.
                    </strong>
                </div>
                <center><input type="submit" value="Registrarse" /></center>
            </div>
        </div>
    </div>
</form>