function asignarDatosPack(descripcion,id,cantidad,activo,orden,alta,modificacion) {
    console.log(descripcion);
    console.log(id);
    console.log(cantidad);
    console.log(activo);
    console.log(orden);
    console.log(alta);
    console.log(modificacion);

    document.getElementById("capa_gestion_pack").innerHTML = "PACK de "+descripcion;
    document.getElementById("tabla_nuevos_packs").style.display = "none";
    document.getElementById("tabla_packs_enlazados").style.display = "none";
    document.getElementById("capa_guardar_insert").style.display = "none";
    document.getElementById("capa_guardar_update").style.display = "inline-grid";
    document.getElementById("boton-cancelar-enlazados").style.display = "block";
    document.getElementById("boton-cancelar-multiples").style.display = "none";
    document.getElementById("boton-cancelar-normal").style.display = "none";
    document.getElementById("id_productos_packs").value = id;
    document.getElementById("cantidad_pack").value = cantidad;
    if(activo == 1) {
        activarElementoUnicoFicha('activo_1', 'capa_activo_1', "capa_unicos_activo");
    }else {
        activarElementoUnicoFicha('activo_2', 'capa_activo_2', "capa_unicos_activo");
    }
    document.getElementById("orden_productos_packs").value = orden;
    document.getElementById("fecha_alta_productos_packs").innerHTML = alta;
    document.getElementById("fecha_modificacion_productos_packs").innerHTML = modificacion;
    location.hash = "#capa_gestion_pack";
}
function cancelarPack(descripcionProducto,tipo) {
    document.getElementById("capa_gestion_pack").innerHTML = "NUEVO PACK de "+descripcionProducto;
    if(tipo == "enlazados") {
        document.getElementById("tabla_nuevos_packs").style.display = "table";
        document.getElementById("tabla_packs_enlazados").style.display = "table";
    }else if(tipo == "multiples" || tipo == "") {
        document.getElementById("capa_packs_multiples").style.display = "block";
        if(document.getElementById("capa_atributo_multiple")) {
            document.getElementById("capa_atributo_multiple").style.display = "block";
        }
    }
    document.getElementById("capa_guardar_insert").style.display = "inline-grid";
    document.getElementById("capa_guardar_update").style.display = "none";
    document.getElementById("id_productos_packs").value = 0;
    document.getElementById("cantidad_pack").value = "";
    activarElementoUnicoFicha('activo_1', 'capa_activo_1', "capa_unicos_activo");
    document.getElementById("orden_productos_packs").value = "";
    document.getElementById("fecha_alta_productos_packs").innerHTML = "";
    document.getElementById("fecha_modificacion_productos_packs").innerHTML = "";
    location.hash = "#capa_superior";
}

function asignarDatosPackMultiple(descripcion,id,cantidad,activo,orden,alta,modificacion) {
    console.log(descripcion);
    console.log(id);
    console.log(cantidad);
    console.log(activo);
    console.log(orden);
    console.log(alta);
    console.log(modificacion);

    document.getElementById("capa_gestion_pack").innerHTML = "PACK de "+descripcion;
    document.getElementById("capa_packs_multiples").style.display = "none";
    document.getElementById("capa_atributo_multiple").style.display = "none";
    document.getElementById("capa_guardar_insert").style.display = "none";
    document.getElementById("capa_guardar_update").style.display = "inline-grid";
    document.getElementById("boton-cancelar-enlazados").style.display = "none";
    document.getElementById("boton-cancelar-multiples").style.display = "block";
    document.getElementById("boton-cancelar-normal").style.display = "none";
    document.getElementById("id_productos_packs").value = id;
    document.getElementById("cantidad_pack").value = cantidad;
    if(activo == 1) {
        activarElementoUnicoFicha('activo_1', 'capa_activo_1', "capa_unicos_activo");
    }else {
        activarElementoUnicoFicha('activo_2', 'capa_activo_2', "capa_unicos_activo");
    }
    document.getElementById("orden_productos_packs").value = orden;
    document.getElementById("fecha_alta_productos_packs").innerHTML = alta;
    document.getElementById("fecha_modificacion_productos_packs").innerHTML = modificacion;
    location.hash = "#capa_gestion_pack";
}
function asignarDatos(descripcion,id,cantidad,activo,orden,alta,modificacion) {
    console.log(descripcion);
    console.log(id);
    console.log(cantidad);
    console.log(activo);
    console.log(orden);
    console.log(alta);
    console.log(modificacion);

    document.getElementById("capa_gestion_pack").innerHTML = "PACK de "+descripcion;
    document.getElementById("capa_packs_multiples").style.display = "none";
    if(document.getElementById("capa_atributo_multiple")) {
        document.getElementById("capa_atributo_multiple").style.display = "none";
    }
    document.getElementById("capa_guardar_insert").style.display = "none";
    document.getElementById("capa_guardar_update").style.display = "inline-grid";
    document.getElementById("boton-cancelar-enlazados").style.display = "none";
    document.getElementById("boton-cancelar-multiples").style.display = "none";
    document.getElementById("boton-cancelar-normal").style.display = "block";
    document.getElementById("id_productos_packs").value = id;
    document.getElementById("cantidad_pack").value = cantidad;
    if(activo == 1) {
        activarElementoUnicoFicha('activo_1', 'capa_activo_1', "capa_unicos_activo");
    }else {
        activarElementoUnicoFicha('activo_2', 'capa_activo_2', "capa_unicos_activo");
    }
    document.getElementById("orden_productos_packs").value = orden;
    document.getElementById("fecha_alta_productos_packs").innerHTML = alta;
    document.getElementById("fecha_modificacion_productos_packs").innerHTML = modificacion;
    location.hash = "#capa_gestion_pack";
}

function guardarPVP(elemento,idProductosPVP,idProductoProductosPVP,idProductosDetallesEnlazadoProductosPVP,idProductosDetallesMultiplesProductosPVP,idPacksProductosPVP,idTarifas,idOferta) {
    /*
    idProductosPVP
    idProductoProductosPVP
    idProductosDetallesEnlazadoProductosPVP
    idProductosDetallesMultiplesProductosPVP
    idPacksProductosPVP

    CREATE TABLE `productos_pvp` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `id_producto` INT(11) NOT NULL DEFAULT '0',
        `id_productos_detalles_enlazado` INT(11) NOT NULL DEFAULT '0',
        `id_productos_detalles_multiples` INT(11) NOT NULL DEFAULT '0',
        `id_packs` INT(11) NOT NULL DEFAULT '0',
        `id_tarifa` INT(11) NOT NULL DEFAULT '0',
        `margen` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
        `pvp` DOUBLE(15,5) NOT NULL DEFAULT '0.00000',
        `fecha_modificacion` DATE NULL DEFAULT NULL,
        `id_ofertas` INT(11) NOT NULL DEFAULT '0',
        `oferta_desde` DATE NULL DEFAULT NULL,
        `oferta_hasta` DATE NULL DEFAULT NULL,
        `pvp_oferta` DOUBLE(15,5) NULL DEFAULT '0.00000',
	PRIMARY KEY (`id`) USING BTREE,INDEX `id_producto` (`id_producto`) USING BTREE)COLLATE='utf8_spanish_ci' ENGINE=MyISAM ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;

    <input type="number" name="margen_productos_pvp[]" id="margen_productos_pvp_<?php echo $contador_elementos; ?>" placeholder="% Margen sobre compras" value="<?php echo $margen_productos_pvp; ?>" step="0.01" />
    <input type="number" name="pvp_productos_pvp[]" id="pvp_productos_pvp_<?php echo $contador_elementos; ?>" placeholder="PVP" value="<?php echo $pvp_productos_pvp; ?>" step="0.01" required />
    <input type="date" name="oferta_desde_productos_pvp[]" id="oferta_desde_productos_pvp_<?php echo $contador_elementos; ?>" placeholder="Oferta desde" value="<?php echo $matriz_oferta_desde_productos_pvp[$key]; ?>" />
    <input type="date" name="oferta_hasta_productos_pvp[]" id="oferta_hasta_productos_pvp_<?php echo $contador_elementos; ?>" placeholder="Oferta hasta" value="<?php echo $matriz_oferta_hasta_productos_pvp[$key]; ?>" />
    <input type="number" name="pvp_oferta_productos_pvp[]" id="pvp_oferta_productos_pvp_<?php echo $contador_elementos; ?>" placeholder="PVP oferta" value="<?php echo $matriz_pvp_oferta_productos_pvp[$key]; ?>" step="0.01" required />
    */
    console.log("guardarPVP de scripts.js de productos");

    var contenedor = document.getElementById("capa_guardar_update_" + elemento);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = 'Guardando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let xhr2 = new XMLHttpRequest();
            xhr2.onload = function () {
                if (xhr2.status == 200) {
                    let capaBodyListaModal = document.getElementById('body-ficha-modal');

                    if (capaBodyListaModal) {
                        capaBodyListaModal.innerHTML = this.responseText;

                        nodeScriptReplace(capaBodyListaModal);
                    }
                }
            }

            xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
            xhr2.send();
        }
    }
    xhr.open("post", "/admin/productos/pvp/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardar-pvp");
    formData.append("idProductosPVP", idProductosPVP);
    formData.append("idProductoProductosPVP", idProductoProductosPVP);
    formData.append("idProductosDetallesEnlazadoProductosPVP", idProductosDetallesEnlazadoProductosPVP);
    formData.append("idProductosDetallesMultiplesProductosPVP", idProductosDetallesMultiplesProductosPVP);
    formData.append("idPacksProductosPVP", idPacksProductosPVP);
    formData.append("idTarifas", idTarifas);
    if(document.getElementById("margen_productos_pvp_"+elemento)) {
        formData.append("margen", document.getElementById("margen_productos_pvp_" + elemento).value);
    }else {
        formData.append("margen", 0);
    }
    formData.append("pvp", document.getElementById("pvp_productos_pvp_"+elemento).value);
    formData.append("id_ofertas", idOferta);
    if(document.getElementById("oferta_desde_productos_pvp_"+elemento)) {
        formData.append("oferta_desde", document.getElementById("oferta_desde_productos_pvp_" + elemento).value);
        formData.append("oferta_hasta", document.getElementById("oferta_hasta_productos_pvp_"+elemento).value);
        formData.append("pvp_oferta", document.getElementById("pvp_oferta_productos_pvp_"+elemento).value);
    }else {
        formData.append("oferta_desde", "0000-00-00");
        formData.append("oferta_hasta", "0000-00-00");
        formData.append("pvp_oferta", "0.00");
    }
    xhr.send(formData);
}

function guardarWeb(elemento,idProductos,idProductoProductosWeb,idProductosOtros,idProductosDetallesEnlazadoProductosWeb,idProductosDetallesMultiplesProductosWeb,idPacksProductosWeb) {
    console.log("guardarWeb de scripts.js de productos");
    var contenedor = document.querySelector("#capa_guardar_update_"+elemento);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Guardando datos" title="Guardando datos" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let xhr2 = new XMLHttpRequest();
            xhr2.onload = function () {
                if (xhr2.status == 200) {
                    let capaBodyListaModal = document.getElementById('body-ficha-modal');

                    if (capaBodyListaModal) {
                        capaBodyListaModal.innerHTML = this.responseText;

                        nodeScriptReplace(capaBodyListaModal);
                    }
                }
            }

            xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
            xhr2.send();
        }
    }
    xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardar");
    formData.append("apartado", "web");
    formData.append("id_productos", idProductos);
    formData.append("idProductoProductosWeb", idProductoProductosWeb);
    formData.append("id_productos_otros", idProductosOtros);
    formData.append("idProductosDetallesEnlazadoProductosWeb", idProductosDetallesEnlazadoProductosWeb);
    formData.append("idProductosDetallesMultiplesProductosWeb", idProductosDetallesMultiplesProductosWeb);
    formData.append("idPacksProductosWeb", idPacksProductosWeb);
    formData.append("descripcion_larga", document.getElementById("descripcion_larga_productos_"+elemento).value);
    formData.append("descripcion_url", document.getElementById("descripcion_url_productos_"+elemento).value);
    formData.append("titulo_meta", document.getElementById("titulo_meta_productos_"+elemento).value);
    formData.append("descripcion_meta", document.getElementById("descripcion_meta_productos_"+elemento).value);
    if(document.getElementById("tienda_productos_"+ elemento + "_1").checked) {
        formData.append("tienda_productos", "1");
    }else {
        formData.append("tienda_productos", "0");
    }
    formData.append("url_externa", document.getElementById("url_externa_productos_"+elemento).value);
    formData.append("gastos", document.getElementById("gastos_productos_"+elemento).value);
    if(document.getElementById("envio_gratis_productos_"+elemento + "_1").checked) {
        formData.append("envio_gratis", "1");
    }else {
        formData.append("envio_gratis", "0");
    }
    formData.append("dias_entrega", document.getElementById("dias_entrega_productos_"+elemento).value);
    xhr.send(formData);
}

