function componentToHex(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}
function rgbToHex(r, g, b) {
    return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
    // alert(rgbToHex(0, 51, 255)); // #0033ff
}
function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
    // alert(hexToRgb("#0033ff").g); // "51";
}

function guardarLinea(accion, elemento, indice) {
    console.log("guardarLinea: linea_"+elemento+"_"+indice);
    var guardar = true;
    /* AQUI CONTROLAMOS LOS CAMPOS OBLIGATORIOS */
    /*
    if(document.getElementById("descripcion_modelos1").value == "") {
        alert("Descripción modelo obligatoria.");
        document.getElementById("descripcion_modelos1").focus();
        guardar = false;
    }
    */
    if(guardar == true) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {

        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                console.log(res.logs);


                if (window.apartado) {
                    cambiarApartadoFicha(window.apartado);
                } else {
                    cambiarApartadoFicha('');
                }
            }
        }
        xhr.open("post", "/admin/impresion_documentos/gestion/datos-update.php", true);
        let form = document.querySelector("#form_datos_post");
        formData = new FormData(form);
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("select", accion);

        formData.append("color_borde_r_lineas_modelos",hexToRgb(document.getElementById("color_borde_lineas_modelos_" + elemento).value).r);
        formData.append("color_borde_g_lineas_modelos",hexToRgb(document.getElementById("color_borde_lineas_modelos_" + elemento).value).g);
        formData.append("color_borde_b_lineas_modelos",hexToRgb(document.getElementById("color_borde_lineas_modelos_" + elemento).value).b);

        formData.append("color_letra_r_lineas_modelos",hexToRgb(document.getElementById("color_letra_lineas_modelos_" + elemento).value).r);
        formData.append("color_letra_g_lineas_modelos",hexToRgb(document.getElementById("color_letra_lineas_modelos_" + elemento).value).g);
        formData.append("color_letra_b_lineas_modelos",hexToRgb(document.getElementById("color_letra_lineas_modelos_" + elemento).value).b);

        formData.append("elemento", elemento);
        xhr.send(formData);
    }
}

function SavePDF(imagen,ruta,elemento,idArchivo) {
    var messages = document.querySelector("#capa_boton_subir_imagen_" + idArchivo);
    let xhr = new XMLHttpRequest();
    let file = imagen.files[0];

    xhr.onreadystatechange = function (res) {
        messages.innerHTML = "Cargando imagen. <img src='../../images/loader.gif' class='w-20p' alt='Cargando' />";
    }
    xhr.onload = function () {
        let res = JSON.parse(this.responseText);
        messages.innerHTML = '';
        document.getElementById("capa_info_subir_pdf_" + idArchivo).innerHTML = res.info;
    }

    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("ruta", ruta);
    formData.append("file", file);
    formData.append("id_archivo", idArchivo);
    xhr.timeout = 5000;
    xhr.open("POST", "/admin/impresion_documentos/componentes/subir_pdf.php");
    xhr.send(formData);
}