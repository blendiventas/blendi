function cambiarEstado(id) {
    var contenedor = document.querySelector("#capa_img_activo_"+id);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(res){
        contenedor.innerHTML = '<img src="../../images/loader.gif" class="w-20p" alt="Cambiando estado" title="Cambiando estado" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(res.logs);
            if(res.valor == 1) {
                contenedor.innerHTML = '<img src="../../images/valid-20.png" id="img-activo-'+id+'" class="w-20p" alt="Activo" title="Activo" onmouseover="this.style.cursor=\'pointer\'" onclick="cambiarEstado(\''+id+'\');" />';
            }else {
                contenedor.innerHTML = '<img src="../../images/invalid-20.png" id="img-activo-'+id+'" class="w-20p" alt="Inactivo" title="Inactivo" onmouseover="this.style.cursor=\'pointer\'" onclick="cambiarEstado(\''+id+'\');" />';
            }
        }
    }
    xhr.open("post", "/admin/idiomas/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id", id);
    formData.append("select", "estado");
    xhr.send(formData);
}

function guardarFicha(accion) {
    var guardar = true;
    if(accion == "eliminar") {
        if (!confirm('Confirmar para eliminar el registro.\nSe eliminarán todos los registros y parámetros de este idioma.')) {
            guardar = false;
        }
    }else {
        /* AQUI CONTROLAMOS LOS CAMPOS OBLIGATORIOS */
        if(document.getElementById("idioma_idiomas").value == "") {
            alert("Descripción idioma obligatoria.");
            document.getElementById("idioma_idiomas").focus();
            guardar = false;
        }
        if (document.getElementById('inactivo_idiomas').checked && document.getElementById('principal_si_idiomas').checked) {
            alert("El idioma principal debe estar activo.");
            /*
            radiobtn = document.getElementById("activo");
            radiobtn.checked = true;
            */
            guardar = false;
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
                    window.location.href = "/admin/gestion-idiomas";
                }else if(res.resultado == "INSERT") {
                    window.location.href = "/admin/gestion-idiomas/id_idiomas="+res.id;
                }else if(res.resultado == "UPDATE") {
                    window.location.href = "/admin/gestion-idiomas/id_idiomas="+res.id+"/apartado="+res.apartado;
                }else if(res.resultado == "INSERT ERROR descripcion") {
                    alert("Descripción idioma obligatoria.");
                    document.getElementById("idioma_idiomas").focus();
                }
            }
        }
        xhr.open("post", "/admin/idiomas/gestion/datos-update.php", true);
        let form = document.querySelector("#form_datos_post");
        formData = new FormData(form);
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("select", accion);
        formData.append("id", document.getElementById("id_idiomas").value);
        xhr.send(formData);
    }
}