function guardarProductoElaborado(idProductos,apartado) {
    console.log("guardarProductoElaborado de scripts.js de productos");

    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            let xhr2 = new XMLHttpRequest();
            xhr2.onload = function () {
                if (xhr2.status == 200) {
                    let capaBodyListaModal = document.getElementById('body-ficha-modal');

                    if (capaBodyListaModal) {
                        capaBodyListaModal.innerHTML = this.responseText;

                        nodeScriptReplace(capaBodyListaModal);
                    }
                }
            }

            xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
            xhr2.send();
        }
    }
    xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardar-elaborado");
    formData.append("apartado", apartado);
    formData.append("id_productos", idProductos);
    formData.append("id_productos_elaborados", document.getElementById("id_productos_elaborados").value);
    formData.append("tipo_producto", document.getElementById("tipo_producto").value);
    if(document.getElementById("id_categoria_elaborados_productos_elaborados")) {
        formData.append("id_categoria_elaborados_productos_elaborados", document.getElementById("id_categoria_elaborados_productos_elaborados").value);
    }else {
        formData.append("id_categoria_elaborados_productos_elaborados", '0');
    }
    if(document.getElementById("cantidad_base_productos_elaborados")) {
        formData.append("cantidad_base_productos_elaborados", document.getElementById("cantidad_base_productos_elaborados").value);
    }else {
        formData.append("cantidad_base_productos_elaborados", '0');
    }
    if(document.getElementById("id_unidades_base_productos_elaborados")) {
        formData.append("id_unidades_base_productos_elaborados", document.getElementById("id_unidades_base_productos_elaborados").value);
    }else {
        formData.append("id_unidades_base_productos_elaborados", '0');
    }
    if(document.getElementById("cantidad_base_productos_elaborados")) {
        formData.append("cantidad_productos_elaborados", document.getElementById("cantidad_base_productos_elaborados").value);
    }else {
        formData.append("cantidad_productos_elaborados", '0');
    }
    if(document.getElementById("horas_tiempo_base_productos_elaborados")) {
        formData.append("horas_tiempo_productos_elaborados", document.getElementById("horas_tiempo_base_productos_elaborados").value);
        formData.append("minutos_tiempo_productos_elaborados", document.getElementById("minutos_tiempo_base_productos_elaborados").value);
        formData.append("segundos_tiempo_productos_elaborados", document.getElementById("segundos_tiempo_base_productos_elaborados").value);
    }else {
        formData.append("horas_tiempo_productos_elaborados", '0');
        formData.append("minutos_tiempo_productos_elaborados", '0');
        formData.append("segundos_tiempo_productos_elaborados", '0');
    }
    xhr.send(formData);
}

function guardarReferencias(elemento,idProductos,idProductoProductosReferencias,idProductosDetallesEnlazadoProductosReferencias,idProductosDetallesMultiplesProductosReferencias,idPacksProductosReferencias) {
    console.log("guardarReferencias de scripts.js de productos");
    var contenedor = document.getElementById("capa_guardar_update_" + elemento);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = 'Guardando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let xhr2 = new XMLHttpRequest();
            xhr2.onload = function () {
                if (xhr2.status == 200) {
                    let capaBodyListaModal = document.getElementById('body-ficha-modal');

                    if (capaBodyListaModal) {
                        capaBodyListaModal.innerHTML = this.responseText;

                        nodeScriptReplace(capaBodyListaModal);
                    }
                }
            }

            xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
            xhr2.send();
        }
    }
    xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardar");
    formData.append("apartado", "referencias");
    formData.append("id_productos", idProductos);
    formData.append("idProductoProductosReferencias", idProductoProductosReferencias);
    formData.append("idProductosDetallesEnlazadoProductosReferencias", idProductosDetallesEnlazadoProductosReferencias);
    formData.append("idProductosDetallesMultiplesProductosReferencias", idProductosDetallesMultiplesProductosReferencias);
    formData.append("idPacksProductosReferencias", idPacksProductosReferencias);
    formData.append("codigo_barras", document.getElementById("codigo_barras_"+elemento).value);
    formData.append("referencia", document.getElementById("referencia_"+elemento).value);
    xhr.send(formData);
}

function guardarControlStock(idProductos,idProductosOtros,idProductosDetallesEnlazadoProductosStock,idProductosDetallesMultiplesProductosStock,idPacksProductosStock) {
    console.log("guardarControlStock de scripts.js de productos");
    var contenedor = document.querySelector("#capa_guardar_stock_update");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = 'Guardando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            /*
            let res = JSON.parse(this.responseText);
            console.log(res.logs);
            */
            let xhr2 = new XMLHttpRequest();
            xhr2.onload = function () {
                if (xhr2.status == 200) {
                    let capaBodyListaModal = document.getElementById('body-ficha-modal');

                    if (capaBodyListaModal) {
                        capaBodyListaModal.innerHTML = this.responseText;

                        nodeScriptReplace(capaBodyListaModal);
                    }
                }
            }

            xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
            xhr2.send();
        }
    }

    xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardar");
    formData.append("apartado", "control_stock");
    formData.append("id_productos", idProductos);
    formData.append("idProductosOtros", idProductosOtros);
    formData.append("idProductosDetallesEnlazadoProductosStock", idProductosDetallesEnlazadoProductosStock);
    formData.append("idProductosDetallesMultiplesProductosStock", idProductosDetallesMultiplesProductosStock);
    formData.append("idPacksProductosStock", idPacksProductosStock);
    if(document.getElementById("control_stock_1").checked) {
        formData.append("control_stock", "1");
        console.log("control_stock: 1");
    }else {
        formData.append("control_stock", "0");
        console.log("control_stock: 0");
    }
    xhr.send(formData);
}
function mostrarOcultarTraspasarProducto() {
    let cantidad = document.getElementById('cantidad');
    let capa_producto_a_traspasar = document.getElementById('capa_producto_a_traspasar');

    if (!cantidad || !capa_producto_a_traspasar) {
        return;
    }

    if (cantidad.value < 0) {
        if (capa_producto_a_traspasar.classList.contains('hidden')) {
            capa_producto_a_traspasar.classList.remove('hidden');
        }
    } else {
        if (!capa_producto_a_traspasar.classList.contains('hidden')) {
            capa_producto_a_traspasar.classList.add('hidden');
        }
    }
}
function guardarStock(idProductos,idProductosOtros,idProductoProductosSku,idProductosDetallesEnlazadoProductosStock,idProductosDetallesMultiplesProductosStock,idPacksProductosStock) {
    console.log("guardarStock de scripts.js de productos");
    var contenedor = document.querySelector("#capa_guardar_update");
    let productoATraspasar = document.getElementById('titulo_relacionado_producto_1_1');

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = 'Guardando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let xhr2 = new XMLHttpRequest();
            xhr2.onload = function () {
                if (xhr2.status == 200) {
                    let capaBodyListaModal = document.getElementById('body-ficha-modal');

                    if (capaBodyListaModal) {
                        capaBodyListaModal.innerHTML = this.responseText;

                        nodeScriptReplace(capaBodyListaModal);
                    }
                }
            }

            xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
            xhr2.send();
        }
    }

    xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardar");
    formData.append("apartado", "stock");
    formData.append("id_productos", idProductos);
    formData.append("idProductosOtros", idProductosOtros);
    formData.append("idProductoProductosSku",idProductoProductosSku);
    formData.append("idProductosDetallesEnlazadoProductosStock", idProductosDetallesEnlazadoProductosStock);
    formData.append("idProductosDetallesMultiplesProductosStock", idProductosDetallesMultiplesProductosStock);
    formData.append("idPacksProductosStock", idPacksProductosStock);
    formData.append("id_productos_sku_stock", document.getElementById("id_productos_sku_stock").value);
    formData.append("lote", document.getElementById("lote").value);
    formData.append("caducidad", document.getElementById("caducidad").value);
    formData.append("numero_serie", document.getElementById("numero_serie").value);
    formData.append("tipo_documento", document.getElementById("tipo_documento").value);
    formData.append("fecha", document.getElementById("fecha").value);
    formData.append("id_documento_1", document.getElementById("id_documento_1").value);
    formData.append("id_documento_2", document.getElementById("id_documento_2").value);
    formData.append("id_librador", document.getElementById("id_librador").value);
    formData.append("cantidad", document.getElementById("cantidad").value);
    formData.append("id_unidades", document.getElementById("id_unidades").value);
    formData.append("unidad", document.getElementById("unidad").value);
    if (productoATraspasar) {
        formData.append("producto_traspasar", productoATraspasar.value);
    } else {
        formData.append("producto_traspasar", '');
    }
    xhr.send(formData);
}
function guardarElaboracion(idProductos,idProductosOtros,idProductoProductosSku,idProductosDetallesEnlazadoProductosStock,idProductosDetallesMultiplesProductosStock,idPacksProductosStock) {
    console.log("guardarStock de scripts.js de productos");

    let guardar = true;
    if(document.getElementById("lote").value == '' && document.getElementById("numero_serie").value == '') {
        alert("Indicar lote o número de serie");
        document.getElementById("lote").focus();
        guardar = false;
    }

    if(guardar == true) {
        var contenedor = document.querySelector("#capa_guardar_update");

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            contenedor.innerHTML = 'Guardando...';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let xhr2 = new XMLHttpRequest();
                xhr2.onload = function () {
                    if (xhr2.status == 200) {
                        let capaBodyListaModal = document.getElementById('body-ficha-modal');

                        if (capaBodyListaModal) {
                            capaBodyListaModal.innerHTML = this.responseText;

                            nodeScriptReplace(capaBodyListaModal);
                        }
                    }
                }

                xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
                xhr2.send();
            }
        }

        console.log("id_productos: " + idProductos);
        console.log("idProductosOtros: " + idProductosOtros);
        console.log("idProductoProductosSku: " + idProductoProductosSku);
        console.log("idProductosDetallesEnlazadoProductosStock: " + idProductosDetallesEnlazadoProductosStock);
        console.log("idProductosDetallesMultiplesProductosStock: " + idProductosDetallesMultiplesProductosStock);
        console.log("idPacksProductosStock: " + idPacksProductosStock);
        /*
        if(document.getElementById("control_stock_si").checked) {
            console.log("control_stock: " + "1");
        }else {
            console.log("control_stock: " + "0");
        }
        */

        xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("select", "guardar");
        formData.append("apartado", "elaboracion");
        formData.append("id_productos", idProductos);
        formData.append("idProductosOtros", idProductosOtros);
        formData.append("idProductoProductosSku", idProductoProductosSku);
        formData.append("idProductosDetallesEnlazadoProductosStock", idProductosDetallesEnlazadoProductosStock);
        formData.append("idProductosDetallesMultiplesProductosStock", idProductosDetallesMultiplesProductosStock);
        formData.append("idPacksProductosStock", idPacksProductosStock);
        /*
        if(document.getElementById("control_stock_si").checked) {
            formData.append("control_stock", "1");
        }else {
            formData.append("control_stock", "0");
        }
        */
        formData.append("id_productos_sku_stock", document.getElementById("id_productos_sku_stock").value);
        formData.append("lote", document.getElementById("lote").value);
        formData.append("caducidad", document.getElementById("caducidad").value);
        formData.append("numero_serie", document.getElementById("numero_serie").value);
        formData.append("tipo_documento", document.getElementById("tipo_documento").value);
        formData.append("fecha", document.getElementById("fecha").value);
        formData.append("id_documento_1", document.getElementById("id_documento_1").value);
        formData.append("id_documento_2", document.getElementById("id_documento_2").value);
        /* formData.append("tipo_librador", document.getElementById("tipo_librador").value); */
        formData.append("id_librador", document.getElementById("id_librador").value);
        formData.append("cantidad", document.getElementById("cantidad").value);
        formData.append("id_unidades", document.getElementById("id_unidades").value);
        formData.append("unidad", document.getElementById("unidad").value);
        //formData.append("importe", document.getElementById("importe").value);
        xhr.send(formData);
    }
}

