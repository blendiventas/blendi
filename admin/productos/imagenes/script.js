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
        if(document.getElementById("apartado").value == "null") {
            if(document.getElementById("descripcion_productos").value == "") {
                alert("Descripción producto obligatoria.");
                document.getElementById("descripcion_productos").focus();
                guardar = false;
            }
        }
    }
    if(guardar == true) {
        var contenedor = document.querySelector("#capa_guardar_update");

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            contenedor.innerHTML = '<img src="../../images/loader.gif" class="w-20p" alt="Guardando datos" title="Guardando datos" />';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                console.log(res.logs);

                if(res.resultado == "DELETE") {
                    window.location.href = "/admin/gestion-productos/id_productos="+res.id+"/apartado="+res.apartado;
                }else if(res.resultado == "INSERT") {
                    window.location.href = "/admin/gestion-productos-imagenes/id_productos="+res.id+"/id_images="+res.id_images+"/att_enl="+res.att_enl+"/att_mult="+res.att_mult+"/id_pack="+res.pack+"/id_ancla="+res.ancla+"/apartado="+res.apartado;
                }else if(res.resultado == "UPDATE") {
                    window.location.href = "/admin/gestion-productos-imagenes/id_productos="+res.id+"/id_images="+res.id_images+"/att_enl="+res.att_enl+"/att_mult="+res.att_mult+"/id_pack="+res.pack+"/id_ancla="+res.ancla+"/apartado="+res.apartado;
                }else if(res.resultado == "INSERT ERROR descripcion") {
                    alert("Descripción producto obligatoria.");
                    document.getElementById("descripcion").focus();
                }
            }
        }
        xhr.open("post", "/admin/productos/imagenes/gestion/datos-update.php", true);
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