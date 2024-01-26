function sumarEtiquetas(capa) {
    document.getElementById(capa).value = parseInt(document.getElementById(capa).value) +1;
}
function restarEtiquetas(capa) {
    if(document.getElementById(capa).value > 1) {
        document.getElementById(capa).value = parseInt(document.getElementById(capa).value) - 1;
    }
}
function imprimirEtiquetas(idDocumento1,ejercicio,idSesion,ip,so,idioma,idUsuario) {
    console.log("imprimirEtiquetas de scripts.js raiz");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {

    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            let contenidoImprimir = "";
            contenidoImprimir += "<html><head>";
            contenidoImprimir += "<meta charset='utf-8'>";
            contenidoImprimir += "<link rel='stylesheet' href='/css/flowbite.min.css' />";
            contenidoImprimir += "<script src='/js/tailwind.js'></script>";
            contenidoImprimir += "<script src='/js/tailwind-config.js'></script>";
            contenidoImprimir += "<script src='/js/flowbite.js'></script>";
            contenidoImprimir += "<link rel='stylesheet' href='/styles.css' type='text/css' />";
            contenidoImprimir += "<title></title>";
            contenidoImprimir += "</head><body>";
            if(res.lineas) {
                contenidoImprimir += "<div class='grid grid-cols-3 space-x-2'>";
                contenidoImprimir += "<div class='text-right'>";
                contenidoImprimir += "Cant.";
                contenidoImprimir += "</div>";
                contenidoImprimir += "<div class='text-left ml-1'>";
                contenidoImprimir += "Producto";
                contenidoImprimir += "</div>";
                contenidoImprimir += "<div class='text-right ml-1'>";
                contenidoImprimir += "P.V.P.";
                contenidoImprimir += "</div>";
                contenidoImprimir += "</div>";
                contenidoImprimir += "<hr />";
                for (var bucle = 0; bucle < res.id_documento_2.length; bucle++) {
                    let numeroCantidad = parseFloat(res.cantidad[bucle]);
                    contenidoImprimir += "<div class='grid grid-cols-3 space-x-2'>";
                    contenidoImprimir += "<div class='text-right'>";
                    contenidoImprimir += numeroCantidad;
                    contenidoImprimir += "</div>";
                    contenidoImprimir += "<div class='text-left ml-1'>";
                    contenidoImprimir += res.descripcion_producto[bucle];
                    contenidoImprimir += "</div>";
                    contenidoImprimir += "<div class='text-right ml-1'>";
                    contenidoImprimir += res.pvp[bucle] + " €";
                    contenidoImprimir += "</div>";
                    contenidoImprimir += "</div>";
                    if (res.referencia_producto[bucle] != "") {
                        contenidoImprimir += "<div class='grid grid-cols-1'>";
                        contenidoImprimir += "<div class='text-left'>";
                        contenidoImprimir += "Referencia: " + res.referencia_producto[bucle];
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "</div>";
                    }
                    if (res.lote[bucle] != "") {
                        contenidoImprimir += "<div class='grid grid-cols-1'>";
                        contenidoImprimir += "<div class='text-left'>";
                        contenidoImprimir += "Lote: " + res.lote[bucle];
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "</div>";
                    }
                    if (res.detalles_producto[bucle] != "") {
                        contenidoImprimir += "<div class='grid grid-cols-1'>";
                        contenidoImprimir += "<div class='text-left'>";
                        contenidoImprimir += res.detalles_producto[bucle];
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "</div>";
                    }
                    if (res.descripcion_oferta[bucle] != "") {
                        contenidoImprimir += "<div class='grid grid-cols-1'>";
                        contenidoImprimir += "<div class='text-left'>";
                        contenidoImprimir += res.descripcion_oferta[bucle];
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "</div>";
                    }
                    if (res.codigo_barras[bucle] != "") {
                        let codigo_barras = numeroCantidad + ' ' + res.codigo_barras[bucle];
                        contenidoImprimir += "<div class='grid grid-cols-1'>";
                        contenidoImprimir += "<div class='text-left'>";
                        contenidoImprimir += "Código de barras: " + codigo_barras;
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "</div>";

                        contenidoImprimir += "<div class='grid grid-cols-1'>";
                        contenidoImprimir += "<div class='text-left'>";
                        contenidoImprimir += "<img alt='testing' src='/barcode.php?codetype=Code39&size=40&text=" + codigo_barras + "&print=true'/>";
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "</div>";
                    }else {
                        contenidoImprimir += "<div class='grid grid-cols-1'>";
                        contenidoImprimir += "<div class='text-left'>";
                        contenidoImprimir += "ATENCIÓN: Sin código de barras";
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "</div>";
                    }
                    contenidoImprimir += "<br />";
                }
            }
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
    }
    xhr.open("post", "/web-gestion/documento_actualizar_etiquetas.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("id_usuario", idUsuario);
    formData.append("ejercicio", ejercicio);
    formData.append("id_documento_1", idDocumento1);
    xhr.send(formData);
}