function guardarOtros(elemento,idProductos,idProductoProductosOtros,idProductosDetallesEnlazadoProductosOtros,idProductosDetallesMultiplesProductosOtros,idPacksProductosOtros) {
    console.log("guardarOtros de scripts.js de productos");
    var contenedor = document.querySelector("#capa_guardar_update_"+elemento);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Guardando datos" title="Guardando datos" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let xhr2 = new XMLHttpRequest();
            xhr2.onload = function () {
                if (xhr2.status == 200) {
                    let capaBodyListaModal = document.getElementById('body-ficha-modal');

                    if (capaBodyListaModal) {
                        capaBodyListaModal.innerHTML = this.responseText;

                        nodeScriptReplace(capaBodyListaModal);
                    }
                }
            }

            xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
            xhr2.send();
        }
    }
    xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardar");
    formData.append("apartado", "otros");
    formData.append("id_productos", idProductos);
    formData.append("idProductoProductosOtros", idProductoProductosOtros);
    formData.append("idProductosDetallesEnlazadoProductosOtros", idProductosDetallesEnlazadoProductosOtros);
    formData.append("idProductosDetallesMultiplesProductosOtros", idProductosDetallesMultiplesProductosOtros);
    formData.append("idPacksProductosOtros", idPacksProductosOtros);
    formData.append("disponibilidad_productos", document.getElementById("disponibilidad_productos_"+elemento).value);
    formData.append("enviar_productos", document.getElementById("enviar_productos_"+elemento).value);
    if(document.getElementById("manual_productos_"+elemento+"_1").checked) {
        formData.append("manual_productos", "1");
    }else {
        formData.append("manual_productos", "0");
    }
    if(document.getElementById("profesionales_productos_"+elemento+"_1")) {
        if (document.getElementById("profesionales_productos_" + elemento+"_1").checked) {
            formData.append("profesionales_productos", "1");
        } else {
            formData.append("profesionales_productos", "0");
        }
    }else {
        formData.append("profesionales_productos", document.getElementById("profesionales_productos_"+elemento).value);
    }
    formData.append("peso_productos", document.getElementById("peso_productos_"+elemento).value);
    formData.append("bultos_productos", document.getElementById("bultos_productos_"+elemento).value);
    formData.append("descuento_maximo_productos", document.getElementById("descuento_maximo_productos_"+elemento).value);
    formData.append("id_observaciones_productos", document.getElementById("id_observaciones_productos_"+elemento).value);
    formData.append("observacion_productos", document.getElementById("observacion_productos_"+elemento).value);
    if(document.getElementById("aplicar_descuento_productos_"+elemento+"_1")) {
        if (document.getElementById("aplicar_descuento_productos_" + elemento+"_1").checked) {
            formData.append("aplicar_descuento_productos", "1");
        } else {
            formData.append("aplicar_descuento_productos", "0");
        }
    }else {
        formData.append("aplicar_descuento_productos", document.getElementById("aplicar_descuento_productos_"+elemento).value);
    }
    xhr.send(formData);
}

function continuarAtributoEnlazado(idProducto) {
    var idAtributoPrincipal = 0;
    var idAtributoEnlazado = 0;
    var atributosPrincipales = document.getElementsByName('atributo_principal');
    var atributosEnlazados = document.getElementsByName('atributo_enlazado');
    for (var bucle = 0 ; bucle < atributosPrincipales.length ; bucle++){
        if ( atributosPrincipales[bucle].checked ) {
            idAtributoPrincipal = atributosPrincipales[bucle].value;
        }
    }
    for (var bucle = 0 ; bucle < atributosEnlazados.length ; bucle++){
        if ( atributosEnlazados[bucle].checked ) {
            idAtributoEnlazado = atributosEnlazados[bucle].value;
        }
    }
    if(idAtributoPrincipal == idAtributoEnlazado) {
        alert("El atributo enlazado debe ser diferente del principal.");
        return false;
    }else {
        window.location.href = "/admin/gestion-productos/id_productos="+idProducto+"/apartado=propiedades/att_pral="+idAtributoPrincipal+"/att_enl="+idAtributoEnlazado;
    }
}
function guardarAtributoEnlazado() {
    console.log("guardarAtributoEnlazado de scripts.js de productos");
    var contenedor = document.querySelector("#capa_guardar_atributos");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Guardando datos" title="Guardando datos" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(res.logs);
            console.log(res.resultado);
            window.location.href = "/admin/gestion-productos/id_productos="+res.id_producto+"/apartado=propiedades";
        }
    }
    xhr.open("post", "/admin/productos/detalles/gestion/datos-datos-update.php", true);
    let form = document.querySelector("#form_datos_post");
    formData = new FormData(form);
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardarAtributoEnlazado");
    xhr.send(formData);
}
function guardarAtributoVertical() {
    console.log("guardarAtributoVertical de scripts.js de productos");
    var contenedor = document.querySelector("#capa_guardar_atributo_vertical");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Guardando datos" title="Guardando datos" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(res.logs);
            console.log(res.resultado);
            window.location.href = "/admin/gestion-productos/id_productos="+res.id_producto+"/apartado=propiedades";
        }
    }
    xhr.open("post", "/admin/productos/detalles/gestion/datos-datos-update.php", true);
    let form = document.querySelector("#form_datos_post");
    formData = new FormData(form);
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardarAtributoVertical");
    xhr.send(formData);
}
function guardarAtributoHorizontal() {
    console.log("guardarAtributoHorizontal de scripts.js de productos");
    var contenedor = document.querySelector("#capa_guardar_atributo_horizontal");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Guardando datos" title="Guardando datos" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(res.logs);
            console.log(res.resultado);
            window.location.href = "/admin/gestion-productos/id_productos="+res.id_producto+"/apartado=propiedades";
        }
    }
    xhr.open("post", "/admin/productos/detalles/gestion/datos-datos-update.php", true);
    let form = document.querySelector("#form_datos_post");
    formData = new FormData(form);
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardarAtributoHorizontal");
    xhr.send(formData);
}
function cambiarEstadoAtributoEnlazado(id) {
    var contenedor = document.querySelector("#capa_img_activo_"+id);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(res){
        contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Cambiando estado" title="Cambiando estado" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(res);
            if(res.valor == 1) {
                contenedor.innerHTML = '<img src="/images/valid-20.png" id="img_activo_'+id+'" class="w-20p" alt="Activo" title="Activo" onmouseover="this.style.cursor=\'pointer\'" onclick="cambiarEstadoAtributoEnlazado(\''+id+'\');" />';
            }else {
                contenedor.innerHTML = '<img src="/images/invalid-20.png" id="img_activo_'+id+'" class="w-20p" alt="Inactivo" title="Inactivo" onmouseover="this.style.cursor=\'pointer\'" onclick="cambiarEstadoAtributoEnlazado(\''+id+'\');" />';
            }
        }
    }
    xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id", id);
    formData.append("apartado", "propiedades");
    formData.append("select", "estado-enlazado");
    xhr.send(formData);
}
function continuarAtributoMultiple(idProducto) {
    var idAtributoPrincipal = 0;
    var atributosPrincipales = document.getElementsByName('atributo_principal');
    for (var bucle = 0 ; bucle < atributosPrincipales.length ; bucle++){
        if ( atributosPrincipales[bucle].checked ) {
            idAtributoPrincipal = atributosPrincipales[bucle].value;
        }
    }
    window.location.href = "/admin/gestion-productos/id_productos="+idProducto+"/apartado=propiedades/att_mult="+idAtributoPrincipal;
}
function guardarAtributoMultiple() {
    console.log("guardarAtributoMultiple de scripts.js de productos");
    var contenedor = document.querySelector("#capa_guardar_atributo_multiple");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Guardando datos" title="Guardando datos" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(res.logs);
            console.log(res.resultado);
            window.location.href = "/admin/gestion-productos/id_productos="+res.id_producto+"/apartado=propiedades";
        }
    }
    xhr.open("post", "/admin/productos/detalles/gestion/datos-datos-update.php", true);
    let form = document.querySelector("#form_datos_post");
    formData = new FormData(form);
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardarAtributoMultiple");
    xhr.send(formData);
}
function continuarAtributoUnico(idProducto) {
    var idAtributoUnico = 0;
    var atributosUnicos = document.getElementsByName('atributo_unico_'+idProducto);
    for (var bucle = 0 ; bucle < atributosUnicos.length ; bucle++){
        if ( atributosUnicos[bucle].checked ) {
            idAtributoUnico = atributosUnicos[bucle].value;
        }
    }
    window.location.href = "/admin/gestion-productos/id_productos="+idProducto+"/apartado=propiedades/att_unico="+idAtributoUnico;
}
function guardarAtributoUnico(idAtributo) {
    console.log("guardarAtributoUnico de scripts.js de productos");
    var contenedor = document.querySelector("#capa_guardar_atributo_unico");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Guardando datos" title="Guardando datos" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(res.logs);
            console.log(res.resultado);
            window.location.href = "/admin/gestion-productos/id_productos="+res.id_producto+"/apartado=propiedades";
        }
    }

    var atributoUnico = 0;
    var atributosUnicos = document.getElementsByName('atributo_unico_'+idAtributo);
    for (var bucle = 0 ; bucle < atributosUnicos.length ; bucle++){
        if ( atributosUnicos[bucle].checked ) {
            atributoUnico = atributosUnicos[bucle].value;
        }
    }

    xhr.open("post", "/admin/productos/detalles/gestion/datos-datos-update.php", true);
    let form = document.querySelector("#form_datos_post");
    formData = new FormData(form);
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id_atributo_unico", idAtributo);
    formData.append("atributo_unico", atributoUnico);
    formData.append("select", "guardarAtributoUnico");
    xhr.send(formData);
}
function eliminarAtributoUnico(idAtributo) {
    console.log("eliminarAtributoUnico de scripts.js de productos");
    var guardar = true;
    
    if (!confirm('Confirmar para eliminar el registro.')) {
        guardar = false;
    }

    if(guardar == true) {
        var contenedor = document.querySelector("#capa_guardar_atributo_unico");

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Guardando datos" title="Guardando datos" />';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                console.log(res.logs);
                console.log(res.resultado);
                window.location.href = "/admin/gestion-productos/id_productos=" + res.id_producto + "/apartado=propiedades";
            }
        }

        var atributoUnico = 0;
        var atributosUnicos = document.getElementsByName('atributo_unico_' + idAtributo);
        for (var bucle = 0; bucle < atributosUnicos.length; bucle++) {
            if (atributosUnicos[bucle].checked) {
                atributoUnico = atributosUnicos[bucle].value;
            }
        }

        xhr.open("post", "/admin/productos/detalles/gestion/datos-datos-update.php", true);
        let form = document.querySelector("#form_datos_post");
        formData = new FormData(form);
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("id_atributo_unico", idAtributo);
        formData.append("atributo_unico", atributoUnico);
        formData.append("select", "eliminarAtributoUnico");
        xhr.send(formData);
    }
}

function eventoKeyUpEnterBuscarProductos(id_productos, apartado) {
    let inputBuscar = document.getElementById('textoBuscarComposicion');
    inputBuscar.addEventListener('keyup', function(e) {
        var keycode = e.keyCode || e.which;
        if (keycode == 13) {
            buscarProductos(id_productos, apartado);
        }
    });
}
function buscarProductos(idProducto,apartado) {
    console.log("buscarProductos de scripts.js de productos");
    var contenedorBotonBuscar = document.getElementById("capa_boton_buscar_producto");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedorBotonBuscar.innerHTML = 'Buscando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            contenedorBotonBuscar.innerHTML = 'Buscar';

            let capaBodyListaModal = document.getElementById('body-ficha-modal');

            if (capaBodyListaModal) {
                capaBodyListaModal.innerHTML = this.responseText;

                nodeScriptReplace(capaBodyListaModal);
            }
        }
    }

    var buscarPor = "";
    var opciones = document.getElementsByName('buscar_productos');
    for (var bucle = 0 ; bucle < opciones.length ; bucle++){
        if ( opciones[bucle].checked ) {
            buscarPor = opciones[bucle].value;
        }
    }
    var textoBuscar = document.getElementById('textoBuscarComposicion').value;

    xhr.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+apartado+"/buscar="+buscarPor+"/texto="+encodeURIComponent(textoBuscar), true);
    xhr.send();
}

