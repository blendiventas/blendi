function cargarProductosCategorias(descripcionURL) {
    console.log("cargarProductosCategorias de scripts_tpv.js raiz");
    var contenedor = document.querySelector("#main");
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Actualizando datos" title="Actualizando datos" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            /* let res = JSON.parse(this.responseText); */
            document.getElementById("main").innerHTML = this.response;
        }
    }

    xhr.open("post", "carga_ajax.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("carga_ajax", "productos-categorias");
    formData.append("descripcionURL", descripcionURL);
    xhr.send(formData);
}