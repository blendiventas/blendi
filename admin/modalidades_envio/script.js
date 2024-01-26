// Zonas


function guardarZona(id, idModalidadEnvio, idZona = null) {
    console.log("guardarZona de scripts.js de productos");
    if (!idZona) {
        let capa_id_zona = document.getElementById('id_zona_libradores');
        if (capa_id_zona) {
            idZona = capa_id_zona.value;
        } else {
            return;
        }
    }

    let incremento_pvp = '';
    let input_incremento_pvp = document.getElementById('incremento_pvp_' + id);
    if (input_incremento_pvp) {
        incremento_pvp = input_incremento_pvp.value;
    }

    let incremento_por_kilo = '';
    let input_incremento_por_kilo = document.getElementById('incremento_por_kilo_' + id);
    if (input_incremento_por_kilo) {
        incremento_por_kilo = input_incremento_por_kilo.value;
    }

    let volumen_maximo_bulto = '';
    let input_volumen_maximo_bulto = document.getElementById('volumen_maximo_bulto_' + id);
    if (input_volumen_maximo_bulto) {
        volumen_maximo_bulto = input_volumen_maximo_bulto.value;
    }

    let modalidades_envio_zonas_franja_incremento_pvp = [];
    let inputs_modalidades_envio_zonas_franja_incremento_pvp = document.getElementsByClassName('modalidades_envio_zonas_franja_incremento_pvp_' + id);
    if (inputs_modalidades_envio_zonas_franja_incremento_pvp) {
        for (let i = 0; i < inputs_modalidades_envio_zonas_franja_incremento_pvp.length; i++) {
            modalidades_envio_zonas_franja_incremento_pvp.push(inputs_modalidades_envio_zonas_franja_incremento_pvp[i].value);
        }
    }

    let modalidades_envio_zonas_franja_volumen_desde = [];
    let inputs_modalidades_envio_zonas_franja_volumen_desde = document.getElementsByClassName('modalidades_envio_zonas_franja_volumen_desde_' + id);
    if (inputs_modalidades_envio_zonas_franja_volumen_desde) {
        for (let i = 0; i < inputs_modalidades_envio_zonas_franja_volumen_desde.length; i++) {
            modalidades_envio_zonas_franja_volumen_desde.push(inputs_modalidades_envio_zonas_franja_volumen_desde[i].value);
        }
    }

    let modalidades_envio_zonas_franja_volumen_hasta = [];
    let inputs_modalidades_envio_zonas_franja_volumen_hasta = document.getElementsByClassName('modalidades_envio_zonas_franja_volumen_hasta_' + id);
    if (inputs_modalidades_envio_zonas_franja_volumen_hasta) {
        for (let i = 0; i < inputs_modalidades_envio_zonas_franja_volumen_hasta.length; i++) {
            modalidades_envio_zonas_franja_volumen_hasta.push(inputs_modalidades_envio_zonas_franja_volumen_hasta[i].value);
        }
    }

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

    xhr.open("post", "/admin/modalidades_envio/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardar-zona");
    formData.append("id", id);
    formData.append("id_modalidad_envio", idModalidadEnvio);
    formData.append("id_zona", idZona);
    formData.append("incremento_pvp", incremento_pvp);
    formData.append("incremento_por_kilo", incremento_por_kilo);
    formData.append("volumen_maximo_bulto", volumen_maximo_bulto);
    formData.append("franjas_incremento_pvp", modalidades_envio_zonas_franja_incremento_pvp);
    formData.append("franjas_volumen_desde", modalidades_envio_zonas_franja_volumen_desde);
    formData.append("franjas_volumen_hasta", modalidades_envio_zonas_franja_volumen_hasta);

    xhr.send(formData);
}
function eliminarModalidadEnvioZona(id, idModalidadEnvio) {
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

    xhr.open("post", "/admin/modalidades_envio/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "eliminar-zona");
    formData.append("id", id);
    formData.append("id_modalidad_envio", idModalidadEnvio);
    xhr.send(formData);
}

function anadirModalidadesEnvioZonasFranja(idModalidadEnvioZona, idModalidadEnvios) {
    let capaACopiar = document.getElementById('titulo_relacionado_nuevo_' + idModalidadEnvioZona);
    let capaDondePegarContenidoNuevo = document.getElementById('modalidades_envio_zonas_franja_nuevos_' + idModalidadEnvioZona);
    let nodoNuevaCapa = document.createElement('div');
    nodoNuevaCapa.classList.add('flex');
    nodoNuevaCapa.classList.add('flex-wrap');
    nodoNuevaCapa.classList.add('mt-3');
    nodoNuevaCapa.classList.add('items-center');
    nodoNuevaCapa.classList.add('space-x-3');
    nodoNuevaCapa.innerHTML = capaACopiar.innerHTML.replace(new RegExp(idModalidadEnvioZona + '_aSustituirPorElContador', 'g'), idModalidadEnvioZona + '_' + window.descripcionBuscadorContador);

    capaDondePegarContenidoNuevo.appendChild(nodoNuevaCapa);

    mostrarEliminarModalidadesEnvioZonasFranja(idModalidadEnvioZona);
}

function mostrarEliminarModalidadesEnvioZonasFranja(idModalidadEnvioZona) {
    let totalModalidadesEnvioFranjas = document.getElementsByClassName('modalidades_envio_zonas_franja_eliminar_' + idModalidadEnvioZona);

    if (totalModalidadesEnvioFranjas.length > 2) {
        for (let i = 0; i < totalModalidadesEnvioFranjas.length; i++) {
            if (totalModalidadesEnvioFranjas[i].classList.contains('hidden')) {
                totalModalidadesEnvioFranjas[i].classList.remove('hidden');
            }
        }
    }
    if (totalModalidadesEnvioFranjas.length === 2) {
        if (!totalModalidadesEnvioFranjas[0].classList.contains('hidden')) {
            totalModalidadesEnvioFranjas[0].classList.add('hidden');
        }
    }
}

function eliminarModalidadesEnvioZonasFranja(element, idModalidadEnvioZona) {
    let capaAEliminar = element.parentNode.parentNode;
    capaAEliminar.remove();

    mostrarEliminarModalidadesEnvioZonasFranja(idModalidadEnvioZona);
}
// Fin zonas