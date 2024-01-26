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

function guardarCostesImportes(idLibradoresProductos, idLibrador, idProducto, capa, elemento) {
    console.log("guardarCostesImportes de scripts.js de libradores");
    if(capa == 'guardar_coste_importe_encontrados_') {
        var contenedor = document.getElementById("guardar_coste_importe_encontrados_" + elemento);
    }else {
        var contenedor = document.getElementById("guardar_coste_importe_" + elemento);
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
    console.log(capa + elemento);
    console.log("Value: " + document.getElementById(capa + elemento).value);
    xhr.open("post", "/admin/libradores/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardar");
    formData.append("apartado", "costes-importes");
    formData.append("id_libradores_productos", idLibradoresProductos);
    formData.append("id_librador", idLibrador);
    formData.append("id_producto", idProducto);
    formData.append("coste_importe", document.getElementById(capa + elemento).value);
    xhr.send(formData);
}

function eliminarCostesImportes(idLibradoresProductos, elemento) {
    console.log("eliminarCostesImportes de scripts.js de libradores");
    var guardar = true;

    if (!confirm('Confirmar para eliminar el registro.')) {
        guardar = false;
    }

    if(guardar == true) {
        var contenedor = document.getElementById("eliminar_coste_importe_" + elemento);

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

                xhr2.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha + "/apartado=" + document.getElementById("apartado").value, true);
                xhr2.send();
            }
        }

        xhr.open("post", "/admin/libradores/gestion/datos-update.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("select", "guardar");
        formData.append("apartado", "eliminar-costes-importes");
        formData.append("id_libradores_productos", idLibradoresProductos);
        xhr.send(formData);
    }
}