function guardarComposicion(origen, idProductoPadre,tipoProducto,contadorProductos,matriz_id_tarifas) {
    let guardar = true;
    let modelo = document.getElementById(origen + "_modelo_productos_"+contadorProductos).value;
    /* AQUI CONTROLAMOS LOS CAMPOS OBLIGATORIOS */
    /*
    modelo = 0 : Con / Sin
    modelo = 1 : Con / Mitad / Sin / Doble
    modelo = 2 : Por cantidad
    modelo = 3 : Único
    modelo = 4 : No mostrar
    modelo = 5 : Menú

    tipo = 0 // normal
    tipo = 1 // elaborado
    tipo = 2 // compuesto
    tipo = 3 // combo manual
    tipo = 4 // combo automático
    */
    if(modelo == 2 || modelo == 3 || modelo == 4 || modelo == 5) {
        if (document.getElementById("cantidad_productos_" + origen + "_" + contadorProductos).value == "null" ||
            document.getElementById("cantidad_productos_" + origen + "_" + contadorProductos).value == "")
        {
            alert("Cantidad producto obligatoria.");
            document.getElementById("cantidad_productos_" + origen + "_" + contadorProductos).focus();
            guardar = false;
        }
    }else if(modelo == 0) {
        if (document.getElementById("cantidad_con_productos_" + origen + "_" + contadorProductos).value == "null" ||
            document.getElementById("cantidad_con_productos_" + origen + "_" + contadorProductos).value == "")
        {
            alert("Cantidad producto obligatoria.");
            document.getElementById("cantidad_con_productos_" + origen + "_" + contadorProductos).focus();
            guardar = false;
        }

        if (document.getElementById("cantidad_sin_productos_" + origen + "_" + contadorProductos).value == "null" ||
            document.getElementById("cantidad_sin_productos_" + origen + "_" + contadorProductos).value == "")
        {
            alert("Cantidad producto obligatoria.");
            document.getElementById("cantidad_sin_productos_" + origen + "_" + contadorProductos).focus();
            guardar = false;
        }
    }else {
        if (document.getElementById("cantidad_con_productos_" + origen + "_" + contadorProductos).value == "null" ||
            document.getElementById("cantidad_con_productos_" + origen + "_" + contadorProductos).value == "")
        {
            alert("Cantidad producto obligatoria.");
            document.getElementById("cantidad_con_productos_" + origen + "_" + contadorProductos).focus();
            guardar = false;
        }

        if (document.getElementById("cantidad_mitad_productos_" + origen + "_" + contadorProductos).value == "null" ||
            document.getElementById("cantidad_mitad_productos_" + origen + "_" + contadorProductos).value == "")
        {
            alert("Cantidad producto obligatoria.");
            document.getElementById("cantidad_mitad_productos_" + origen + "_" + contadorProductos).focus();
            guardar = false;
        }

        if (document.getElementById("cantidad_sin_productos_" + origen + "_" + contadorProductos).value == "null" ||
            document.getElementById("cantidad_sin_productos_" + origen + "_" + contadorProductos).value == "")
        {
            alert("Cantidad producto obligatoria.");
            document.getElementById("cantidad_sin_productos_" + origen + "_" + contadorProductos).focus();
            guardar = false;
        }

        if (document.getElementById("cantidad_doble_productos_" + origen + "_" + contadorProductos).value == "null" ||
            document.getElementById("cantidad_doble_productos_" + origen + "_" + contadorProductos).value == "")
        {
            alert("Cantidad producto obligatoria.");
            document.getElementById("cantidad_doble_productos_" + origen + "_" + contadorProductos).focus();
            guardar = false;
        }
    }

    console.log("Modelo: " + modelo);

    if(guardar == true) {
        console.log("guardarCompuesto de scripts.js de productos");
        let contenedor = document.getElementById("guardar_relacionado_" + origen + "_"+contadorProductos);
        let incrementoTarifas = "0";
        if(modelo == 0 || modelo == 1 || modelo == 2 || modelo == 3 || modelo == 5) {
            incrementoTarifas = document.getElementById("incrementos_tarifas").value;
        }
        let idTarifas = [];
        let sumarCon = [];
        let sumarMitad = [];
        let sumarSin = [];
        let sumarDoble = [];
        if(modelo == 4) {
            idTarifas.push("0");
            sumarCon.push("0");
            sumarMitad.push("0");
            sumarSin.push("0");
            sumarDoble.push("0");
        }

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            contenedor.innerHTML = 'Guardando...';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let xhr2 = new XMLHttpRequest();
                xhr2.onload = function () {
                    if (xhr2.status == 200) {
                        let capaBodyListaModal = document.getElementById('body-ficha-modal');

                        if (capaBodyListaModal) {
                            capaBodyListaModal.innerHTML = this.responseText;

                            nodeScriptReplace(capaBodyListaModal);
                        }
                    }
                }

                xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
                xhr2.send();
            }
        }

        xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("apartado", "composicion");
        formData.append("select", "guardar-composicion");
        formData.append("id_productos", idProductoPadre);
        formData.append("tipo_producto", tipoProducto);
        formData.append("id_tabla_relacionado", document.getElementById("id_tabla_relacionado_" + origen + "_"+contadorProductos).value);
        formData.append("id_producto_relacionado", document.getElementById("id_producto_productos_" + origen + "_"+contadorProductos).value);
        formData.append("id_enlazado", document.getElementById("id_enlazado_productos_" + origen + "_"+contadorProductos).value);
        formData.append("id_multiple", document.getElementById("id_multiple_productos_" + origen + "_"+contadorProductos).value);
        formData.append("id_pack", document.getElementById("id_pack_productos_" + origen + "_"+contadorProductos).value);
        formData.append("modelo", document.getElementById(origen + "_modelo_productos_"+contadorProductos).value);
        formData.append("incrementos_tarifas", incrementoTarifas);
        if(modelo == 0) {
            formData.append("cantidad_con", document.getElementById("cantidad_con_productos_" + origen + "_"+contadorProductos).value);
            formData.append("cantidad_mitad", "0");
            formData.append("cantidad_sin", document.getElementById("cantidad_sin_productos_" + origen + "_"+contadorProductos).value);
            formData.append("cantidad_doble", "0");
            for(let bucleIncrementosTarifas = 0 ; bucleIncrementosTarifas < incrementoTarifas ; bucleIncrementosTarifas++) {
                idTarifas.push(document.getElementById("id_incrementos_tarifas_" + origen + "_" + contadorProductos + "_" + bucleIncrementosTarifas).value);
                sumarCon.push(document.getElementById("sumar_con_productos_" + origen + "_" + contadorProductos + "_" + bucleIncrementosTarifas).value);
                sumarMitad.push("0");
                sumarSin.push(document.getElementById("sumar_sin_productos_" + origen + "_" + contadorProductos + "_" + bucleIncrementosTarifas).value);
                sumarDoble.push("0");
            }
            formData.append("id_tarifas", idTarifas);
            formData.append("sumar_con", sumarCon);
            formData.append("sumar_mitad", sumarMitad);
            formData.append("sumar_sin", sumarSin);
            formData.append("sumar_doble", sumarDoble);
            if(document.getElementById("por_defecto_sin_productos_" + origen + "_"+contadorProductos).checked) {
                formData.append("por_defecto", "2");
            }else {
                formData.append("por_defecto", "0");
            }
            formData.append("id_unidad", "0");
        }else if(modelo == 1) {
            formData.append("cantidad_con", document.getElementById("cantidad_con_productos_" + origen + "_"+contadorProductos).value);
            formData.append("cantidad_mitad", document.getElementById("cantidad_mitad_productos_" + origen + "_"+contadorProductos).value);
            formData.append("cantidad_sin", document.getElementById("cantidad_sin_productos_" + origen + "_"+contadorProductos).value);
            formData.append("cantidad_doble", document.getElementById("cantidad_doble_productos_" + origen + "_"+contadorProductos).value);
            for(let bucleIncrementosTarifas = 0 ; bucleIncrementosTarifas < incrementoTarifas ; bucleIncrementosTarifas++) {
                idTarifas.push(document.getElementById("id_incrementos_tarifas_" + origen + "_" + contadorProductos + "_" + bucleIncrementosTarifas).value);
                sumarCon.push(document.getElementById("sumar_con_productos_" + origen + "_" + contadorProductos + "_" + bucleIncrementosTarifas).value);
                sumarMitad.push(document.getElementById("sumar_mitad_productos_" + origen + "_" + contadorProductos + "_" + bucleIncrementosTarifas).value);
                sumarSin.push(document.getElementById("sumar_sin_productos_" + origen + "_" + contadorProductos + "_" + bucleIncrementosTarifas).value);
                sumarDoble.push(document.getElementById("sumar_doble_productos_" + origen + "_" + contadorProductos + "_" + bucleIncrementosTarifas).value);
            }
            formData.append("id_tarifas", idTarifas);
            formData.append("sumar_con", sumarCon);
            formData.append("sumar_mitad", sumarMitad);
            formData.append("sumar_sin", sumarSin);
            formData.append("sumar_doble", sumarDoble);
            if(document.getElementById("por_defecto_con_productos_" + origen + "_"+contadorProductos).checked) {
                formData.append("por_defecto", "0");
            }else if(document.getElementById("por_defecto_mitad_productos_" + origen + "_"+contadorProductos).checked) {
                formData.append("por_defecto", "1");
            }else if(document.getElementById("por_defecto_sin_productos_" + origen + "_"+contadorProductos).checked) {
                formData.append("por_defecto", "2");
            }else if(document.getElementById("por_defecto_doble_productos_" + origen + "_"+contadorProductos).checked) {
                formData.append("por_defecto", "3");
            }
            formData.append("id_unidad", "0");
        }else if(modelo == 2 || modelo == 3 || modelo == 5) {
            formData.append("cantidad_con", document.getElementById("cantidad_productos_" + origen + "_"+contadorProductos).value);
            formData.append("cantidad_mitad", "0");
            formData.append("cantidad_sin", "0");
            formData.append("cantidad_doble", "0");
            if(modelo == 2 || modelo == 3 || modelo == 5) {
                for (let bucleIncrementosTarifas = 0; bucleIncrementosTarifas < incrementoTarifas; bucleIncrementosTarifas++) {
                    idTarifas.push(document.getElementById("id_incrementos_tarifas_" + origen + "_" + contadorProductos + "_" + bucleIncrementosTarifas).value);
                    sumarCon.push(document.getElementById("sumar_productos_" + origen + "_" + contadorProductos + "_" + bucleIncrementosTarifas).value);
                    sumarMitad.push("0");
                    sumarSin.push("0");
                    sumarDoble.push("0");
                }
            }
            console.log(idTarifas)
            formData.append("id_tarifas", idTarifas);
            formData.append("sumar_con", sumarCon);
            formData.append("sumar_mitad", sumarMitad);
            formData.append("sumar_sin", sumarSin);
            formData.append("sumar_doble", sumarDoble);
            formData.append("por_defecto", "0");
            formData.append("id_unidad", "0");
        }else if(modelo == 4) {
            formData.append("cantidad_con", document.getElementById("cantidad_productos_" + origen + "_"+contadorProductos).value);
            formData.append("cantidad_mitad", "0");
            formData.append("cantidad_sin", "0");
            formData.append("cantidad_doble", "0");
            /*
            for(let bucleIncrementosTarifas = 0 ; bucleIncrementosTarifas < incrementoTarifas ; bucleIncrementosTarifas++) {
                idTarifas.push(document.getElementById("id_incrementos_tarifas_" + origen + "_" + contadorProductos + "_" + bucleIncrementosTarifas).value);
                sumarCon.push("0");
                sumarMitad.push("0");
                sumarSin.push("0");
                sumarDoble.push("0");
            }
            */
            formData.append("id_tarifas", idTarifas);
            formData.append("sumar_con", sumarCon);
            formData.append("sumar_mitad", sumarMitad);
            formData.append("sumar_sin", sumarSin);
            formData.append("sumar_doble", sumarDoble);
            formData.append("por_defecto", "0");
            let selectIdUnidad = document.getElementById("id_unidad_productos_" + origen + "_"+contadorProductos);
            if (selectIdUnidad && selectIdUnidad.options[selectIdUnidad.selectedIndex]) {
                formData.append("id_unidad", selectIdUnidad.options[selectIdUnidad.selectedIndex].value);
            }else {
                formData.append("id_unidad", '0');
            }
        }
        if(modelo == 5) {
            formData.append("id_grupo", document.getElementById("id_grupo_productos_"+contadorProductos).value);
            if(document.getElementById("producto_activo_"+contadorProductos)) {
                if (document.getElementById("producto_activo_" + contadorProductos).checked) {
                    formData.append("activo", "1");
                } else {
                    formData.append("activo", "0");
                }
            }else {
                formData.append("activo", "1");
            }
        } else {
            formData.append("id_grupo", "0");
        }
        formData.append("fijo", "0");
        formData.append("mostrar", document.getElementById("mostrar_productos_" + origen + "_"+contadorProductos).value);
        xhr.send(formData);
    }
}
function guardarEmbalaje(origen, idProductoPadre,tipoProducto,contadorProductos) {
    console.log("guardarEmbalaje de scripts.js de productos");
    var contenedor = document.getElementById("guardar_relacionado_"+origen+"_"+contadorProductos);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = 'Guardando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let xhr2 = new XMLHttpRequest();
            xhr2.onload = function () {
                if (xhr2.status == 200) {
                    let capaBodyListaModal = document.getElementById('body-ficha-modal');

                    if (capaBodyListaModal) {
                        capaBodyListaModal.innerHTML = this.responseText;

                        nodeScriptReplace(capaBodyListaModal);
                    }
                }
            }

            xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
            xhr2.send();
        }
    }

    xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("apartado", "embalaje");
    formData.append("select", "guardar-embalaje");
    formData.append("id_productos", idProductoPadre);
    formData.append("id_tabla_relacionado", document.getElementById("id_tabla_relacionado_" + origen + "_"+contadorProductos).value);
    formData.append("id_producto_relacionado", document.getElementById("id_producto_productos_" + origen + "_"+contadorProductos).value);
    formData.append("cantidad", document.getElementById("cantidad_productos_" + origen + "_"+contadorProductos).value);
    if(document.getElementById("sumar_embalaje_" + origen + "_" + contadorProductos + "_1")) {
        if(document.getElementById("sumar_embalaje_" + origen + "_" + contadorProductos + "_1").checked) {
            formData.append("sumar", "1");
        }else {
            formData.append("sumar", "0");
        }
    }else {
        formData.append("sumar", "0");
    }
    xhr.send(formData);
}
function eliminarEmbalaje(idProducto,idProductoRelacionado,idElemento) {
    var guardar = true;
    if (!confirm('Confirmar para eliminar el registro.')) {
        guardar = false;
    }
    if(guardar == true) {
        var contenedor = document.getElementById("eliminar_relacionado_relacionados_"+idElemento);

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            contenedor.innerHTML = 'Eliminando...';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let xhr2 = new XMLHttpRequest();
                xhr2.onload = function () {
                    if (xhr2.status == 200) {
                        let capaBodyListaModal = document.getElementById('body-ficha-modal');

                        if (capaBodyListaModal) {
                            capaBodyListaModal.innerHTML = this.responseText;

                            nodeScriptReplace(capaBodyListaModal);
                        }
                    }
                }

                xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
                xhr2.send();
            }
        }
        xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("apartado", "embalaje");
        formData.append("select", "eliminar-embalaje");
        formData.append("id_producto_relacionado", document.getElementById("id_tabla_relacionado_relacionados_" + idElemento).value);
        xhr.send(formData);
    }
}
function eliminarRelacionadoElaborados(idProductoRelacionadoElaborado,idProducto,idElemento) {
    var guardar = true;
    if (!confirm('Confirmar para eliminar el registro.')) {
        guardar = false;
    }
    if(guardar == true) {
        var contenedor = document.getElementById("eliminar_relacionado_relacionados_"+idElemento);

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            contenedor.innerHTML = 'Eliminando...';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let xhr2 = new XMLHttpRequest();
                xhr2.onload = function () {
                    if (xhr2.status == 200) {
                        let capaBodyListaModal = document.getElementById('body-ficha-modal');

                        if (capaBodyListaModal) {
                            capaBodyListaModal.innerHTML = this.responseText;

                            nodeScriptReplace(capaBodyListaModal);
                        }
                    }
                }

                xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
                xhr2.send();
            }
        }
        xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("apartado", "compuesto");
        formData.append("select", "eliminar-relacionado-elaborados");
        formData.append("id_producto_relacionado_elaborado", idProductoRelacionadoElaborado);
        xhr.send(formData);
    }
}
/*
function calcularRentabilidadElaborado() {
    let contenedorRentabilidad = document.getElementById('rentabilidad_del_elaborado');
    let cantidadResultante = document.getElementById('cantidad_base_productos_elaborados').value;
    let contenedoresCantidadProductosRelacionados = document.getElementsByClassName('cantidad_productos_relacionados');
    let totalCantidadProductosRelacionados = 0;
    let rentabilidad = 100;

    for(let contadorProductosRelacionados = 0; contadorProductosRelacionados < contenedoresCantidadProductosRelacionados.length; contadorProductosRelacionados++) {
        totalCantidadProductosRelacionados = parseFloat(totalCantidadProductosRelacionados) + parseFloat(contenedoresCantidadProductosRelacionados[contadorProductosRelacionados].value);
    }
    if (cantidadResultante && totalCantidadProductosRelacionados) {
        rentabilidad = cantidadResultante / totalCantidadProductosRelacionados * 100;
    }

    contenedorRentabilidad.innerHTML = rentabilidad.toFixed(2).toString();
}
*/
function avisoRentabilidad() {
    document.getElementById('rentabilidad_del_elaborado').innerText = 'Pendiente de guardar';
}
function eliminarRelacionado(idProducto,idProductoRelacionado,idElemento) {
    var guardar = true;
    if (!confirm('Confirmar para eliminar el registro.')) {
        guardar = false;
    }
    if(guardar == true) {
        var contenedor = document.getElementById("eliminar_relacionado_relacionados_"+idElemento);

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            contenedor.innerHTML = 'Eliminando...';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let xhr2 = new XMLHttpRequest();
                xhr2.onload = function () {
                    if (xhr2.status == 200) {
                        let capaBodyListaModal = document.getElementById('body-ficha-modal');

                        if (capaBodyListaModal) {
                            capaBodyListaModal.innerHTML = this.responseText;

                            nodeScriptReplace(capaBodyListaModal);
                        }
                    }
                }

                xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
                xhr2.send();
            }
        }
        xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("apartado", "compuesto");
        formData.append("select", "eliminar-relacionado");
        formData.append("id_producto_relacionado", idProductoRelacionado);
        xhr.send(formData);
    }
}
function eliminarRelacionadoCombo(idProducto,idProductoRelacionado,idElemento,textoBuscar,buscarPor) {
    var guardar = true;
    if (!confirm('Confirmar para eliminar el registro.')) {
        guardar = false;
    }
    if(guardar == true) {
        var contenedor = document.querySelector("#guardar_relacionado_relacionados_"+idElemento);

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            contenedor.innerHTML = 'Eliminando';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let xhr2 = new XMLHttpRequest();
                xhr2.onload = function () {
                    if (xhr2.status == 200) {
                        let capaBodyListaModal = document.getElementById('body-ficha-modal');

                        if (capaBodyListaModal) {
                            capaBodyListaModal.innerHTML = this.responseText;

                            nodeScriptReplace(capaBodyListaModal);
                        }
                    }
                }

                xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
                xhr2.send();
            }
        }
        xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("apartado", "compuesto");
        formData.append("select", "eliminar-relacionado-combo");
        formData.append("id_producto_relacionado", document.getElementById("id_tabla_relacionado_relacionados_" + idElemento).value);
        xhr.send(formData);
    }
}

