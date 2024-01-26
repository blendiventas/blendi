function guardarDescripcion(id_comedores) {
    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            window.location.href = "/admin/gestion-comedores/" + res.id_comedores;
        }
    }

    xhr.open("post", "/admin/mesas/comedores/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id_comedores", id_comedores);
    formData.append("descripcion", document.getElementById('descripcion_comedores_input_text_' + id_comedores).value);
    formData.append("select", "guardar-descripcion");
    xhr.send(formData);
}

function guardarPrincipal(id_comedores,principal_comedores) {
    if(principal_comedores == 0) {
        let xhr = new XMLHttpRequest();

        xhr.onload = function () {
            if (xhr.status == 200) {
                window.location.href = "/admin/gestion-comedores/"+id_comedores;
            }
        }

        xhr.open("post", "/admin/mesas/comedores/gestion/datos-update.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("id_comedores", id_comedores);
        formData.append("principal_comedores", principal_comedores);
        formData.append("select", "guardar-principal");
        xhr.send(formData);
    }
}

function guardarActivo(id_comedores,activo_comedores) {
    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            document.getElementById('activo_comedores_lista_' + id_comedores).value = res.activo_comedores;
            document.getElementById('fecha_modificacion_comedores_lista_' + id_comedores).value = res.fecha_modificacion;
        }
    }

    xhr.open("post", "/admin/mesas/comedores/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id_comedores", id_comedores);
    formData.append("activo_comedores", activo_comedores);
    formData.append("select", "guardar-activo");
    xhr.send(formData);
}
