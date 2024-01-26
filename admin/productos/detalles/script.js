function cambiarEstado(id) {
    var contenedor = document.querySelector("#capa_img_activo_"+id);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(res){
        contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Cambiando estado" title="Cambiando estado" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(res.logs);
            if(res.valor == 1) {
                contenedor.innerHTML = '<img src="/images/valid-20.png" id="img-activo-'+id+'" class="w-20p" alt="Activo" title="Activo" onmouseover="this.style.cursor=\'pointer\'" onclick="cambiarEstado(\''+id+'\');" />';
            }else {
                contenedor.innerHTML = '<img src="/images/invalid-20.png" id="img-activo-'+id+'" class="w-20p" alt="Inactivo" title="Inactivo" onmouseover="this.style.cursor=\'pointer\'" onclick="cambiarEstado(\''+id+'\');" />';
            }
        }
    }
    xhr.open("post", "/admin/productos/detalles/gestion/datos-datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id_productos_detalles", id);
    formData.append("select", "estado");
    xhr.send(formData);
}
function cambiarEstadoDatos(id) {
    var contenedor = document.querySelector("#capa_img_activo_"+id);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(res){
        contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Cambiando estado" title="Cambiando estado" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(res.logs);
            if(res.valor == 1) {
                contenedor.innerHTML = '<img src="/images/valid-20.png" id="img-activo-'+id+'" class="w-20p" alt="Activo" title="Activo" onmouseover="this.style.cursor=\'pointer\'" onclick="cambiarEstado(\''+id+'\');" />';
            }else {
                contenedor.innerHTML = '<img src="/images/invalid-20.png" id="img-activo-'+id+'" class="w-20p" alt="Inactivo" title="Inactivo" onmouseover="this.style.cursor=\'pointer\'" onclick="cambiarEstado(\''+id+'\');" />';
            }
        }
    }
    xhr.open("post", "/admin/productos/detalles/gestion/datos-datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id_productos_detalles", id);
    formData.append("select", "estado_datos");
    xhr.send(formData);
}

function guardarFicha(accion) {
    var guardar = true;
    if(accion == "eliminar") {
        if (!confirm('Confirmar para eliminar el registro.')) {
            guardar = false;
        }
    }else if(accion == "eliminar-imagen") {
        if (!confirm('Confirmar para eliminar la imagen.')) {
            guardar = false;
        }
    }else {
        /* AQUI CONTROLAMOS LOS CAMPOS OBLIGATORIOS */
        if(document.getElementById("detalle_productos_detalles").value == "") {
            document.getElementById("detalle_productos_detalles").focus();
            guardar = false;
        }
    }
    if(guardar == true) {
        var contenedor = document.querySelector("#capa_guardar_update");

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Guardando datos" title="Guardando datos" />';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                console.log(res.logs);
                console.log(res);

                var link_productos_sys = "";
                if(res.id_productos != "null") {
                    link_productos_sys = "/id_productos="+res.id_productos;
                }
                if(res.resultado == "DELETE") {
                    window.location.href = "/admin/gestion-productos-detalles"+"/apartado="+res.apartado+link_productos_sys;
                }else if(res.resultado == "INSERT") {
                    window.location.href = "/admin/gestion-productos-detalles/id_productos_detalles="+res.id+"/apartado="+res.apartado+link_productos_sys;
                }else if(res.resultado == "UPDATE") {
                    window.location.href = "/admin/gestion-productos-detalles/id_productos_detalles="+res.id+"/apartado="+res.apartado+link_productos_sys;
                }else if(res.resultado == "INSERT ERROR descripcion") {
                    alert("Detalle propiedad obligatoria.");
                    document.getElementById("detalle_productos_detalles").focus();
                }

            }
        }
        xhr.open("post", "/admin/productos/detalles/gestion/datos-update.php", true);
        let form = document.querySelector("#form_datos_post");
        formData = new FormData(form);
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("select", accion);
        xhr.send(formData);
    }
}

function guardarPropiedad(accion, idProductos, idProductosDetalles, idProductosDetallesDatos) {
    var guardar = true;
    if(accion == "eliminar") {
        if (!confirm('Confirmar para eliminar el registro.')) {
            guardar = false;
        }
    }else {
        /* AQUI CONTROLAMOS LOS CAMPOS OBLIGATORIOS */
        if(document.getElementById("detalle_productos_detalles_datos_"+idProductosDetallesDatos).value == "") {
            alert("Detalle propiedad obligatoria.");
            document.getElementById("detalle_productos_detalles_datos_"+idProductosDetallesDatos).focus();
            guardar = false;
        }
    }
    if(guardar == true) {
        var contenedor = document.querySelector("#capa_guardar_update_productos_detalles_datos_"+idProductosDetallesDatos);

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            contenedor.innerHTML = '<img src="/images/loader.gif" class="w-20p" alt="Guardando datos" title="Guardando datos" />';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                console.log(res.logs);

                var link_productos_sys = "";
                if(idProductos != "null") {
                    link_productos_sys = "/id_productos="+idProductos;
                }
                if(res.resultado == "DELETE") {
                    window.location.href = "/admin/gestion-productos-detalles"+"/apartado="+res.apartado+link_productos_sys+"/ancla=linea_"+idProductosDetallesDatos;
                }else if(res.resultado == "INSERT") {
                    window.location.href = "/admin/gestion-productos-detalles/id_productos_detalles="+idProductosDetalles+"/apartado="+res.apartado+link_productos_sys+"/ancla=linea_"+idProductosDetallesDatos;
                }else if(res.resultado == "UPDATE") {
                    window.location.href = "/admin/gestion-productos-detalles/id_productos_detalles="+idProductosDetalles+"/apartado="+res.apartado+link_productos_sys+"/ancla=linea_"+idProductosDetallesDatos;
                }else if(res.resultado == "INSERT ERROR descripcion") {
                    alert("Detalle propiedad obligatoria.");
                    document.getElementById("detalle_productos_detalles_datos_"+id).focus();
                }

            }
        }
        xhr.open("post", "/admin/productos/detalles/gestion/datos-datos-update.php", true);
        formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("select", accion);
        formData.append("id_productos", idProductos);
        formData.append("id_productos_detalles", idProductosDetalles);
        formData.append("id_idioma_productos_detalles_datos", idProductosDetallesDatos);
        formData.append("detalle_productos_detalles_datos", document.getElementById("detalle_productos_detalles_datos_"+idProductosDetallesDatos).value);
        formData.append("orden_productos_detalles_datos", document.getElementById("orden_productos_detalles_datos_"+idProductosDetallesDatos).value);
        if (document.getElementById('activo_productos_detalles_datos_'+idProductosDetallesDatos)) {
            formData.append("activo_productos_detalles_datos", "1");
        }else if (document.getElementById('inactivo_productos_detalles_datos_'+idProductosDetallesDatos)) {
            formData.append("activo_productos_detalles_datos", "0");
        }else {
            if (document.getElementById('activo_productos_detalles_datos_0').checked) {
                formData.append("activo_productos_detalles_datos", "1");
            } else {
                formData.append("activo_productos_detalles_datos", "0");
            }
        }
        xhr.send(formData);
    }
}