function guardarUnidades(accion,idElemento) {
    var guardar = true;
    if(accion == "eliminar") {
        if (!confirm('Confirmar para eliminar el registro.')) {
            guardar = false;
        }
    }
    /* AQUI CONTROLAMOS LOS CAMPOS OBLIGATORIOS */
    if(document.getElementById("id_unidades_"+idElemento).value == "0") {
        alert("Unidad obligatoria.");
        document.getElementById("id_unidades_"+idElemento).focus();
        guardar = false;
    }
    if(guardar == true) {
        if(idElemento == 0) {
            var contenedor = document.querySelector("#capa_guardar_insert");
        }else {
            var contenedor = document.querySelector("#capa_guardar_update_" + idElemento);
        }
        var idProducto = document.getElementById("id_productos").value;

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            contenedor.innerHTML = 'Guardando...';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let xhr2 = new XMLHttpRequest();
                xhr2.onload = function () {
                    if (xhr2.status == 200) {
                        let capaBodyListaModal = document.getElementById('body-ficha-modal');

                        if (capaBodyListaModal) {
                            capaBodyListaModal.innerHTML = this.responseText;

                            nodeScriptReplace(capaBodyListaModal);
                        }
                    }
                }

                xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
                xhr2.send();
            }
        }
        xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
        let form = document.querySelector("#form_datos_post");
        formData = new FormData(form);
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("select", accion);
        formData.append("apartado", "unidades");
        formData.append("id_productos", idProducto);
        formData.append("id_productos_unidades", document.getElementById("id_productos_unidades_"+idElemento).value);
        formData.append("id_unidades", document.getElementById("id_unidades_"+idElemento).value);
        if(document.getElementById("conversion_"+idElemento)) {
            formData.append("conversion", document.getElementById("conversion_" + idElemento).value);
        }
        if(document.getElementById("principal_"+idElemento+"_1").checked) {
            formData.append("principal", "1");
        }else {
            formData.append("principal", "0");
        }
        formData.append("activo", document.getElementById("unidad_activo_"+idElemento).value);
        xhr.send(formData);
    }
}

