<div class="grid-2-dis bg-header web-header">
    <div class="box bg-header">
        <a href="<?php echo $host_url; ?>" target="_self">
            <img src="<?php echo $host_images . 'datos_empresa/' . $logo_datos_empresa; ?>" id="imagen-logo" class="img"
                 alt=""
                 title="">
        </a>
    </div>
    <div class="box bg-header">
        <div class="grid-3-menu">
            <div class="box">
                <?php
                if ($idioma == "castellano") { $valor_idioma = "Buscar productos..."; } else
                { $valor_idioma = "Buscar productos..."; }
                ?>
                <div class="capa-buscador">
                    <input type="text" id="textoBuscar" name="textoBuscar" placeholder="<?php echo $valor_idioma; ?>">
                    <input type="hidden" id="cercar_poblacion" name="poblacion" value="">
                    <input type="hidden" id="cercar_provincia" name="provincia" value="">
                    <input type="hidden" id="cercar_sector" name="sector" value="">
                    <div class="capa-boton-buscar">
                        <button class="boton_buscador" id="boton_buscador" type="button" onclick="buscar(document.getElementById('textoBuscar').value);">
                            <img class="icono" id="icono_buscar" src="<?php echo $host; ?>icons/System/search-line.svg" alt="Buscar" />
                            <img src="/images/loader.gif" class="mw-20p hidden" alt="Buscando datos" title="Buscando datos" />
                        </button>
                    </div>
                </div>
            </div>
            <div class="box">
                <a href="<?php echo $host_idioma; ?>acceso-registro" class="menu">
                    <div class="box button-menu">
                        <div id="opcionesInicio" class="text-08">
                            <a href="#" class="button-menu" onclick="document.getElementById('callout-iniciar').style.display='block'; document.getElementById('bg-main').style.display='none';">Mi cuenta</a>
                            &nbsp;/&nbsp;
                            <a href="#" class="button-menu" onclick="document.getElementById('callout-crear').style.display='block'; document.getElementById('bg-main').style.display='none';">Crear cuenta</a>
                        </div>
                        <div id="datosInicio" class="text-08 hidden">
                            <a href="#" class="button-menu" onclick="identificar('0');">Cerrar sesión</a><br />
                            <div id="nombreLibrador" class="normal"></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="button-mis_pedidos" id="capa_boton_otros_documentos" onclick="actualizarOtrosDocumentos('capa-otros-documentos','','','mostrar'); collapseCapa('capa-otros-documentos');">
                <img class="mw-30p" src="<?php echo $host; ?>icons/Editor/list-unordered.svg" alt="Otros documentos" />
                <div class="text-08 mt-8p mr-10p float-right">Mis pedidos</div>
            </div>
            <!--
            <div class="box">
                <img src="<?php echo $host; ?>images/banderas/<?php echo $idioma_bandera[$id_idioma]; ?>" class="bandera" alt="<?php echo $idioma_disponible[$id_idioma]; ?>" onclick="collapseCapa('capa-idiomas');">
            </div>
            -->
        </div>

        <div id="capa-idiomas" class="float-right mtp-05 hidden">
            <?php
            foreach ($idioma_disponible as $key_idioma => $valor_idioma) {
                ?>
                <a href="<?php echo $host.$idioma_lang[$key_idioma]."/".$url_base; ?>" target="_self">
                    <img src="<?php echo $host; ?>images/banderas/<?php echo $idioma_bandera[$key_idioma]; ?>" class="banderas" alt="<?php echo $valor_idioma; ?>">
                </a>
                <?php
            }
            ?>
        </div>
        <?php
        if($mostrar_cesta == "superior") {
            $columnas = 3;
        }else {
            $columnas = 2;
        }
        ?>
        <div class="grid-<?php echo $columnas; ?>-dis bg-header">
            <?php
            if($mostrar_familias == "lateral") {
                ?>
                <div class="box">
                    <div id="li_sidebar" class="bg-header">
                        <img class="mw-30p" src="<?php echo $host; ?>icons/Editor/align-justify.svg" alt="My Happy SVG" />
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="box">
                <button id="capa-boton-logos-menu" class="collapsible button-menu w-100" onclick="collapseCapa('capa-logos-menu');">
                    Más...
                </button>
                <div class="grid-4 bg-header" id="capa-logos-menu">
                    <div class="box">
                        <a href="<?php echo $host_idioma; ?>mas-vendidos" class="menu">
                            <div class="box button-menu">
                                <span class="text-08">Más vendidos</span>
                            </div>
                        </a>
                    </div>
                    <div class="box">
                        <a href="<?php echo $host_idioma; ?>novedades" class="menu">
                            <div class="box button-menu">
                                <span class="text-08">Novedades</span>
                            </div>
                        </a>
                    </div>
                    <div class="box">
                        <a href="<?php echo $host_idioma; ?>outlet" class="menu">
                            <div class="box button-menu">
                                <span class="text-08">Outlet</span>
                            </div>
                        </a>
                    </div>
                    <div class="box">
                        <a href="<?php echo $host_idioma; ?>doctor-vinilo">
                            <div class="box button-menu">
                                <span class="text-08">Doctor Vinilo</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            if($mostrar_cesta == "superior") {
                ?>
                <div class="box">
                    <div class="button-cesta" id="capa_boton_cesta" onclick="collapseCapa('capa-cesta'); actualizarCesta();">
                        <img class="mw-30p" src="<?php echo $host; ?>icons/magicoon/regular/shopping-basket.png" alt="Cesta" />
                        <div class="contador-cesta" id="contador-cesta">0</div>
                    </div>
                <?php
            }else {
                ?>
                <div class="box">
                    <!-- <div id="li_sidebar" class="bg-header"> -->
                    <div id="capa_boton_cesta" class="button-cesta">
                        <img class="mw-30p" src="<?php echo $host; ?>icons/magicoon/regular/shopping-basket.png" alt="Cesta" onclick="mostrarCestaPantalla = 'si'; actualizarCesta();" />
                        <div class="contador-cesta" id="contador-cesta">0</div>
                    </div>
                <?php
            }
            ?>
                <div class="button-cesta hidden" id="capa_boton_otros_documentos" onclick="actualizarOtrosDocumentos('capa-otros-documentos','global','','mostrar'); collapseCapa('capa-otros-documentos');">
                    <img class="mw-30p" src="<?php echo $host; ?>icons/Editor/list-unordered.svg" alt="Otros documentos" />
                </div>
            </div>
        </div>
    </div>
</div>
<?php
/*
$tipus_menu_web_superior = "scroll-horizontal";
$tipus_menu_web_superior = "normal";
*/
if($tipus_menu_web_superior == "scroll-horizontal") {
    ?>
    <div class="capa-botones-familias-scroll-horizontal" id="capa_categorias_superior">
        <?php
        $mostrar_familias_anterior = $mostrar_familias;
        $mostrar_familias = "superior";
        ?>
        <div class="botones-izquierdo-scroll" id="boton_scroll_izquierda">
            <img class="w-25p bg-white" src="<?php echo $host; ?>icons/System/arrow-left-s-line.svg" alt="<?php echo $familia; ?>" onmousedown="startScroll('capa_categorias_superior','-');" onmouseup="stopScroll();" />
        </div>
        <div class="botones-derecho-scroll" id="boton_scroll_derecha">
            <img class="w-25p bg-white" src="<?php echo $host; ?>icons/System/arrow-right-s-line.svg" alt="<?php echo $familia; ?>" onmousedown="startScroll('capa_categorias_superior','+');" onmouseup="stopScroll();" />
        </div>
        <div class="capa-botones-scroll">
            <?php
            require("categorias_superior_scroll.php");
            ?>
        </div>
        <?php
        $mostrar_familias = $mostrar_familias_anterior;
        ?>
    </div>
    <?php
}else {
    ?>
    <div class="capa-botones-familias" id="capa-botones-familias" style="height: <?php echo $altura_capa_categorias; ?>px">
        <?php
        require("categorias_superior.php");
        ?>
    </div>
    <?php
}