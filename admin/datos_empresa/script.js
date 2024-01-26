function guardarFichaDatosEmpresa(accion) {
    console.log('Guardar ficha.');

    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            cambiarApartadoFicha(window.apartado);
        }
    }
    xhr.open("post", "/admin/" + window.ruta_sys + "/gestion/datos-update.php", true);
    let formData = document.querySelector("#form_datos_post");
    formData = new FormData(formData);
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", accion);
    xhr.send(formData);
}

function guardarConfiguracion(accion) {
    var capaInfo = document.querySelector("#capa_guardar_update");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        capaInfo.innerHTML = '<img src="../../images/loader.gif" class="w-20p" alt="Guardando datos" title="Guardando datos" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(res.logs);

            cambiarApartadoFicha(window.apartado);
        }
    }
    xhr.open("post", "/admin/datos_empresa/gestion/datos-update.php", true);
    let formData = document.querySelector("#form_datos_post");
    formData = new FormData(formData);
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", accion);
    xhr.send(formData);
}