function mostrar_opciones_modelo(elementos,indice) {
    if (document.getElementById(elementos + "_modelo_productos_" + indice).value == 0 ||
        document.getElementById(elementos + "_modelo_productos_" + indice).value == 1)
    {
        let por_defecto_productos = document.getElementsByClassName('por_defecto_productos_' + elementos + '_' + indice);
        for (let i = 0; i < por_defecto_productos.length; i++) {
            if (i == 0) {
                por_defecto_productos[i].checked = true
            } else {
                por_defecto_productos[i].checked = false
            }
        }
    }
    if(document.getElementById(elementos + "_modelo_productos_" + indice).value == 0) {
        // <option value="0">Con / Sin</option>
        document.getElementById(elementos + "_modelo_base_" + indice).style.display = "none";
        document.getElementById(elementos + "_modelo_opciones_cantidad_" + indice).style.display = "block";
        document.getElementById(elementos + "_modelo_opciones_incremento_" + indice).style.display = "block";
        document.getElementById(elementos + "_modelo_opciones_por_defecto_" + indice).style.display = "block";

        document.getElementById(elementos + "_row-con_cantidad_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-mitad_cantidad_" + indice).style.display = 'none';
        document.getElementById(elementos + "_row-sin_cantidad_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-doble_cantidad_" + indice).style.display = 'none';
        document.getElementById(elementos + "_row-con_sumar_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-mitad_sumar_" + indice).style.display = 'none';
        document.getElementById(elementos + "_row-sin_sumar_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-doble_sumar_" + indice).style.display = 'none';
        document.getElementById(elementos + "_row-con_por_defecto_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-mitad_por_defecto_" + indice).style.display = 'none';
        document.getElementById(elementos + "_row-sin_por_defecto_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-doble_por_defecto_" + indice).style.display = 'none';
        if (elementos == 'encontrados') {
            document.getElementById(elementos + "_row-incremento_" + indice).style.display = 'block';
            document.getElementById(elementos + "_row-select_grupos_" + indice).style.display = 'none';
            document.getElementById(elementos + "_row-link_grupos_" + indice).style.display = 'none';
            document.getElementById(elementos + "_row-unidades_" + indice).style.display = 'none';
        } else {
            document.getElementById("row_sumar_productos_relacionados_" + indice).style.display = 'none';
        }
        document.getElementById("mostrar_productos_" + elementos + "_"+indice).value = 1;

    }else if(document.getElementById(elementos + "_modelo_productos_" + indice).value == 1) {
        // <option value="1" selected>Con / Mitad / Sin / Doble</option>
        document.getElementById(elementos + "_modelo_base_" + indice).style.display = "none";
        document.getElementById(elementos + "_modelo_opciones_cantidad_" + indice).style.display = "block";
        document.getElementById(elementos + "_modelo_opciones_incremento_" + indice).style.display = "block";
        document.getElementById(elementos + "_modelo_opciones_por_defecto_" + indice).style.display = "block";

        document.getElementById(elementos + "_row-con_cantidad_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-mitad_cantidad_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-sin_cantidad_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-doble_cantidad_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-con_sumar_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-mitad_sumar_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-sin_sumar_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-doble_sumar_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-con_por_defecto_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-mitad_por_defecto_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-sin_por_defecto_" + indice).style.display = 'block';
        document.getElementById(elementos + "_row-doble_por_defecto_" + indice).style.display = 'block';
        if (elementos == 'encontrados') {
            document.getElementById(elementos + "_row-incremento_" + indice).style.display = 'block';
            document.getElementById(elementos + "_row-select_grupos_" + indice).style.display = 'none';
            document.getElementById(elementos + "_row-link_grupos_" + indice).style.display = 'none';
            document.getElementById(elementos + "_row-unidades_" + indice).style.display = 'none';
        } else {
            document.getElementById("row_sumar_productos_relacionados_" + indice).style.display = 'none';
        }
        document.getElementById("mostrar_productos_" + elementos + "_"+indice).value = 1;

    }else if(document.getElementById(elementos + "_modelo_productos_" + indice).value == 2) {
        // <option value="2">Por cantidad</option>
        document.getElementById(elementos + "_modelo_base_" + indice).style.display = "block";
        document.getElementById(elementos + "_modelo_opciones_cantidad_" + indice).style.display = "none";
        document.getElementById(elementos + "_modelo_opciones_incremento_" + indice).style.display = "none";
        document.getElementById(elementos + "_modelo_opciones_por_defecto_" + indice).style.display = "none";
        if (elementos == 'encontrados') {
            document.getElementById(elementos + "_row-incremento_" + indice).style.display = 'block';
            document.getElementById(elementos + "_row-select_grupos_" + indice).style.display = 'none';
            document.getElementById(elementos + "_row-link_grupos_" + indice).style.display = 'none';
            document.getElementById(elementos + "_row-unidades_" + indice).style.display = 'none';
        } else {
            document.getElementById("row_sumar_productos_relacionados_" + indice).style.display = 'block';
        }
        document.getElementById("mostrar_productos_" + elementos + "_"+indice).value = 1;
    }else if(document.getElementById(elementos + "_modelo_productos_" + indice).value == 3) {
        // <option value="3">Único</option>
        document.getElementById(elementos + "_modelo_base_" + indice).style.display = "block";
        document.getElementById(elementos + "_modelo_opciones_cantidad_" + indice).style.display = "none";
        document.getElementById(elementos + "_modelo_opciones_incremento_" + indice).style.display = "none";
        document.getElementById(elementos + "_modelo_opciones_por_defecto_" + indice).style.display = "none";
        if (elementos == 'encontrados') {
            document.getElementById(elementos + "_row-incremento_" + indice).style.display = 'block';
            document.getElementById(elementos + "_row-select_grupos_" + indice).style.display = 'none';
            document.getElementById(elementos + "_row-link_grupos_" + indice).style.display = 'none';
            document.getElementById(elementos + "_row-unidades_" + indice).style.display = 'none';
        } else {
            document.getElementById("row_sumar_productos_relacionados_" + indice).style.display = 'block';
        }
        document.getElementById("mostrar_productos_" + elementos + "_"+indice).value = 1;
    }else if(document.getElementById(elementos + "_modelo_productos_" + indice).value == 4) {
        // <option value="4">No mostrar</option>
        document.getElementById(elementos + "_modelo_base_" + indice).style.display = "block";
        document.getElementById(elementos + "_modelo_opciones_cantidad_" + indice).style.display = "none";
        document.getElementById(elementos + "_modelo_opciones_incremento_" + indice).style.display = "none";
        document.getElementById(elementos + "_modelo_opciones_por_defecto_" + indice).style.display = "none";
        if (elementos == 'encontrados') {
            document.getElementById(elementos + "_row-incremento_" + indice).style.display = 'none';
            document.getElementById(elementos + "_row-select_grupos_" + indice).style.display = 'none';
            document.getElementById(elementos + "_row-link_grupos_" + indice).style.display = 'none';
            document.getElementById(elementos + "_row-unidades_" + indice).style.display = 'block';
        } else {
            document.getElementById("row_sumar_productos_relacionados_" + indice).style.display = 'block';
        }
        document.getElementById("mostrar_productos_" + elementos + "_"+indice).value = 0;
    }else if(document.getElementById(elementos + "_modelo_productos_" + indice).value == 5) {
        // <option value="5">Menú</option>
        document.getElementById(elementos + "_modelo_base_" + indice).style.display = "block";
        document.getElementById(elementos + "_modelo_opciones_cantidad_" + indice).style.display = "none";
        document.getElementById(elementos + "_modelo_opciones_incremento_" + indice).style.display = "none";
        document.getElementById(elementos + "_modelo_opciones_por_defecto_" + indice).style.display = "none";
        if (elementos == 'encontrados') {
            document.getElementById(elementos + "_row-incremento_" + indice).style.display = 'block';
            document.getElementById(elementos + "_row-select_grupos_" + indice).style.display = 'block';
            document.getElementById(elementos + "_row-link_grupos_" + indice).style.display = 'block';
            document.getElementById(elementos + "_row-unidades_" + indice).style.display = 'none';
        } else {
            document.getElementById("row_sumar_productos_relacionados_" + indice).style.display = 'block';
        }
        document.getElementById("mostrar_productos_" + elementos + "_"+indice).value = 1;
    }
}

function guardarCoste(idProducto, apartado) {
    console.log("guardarCoste de scripts.js de productos");
    var contenedor = document.querySelector("#capa-guardar-elaborado");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = 'Guardando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            guardarProductoElaborado(idProducto, apartado);
        }
    }
    xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
    let form = document.querySelector("#form_datos_post");
    formData = new FormData(form);
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardar");
    xhr.send(formData);
}

function mostrarVentaInterno() {
    if(document.getElementById("venta_interno_1").checked)
    {
        document.getElementById('capa_producto_venta').style.display = 'block';
        document.getElementById('capa_producto_interno').style.display = 'none';
        document.getElementById("producto_venta_productos").value = 1;
    }else {
        document.getElementById('capa_producto_venta').style.display = 'none';
        document.getElementById('capa_producto_interno').style.display = 'block';
        document.getElementById("producto_venta_productos").value = 0;
    }
}

function guardarLoteElaboracion(idElaborado, idLineaElaborado) {
    console.log("guardarLoteElaboracion de scripts.js de productos");

    console.log("idElaborado: " + idElaborado);
    console.log("idLineaElaborado: " + idLineaElaborado);

    //var contenedor = document.querySelector("#capa-guardar-elaborado");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        //contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Guardando datos" title="Guardando datos" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let xhr2 = new XMLHttpRequest();
            xhr2.onload = function () {
                if (xhr2.status == 200) {
                    let capaBodyListaModal = document.getElementById('body-ficha-modal');

                    if (capaBodyListaModal) {
                        capaBodyListaModal.innerHTML = this.responseText;

                        nodeScriptReplace(capaBodyListaModal);

                        let showElaborado = document.getElementById('tabla_datos_elaboracion_' + idElaborado + '-show');
                        if (showElaborado) {
                            showElaborado.click();
                        }
                    }
                }
            }

            xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
            xhr2.send();
        }
    }
    xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
    formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardarLoteElaboracion");
    formData.append("apartado", "guardarLoteElaboracion");
    formData.append("id_linea_elaborado", idLineaElaborado);
    formData.append("totalCantidadLineaElaboracion", document.getElementById("total_cantidad-linea-elaboracion" + idLineaElaborado).value);
    formData.append("cantidadLineaElaboracion", document.getElementById("cantidad-linea-elaboracion" + idLineaElaborado).value);

    if(document.getElementById("lote-linea-elaboracion" + idLineaElaborado)) {
        console.log("loteLineaElaboracion: " + document.getElementById("lote-linea-elaboracion" + idLineaElaborado).value);
        console.log("caducidadLineaElaboracion: " + document.getElementById("caducidad-linea-elaboracion" + idLineaElaborado).value);

        formData.append("loteLineaElaboracion", document.getElementById("lote-linea-elaboracion" + idLineaElaborado).value);
        formData.append("caducidadLineaElaboracion", document.getElementById("caducidad-linea-elaboracion" + idLineaElaborado).value);
        formData.append("numero_serieLineaElaboracion", '');
    }
    if(document.getElementById("numero_serie-linea-elaboracion" + idLineaElaborado)) {
        console.log("numero_serieLineaElaboracion: " + document.getElementById("numero_serie-linea-elaboracion" + idLineaElaborado).value);

        formData.append("loteLineaElaboracion", '');
        formData.append("caducidadLineaElaboracion", '');
        formData.append("numero_serieLineaElaboracion", document.getElementById("numero_serie-linea-elaboracion" + idLineaElaborado).value);
    }

    xhr.send(formData);
}
function imprimirEtiquetas(linea_sku_stock) {
    let contenidoImprimir = "";
    let cantidad = document.getElementById('cantidad_imprimir_etiqueta_' + linea_sku_stock.id);
    let codigo_barras = linea_sku_stock.codigo_barras;
    contenidoImprimir += "<html><head>";
    contenidoImprimir += "<meta charset='utf-8'>";
    contenidoImprimir += "<link rel='stylesheet' href='/styles.css' type='text/css' />";
    contenidoImprimir += "<title></title>";
    contenidoImprimir += "</head><body>";
    contenidoImprimir += "<div class='grid-3-tiquet'>";
    contenidoImprimir += "<div class='row text-left ml-1'>";
    contenidoImprimir += linea_sku_stock.descripcion_producto;
    contenidoImprimir += "</div>";
    contenidoImprimir += "</div>";
    if (linea_sku_stock.lote != "") {
        contenidoImprimir += "<div class='grid-1'>";
        contenidoImprimir += "<div class='row text-left'>";
        contenidoImprimir += "Lote: " + linea_sku_stock.lote;
        contenidoImprimir += "</div>";
        contenidoImprimir += "</div>";
    }
    if (linea_sku_stock.caducidad != "") {
        contenidoImprimir += "<div class='grid-1'>";
        contenidoImprimir += "<div class='row text-left'>";
        contenidoImprimir += "Caducidad: " + linea_sku_stock.caducidad;
        contenidoImprimir += "</div>";
        contenidoImprimir += "</div>";
    }
    if (cantidad) {
        codigo_barras = cantidad.value + ' ' + codigo_barras;
        contenidoImprimir += "<div class='grid-1'>";
        contenidoImprimir += "<div class='row text-left'>";
        contenidoImprimir += "Cantidad: " + cantidad.value;
        contenidoImprimir += "</div>";
        contenidoImprimir += "</div>";
    }
    if (linea_sku_stock.numero_serie != "") {
        contenidoImprimir += "<div class='grid-1'>";
        contenidoImprimir += "<div class='row text-left'>";
        contenidoImprimir += "Número de serie: " + linea_sku_stock.numero_serie;
        contenidoImprimir += "</div>";
        contenidoImprimir += "</div>";
    }
    if (codigo_barras != "") {
        contenidoImprimir += "<div class='grid-1'>";
        contenidoImprimir += "<div class='row text-left'>";
        contenidoImprimir += "Código de barras: " + codigo_barras;
        contenidoImprimir += "</div>";
        contenidoImprimir += "</div>";

        contenidoImprimir += "<div class='grid-1'>";
        contenidoImprimir += "<div class='row text-left'>";
        contenidoImprimir += "<img alt='testing' src='/barcode.php?codetype=Code39&size=40&text=" + codigo_barras + "&print=true'/>";
        contenidoImprimir += "</div>";
        contenidoImprimir += "</div>";
    }else {
        contenidoImprimir += "<div class='grid-1'>";
        contenidoImprimir += "<div class='row text-left'>";
        contenidoImprimir += "ATENCIÓN: Sin código de barras";
        contenidoImprimir += "</div>";
        contenidoImprimir += "</div>";
    }
    contenidoImprimir += "<br />";
    contenidoImprimir += "<hr />";

    contenidoImprimir += "<script>\r";
    contenidoImprimir += "window.onload = function() {\r";
    contenidoImprimir += "print();\r";
    contenidoImprimir += "window.close();\r";
    contenidoImprimir += "}\r";
    contenidoImprimir += "</script>\r";
    contenidoImprimir += "</body></html>";

    var ventimp = window.open(' ', 'popimpr');
    ventimp.document.write( contenidoImprimir );
    ventimp.document.close();
}

function imprimirTiquets(linea_sku_stock,lineas_datos_cantidad,lineas_datos_descripciones,lineas_datos_lotes,lineas_datos_caducidades,lineas_datos_numeros_serie) {
    let contenidoImprimir = "";
    contenidoImprimir += "<html><head>";
    contenidoImprimir += "<meta charset='utf-8'>";
    contenidoImprimir += "<link rel='stylesheet' href='/styles.css' type='text/css' />";
    contenidoImprimir += "<title></title>";
    contenidoImprimir += "</head><body>";
    contenidoImprimir += "<div class='grid grid-cols-1 mt-2 items-center space-x-1'>";
    contenidoImprimir += "<div class='text-left ml-1'>";
    contenidoImprimir += linea_sku_stock.descripcion_producto;
    contenidoImprimir += "</div>";
    contenidoImprimir += "</div>";
    if (linea_sku_stock.lote != "") {
        contenidoImprimir += "<div class='grid grid-cols-1 mt-2 items-center space-x-1'>";
        contenidoImprimir += "<div class='text-left'>";
        contenidoImprimir += "Lote: " + linea_sku_stock.lote;
        contenidoImprimir += "</div>";
        contenidoImprimir += "</div>";
    }
    if (linea_sku_stock.caducidad != "") {
        contenidoImprimir += "<div class='grid grid-cols-1 mt-2 items-center space-x-1'>";
        contenidoImprimir += "<div class='text-left'>";
        contenidoImprimir += "Caducidad: " + linea_sku_stock.caducidad;
        contenidoImprimir += "</div>";
        contenidoImprimir += "</div>";
    }
    if (linea_sku_stock.numero_serie != "") {
        contenidoImprimir += "<div class='grid grid-cols-1 mt-2 items-center space-x-1'>";
        contenidoImprimir += "<div class='text-left'>";
        contenidoImprimir += "Número de serie: " + linea_sku_stock.numero_serie;
        contenidoImprimir += "</div>";
        contenidoImprimir += "</div>";
    }
    if (linea_sku_stock.codigo_barras != "") {
        contenidoImprimir += "<div class='grid grid-cols-1 mt-2 items-center space-x-1'>";
        contenidoImprimir += "<div class='text-left'>";
        contenidoImprimir += "Código de barras: " + linea_sku_stock.codigo_barras;
        contenidoImprimir += "</div>";
        contenidoImprimir += "</div>";

        contenidoImprimir += "<div class='grid grid-cols-1 mt-2 items-center space-x-1'>";
        contenidoImprimir += "<div class='text-left'>";
        contenidoImprimir += "<img alt='testing' src='/barcode.php?codetype=Code39&size=40&text=" + linea_sku_stock.codigo_barras + "&print=true'/>";
        contenidoImprimir += "</div>";
        contenidoImprimir += "</div>";
    }else {
        contenidoImprimir += "<div class='grid grid-cols-1 mt-2 items-center space-x-1'>";
        contenidoImprimir += "<div class='text-left'>";
        contenidoImprimir += "ATENCIÓN: Sin código de barras";
        contenidoImprimir += "</div>";
        contenidoImprimir += "</div>";
    }
    contenidoImprimir += "<br />";
    contenidoImprimir += "<hr />";

    let columnas = 2;
    let columna_lote = false;
    let columna_numero_serie = false;

    for (let ld = 0 ; ld < lineas_datos_cantidad.length ; ld++) {
        if(lineas_datos_lotes[ld] != '') {
            columna_lote = true;
        }
        if(lineas_datos_numeros_serie[ld] != '') {
            columna_numero_serie = true;
        }
    }
    if(columna_lote == true) {
        columnas += 1;
    }
    if(columna_numero_serie == true) {
        columnas += 1;
    }
    for (let ld = 0 ; ld < lineas_datos_cantidad.length ; ld++) {
        contenidoImprimir += "<div class='grid grid-cols-"+columnas+" mt-2 items-center space-x-1'>";
        contenidoImprimir += "<div class='right'>" + lineas_datos_cantidad[ld] + "</div>";
        contenidoImprimir += "<div class='text-left'>" + lineas_datos_descripciones[ld] + "</div>";
        if(lineas_datos_lotes != '') {
            contenidoImprimir += "<div class='text-left'>" + lineas_datos_lotes[ld] + "</div>";
            contenidoImprimir += "<div class='text-left'>" + lineas_datos_caducidades[ld] + "</div>";
        }
        if(lineas_datos_numeros_serie != '') {
            contenidoImprimir += "<div class='text-left'>" + lineas_datos_numeros_serie[ld] + "</div>";
        }
        contenidoImprimir += "</div>";
    }
    contenidoImprimir += "<script>\r";
    contenidoImprimir += "window.onload = function() {\r";
    contenidoImprimir += "print();\r";
    contenidoImprimir += "window.close();\r";
    contenidoImprimir += "}\r";
    contenidoImprimir += "</script>\r";
    contenidoImprimir += "</body></html>";

    var ventimp = window.open(' ', 'popimpr');
    ventimp.document.write( contenidoImprimir );
    ventimp.document.close();
}

// Personalización

function guardarTitulo(id, idProducto, tipoProducto) {
    console.log("guardarTitulo de scripts.js de productos");
    var contenedor = document.querySelector("#capa_guardar_update_" + id);
    if (id == 0) {
        contenedor = document.querySelector("#capa_guardar_insert");
    }

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = 'Guardando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let xhr2 = new XMLHttpRequest();
            xhr2.onload = function () {
                if (xhr2.status == 200) {
                    let capaBodyListaModal = document.getElementById('body-ficha-modal');

                    if (capaBodyListaModal) {
                        capaBodyListaModal.innerHTML = this.responseText;

                        nodeScriptReplace(capaBodyListaModal);
                    }
                }
            }

            xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
            xhr2.send();
        }
    }

    xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardar-titulo");
    formData.append("apartado", "personalizacion");
    formData.append("id", id);
    formData.append("id_producto", idProducto);
    formData.append("tipo_producto", tipoProducto);
    formData.append("descripcion", document.getElementById('titulo_descripcion_' + id).value);
    formData.append("modelo", document.getElementById('titulo_tipo_' + id).value);
    let orden = document.getElementById('titulo_orden_' + id).value;
    if (id == 0) {
        orden = document.getElementsByClassName('titulo_orden').length * 10 + 10;
    }
    formData.append("orden", orden);

    let titulosRelacionadosAEnviar = '';
    let titulosRelacionadosDefectoAEnviar = '';
    let titulosRelacionadosIdProductoAEnviar = '';
    let titulosRelacionadosTarifasAEnviar = '';
    let titulosRelacionadosSumarConAEnviar = '';
    if (id != 0) {
        let titulosRelacionadosTarifas = document.getElementById('titulo_relacionado_incrementos_' + id + '_aSustituirPorElContador_target').querySelectorAll('.titulo_relacionado_producto_tarifa_id_' + id);
        for (let i = 0; i < titulosRelacionadosTarifas.length; i++) {
            if (i !== 0) {
                titulosRelacionadosTarifasAEnviar += ',';
            }

            titulosRelacionadosTarifasAEnviar += titulosRelacionadosTarifas[i].value;
        }

        let titulosRelacionados = document.getElementsByClassName('titulo_relacionado_descripcion_' + id);
        let titulosRelacionadosDefecto = document.getElementsByClassName('titulo_relacionado_defecto_input_' + id);
        let titulosRelacionadosIdProducto = document.getElementsByClassName('titulo_relacionado_producto_' + id);
        let titulosRelacionadosSumarCon = document.getElementsByClassName('titulo_relacionado_producto_tarifa_incremento_' + id);
        for (let i = 0; i < titulosRelacionados.length - 1; i++) {
            if (i !== 0) {
                titulosRelacionadosAEnviar += ',';
                titulosRelacionadosDefectoAEnviar += ',';
                titulosRelacionadosIdProductoAEnviar += ',';
                titulosRelacionadosSumarConAEnviar += ',';
            }
            titulosRelacionadosAEnviar += titulosRelacionados[i].value.replace(',', '');
            titulosRelacionadosDefectoAEnviar += titulosRelacionadosDefecto[i].checked;
            titulosRelacionadosIdProductoAEnviar += titulosRelacionadosIdProducto[i].value;

            for (let z = i * titulosRelacionadosTarifas.length; z < i * titulosRelacionadosTarifas.length + titulosRelacionadosTarifas.length; z++) {
                if (z !== i * titulosRelacionadosTarifas.length) {
                    titulosRelacionadosSumarConAEnviar += ';';
                }

                titulosRelacionadosSumarConAEnviar += titulosRelacionadosSumarCon[z].value;
            }
        }
    }

    formData.append("relacionadosDescripciones", titulosRelacionadosAEnviar);
    formData.append("relacionadosDefecto", titulosRelacionadosDefectoAEnviar);
    formData.append("idProductoRelacionado", titulosRelacionadosIdProductoAEnviar);
    formData.append("tarifas", titulosRelacionadosTarifasAEnviar);
    formData.append("sumarCon", titulosRelacionadosSumarConAEnviar);

    xhr.send(formData);
}
function eliminarTitulo(id, idProducto) {
    console.log("eliminarTitulo de scripts.js de productos");
    var contenedor = document.querySelector("#capa_guardar_update_" + id);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = 'Eliminando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let xhr2 = new XMLHttpRequest();
            xhr2.onload = function () {
                if (xhr2.status == 200) {
                    let capaBodyListaModal = document.getElementById('body-ficha-modal');

                    if (capaBodyListaModal) {
                        capaBodyListaModal.innerHTML = this.responseText;

                        nodeScriptReplace(capaBodyListaModal);
                    }
                }
            }

            xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha+"/apartado="+document.getElementById("apartado").value, true);
            xhr2.send();
        }
    }

    xhr.open("post", "/admin/productos/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "eliminar-titulo");
    formData.append("apartado", "personalizacion");
    formData.append("id", id);
    formData.append("id_producto", idProducto);
    xhr.send(formData);
}
function updateTipo(idTitulo, tipo, defectosChecked) {
    document.getElementById('titulo_button_text_dropdown_tipo_' + idTitulo).innerHTML = document.getElementById('titulo_dropdown_tipo_' + idTitulo + '_opcion_' + tipo).innerHTML;
    document.getElementById('titulo_tipo_' + idTitulo).value = tipo;

    let opciones = document.getElementsByClassName('titulo_dropdown_tipo_' + idTitulo + '_opcion');
    for (let i = 0; i < opciones.length; i++) {
        if (opciones[i].classList.contains('bg-blendi-50')) {
            opciones[i].classList.remove('bg-blendi-50');
        }
    }
    let opcionActual = document.getElementById('titulo_dropdown_tipo_' + idTitulo + '_opcion_' + tipo);
    if (!opcionActual.classList.contains('bg-blendi-50')) {
        opcionActual.classList.add('bg-blendi-50');
    }
    document.getElementById('titulo_button_dropdown_tipo_' + idTitulo).click();

    let contenidoDefecto = '';
    let defectoChecked = '';
    let capasDefecto = document.getElementsByClassName('titulo_relacionado_defecto_' + idTitulo);
    for (let i = 0; i < capasDefecto.length; i++) {
        defectoChecked = ' checked';
        contenidoDefecto = '';
        if ((defectosChecked[i] !== undefined && defectosChecked[i] == 2) || (i == capasDefecto.length - 1)) {
            defectoChecked = '';
        }
        if (tipo === 3) {
            contenidoDefecto = '<input type="radio"' + defectoChecked + ' name="titulo_relacionado_defecto_' + idTitulo + '_' + tipo + '" value="' + idTitulo + '" class="titulo_relacionado_defecto_input_' + idTitulo + '" id="titulo_relacionado_defecto_input_' + idTitulo + '_' + i + '">';
        }
        if (tipo === 0 || tipo === 5) {
            contenidoDefecto = '<input type="checkbox"' + defectoChecked + ' name="titulo_relacionado_defecto_' + idTitulo + '_' + tipo + '[]" value="2" class="sr-only peer titulo_relacionado_defecto_input_' + idTitulo + '">\n' +
                '<div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[\'\'] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blendi-600"></div>';
        }
        capasDefecto[i].innerHTML = contenidoDefecto;
        if (tipo === 3 && defectoChecked) {
            document.getElementById('titulo_relacionado_defecto_input_' + idTitulo + '_' + i).checked = true;
        }
    }
}
function loadDropdownTipo(idTitulo) {
    // set the dropdown menu element
    let targetElResultados = document.getElementById('titulo_dropdown_tipo_' + idTitulo);

    // set the element that trigger the dropdown menu on click
    let triggerElResultados = document.getElementById('titulo_button_dropdown_tipo_' + idTitulo);

    // options with default values
    let optionsResultados = {
        placement: 'bottom',
    };

    let dropdown = new Dropdown(targetElResultados, triggerElResultados, optionsResultados);
}

function anadirTituloRelacionado(idTitulo, idProductos) {
    let capaACopiar = document.getElementById('titulo_relacionado_nuevo_' + idTitulo);
    let capaDondePegarContenidoNuevo = document.getElementById('titulos_relacionados_nuevos_' + idTitulo);
    let nodoNuevaCapa = document.createElement('div');
    nodoNuevaCapa.classList.add('flex');
    nodoNuevaCapa.classList.add('flex-wrap');
    nodoNuevaCapa.classList.add('mt-3');
    nodoNuevaCapa.classList.add('items-center');
    nodoNuevaCapa.classList.add('space-x-3');
    nodoNuevaCapa.innerHTML = capaACopiar.innerHTML.replace(new RegExp(idTitulo + '_aSustituirPorElContador', 'g'), idTitulo + '_' + window.descripcionBuscadorContador);

    capaDondePegarContenidoNuevo.appendChild(nodoNuevaCapa);

    mostrarEliminarTituloRelacionado(idTitulo);

    let triggerDropdown = document.getElementById('titulo_relacionado_dropdown_descripcion_' + idTitulo + '_' + window.descripcionBuscadorContador + '_trigger');
    let actualDescipcionBuscadorContador = window.descripcionBuscadorContador;
    triggerDropdown.children[0].onkeyup = (function() { descripcionBuscador(idTitulo, actualDescipcionBuscadorContador, idProductos); });

    loadDropdownDescripcionBuscador(idTitulo, window.descripcionBuscadorContador);
    loadDropdownIncrementos(idTitulo, window.descripcionBuscadorContador);

    window.descripcionBuscadorContador++;
}
function mostrarEliminarTituloRelacionado(idTitulo) {
    let totalTituloRelacionados = document.getElementsByClassName('titulo_relacionado_eliminar_' + idTitulo);

    if (totalTituloRelacionados.length > 2) {
        for (let i = 0; i < totalTituloRelacionados.length; i++) {
            if (totalTituloRelacionados[i].classList.contains('hidden')) {
                totalTituloRelacionados[i].classList.remove('hidden');
            }
        }
    }
    if (totalTituloRelacionados.length === 2) {
        if (!totalTituloRelacionados[0].classList.contains('hidden')) {
            totalTituloRelacionados[0].classList.add('hidden');
        }
    }
}
function loadDropdownDescripcionBuscador(idTitulo, contador) {
    let targetElResultados = document.getElementById('titulo_relacionado_dropdown_descripcion_' + idTitulo + '_' + contador);

    let triggerElResultados = document.getElementById('titulo_relacionado_dropdown_descripcion_' + idTitulo + '_' + contador + '_trigger');

    let optionsResultados = {
        placement: 'bottom',
    };

    let dropdown = new Dropdown(targetElResultados, triggerElResultados, optionsResultados);
}
function loadDropdownIncrementos(idTitulo, contador) {
    let targetElResultados = document.getElementById('titulo_relacionado_incrementos_' + idTitulo + '_' + contador + '_target');

    let triggerElResultados = document.getElementById('titulo_relacionado_incrementos_' + idTitulo + '_' + contador + '_trigger');

    let optionsResultados = {
        placement: 'bottom',
    };

    let dropdown = new Dropdown(targetElResultados, triggerElResultados, optionsResultados);
}
function updateTituloRelacionadoProducto(idTitulo, contador, idProducto, descripcionProducto) {
    let descripcionTrigger = document.getElementById('titulo_relacionado_dropdown_descripcion_' + idTitulo + '_' + contador + '_trigger');
    let inputDescripcion = document.getElementById('titulo_relacionado_dropdown_descripcion_' + idTitulo + '_' + contador + '_trigger').children[0];
    let inputProducto = document.getElementById('titulo_relacionado_producto_' + idTitulo + '_' + contador);
    let capaIncrementos = document.getElementById('titulo_relacionado_incrementos_' + idTitulo + '_' + contador);

    if (descripcionProducto && inputDescripcion) {
        inputDescripcion.value = descripcionProducto;
    }
    if (inputProducto) {
        inputProducto.value = idProducto;
    }
    if (descripcionTrigger && idProducto !== 0) {
        descripcionTrigger.click();
    }
    if (capaIncrementos && idProducto !== 0) {
        capaIncrementos.classList.remove('hidden');
    } else {
        if (capaIncrementos) {
            capaIncrementos.classList.add('hidden');
        }
    }
}
function descripcionBuscador(idTitulo, contador, idProductos) {
    updateTituloRelacionadoProducto(idTitulo, contador, 0, '');

    let descripcionABuscar = document.getElementById('titulo_relacionado_dropdown_descripcion_' + idTitulo + '_' + contador + '_trigger').children[0].value;

    let capaResultados = document.getElementById('titulo_relacionado_dropdown_descripcion_' + idTitulo + '_' + contador);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        capaResultados.innerHTML = 'Buscando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            let txt;
            if (res.descripciones && res.descripciones.length > 0) {
                let capaResultadosContenido = '';
                for (let i = 0; i < res.descripciones.length; i++) {
                    txt = document.createElement("textarea");
                    txt.innerHTML = res.descripciones[i];
                    capaResultadosContenido += '<div onclick="updateTituloRelacionadoProducto(' + idTitulo + ', ' + contador + ', ' + res.ids[i] + ', \'' + txt.value.replace("'", "") + '\')" class="grid grid-cols-7 items-center space-x-2 h-12 px-3 hover:bg-gray-50">'
                    capaResultadosContenido += '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                    capaResultadosContenido += '<div class="col-span-6">' + res.descripciones[i] + '</div>';
                    capaResultadosContenido += '</div>';
                }

                capaResultados.innerHTML = capaResultadosContenido;
            } else {
                capaResultados.innerHTML = 'Productos no encontrados.';
            }
        }
    }

    xhr.open("post", "/admin/productos/gestion/datos-select.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id_productos", idProductos);
    formData.append("select", "buscar-productos-personalizacion");
    formData.append("apartado", "personalizacion");
    formData.append("texto_buscar", descripcionABuscar);
    xhr.send(formData);
}
function eliminarTituloRelacionado(element, idTitulo) {
    let capaAEliminar = element.parentNode.parentNode;
    capaAEliminar.remove();

    mostrarEliminarTituloRelacionado(idTitulo);
}
window.descripcionBuscadorContador = 0;
function setDescripcionBuscadorContador(contador) {
    window.descripcionBuscadorContador = contador;
}
// Fin personalización

// Menú
function nuevoMenu() {
    let id = 0;
    window.id_ficha = id;

    let botonGuardarFichaModal = document.getElementById("boton-guardar-ficha-modal");
    if (botonGuardarFichaModal) {
        botonGuardarFichaModal.disabled = false;
        botonGuardarFichaModal.innerHTML = 'Guardar';
    }
    let botonEliminarFichaModal = document.getElementById("boton-eliminar-ficha-modal");
    if (botonEliminarFichaModal) {
        botonEliminarFichaModal.disabled = false;
        botonEliminarFichaModal.innerHTML = 'Eliminar';

        if (id == 0 && !botonEliminarFichaModal.classList.contains('hidden')) {
            botonEliminarFichaModal.classList.add('hidden');
        }
        if (id != 0){
            botonEliminarFichaModal.classList.remove('hidden');
        }
    }


    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            let capaBodyListaModal = document.getElementById('body-ficha-modal');

            if (capaBodyListaModal) {
                capaBodyListaModal.innerHTML = this.responseText;

                nodeScriptReplace(capaBodyListaModal);

                let capaBotonOpenModalFicha = document.getElementById('botonOpenModalFicha');
                if (capaBotonOpenModalFicha) {
                    let inputDescripcionProductos = document.getElementById('descripcion_productos');
                    let inputActivoNo = document.getElementById('capa_activo_2');
                    let inputTipoProducto = document.getElementById('tipo_producto_productos');
                    inputDescripcionProductos.value = 'Nuevo menú';
                    inputActivoNo.click();
                    inputTipoProducto.value = 3;
                    window.apartado = 'menu';
                    guardarFicha('guardar');

                    capaBotonOpenModalFicha.click();
                }
            }
        }
    }

    xhr.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha, true);
    xhr.send();
}
function loadDropdownIncrementosMenu(idProducto) {
    let targetElResultados = document.getElementById('producto_relacionado_incrementos_' + idProducto + '_target');

    let triggerElResultados = document.getElementById('producto_relacionado_incrementos_' + idProducto + '_trigger');

    let optionsResultados = {
        placement: 'bottom',
    };

    let dropdown = new Dropdown(targetElResultados, triggerElResultados, optionsResultados);
}
// Fin menú

// Elaboración
function loadDropdownLoteBuscador(idLinea) {
    let targetElResultados = document.getElementById('lote-linea-elaboracion_' + idLinea + '_target');

    let triggerElResultados = document.getElementById('lote-linea-elaboracion_' + idLinea + '_trigger');

    let optionsResultados = {
        placement: 'bottom',
    };

    let dropdown = new Dropdown(targetElResultados, triggerElResultados, optionsResultados);
}
function updateLoteLinea(idLinea, lote) {
    document.getElementById('lote-linea-elaboracion' + idLinea).value = lote;
}
function loteBuscador(idLinea) {
    let descripcionABuscar = document.getElementById('lote-linea-elaboracion' + idLinea).value;

    let capaResultados = document.getElementById('lote-linea-elaboracion_' + idLinea + '_target');

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        capaResultados.innerHTML = 'Buscando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            if (res.lotes && res.lotes.length > 0) {
                let capaResultadosContenido = '';
                for (let i = 0; i < res.lotes.length; i++) {
                    capaResultadosContenido += '<div onclick="updateLoteLinea(' + idLinea + ', \'' + res.lotes[i] + '\')" class="grid grid-cols-7 items-center space-x-2 h-12 px-3 hover:bg-gray-50">'
                    capaResultadosContenido += '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                    capaResultadosContenido += '<div class="col-span-6">' + res.lotes[i] + '</div>';
                    capaResultadosContenido += '</div>';
                }

                capaResultados.innerHTML = capaResultadosContenido;
            } else {
                capaResultados.innerHTML = 'Lotes no encontrados.';
            }
        }
    }

    xhr.open("post", "/admin/productos/gestion/datos-select.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id_productos", 0);
    formData.append("select", "buscar-lotes");
    formData.append("apartado", "elaboracion");
    formData.append("texto_buscar", descripcionABuscar);
    xhr.send(formData);
}
function loadDropdownNumeroSerieBuscador(idLinea) {
    let targetElResultados = document.getElementById('numero_serie-linea-elaboracion_' + idLinea + '_target');

    let triggerElResultados = document.getElementById('numero_serie-linea-elaboracion_' + idLinea + '_trigger');

    let optionsResultados = {
        placement: 'bottom',
    };

    let dropdown = new Dropdown(targetElResultados, triggerElResultados, optionsResultados);
}
function updateNumeroSerieLinea(idLinea, lote) {
    document.getElementById('numero_serie-linea-elaboracion' + idLinea).value = lote;
}
function numeroSerieBuscador(idLinea) {
    let descripcionABuscar = document.getElementById('numero_serie-linea-elaboracion' + idLinea).value;

    let capaResultados = document.getElementById('numero_serie-linea-elaboracion_' + idLinea + '_target');

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        capaResultados.innerHTML = 'Buscando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            if (res.numeros_serie && res.numeros_serie.length > 0) {
                let capaResultadosContenido = '';
                for (let i = 0; i < res.lotes.length; i++) {
                    capaResultadosContenido += '<div onclick="updateNumeroSerieLinea(' + idLinea + ', \'' + res.numeros_serie[i] + '\')" class="grid grid-cols-7 items-center space-x-2 h-12 px-3 hover:bg-gray-50">'
                    capaResultadosContenido += '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                    capaResultadosContenido += '<div class="col-span-6">' + res.numeros_serie[i] + '</div>';
                    capaResultadosContenido += '</div>';
                }

                capaResultados.innerHTML = capaResultadosContenido;
            } else {
                capaResultados.innerHTML = 'Números de serie no encontrados.';
            }
        }
    }

    xhr.open("post", "/admin/productos/gestion/datos-select.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id_productos", 0);
    formData.append("select", "buscar-numeros-serie");
    formData.append("apartado", "elaboracion");
    formData.append("texto_buscar", descripcionABuscar);
    xhr.send(formData);
}
// Fin elaboración
