String.prototype.stripSlashes = function(){
    return this.replace(/\\(.)/mg, "$1");
}

window.mobileCheck = function() {
    if(/Android|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        // true for mobile device
        return true;
    }else{
        // false for not mobile device
        return false;
    }
};

window.iOSCheck = function() {
    return [
            'iPad Simulator',
            'iPhone Simulator',
            'iPod Simulator',
            'iPad',
            'iPhone',
            'iPod'
        ].includes(navigator.platform)
        // iPad on iOS 13 detection
        || (navigator.userAgent.includes("Mac") && "ontouchend" in document);
};

window.showPasswordLogin = [false, false];
window.inputsClave = ['clave', 'clave_registro'];
function toogleShowPasswordLogin(indexClave = 0) {
    window.showPasswordLogin[indexClave] = !window.showPasswordLogin[indexClave];

    let capaShowPasswordLogin = document.getElementById('showPasswordLogin-' + window.inputsClave[indexClave]);
    let inputClave = document.getElementById(window.inputsClave[indexClave]);
    const actualInput = inputClave.type;
    if (actualInput === 'password'){
        inputClave.type = 'text';
        capaShowPasswordLogin.innerText = 'Ocultar';
    } else if (actualInput === 'text'){
        inputClave.type = 'password';
        capaShowPasswordLogin.innerText = 'Mostrar';
    }
}

function gestionDeCapasGenerales() {
    let currentZone = null;
    let currentZoneLink = null;
    for (let i = 0; i < zonasDisplay.length; i++) {
        currentZone = document.getElementById('capa_' + zonasDisplay[i]);
        currentZoneLink = document.querySelector('.link_' + zonasDisplay[i]);
        if (zonaDisplay != zonasDisplay[i]) {
            if (currentZoneLink) {
                if (currentZoneLink.classList.contains('border-y-2')) {
                    currentZoneLink.classList.remove('border-y-2')
                }
                if (currentZoneLink.classList.contains('border-b-blendi-700')) {
                    currentZoneLink.classList.remove('border-b-blendi-700')
                }
                if (currentZoneLink.classList.contains('border-t-white')) {
                    currentZoneLink.classList.remove('border-t-white')
                }
            }
        }
    }
    for (let i = 0; i < zonasDisplay.length; i++) {
        currentZone = document.getElementById('capa_' + zonasDisplay[i]);
        currentZoneLink = document.querySelector('.link_' + zonasDisplay[i]);
        if (zonaDisplay == zonasDisplay[i]) {
            currentZone.style.display = 'block';

            if (currentZoneLink) {
                if (!currentZoneLink.classList.contains('border-y-2')) {
                    currentZoneLink.classList.add('border-y-2')
                }
                if (!currentZoneLink.classList.contains('border-b-blendi-700')) {
                    currentZoneLink.classList.add('border-b-blendi-700')
                }
                if (!currentZoneLink.classList.contains('border-t-white')) {
                    currentZoneLink.classList.add('border-t-white')
                }
            }

            if (zonaDisplay == 'comedor') {
                setCapaComedorHeight();
            }
        } else {
            if (currentZone) {
                currentZone.style.display = 'none';
            }
        }
    }
}

function FullScreenMode(url){
    var win = window.open("","","channelmode=1,fullscreen=1");
    /* var win = window.open("", "full", "dependent=yes, fullscreen=yes"); */
    win.location = url;
    win.moveTo(0,0);
    win.resizeTo(screen.width, screen.height);
    window.opener = null;
}

function shopShowHide(capa) {
    console.log("shopShowHide de scripts.js raiz");
    if(document.getElementById(capa).style.display == "none") {
        document.getElementById(capa).style.display = "block";
    }else {
        document.getElementById(capa).style.display = "none";
    }
}

var timerScroll = null;
function stopScroll() {
    clearInterval(timerScroll);
}
function startScroll(capa,sentido) {
    timerScroll = setInterval(function() {
        if (sentido == "-") {
            document.getElementById(capa).scrollLeft -= 10;
        } else {
            document.getElementById(capa).scrollLeft += 10;
        }
    }, 10);
}

function collapseCapa(capa) {
    console.log("collapseCapa de scripts.js raiz: "+capa);
    if(document.getElementById(capa).style.display === "block" || document.getElementById(capa).style.display === "inline-grid") {
        document.getElementById(capa).style.display = "none";
    }else {
        document.getElementById(capa).style.display = "block";
    }
}
function collapseMenu(capa) {
    let capaToToogleVisibility = document.getElementById(capa);
    let capaToToogleVisibilityArrowHidden = document.getElementById(capa + '-hidden');
    let capaToToogleVisibilityArrowShow = document.getElementById(capa + '-show');
    if(capaToToogleVisibility.classList.contains('hidden')) {
        capaToToogleVisibility.classList.remove('hidden');
    }else {
        capaToToogleVisibility.classList.add('hidden');
    }
    if (capaToToogleVisibilityArrowHidden && capaToToogleVisibilityArrowShow) {
        collapseMenu(capa + '-hidden');
        collapseMenu(capa + '-show');
    }
}

function toggleDarkMode() {
    let darkMode = document.getElementById('toggle_dark_mode').checked;

    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            location.reload();
        }
    }

    xhr.open("post", "/admin/usuarios/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("id_sesion_js", id_sesion_js);
    formData.append("id_panel", id_panel);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("interface_js", interface_js);
    formData.append("select", "guardar-dark-mode");
    formData.append("dark_mode", darkMode);
    xhr.send(formData);
}

function cargarCabeceraCesta() {
    console.log("cargarCabeceraCesta de scripts.js raiz");

    if (idLibrador && idLibrador > 0) {
        document.getElementById("id_librador_seleccionar").value = idLibrador;
        document.getElementById("id_librador_cesta").value = idLibrador;
    }

    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            let showModalFac = false;
            if (typeof modalFac !== 'undefined' && !modalFac._isHidden) {
                modalFac.hide();
                showModalFac = true;
            }

            let capaCabeceraCesta = document.getElementById('capa_cabecera_cesta_1');
            capaCabeceraCesta.innerHTML = this.responseText;

            nodeScriptReplace(capaCabeceraCesta);

            if (showModalFac) {
                modalFac.show();

                let inputNumeroDocumento = document.getElementById('numero_documento');
                if (inputNumeroDocumento && (tipoLibrador == 'cre' || tipoLibrador == 'pro') && inputNumeroDocumento.value == '') {
                    inputNumeroDocumento.focus();
                }
            }
        }
    }

    xhr.open("post", host_url, true);
    let formData = new FormData();
    formData.append("ajax", 1);
    formData.append("ajax_cabecera_cesta", 1);
    xhr.send(formData);
}

function cargarComedor() {
    console.log("cargarComedor de scripts.js raiz");
    let xhr = new XMLHttpRequest();

    setHeights();

    xhr.onload = function () {
        if (xhr.status == 200) {
            let capaComedor = document.getElementById('capa_comedor');
            if (capaComedor) {
                capaComedor.innerHTML = this.responseText;

                nodeScriptReplace(capaComedor);
            }

            if (existenMesas) {
                zonaDisplay = 'comedor';
            } else {
                zonaDisplay = 'productos';
            }
            cargarCabeceraCesta();
            gestionDeCapasGenerales();
        }
    }

    xhr.open("post", host_url, true);
    let formData = new FormData();
    formData.append("ajax", 1);
    formData.append("ajax_mesas", 1);
    xhr.send(formData);
}

function cargarCategoria(descripcionUrl) {
    console.log("cargarCategoria de scripts.js raiz");
    let xhr = new XMLHttpRequest();

    setHeights();

    xhr.onload = function () {
        if (xhr.status == 200) {
            let capaGeneralProductos = document.getElementById('capa_general_productos');
            capaGeneralProductos.innerHTML = this.responseText;

            nodeScriptReplace(capaGeneralProductos);
        }
    }

    if (descripcionUrl === '-inicio') {
        xhr.open("post", host_url.substring(0, host_url.length - 1) + descripcionUrl, true);
    } else {
        xhr.open("post", host_url + descripcionUrl, true);
    }
    let formData = new FormData();
    formData.append("ajax", 1);
    xhr.send(formData);

    let xhr2 = new XMLHttpRequest();

    xhr2.onload = function () {
        if (xhr2.status == 200) {
            let capaGeneralCategorias = document.getElementById('capa_general_categorias');
            capaGeneralCategorias.innerHTML = this.responseText;

            nodeScriptReplace(capaGeneralCategorias);

            let capaCategoriasSuperior = document.getElementById('capa_categorias_superior');
            if (capaCategoriasSuperior) {
                let categorySelected = capaCategoriasSuperior.querySelector('.border-b-blendi-700');

                if (categorySelected) {
                    categorySelected.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                }
            }
        }
    }

    if (descripcionUrl === '-inicio') {
        xhr2.open("post", host_url.substring(0, host_url.length - 1) + descripcionUrl, true);
    } else {
        xhr2.open("post", host_url + descripcionUrl, true);
    }
    let formData2 = new FormData();
    formData2.append("ajax", 1);
    formData2.append("cargar_categorias", 1);
    xhr2.send(formData2);
}

function cargarProducto(descripcionUrl) {
    console.log("cargarCategoria de scripts.js raiz");
    let xhr = new XMLHttpRequest();

    window.compraHabilitada = false;
    xhr.onload = function () {
        if (xhr.status == 200) {
            let capaGeneralProductos = document.getElementById('capa_general_productos');
            capaGeneralProductos.innerHTML = this.responseText;

            nodeScriptReplace(capaGeneralProductos);
            window.compraHabilitada = true;
        }
    }

    xhr.open("post", host_url + descripcionUrl, true);
    let formData = new FormData();
    formData.append("ajax", 1);
    xhr.send(formData);
}

function genericSocialShare(url) {
    console.log("genericSocialShare de scripts.js raiz");
    window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
    return true;
}
function insertRedes(idCliente,idEmpresa,idFamilia,idProducto,red) {
    console.log("insertRedes de scripts.js raiz");
    /*
    var request_load = {};
    request_load.id_cliente = idCliente;
    request_load.id_empresa = idEmpresa;
    request_load.id_familia = idFamilia;
    request_load.id_producto = idProducto;
    request_load.red = red;

    $.ajax({
        type: 'POST',
        url: urlCompraE + 'insert_redes.php',
        data: JSON.stringify(request_load)
    })
    */
}
function takIni() {
    document.getElementById('tipo_librador').value = 'tak';
    document.getElementById('id_librador_seleccionar').value = idLibradorTak;
    document.getElementById("numero_comensales_guardar").value = "0";
    document.getElementById('comensales-guardar').value = "0";
    /* document.getElementById('comensales').value = "0"; */
    document.getElementById('tipo_librador').value = 'tak';
    document.getElementById('boton-mesas').style.display = 'inline-grid';
    document.getElementById('main').style.display = "block";
    datosFacturacionCesta(document.getElementById("id_librador_seleccionar").value, 'cabecera');
}
function delIni(origen) {
    document.getElementById("numero_comensales_guardar").value = "0";
    document.getElementById('comensales-guardar').value = "0";
    document.getElementById('tipo_librador').value = 'del';
    document.getElementById('boton-mesas').style.display = 'inline-grid';
    document.getElementById('main').style.display = "block";

    if(document.getElementById('id_librador_cesta')) {

    }
    if(document.getElementById('id_librador_cesta_cli')) {

    }
    if(document.getElementById('id_librador_seleccionar')) {

    }
    if(document.getElementById('id_librador_seleccionar_cli')) {
        document.getElementById('id_librador_cesta_cli').value = document.getElementById('id_librador_cesta').value;
    }

    identificar(origen);
}
function identificar(iniciar) {
    console.log("identificar de scripts.js raiz");
    var guardar = true;
    if(iniciar == '2') {
        if (document.getElementById("nombre_registro").value == "") {
            guardar = false;
            alert("Indique un nombre.");
            document.getElementById("nombre_registro").focus();
        }else if (!document.getElementById("crear_cuenta_tipo_persona").checked && !document.getElementById("crear_cuenta_tipo_empresa").checked) {
            guardar = false;
            alert("Debe marcar si es una cuenta personal o de empresa.");
        }else if (document.getElementById("email_crear").value == "") {
            guardar = false;
            alert("Indique una cuenta de mail.");
            document.getElementById("email_crear").focus();
        }else if (document.getElementById("password_crear").value == "") {
            guardar = false;
            alert("Indique una contraseña.");
            document.getElementById("password_crear").focus();
        }else if (document.getElementById("repetir_password_crear").value == "") {
            guardar = false;
            alert("Repita la contraseña para verificar que es correcta.");
            document.getElementById("repetir_password_crear").focus();
        }else if (document.getElementById("password_crear").value != document.getElementById("repetir_password_crear").value) {
            guardar = false;
            alert("La contraseña introducida no es correcta.");
            document.getElementById("password_crear").value = "";
            document.getElementById("repetir_password_crear").value = "";
            document.getElementById("password_crear").focus();
        }
    }
    if(iniciar == '1') {
        if (document.getElementById("email_iniciar").value == "") {
            guardar = false;
            alert("Indique una cuenta de mail.");
            document.getElementById("email_iniciar").focus();
        }else if (document.getElementById("password_iniciar").value == "") {
            guardar = false;
            alert("Indique su contraseña.");
            document.getElementById("password_iniciar").focus();
        }
    }

    if(iniciar == '4') {
        if (document.getElementById("nombre_documento").value == '' && document.getElementById("apellido_1_documento").value == '' && document.getElementById("apellido_2_documento").value == '' && document.getElementById("razon_social_documento").value == '' && document.getElementById("razon_comercial_documento").value == '') {
            guardar = false;
            alert("Indique un nombre o razón social");
            document.getElementById("nombre_documento").focus();
        }
    }
    if (iniciar == 'del') {
        if(document.getElementById("nombre_documento_buscar") && document.getElementById("nombre_documento_buscar").value == '' && document.getElementById("nombre_documento") && document.getElementById("nombre_documento").value == '') {
            guardar = false;
            alert("Indique un nombre o razón social");
            document.getElementById("nombre_documento_buscar").focus();
        }
    }

    if(guardar == true) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {

        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                if(res.logs == "abrir-sesion") {
                    sessionStorage.setItem('id_librador', res.log_id_librador);
                    idLibrador = res.log_id_librador;
                    document.getElementById("id_librador_seleccionar").value = res.log_id_librador;
                    document.getElementById("id_librador_cesta").value = res.log_id_librador;

                    sessionStorage.setItem('tipo_librador', res.log_tipo_librador);
                    tipoLibrador = res.log_tipo_librador;
                    document.getElementById("tipo_librador").value = res.log_tipo_librador;
                }

                if(res.logs == "cerrar-sesion") {
                    sessionStorage.setItem('id_librador', '0');
                    idLibrador = 0;
                    document.getElementById("id_librador_seleccionar").value = 0;
                    document.getElementById("id_librador_cesta").value = 0;
                }

                sessionStorage.setItem('id_librador', document.getElementById("id_librador_seleccionar").value);
                idLibrador = document.getElementById("id_librador_seleccionar").value;
                if(res.id_documento_1) {
                    sessionStorage.setItem('id_documento', res.id_documento_1);
                    idDocumento = res.id_documento_1;
                }

                if(res.logs == "error") {
                    alert("No se puede utilizar la cuenta de mail introducida.");
                }else {
                    if(iniciar == '6' || iniciar == '7' || iniciar == '70') {
                        cobrarModal();
                    } else if(iniciar == '8') {
                        identificar('11');
                    } else if(iniciar == '11') {
                        window.location.href = host_url;
                    }else {
                        /* window.location.href = urlCompleta + "cargar_"+idDocumento; */
                        // window.location.href = urlCompleta;
                        let capaComensalesLoading = document.getElementById('capa-comensales-loading');
                        let botonOpenModalComensalesLoading = document.getElementById('botonOpenModalComensalesLoading');
                        if (capaComensalesLoading && botonOpenModalComensalesLoading && !capaComensalesLoading.classList.contains('hidden')) {
                            botonOpenModalComensalesLoading.click();
                        }

                        let capaComensales = document.getElementById('capa-comensales');
                        let botonOpenModalComensales = document.getElementById('botonOpenModalComensales');
                        if (capaComensales && botonOpenModalComensales && !capaComensales.classList.contains('hidden')) {
                            botonOpenModalComensales.click();
                        }

                        let capaEntregaDomicilioModal = document.getElementById('capa-entrega-domicilio-modal');
                        let botonOpenModalEntregaDomicilio = document.getElementById('botonOpenModalEntregaDomicilio');
                        if (capaEntregaDomicilioModal && botonOpenModalEntregaDomicilio && !capaEntregaDomicilioModal.classList.contains('hidden')) {
                            botonOpenModalEntregaDomicilio.click();
                        }

                        let capaModalTak = document.getElementById('modal-tak');
                        if (capaModalTak && modalTak && !capaModalTak.classList.contains('hidden')) {
                            modalTak.hide();
                        }

                        let capaModalDel = document.getElementById('modal-del');
                        if (capaModalDel && modalDel && !capaModalDel.classList.contains('hidden')) {
                            modalDel.hide();
                        }

                        let capaModalFac = document.getElementById('modal-facturacion');
                        if (capaModalFac && modalFac && !capaModalFac.classList.contains('hidden')) {
                            let inputNumeroDocumento = document.getElementById('numero_documento');
                            if (inputNumeroDocumento && (tipoLibrador == 'cre' || tipoLibrador == 'pro') && inputNumeroDocumento.value == '') {
                                inputNumeroDocumento.focus();
                            } else {
                                modalFac.hide();
                            }
                        }

                        zonaDisplay = 'productos';
                        gestionDeCapasGenerales();
                        cargarCabeceraCesta();
                        actualizarCesta();
                        let familiaActual = document.querySelector('.categoria_menu.border-b-blendi-700');
                        if (familiaActual) {
                            familiaActual.click();
                        } else {
                            setHeights();
                        }
                    }
                }
            }
        }

        xhr.open("post", "/web-gestion/datos-pre-librador.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("id_sesion_js", id_sesion_js);
        formData.append("ip", ip);
        formData.append("so", so);
        formData.append("idioma", idioma);
        formData.append("interface_js", interface_js);
        if(interface_js == "web") {
            formData.append("id_panel", id_panel);
        }
        formData.append("id_documento", idDocumento);
        formData.append("ejercicio", ejercicio);

        if (document.getElementById("serie_documento")) {
            formData.append("serie_documento", document.getElementById("serie_documento").value);
        } else {
            formData.append("serie_documento", '');
        }

        if (iniciar == '0') {
            formData.append("select", "identificar");
            formData.append("email_registro", "");
            formData.append("password_registro", "");
        } else if (iniciar == '1') {
            formData.append("select", "identificar");
            formData.append("email_registro", document.getElementById("email_iniciar").value);
            formData.append("password_registro", document.getElementById("password_iniciar").value);
            formData.append("tipo_librador", "tak");
            formData.append("tipo_documento_seleccionar", "ped");
        } else if (iniciar == '2') {
            formData.append("select", "crear");
            formData.append("nombre_registro", document.getElementById("nombre_registro").value);
            if (document.getElementById("crear_cuenta_tipo_persona").checked) {
                formData.append("tipo_cuenta_registro", "persona");
            } else {
                formData.append("tipo_cuenta_registro", "empresa");
            }
            formData.append("email_registro", document.getElementById("email_crear").value);
            formData.append("password_registro", document.getElementById("password_crear").value);
            formData.append("tipo_librador", "tak");
            formData.append("tipo_documento_seleccionar", "ped");
        } else if (iniciar == '3') {
            formData.append("select", "seleccionar-librador");
            formData.append("tipo_librador", document.getElementById("tipo_librador").value);
            formData.append("id_librador", document.getElementById("id_librador_seleccionar").value);
            formData.append("id_documento", idDocumento);
            formData.append("tipo_documento_seleccionar", document.getElementById("tipo_documento").value);
            if(document.getElementById("comensales-guardar")) {
                formData.append("comensales", document.getElementById("comensales-guardar").value);
            }
        } else if (iniciar == '4') {
            if(document.getElementById("id_librador_cesta_cli")) {
                if (document.getElementById("id_librador_cesta_cli").value == -1) {
                    formData.append("tipo_librador", "cli");
                    formData.append("id_librador", document.getElementById("id_librador_cesta_cli").value);
                }else {
                    formData.append("tipo_librador", document.getElementById("tipo_librador").value);
                    formData.append("id_librador", document.getElementById("id_librador_cesta").value);
                }
            }else {
                formData.append("tipo_librador", document.getElementById("tipo_librador").value);
                formData.append("id_librador", document.getElementById("id_librador_cesta").value);
            }
            formData.append("select", "guardar-seleccionar-librador");
            formData.append("tipo_documento_seleccionar", document.getElementById("tipo_documento").value);
            formData.append("nombre_documento", document.getElementById("nombre_documento").value);
            formData.append("apellido_1_documento", document.getElementById("apellido_1_documento").value);
            formData.append("apellido_2_documento", document.getElementById("apellido_2_documento").value);
            formData.append("razon_social_documento", document.getElementById("razon_social_documento").value);
            formData.append("razon_comercial_documento", document.getElementById("razon_comercial_documento").value);
            formData.append("nif_documento", document.getElementById("nif_documento").value);
            formData.append("direccion_documento", document.getElementById("direccion_documento").value);
            formData.append("numero_direccion_documento", document.getElementById("numero_direccion_documento").value);
            formData.append("escalera_direccion_documento", document.getElementById("escalera_direccion_documento").value);
            formData.append("piso_direccion_documento", document.getElementById("piso_direccion_documento").value);
            formData.append("puerta_direccion_documento", document.getElementById("puerta_direccion_documento").value);
            formData.append("localidad_documento", document.getElementById("localidad_documento").value);
            formData.append("codigo_postal_documento", document.getElementById("codigo_postal_documento").value);
            formData.append("provincia_documento", document.getElementById("provincia_documento").value);
            //formData.append("telefono_1_documento", document.getElementById("telefono_1_documento").value);
            //formData.append("telefono_2_documento", document.getElementById("telefono_2_documento").value);
            //formData.append("fax_documento", document.getElementById("fax_documento").value);
            formData.append("mobil_documento", document.getElementById("mobil_documento").value);
            formData.append("email_documento", document.getElementById("email_documento").value);
            formData.append("persona_contacto_documento", document.getElementById("persona_contacto_documento").value);
            if(document.getElementById("check_guardar_datos_facturacion_cesta")) {
                if (document.getElementById("check_guardar_datos_facturacion_cesta").checked) {
                    formData.append("guardar_ficha", 1);
                } else {
                    formData.append("guardar_ficha", 0);
                }
            }else {
                formData.append("guardar_ficha", 0);
            }
            if(document.getElementById("tipo_librador").value == "tak") {
                formData.append("mobil_documento", document.getElementById("mobil_documento").value);
                formData.append("fecha_recogida_documento", document.getElementById("fecha_recogida_documento").value);
                formData.append("hora_recogida_documento", document.getElementById("hora_recogida_documento").value);
            }
        } else if (iniciar == '5' || iniciar == '6' || iniciar == '7' || iniciar == '70') {
            formData.append("tipo_librador", document.getElementById("tipo_librador").value);
            formData.append("id_librador", document.getElementById("id_librador_cesta").value);
            formData.append("tipo_documento_seleccionar", document.getElementById("tipo_documento").value);
            formData.append("numero_documento", document.getElementById("numero_documento").value);
            formData.append("fecha_documento", document.getElementById("fecha_documento").value);
            formData.append("fecha_entrada", document.getElementById("fecha_entrada").value);
            formData.append("id_modalidad_envio", document.getElementById("id_modalidad_envio").value);
            formData.append("id_modalidad_entrega", document.getElementById("id_modalidad_entrega").value);
            if(document.getElementById("check_recargo_documento_cesta").checked) {
                formData.append("recargo_documento_cesta", 1);
            }else {
                formData.append("recargo_documento_cesta", 0);
            }
            formData.append("irpf_documento_cesta", document.getElementById("irpf_documento_cesta").value);
            formData.append("descuento_pp_documento_cesta", document.getElementById("descuento_pp_documento_cesta").value);
            formData.append("descuento_librador_documento_cesta", document.getElementById("descuento_librador_documento_cesta").value);
            if(document.getElementById("check_guardar_datos_documento_cesta").checked) {
                formData.append("guardar_ficha", 1);
            }else {
                formData.append("guardar_ficha", 0);
            }
        }
        if (iniciar == '5') {
            formData.append("select", "guardar-datos-documento");
            formData.append("id_modalidad_pago", document.getElementById("id_modalidad_pago").value);
        }else if (iniciar == '6') {
            formData.append("select", "guardar-datos-documento");
            formData.append("id_modalidad_pago", document.getElementById("id_modalidad_pago_cobrar").value);
        }else if (iniciar == '7') {
            formData.append("select", "dividir-cobro");
            formData.append("id_modalidad_pago", document.getElementById("id_modalidad_pago_cobrar").value);
            formData.append("fracciones", document.getElementById("dividir_cobro").value);
            formData.append("total_fraccionar", document.getElementById("total_fraccionar").value);
        }else if (iniciar == '70') {
            formData.append("select", "dividir-cobro");
            formData.append("id_modalidad_pago", document.getElementById("id_modalidad_pago_cobrar").value);
            formData.append("fracciones", "0");
            formData.append("total_fraccionar", document.getElementById("total_fraccionar").value);
        }else if (iniciar == '8') {
            formData.append("select", "guardar-datos-descuentos");
            if(document.getElementById("check_recargo_descuento_cesta").checked) {
                formData.append("recargo_documento_cesta", 1);
            }else {
                formData.append("recargo_documento_cesta", 0);
            }
            formData.append("id_librador", document.getElementById("id_librador_cesta").value);
            formData.append("id_modalidad_pago", document.getElementById("id_modalidad_pago").value);
            formData.append("fecha_documento", document.getElementById("fecha_documento").value);
            formData.append("tipo_documento_seleccionar", document.getElementById("tipo_documento").value);
            formData.append("irpf_documento_cesta", document.getElementById("irpf_descuento_cesta").value);
            formData.append("descuento_pp_documento_cesta", document.getElementById("descuento_pp").value);
            formData.append("descuento_librador_documento_cesta", document.getElementById("descuento_librador").value);
            formData.append("descuento_librador_euro_documento_cesta", document.getElementById("descuento_librador_euro").value);
            if(document.getElementById("check_guardar_datos_descuento_cesta").checked) {
                formData.append("guardar_ficha", 1);
            }else {
                formData.append("guardar_ficha", 0);
            }
        }else if (iniciar == '9') {
            formData.append("select", "guardar-datos-irpf");
            formData.append("irpf_totales_cesta", document.getElementById("irpf_totales_cesta").value);
            if(document.getElementById("check_guardar_datos_irpf_cesta").checked) {
                formData.append("guardar_ficha", 1);
            }else {
                formData.append("guardar_ficha", 0);
            }
        }else if (iniciar == '11') {
            formData.append("select", "guardar-nota-documento");
            formData.append("nota_documento_cesta", document.getElementById("nota_documento").value);
        }else if (iniciar == 'del') {
            formData.append("select", "guardar-datos-del");
            formData.append("tipo_librador", document.getElementById("tipo_librador").value);
            formData.append("id_librador", document.getElementById("id_librador_cesta").value);
            formData.append("tipo_documento_seleccionar", document.getElementById("tipo_documento").value);
            if(document.getElementById("nombre_documento_buscar") && document.getElementById("nombre_documento_buscar").value != '') {
                console.log('nombre_documento_buscar: ' + document.getElementById("nombre_documento_buscar").value);
                formData.append("nombre_documento", document.getElementById("nombre_documento_buscar").value);
                formData.append("direccion_documento", document.getElementById("direccion_documento_buscar").value);
                formData.append("numero_direccion_documento", document.getElementById("numero_direccion_documento_buscar").value);
                formData.append("escalera_direccion_documento", document.getElementById("escalera_direccion_documento_buscar").value);
                formData.append("piso_direccion_documento", document.getElementById("piso_direccion_documento_buscar").value);
                formData.append("puerta_direccion_documento", document.getElementById("puerta_direccion_documento_buscar").value);
                formData.append("localidad_documento", document.getElementById("localidad_documento_buscar").value);
                formData.append("codigo_postal_documento", document.getElementById("codigo_postal_documento_buscar").value);
                formData.append("mobil_documento", document.getElementById("mobil_documento_buscar").value);
                formData.append("fecha_entrega_documento", document.getElementById("fecha_entrega_documento_buscar").value);
                formData.append("hora_entrega_documento", document.getElementById("hora_entrega_documento_buscar").value);
            }else {
                console.log('nombre_documento: ' + document.getElementById("nombre_documento").value);
                formData.append("nombre_documento", document.getElementById("nombre_documento").value);
                formData.append("direccion_documento", document.getElementById("direccion_documento").value);
                formData.append("numero_direccion_documento", document.getElementById("numero_direccion_documento").value);
                formData.append("escalera_direccion_documento", document.getElementById("escalera_direccion_documento").value);
                formData.append("piso_direccion_documento", document.getElementById("piso_direccion_documento").value);
                formData.append("puerta_direccion_documento", document.getElementById("puerta_direccion_documento").value);
                formData.append("localidad_documento", document.getElementById("localidad_documento").value);
                formData.append("codigo_postal_documento", document.getElementById("codigo_postal_documento").value);
                formData.append("mobil_documento", document.getElementById("mobil_documento").value);
                formData.append("fecha_entrega_documento", document.getElementById("fecha_entrega_documento").value);
                formData.append("hora_entrega_documento", document.getElementById("hora_entrega_documento").value);
            }
            formData.append("guardar_ficha", 0);
        }else if (iniciar == 'dels') {
            formData.append("select", "guardar-datos-del");
            formData.append("tipo_librador", document.getElementById("tipo_librador").value);
            formData.append("id_librador", document.getElementById("id_librador_cesta").value);
            formData.append("tipo_documento_seleccionar", document.getElementById("tipo_documento").value);
            if(document.getElementById("nombres_documento_buscar")) {
                formData.append("nombre_documento", document.getElementById("nombres_documento_buscar").value);
                formData.append("direccion_documento", document.getElementById("direcciones_documento_buscar").value);
                formData.append("numero_direccion_documento", document.getElementById("numeros_direccion_documento_buscar").value);
                formData.append("escalera_direccion_documento", document.getElementById("escaleras_direccion_documento_buscar").value);
                formData.append("piso_direccion_documento", document.getElementById("pisos_direccion_documento_buscar").value);
                formData.append("puerta_direccion_documento", document.getElementById("puertas_direccion_documento_buscar").value);
                formData.append("localidad_documento", document.getElementById("localidades_documento_buscar").value);
                formData.append("codigo_postal_documento", document.getElementById("codigos_postal_documento_buscar").value);
                formData.append("mobil_documento", document.getElementById("mobil_documento_buscar").value);
                formData.append("fecha_entrega_documento", document.getElementById("fechas_entrega_documento_buscar").value);
                formData.append("hora_entrega_documento", document.getElementById("horas_entrega_documento_buscar").value);
            }else {
                formData.append("nombre_documento", document.getElementById("nombre_documento").value);
                formData.append("direccion_documento", document.getElementById("direccion_documento").value);
                formData.append("numero_direccion_documento", document.getElementById("numero_direccion_documento").value);
                formData.append("escalera_direccion_documento", document.getElementById("escalera_direccion_documento").value);
                formData.append("piso_direccion_documento", document.getElementById("piso_direccion_documento").value);
                formData.append("puerta_direccion_documento", document.getElementById("puerta_direccion_documento").value);
                formData.append("localidad_documento", document.getElementById("localidad_documento").value);
                formData.append("codigo_postal_documento", document.getElementById("codigo_postal_documento").value);
                formData.append("mobil_documento", document.getElementById("mobil_documento").value);
                formData.append("fecha_entrega_documento", document.getElementById("fecha_entrega_documento").value);
                formData.append("hora_entrega_documento", document.getElementById("hora_entrega_documento").value);
            }
            formData.append("guardar_ficha", 0);
        }
        xhr.send(formData);
    }
}
function lineaFormularioCesta(idLinea,slug,bucle,tipo,estado) {
    console.log("lineaFormularioCesta de scripts.js raiz");

    var contenidoLinea = '\n';
    contenidoLinea += '<input type="hidden" id="linea_id_documento_2_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_fecha_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_id_producto_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_id_productos_detalles_enlazado_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_id_productos_detalles_multiples_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_id_packs_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_tipo_producto_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_codigo_barras_producto_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_descuento_base_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_importe_descuento_base_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_iva_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_importe_iva_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_recargo_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_importe_recargo_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_total_antes_descuento_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_descuento_total_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_importe_descuento_total_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_id_documento_anterior_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_id_vendedor_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_estado_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_id_usuario_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_hora_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_id_terminal_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_referencia_librador_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_numero_serie_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_lote_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_caducidad_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_importe_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_importe_fijo_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_base_antes_descuento_' + bucle + '" value="" />\n' +
        '    <input type="hidden" id="linea_base_despues_descuento_' + bucle + '" value="" />\n';
    if(mostrarCesta == "superior") {
        contenidoLinea += '<div class="col-span-12 py-2">\n' +
            '        <img src="" id="linea_imagen_producto_' + bucle + '" class="w-95 hidden" />\n' +
            '    </div>\n' +
            '        <input type="hidden" id="linea_referencia_producto_' + bucle + '" value="" />\n' +
            '        <div class="col-span-12 py-2 text-center" id="linea_descripcion_producto_' + bucle + '"' + tipo + '>&nbsp;</div>\n' +
            '    <div class="row-cesta">\n';
        if (tipoLibrador == "pro" || tipoLibrador == "cre") {
            contenidoLinea += '        <div class="col-span-12 py-2 text-center" id="linea_coste_unidad_' + bucle + '">&nbsp;</div>\n';
        } else {
            contenidoLinea += '        <div class="col-span-12 py-2 text-center" id="linea_pvp_unidad_' + bucle + '">&nbsp;</div>\n';
        }
        contenidoLinea +=
            '        <div class="col-span-12 py-2 text-center" id="linea_cantidad_' + bucle + '">&nbsp;</div>\n' +
            '        <div class="col-span-12 py-2 text-center" id="linea_total_despues_descuento_' + bucle + '">&nbsp;</div>\n' +
            '    <input type="hidden" id="linea_orden_' + bucle + '" value="" />\n';
    }else {
        contenidoLinea += '<input type="hidden" id="linea_imagen_producto_' + bucle + '" value="" />\n';
        contenidoLinea += '<input type="hidden" id="linea_referencia_producto_' + bucle + '" value="" />\n';
        contenidoLinea += '<input type="hidden" id="linea_orden_' + bucle + '" value="" />\n';
        contenidoLinea += '        <div class="col-span-5 py-2" id="linea_descripcion_producto_' + bucle + '">&nbsp;</div>\n';
        if(tipoLibrador == "pro" || tipoLibrador == "cre") {
            contenidoLinea += '        <div class="col-span-2 py-2 text-center" id="linea_coste_unidad_' + bucle + '">&nbsp;</div>\n';
        }else {
            contenidoLinea += '        <div class="col-span-2 py-2 text-center" id="linea_pvp_unidad_' + bucle + '">&nbsp;</div>\n';
        }
        contenidoLinea +=
            '        <div class="py-2 text-center" id="linea_cantidad_' + bucle + '">&nbsp;</div>\n' +
            '        <div class="col-span-2 py-2 text-center" id="linea_total_despues_descuento_' + bucle + '">&nbsp;</div>\n';
    }

    if(estado == 0 && slug) {
        contenidoLinea += '       <div class="py-2 text-blendi-600" id="capa_guardar_producto_' + bucle + '" onmouseover="this.style.cursor=\'pointer\'">\n' +
            '           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 m-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>\n' +
            '       </div>\n' +
            '       <div class="py-2 text-blendi-600" id="capa_eliminar_producto_' + idLinea + '" onmouseover="this.style.cursor=\'pointer\'" onclick="eliminarProducto(' + idLinea + ');">\n' +
            '           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 m-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>\n' +
            '       </div>\n';
    }else {
        contenidoLinea += '       <div class="py-2 text-blendi-600" id="capa_guardar_producto_' + bucle + '">\n' +
            '           &nbsp;\n' +
            '       </div>\n' +
            '       <div class="py-2 text-blendi-600" id="capa_eliminar_producto_' + idLinea + '">\n' +
            '           &nbsp;\n' +
            '       </div>\n';
    }
    contenidoLinea +=
        '        <div class="col-span-12" id="linea_detalles_producto_' + bucle + '">&nbsp;</div>\n' +
        '        <div class="col-span-12" id="linea_descripcion_oferta_' + bucle + '">&nbsp;</div>\n' +
        '        <div class="col-span-12" id="linea_nota_producto_' + bucle + '">&nbsp;</div>\n';
    contenidoLinea += '</div>\n' +
        '    </div>\n';
    document.getElementById("contenido_lineas").insertAdjacentHTML("afterbegin", contenidoLinea);
}
function lineasCesta() {
    console.log("lineasCesta de scripts.js raiz");

    if(idDocumento == null || idDocumento === undefined) {
        document.getElementById("contador-cesta").innerHTML = "0";
    }else {
        let xhr = new XMLHttpRequest();
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                document.getElementById("contador-cesta").innerHTML = res.numeroProductos;
                let capaBotonesInactividad = document.getElementById('capa_cabecera_botones_inactividad');
                if(res.numeroProductos != "0" && res.numeroProductos != 0) {
                    if (capaBotonesInactividad && !capaBotonesInactividad.classList.contains('hidden')) {
                        capaBotonesInactividad.classList.add('hidden')
                    }
                    if(accion == "abrir-documento") {
                        accion = "";
                        /* actualizarCesta(); */
                        if(mostrarCesta == "superior") {
                            actualizarCesta();
                            collapseCapa('capa-cesta');
                        }
                    }
                } else {
                    if (capaBotonesInactividad && capaBotonesInactividad.classList.contains('hidden')) {
                        capaBotonesInactividad.classList.remove('hidden')
                    }
                }

                if(document.getElementById("tipo_librador").value == "tak") {
                    if(document.getElementById("nombre_documento").value == "" && document.getElementById("mobil_documento").value == "") {
                        if(document.getElementById("capa-boton-cesta-cobrar")) {
                            console.log("Ocultar boton cobrar TAK");
                            document.getElementById("capa-boton-cesta-cobrar").style.display = "none";
                        }
                        if(document.getElementById("capa_cabecera_botones_cesta_2")) {
                            document.getElementById("capa_cabecera_botones_cesta_2").style.display = 'none';
                        }
                    }
                }
                if(document.getElementById("tipo_librador").value == "del") {
                    if(document.getElementById("mobil_documento").value == "" || document.getElementById("direccion_documento").value == "") {
                        if(document.getElementById("capa-boton-cesta-cobrar")) {
                            console.log("Ocultar boton cobrar DEL");
                            document.getElementById("capa-boton-cesta-cobrar").style.display = "none";
                        }
                        if(document.getElementById("capa_cabecera_botones_cesta_2")) {
                            document.getElementById("capa_cabecera_botones_cesta_2").style.display = 'none';
                        }
                    }
                }

                if(res.documento_ok == 0) {
                    idDocumento = 0;
                    sessionStorage.setItem('id_documento', '0');
                }
            }
        }

        xhr.open("post", "/web-gestion/datos-productos-ini.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("so", so);
        formData.append("idioma", idioma);
        formData.append("interface_js", interface_js);
        if(interface_js == "web") {
            formData.append("id_panel", id_panel);
        }
        formData.append("accion", "lineas-documento");
        formData.append("ejercicio", ejercicio);
        formData.append("id_documento_1", idDocumento);
        xhr.send(formData);
    }
}

function ultimoProductoAnadido() {
    if (window.tiquet_anterior == null ||
        window.tiquet == null ||
        window.tiquet_anterior[0] == undefined ||
        window.tiquet[0] == undefined ||
        window.tiquet_anterior[0].productosPorGrupo == undefined ||
        window.tiquet[0].productosPorGrupo == undefined
    ) {
        return null;
    }

    let productosTiquet = [];
    for (let i = 0; i < window.tiquet[0].productosPorGrupo.length; i++) {
        for (let z = 0; z < window.tiquet[0].productosPorGrupo[i].productos.length; z++) {
            productosTiquet.push(window.tiquet[0].productosPorGrupo[i].productos[z]);
        }
    }

    let productosTiquetAnterior = [];
    for (let i = 0; i < window.tiquet_anterior[0].productosPorGrupo.length; i++) {
        for (let z = 0; z < window.tiquet_anterior[0].productosPorGrupo[i].productos.length; z++) {
            productosTiquetAnterior.push(window.tiquet_anterior[0].productosPorGrupo[i].productos[z]);
        }
    }

    let productoEncontrado = false;
    let ultimoProductoAnadido = null;
    for (let i = 0; i < productosTiquet.length; i++) {
        productoEncontrado = false;
        for (let z = 0; z < productosTiquetAnterior.length; z++) {
            if (productosTiquet[i].descripcion_producto == productosTiquetAnterior[z].descripcion_producto &&
                productosTiquet[i].cantidad == productosTiquetAnterior[z].cantidad
            ) {
                productoEncontrado = true;
            }
            if (productosTiquet[i].descripcion_producto.substring(0, 1) == '-') {
                productoEncontrado = true;
            }
        }

        if (productoEncontrado == false) {
            ultimoProductoAnadido = productosTiquet[i];
        }
    }

    return ultimoProductoAnadido;
}

window.tiquet_anterior = null;
window.tiquet = null;
window.mostrar_ultimo_producto = null;
window.mostrar_ultimo_producto_mobile = null;
function actualizarCesta() {
    console.log("actualizarCesta de scripts.js raiz");
    //var contenedor = document.querySelector("#loader-capa-cesta");
    document.getElementById("contenido_lineas").innerHTML = "";

    if(document.getElementById("capa_cobrar")) {
        if(mostrarCesta == "superior") {
            document.getElementById("capa_cobrar").innerHTML = "";
            document.getElementById("h1-inicio").innerHTML = "";
        }
    }

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        //contenedor.innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Actualizando datos" title="Actualizando datos" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            window.tiquet_anterior = window.tiquet;

            let bodyProductoModal = document.getElementById('contenido_lineas');
            bodyProductoModal.innerHTML = this.responseText;

            nodeScriptReplace(bodyProductoModal);

            lineasCesta();

            let productoAnadido = ultimoProductoAnadido();
            if (productoAnadido != null) {
                document.getElementById('producto_anadido_descripcion').innerHTML = productoAnadido.descripcion_producto;
                document.getElementById('producto_anadido_descripcion_mobile').innerHTML = productoAnadido.descripcion_producto;
                let capa_producto_anadido_editar = document.getElementById('producto_anadido_editar');
                let capa_producto_anadido_editar_mobile = document.getElementById('producto_anadido_editar_mobile');
                let content_capa_producto_anadido_editar = '';
                if ((productoAnadido.id_producto_relacionado == '' || productoAnadido.id_producto_relacionado == null) && (productoAnadido.tipo_producto == 3 || productoAnadido.tipo_producto == 4)) {
                    content_capa_producto_anadido_editar = '<div class="py-2 text-blendi-600" onmouseover="this.style.cursor=\'pointer\'" onclick="editarProducto(' + productoAnadido.id_documento_2 + ', \'' + productoAnadido.slug + '\',0);"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 m-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg></div>';
                    capa_producto_anadido_editar.innerHTML = content_capa_producto_anadido_editar;
                    capa_producto_anadido_editar_mobile.innerHTML = content_capa_producto_anadido_editar;
                } else {
                    content_capa_producto_anadido_editar = '<div class="py-2 text-blendi-600" onmouseover="this.style.cursor=\'pointer\'" onclick="document.getElementById(\'botonOpenModalProducto\').click(); detallesProductoModal(\'' + productoAnadido.descripcion_producto + '\', ' + productoAnadido.id_producto + ', \'' + ((productoAnadido.id_producto_relacionado == null)? '' : productoAnadido.id_producto_relacionado) + '\', \'' + productoAnadido.tipo_producto + '\', ' + productoAnadido.id_documento_2 + ', false, \'\', \'\');"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 m-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg></div>';
                    capa_producto_anadido_editar.innerHTML = content_capa_producto_anadido_editar;
                    capa_producto_anadido_editar_mobile.innerHTML = content_capa_producto_anadido_editar;
                }

                let capa_producto_anadido_eliminar = document.getElementById('producto_anadido_eliminar');
                let capa_producto_anadido_eliminar_mobile = document.getElementById('producto_anadido_eliminar_mobile');
                let content_capa_producto_anadido_eliminar = '';
                if (productoAnadido.id_producto_relacionado == '' || productoAnadido.id_producto_relacionado == null) {
                    content_capa_producto_anadido_eliminar = '<div class="py-2 text-blendi-600" onmouseover="this.style.cursor=\'pointer\'" onclick="eliminarProducto(' + productoAnadido.id_documento_2 + ');"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 m-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></div>';
                    capa_producto_anadido_eliminar.innerHTML = content_capa_producto_anadido_eliminar;
                    capa_producto_anadido_eliminar_mobile.innerHTML = content_capa_producto_anadido_eliminar;
                } else {
                    content_capa_producto_anadido_eliminar = '<div class="py-2 text-blendi-600" onmouseover="this.style.cursor=\'pointer\'" onclick="detallesProductoModal(\'' + productoAnadido.descripcion_producto + '\', ' + productoAnadido.id_producto + ', \'' + ((productoAnadido.id_producto_relacionado == null)? '' : productoAnadido.id_producto_relacionado) + '\', \'' + productoAnadido.tipo_producto + '\', ' + productoAnadido.id_documento_2 + ', true, \'\', \'\');"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 m-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></div>';
                    capa_producto_anadido_eliminar.innerHTML = content_capa_producto_anadido_eliminar;
                    capa_producto_anadido_eliminar_mobile.innerHTML = content_capa_producto_anadido_eliminar;
                }

                if (document.getElementById('producto_anadido').classList.contains('hidden')) {
                    toggleDisplay('producto_anadido');
                }
                if (window.mostrar_ultimo_producto != null) {
                    clearTimeout(window.mostrar_ultimo_producto);
                }
                window.mostrar_ultimo_producto = window.setTimeout(function(){ toggleDisplay('producto_anadido'); }, 3000);

                if (document.getElementById('producto_anadido_mobile').classList.contains('hidden')) {
                    toggleDisplay('producto_anadido_mobile');
                }
                if (window.mostrar_ultimo_producto_mobile != null) {
                    clearTimeout(window.mostrar_ultimo_producto_mobile);
                }
                window.mostrar_ultimo_producto_mobile = window.setTimeout(function(){ toggleDisplay('producto_anadido_mobile'); }, 3000);
            }
        }
    }

    xhr.open("post", "/web-gestion/documento_actualizar.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("ejercicio", ejercicio);
    formData.append("interface_js", interface_js);
    formData.append("tipo_librador", tipoLibrador);
    if(interface_js == "web") {
        formData.append("id_panel", id_panel);
    }
    formData.append("id_documento_1", idDocumento);
    formData.append("decimales_cantidades", decimalesCantidades);
    formData.append("decimales_importes", decimalesImportes);
    /* formData.append("funcion_origen", "actualizarCesta"); */
    formData.append("funcion_origen", "tiquetCamarero");
    xhr.send(formData);
}
function marcarProductosCobrar(elemento) {
    let productosAMarcarODesmarcar = document.getElementsByClassName('productosCobroTiquetOriginal');
    let isCurrentChecked = null;
    for (let bucle = 0 ; bucle < productosAMarcarODesmarcar.length ; bucle++) {
        isCurrentChecked = productosAMarcarODesmarcar[bucle].checked
        productosAMarcarODesmarcar[bucle].checked = elemento.checked;
        if (isCurrentChecked != elemento.checked) {
            modificarTotalTicketCobrar(productosAMarcarODesmarcar[bucle]);
        }
    }
}
function productosCobro() {
    console.log("productosCobro de scripts.js raiz");
    var contenedor = document.querySelector("#capa-cobrar-por-producto");
    //document.getElementById('capa-dividir_cobro').children[0].style.display = 'none';
    //document.getElementById('capa-boton-dividir_cobro').children[0].style.display = 'none';
    //document.getElementById('capa-boton-por_producto_cobro').children[0].style.display = 'none';
    //document.getElementById('id_modalidad_pago_cobrar').disabled = true;

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenedor.innerHTML = '<div>Cargando productos...</div>';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            if(res.lineas) {
                let contenido = "";
                for (var i = -1; i < res.orden_descripcion_cantidades.length; i++) {
                    if (i != -1) {
                        contenido += '<div class="font-semibold mt-2">' + res.orden_descripcion_cantidades[i] + '</div>';
                    }
                    for (var bucle = 0; bucle < res.id_documento_2.length; bucle++) {
                        if (i != -1 || res.orden[bucle] != '') {
                            if (res.orden[bucle] != res.orden_descripcion_cantidades[i]) {
                                continue;
                            }
                        }
                        let idDocumento2 = res.id_documento_2[bucle];
                        let descripcionProducto = res.descripcion_producto[bucle];
                        descripcionProducto = descripcionProducto.replaceAll("'", "");
                        descripcionProducto = descripcionProducto.replaceAll('"', "");
                        let detallesProducto = res.detalles_producto[bucle];
                        detallesProducto = detallesProducto.replaceAll("'", "");
                        detallesProducto = detallesProducto.replaceAll('"', "");
                        if (detallesProducto != '') {
                            detallesProducto += '<br>';
                        }
                        let cantidadProducto = 1;
                        for (var bucleCantidad = 0; bucleCantidad < res.cantidad[bucle]; bucleCantidad++) {
                            if (bucleCantidad + 1 > res.cantidad[bucle]) {
                                cantidadProducto = res.cantidad[bucle] - bucleCantidad;
                            }
                            contenido += "<div class='flex flex-wrap mt-1'>" +
                                "<div>" +
                                "<input type='checkbox' checked class='productosCobroTiquetOriginal mtp-05' data-iddocumento2='"+ idDocumento2 +"' data-pvp='"+ parseFloat(res.pvp_unidad[bucle]) +"' data-cantidad='"+ cantidadProducto.toFixed(decimalesCantidades) +"' onclick='modificarTotalTicketCobrar(this)' />" +
                                "</div>" +
                                "<div class='ml-2'>" +
                                cantidadProducto.toFixed(decimalesCantidades) +
                                "x " +
                                descripcionProducto +
                                detallesProducto +
                                "</div>" +
                                "<div class='grow text-right'>" +
                                parseFloat(res.pvp_unidad[bucle] * cantidadProducto).toFixed(2) + " €" +
                                "</div>" +
                                "</div>";
                        }
                    }
                }
                contenedor.innerHTML = contenido;
            }
        }
    }
    xhr.open("post", "/web-gestion/documento_actualizar.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("ejercicio", ejercicio);
    formData.append("interface_js", interface_js);
    formData.append("tipo_librador", tipoLibrador);
    if(interface_js == "web") {
        formData.append("id_panel", id_panel);
    }
    formData.append("id_documento_1", idDocumento);
    formData.append("decimales_cantidades", decimalesCantidades);
    formData.append("decimales_importes", decimalesImportes);
    formData.append("funcion_origen", "productosCobro");
    xhr.send(formData);
}
function modificarTotalTicketCobrar(elemento) {
    if (elemento.checked) {
        sumarTotalTicketCobrar(elemento);
    } else {
        restarTotalTicketCobrar(elemento);
    }
}
function restarTotalTicketCobrar(elemento) {
    let pvpUnidad = elemento.dataset['pvp'];
    let capaImporteCobrar0 = document.querySelector("#capa-importe-cobrar_0");
    let capaImporteCobrar1 = document.querySelector("#capa-importe-cobrar_1_0");
    let importeCobrar0 = document.querySelector("#importe-cobrar_0");
    let importeCobrar1 = document.querySelector("#importe-cobrar_1_0");
    let importeEntregado0 = document.querySelector("#importe-entregado_0");
    let importeEntregado1 = document.querySelector("#importe-entregado_1_0");
    let capaCobrarDatoTotal = document.querySelector("#capa_cobrar_dato_total");

    importeEntregado0.value = (parseFloat(importeCobrar0.value) - parseFloat(pvpUnidad)).toFixed(2);
    importeEntregado1.value = (parseFloat(importeCobrar1.value) + parseFloat(pvpUnidad)).toFixed(2);
    capaImporteCobrar0.innerHTML = importeEntregado0.value;
    capaImporteCobrar1.innerHTML = importeEntregado1.value;
    importeCobrar0.value = importeEntregado0.value;
    importeCobrar1.value = importeEntregado1.value;
    capaCobrarDatoTotal.innerHTML = importeEntregado0.value + ' €';
}
function sumarTotalTicketCobrar(elemento) {
    let pvpUnidad = elemento.dataset['pvp'];
    let capaImporteCobrar0 = document.querySelector("#capa-importe-cobrar_0");
    let capaImporteCobrar1 = document.querySelector("#capa-importe-cobrar_1_0");
    let importeCobrar0 = document.querySelector("#importe-cobrar_0");
    let importeCobrar1 = document.querySelector("#importe-cobrar_1_0");
    let importeEntregado0 = document.querySelector("#importe-entregado_0");
    let importeEntregado1 = document.querySelector("#importe-entregado_1_0");
    let capaCobrarDatoTotal = document.querySelector("#capa_cobrar_dato_total");

    importeEntregado0.value = (parseFloat(importeCobrar0.value) + parseFloat(pvpUnidad)).toFixed(2);
    importeEntregado1.value = (parseFloat(importeCobrar1.value) - parseFloat(pvpUnidad)).toFixed(2);
    capaImporteCobrar0.innerHTML = importeEntregado0.value;
    capaImporteCobrar1.innerHTML = importeEntregado1.value;
    importeCobrar0.value = importeEntregado0.value;
    importeCobrar1.value = importeEntregado1.value;
    capaCobrarDatoTotal.innerHTML = importeEntregado0.value + ' €';
}
function pasarProducto(idDocumento2,pvpUnidad,descripcionProducto,button) {
    console.log("pasarProducto de scripts.js raiz");
    if (document.getElementsByClassName('productosCobroTiquetOriginal').length <= 1) {
        return;
    }
    let contenedor = document.querySelector("#capa_productos_cobro_1_0");
    let capaImporteCobrar0 = document.querySelector("#capa-importe-cobrar_0");
    let capaImporteCobrar1 = document.querySelector("#capa-importe-cobrar_1_0");
    let importeCobrar0 = document.querySelector("#importe-cobrar_0");
    let importeCobrar1 = document.querySelector("#importe-cobrar_1_0");
    let importeEntregado0 = document.querySelector("#importe-entregado_0");
    let importeEntregado1 = document.querySelector("#importe-entregado_1_0");

    importeEntregado0.value = (parseFloat(importeCobrar0.value) - parseFloat(pvpUnidad)).toFixed(2);
    importeEntregado1.value = (parseFloat(importeCobrar1.value) + parseFloat(pvpUnidad)).toFixed(2);

    importeEntregado0.disabled = true;
    /*
    document.getElementById("imprimir_al_cobrar_si_" + numeroEfecto).disabled = true;
    */
    document.getElementById("imprimir_al_cobrar_si_0").disabled = true;

    //document.getElementById("capa-botones-metodos_pago_0").style.display = "none";
    document.getElementById("documento_bancario_0").disabled = true;
    document.getElementById("vencimiento_documento_bancario_0").disabled = true;
    document.getElementById("fecha_pago_0").disabled = true;
    document.getElementById("nota_0").disabled = true;
    document.getElementById("id_banco_cobro_0").disabled = true;

    capaImporteCobrar0.innerHTML = importeEntregado0.value;
    capaImporteCobrar1.innerHTML = importeEntregado1.value;
    importeCobrar0.value = importeEntregado0.value;
    importeCobrar1.value = importeEntregado1.value;
    button.parentNode.outerHTML = '';
    contenedor.innerHTML += "<div><button class='mtp-05 productosNuevoTiquet' data-iddocumento2='" + idDocumento2 + "' onclick='pasarProductoInverso(" + idDocumento2 + "," + pvpUnidad + ",\"" + descripcionProducto + "\",this)'>" + descripcionProducto + " ></button></div>";
    document.getElementById("importe-cambio_0").innerHTML = "";
    document.getElementById("importe-cambio_1_0").innerHTML = "";
    if (document.getElementsByClassName('productosNuevoTiquet').length >= 1) {
        importeEntregado1.disabled = false;
        document.getElementById("imprimir_al_cobrar_1_0_si").disabled = false;
        // document.getElementById("capa-botones-metodos_pago_1_0").style.display = "inline-grid";
        document.getElementById("documento_bancario_1_0").disabled = false;
        document.getElementById("vencimiento_documento_bancario_1_0").disabled = false;
        document.getElementById("fecha_pago_1_0").disabled = false;
        document.getElementById("nota_1_0").disabled = false;
        document.getElementById("id_banco_cobro_1_0").disabled = false;
    }
    importeEntregado1.select();
    importeEntregado1.focus();
}
function pasarProductoInverso(idDocumento2,pvpUnidad,descripcionProducto,button) {
    console.log("pasarProductoInverso de scripts.js raiz");
    let contenedor = document.querySelector("#capa_productos_cobro_0");
    let capaImporteCobrar0 = document.querySelector("#capa-importe-cobrar_0");
    let capaImporteCobrar1 = document.querySelector("#capa-importe-cobrar_1_0");
    let importeCobrar0 = document.querySelector("#importe-cobrar_0");
    let importeCobrar1 = document.querySelector("#importe-cobrar_1_0");
    let importeEntregado0 = document.querySelector("#importe-entregado_0");
    let importeEntregado1 = document.querySelector("#importe-entregado_1_0");

    importeEntregado0.value = (parseFloat(importeCobrar0.value) + parseFloat(pvpUnidad)).toFixed(2);
    importeEntregado1.value = (parseFloat(importeCobrar1.value) - parseFloat(pvpUnidad)).toFixed(2);

    capaImporteCobrar0.innerHTML = importeEntregado0.value;
    capaImporteCobrar1.innerHTML = importeEntregado1.value;
    importeCobrar0.value = importeEntregado0.value;
    importeCobrar1.value = importeEntregado1.value;
    button.parentNode.outerHTML = '';
    contenedor.innerHTML += "<div><button class='productosCobroTiquetOriginal mtp-05' onclick='pasarProducto(" + idDocumento2 + "," + pvpUnidad + ",\"" + descripcionProducto + "\",this)'>< " + descripcionProducto + "</button></div>";
    document.getElementById("importe-cambio_0").innerHTML = "";
    document.getElementById("importe-cambio_1_0").innerHTML = "";
    if (document.getElementsByClassName('productosNuevoTiquet').length == 0) {
        importeEntregado1.disabled = true;
        document.getElementById("imprimir_al_cobrar_1_0_si").disabled = true;
        //document.getElementById("capa-botones-metodos_pago_1_0").style.display = "none";
        document.getElementById("documento_bancario_1_0").disabled = true;
        document.getElementById("vencimiento_documento_bancario_1_0").disabled = true;
        document.getElementById("fecha_pago_1_0").disabled = true;
        document.getElementById("nota_1_0").disabled = true;
        document.getElementById("id_banco_cobro_1_0").disabled = true;

        importeEntregado0.disabled = false;
        document.getElementById("imprimir_al_cobrar_si_0").disabled = false;
        //document.getElementById("capa-botones-metodos_pago_0").style.display = "inline-grid";
        document.getElementById("documento_bancario_0").disabled = false;
        document.getElementById("vencimiento_documento_bancario_0").disabled = false;
        document.getElementById("fecha_pago_0").disabled = false;
        document.getElementById("nota_0").disabled = false;
        document.getElementById("id_banco_cobro_0").disabled = false;
    }
    importeEntregado0.select();
    importeEntregado0.focus();
}
window.compraHabilitada = true;
function comprarProducto(contador_elemento,accion,idEnlazado,idMultiple,idPack,anadidoModal) {
    console.log("comprarProducto de scripts.js raiz");
    console.log("Número documento en comprarProducto: " + document.getElementById("numero_documento").value);

    if (!window.compraHabilitada) {
        return;
    }

    var guardar = true;
    if(accion == "eliminar") {
        if (!confirm('Confirmar para eliminar el registro.')) {
            guardar = false;
        }
    }else if(accion == "eliminar-pack") {
        if (!confirm('Confirmar para eliminar el pack.')) {
            guardar = false;
        }
    }else if(accion == "eliminar-imagen") {
        if (!confirm('Confirmar para eliminar la imagen.')) {
            guardar = false;
        }
    }
    if(guardar == true) {
        let restoCantidadLote = 0;
        let elementosRadioLote = document.getElementsByName("radio_lote");
        if (elementosRadioLote.length) {
            let stockLote = parseFloat(document.querySelector('input[name="radio_lote"]:checked').value);
            if (parseFloat(document.getElementById("cantidad_" + contador_elemento + anadidoModal).value) > stockLote) {
                restoCantidadLote = parseFloat(document.getElementById("cantidad_" + contador_elemento + anadidoModal).value) - stockLote;
                document.getElementById("cantidad_" + contador_elemento + anadidoModal).value = stockLote;
                modificarCantidades(contador_elemento, anadidoModal, true);
            }
        }

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {

        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                let slug = null;

                console.log(res.datos);

                sessionStorage.setItem('id_documento', res.id_documento_1);
                sessionStorage.setItem('ejercicio', res.ejercicio);
                idDocumento = res.id_documento_1;
                ejercicio = res.ejercicio;
                let capaNumeroDocumento = document.getElementById('numero_documento');
                if (res.numero_documento && capaNumeroDocumento) {
                    capaNumeroDocumento.value = res.numero_documento;
                }
                if (mostrarCesta == "superior") {
                    document.getElementById("contador-cesta").innerHTML = res.numeroProductos;
                    if (document.getElementById("capa-cesta").style.display = "block") {
                        actualizarCesta();
                    }
                }else {
                    sessionStorage.setItem('mostrar_cesta_pantalla', 'si');
                    mostrarCestaPantalla = 'si';
                    actualizarCesta();
                }
                cargarCabeceraCesta();
                if(res.tipo_producto_sys == "0" || res.tipo_producto_sys == "1") {
                    if (restoCantidadLote > 0) {
                        if (elementosRadioLote.length) {
                            document.getElementById("cantidad_" + contador_elemento + anadidoModal).value = restoCantidadLote;
                            document.querySelector('input[name="radio_lote"]:checked').disabled = true;
                            document.querySelector('input[name="radio_lote"]:checked').checked = false;
                        }
                    } else {
                        if (document.getElementById("link_boton_volver" + anadidoModal)) {
                            let linkVolver = document.getElementById("link_boton_volver" + anadidoModal);
                            if (linkVolver) {
                                linkVolver.click();
                            }
                        }
                    }
                }else if(!anadidoModal && (res.tipo_producto_sys == "3" || res.tipo_producto_sys == "4")) {
                    document.getElementById('id_linea').value = res.id_documento_2;
                }else if(anadidoModal && (res.tipo_producto_sys == "3" || res.tipo_producto_sys == "4")) {
                    slug = document.getElementById('slug_producto');
                    if (slug && slug.value) {
                        cargarProducto(slug.value + '/' + res.id_documento_2);
                    }
                }else {
                    let boton_guardar = document.getElementById("boton_guardar_" + contador_elemento + anadidoModal);
                    if (boton_guardar) {
                        boton_guardar.style.display = "block";
                    }
                }

                if (res.tipo_producto_sys == "3" || res.tipo_producto_sys == "4") {
                    slug = document.getElementById('slug_producto');
                    if (slug && slug.value) {
                        cargarProducto(slug.value + '/' + res.id_documento_2);
                    }
                }

                if (restoCantidadLote <= 0 && !document.getElementById('capa-producto-modal').classList.contains('hidden')) {
                    document.getElementById('cerrar_modal_producto').click();
                } else {
                    if (anadidoModal) {
                        detallesProductoModal(document.getElementById('titulo-producto-modal').innerHTML, document.getElementById('id_producto_modal').value, '', document.getElementById('tipo_producto_' + contador_elemento + '_modal').value, -1, false, '', '');

                        setTimeout(function() {
                            if (restoCantidadLote > 0) {
                                if (elementosRadioLote.length) {
                                    document.getElementById("cantidad_" + contador_elemento + anadidoModal).value = restoCantidadLote;
                                    document.querySelector('input[name="radio_lote"]:checked').disabled = true;
                                    document.querySelector('input[name="radio_lote"]:checked').checked = false;
                                }
                            }
                        }, 500);
                    }
                }
            }
        }

        xhr.open("post", "/web-gestion/documento_guardar.php", true);
        let form = document.querySelector("#formulario_producto" + anadidoModal);
        let formData = new FormData(form);
        formData.append("id_sesion", idSesion);
        formData.append("id_sesion_js", id_sesion_js);
        formData.append("ip", ip);
        formData.append("so", so);
        formData.append("idioma", idioma);
        formData.append("id_idioma", id_idioma);
        formData.append("interface_js", interface_js);
        if(interface_js == "web") {
            formData.append("id_panel", id_panel);
        }
        formData.append("accion", accion);
        formData.append("ejercicio", ejercicio);
        formData.append("id_tarifa_web", idTarifaWeb);
        formData.append("id_documento_1", idDocumento);
        formData.append("id_usuario", idUsuario);
        formData.append("elemento", contador_elemento);
        formData.append("procedencia", document.getElementById("procedencia").value);
        formData.append("tipo_documento", document.getElementById("tipo_documento").value);
        formData.append("id_librador", document.getElementById("id_librador_seleccionar").value);
        formData.append("idEnlazado", idEnlazado);
        formData.append("idMultiple", idMultiple);
        formData.append("idPack", idPack);
        formData.append("tipo_librador", document.getElementById("tipo_librador").value);
        formData.append("codigo_librador_documento", document.getElementById("codigo_librador_documento").value);
        if(document.getElementById("nombre_documento")) {
            formData.append("nombre_documento", document.getElementById("nombre_documento").value);
            formData.append("apellido_1_documento", document.getElementById("apellido_1_documento").value);
            formData.append("apellido_2_documento", document.getElementById("apellido_2_documento").value);
        }
        if(document.getElementById("razon_social_documento")) {
            formData.append("razon_social_documento", document.getElementById("razon_social_documento").value);
        }
        if(document.getElementById("razon_comercial_documento")) {
            formData.append("razon_comercial_documento", document.getElementById("razon_comercial_documento").value);
        }
        formData.append("nif_documento", document.getElementById("nif_documento").value);
        formData.append("direccion_documento", document.getElementById("direccion_documento").value);
        formData.append("numero_direccion_documento", document.getElementById("numero_direccion_documento").value);
        formData.append("escalera_direccion_documento", document.getElementById("escalera_direccion_documento").value);
        formData.append("piso_direccion_documento", document.getElementById("piso_direccion_documento").value);
        formData.append("puerta_direccion_documento", document.getElementById("puerta_direccion_documento").value);
        formData.append("localidad_documento", document.getElementById("localidad_documento").value);
        formData.append("codigo_postal_documento", document.getElementById("codigo_postal_documento").value);
        formData.append("provincia_documento", document.getElementById("provincia_documento").value);
        formData.append("telefono_1_documento", document.getElementById("telefono_1_documento").value);
        formData.append("telefono_2_documento", document.getElementById("telefono_2_documento").value);
        formData.append("fax_documento", document.getElementById("fax_documento").value);
        formData.append("mobil_documento", document.getElementById("mobil_documento").value);
        formData.append("email_documento", document.getElementById("email_documento").value);
        formData.append("persona_contacto_documento", document.getElementById("persona_contacto_documento").value);
        formData.append("nombre_envio_documento", document.getElementById("nombre_envio_documento").value);
        formData.append("razon_social_envio_documento", document.getElementById("razon_social_envio_documento").value);
        formData.append("razon_comercial_envio_documento", document.getElementById("razon_comercial_envio_documento").value);
        formData.append("direccion_envio_documento", document.getElementById("direccion_envio_documento").value);
        formData.append("numero_direccion_envio_documento", document.getElementById("numero_direccion_envio_documento").value);
        formData.append("escalera_direccion_envio_documento", document.getElementById("escalera_direccion_envio_documento").value);
        formData.append("piso_direccion_envio_documento", document.getElementById("piso_direccion_envio_documento").value);
        formData.append("puerta_direccion_envio_documento", document.getElementById("puerta_direccion_envio_documento").value);
        formData.append("localidad_envio_documento", document.getElementById("localidad_envio_documento").value);
        formData.append("codigo_postal_envio_documento", document.getElementById("codigo_postal_envio_documento").value);
        formData.append("provincia_envio_documento", document.getElementById("provincia_envio_documento").value);
        formData.append("id_zona_envio", document.getElementById("id_zona_envio").value);
        formData.append("telefono_1_envio_documento", document.getElementById("telefono_1_envio_documento").value);
        formData.append("telefono_2_envio_documento", document.getElementById("telefono_2_envio_documento").value);
        formData.append("mobil_envio_documento", document.getElementById("mobil_envio_documento").value);
        formData.append("persona_contacto_envio_documento", document.getElementById("persona_contacto_envio_documento").value);
        formData.append("observaciones_envio_documento", document.getElementById("observaciones_envio_documento").value);
        formData.append("serie_documento", document.getElementById("serie_documento").value);
        formData.append("numero_documento", document.getElementById("numero_documento").value);
        formData.append("fecha_documento", document.getElementById("fecha_documento").value);
        formData.append("fecha_entrada", document.getElementById("fecha_entrada").value);
        formData.append("id_modalidad_pago", document.getElementById("id_modalidad_pago").value);
        formData.append("id_modalidad_envio", document.getElementById("id_modalidad_envio").value);
        formData.append("id_modalidad_entrega", document.getElementById("id_modalidad_entrega").value);
        formData.append("base", document.getElementById("base").value);
        formData.append("decimales_cantidades", decimalesCantidades);
        formData.append("decimales_importes", decimalesImportes);
        xhr.send(formData);
    }
}
function comprarProductoDesdeCategoria(id_producto, slug, descripcion_producto, iva, recargo_producto, pvp, coste, orden, tipo_producto, anadidoModal) {
    console.log("comprarProductoDesdeCategoria de scripts.js raiz");

    document.getElementById('id_producto'+anadidoModal).value = id_producto;
    document.getElementById('slug_producto'+anadidoModal).value = slug;
    document.getElementById('descripcion_producto_0'+anadidoModal).value = descripcion_producto;
    document.getElementById('alt_producto_0'+anadidoModal).value = descripcion_producto;
    document.getElementById('tittle_producto_0'+anadidoModal).value = descripcion_producto;
    document.getElementById('iva_producto_0'+anadidoModal).value = iva;
    document.getElementById('recargo'+anadidoModal).value = window.recargo;
    document.getElementById('recargo_producto_0'+anadidoModal).value = recargo_producto;
    document.getElementById('pvp_base_0'+anadidoModal).value = pvp;
    document.getElementById('pvp_linea_0'+anadidoModal).value = pvp;
    document.getElementById('pvp_total_0'+anadidoModal).value = pvp;
    document.getElementById('pvp_span_combo_0'+anadidoModal).value = pvp;
    document.getElementById('coste_producto_0'+anadidoModal).value = coste;
    document.getElementById('tipo_producto_0'+anadidoModal).value = tipo_producto;
    document.getElementById('orden'+anadidoModal).value = orden;

    comprarProducto(0, 'insertar-producto', 0, 0, 0, anadidoModal);
}
function eliminarProducto(idLinea) {
    console.log("eliminarProducto idLinea: "+idLinea+" de scripts.js raiz");
    var guardar = true;
    if(guardar == true) {
        if(document.getElementById("capa_cobrar")) {
            document.getElementById("capa_cobrar").style.display = "none";
        }
        if(document.getElementById("grid-ficha-producto")) {
            document.getElementById("grid-ficha-producto").style.display = "none";
        }
        if (document.getElementById("capa-boton-volver")) {
            document.getElementById("capa-boton-volver").style.display = "none";
        }
        var contenedor = document.querySelector("#capa_eliminar_producto_"+idLinea);

        let xhr = new XMLHttpRequest();
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                actualizarCesta();
            }
        }

        xhr.open("post", "/web-gestion/documento_guardar.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("id_sesion_js", id_sesion_js);
        formData.append("ip", ip);
        formData.append("so", so);
        formData.append("idioma", idioma);
        formData.append("id_idioma", id_idioma);
        formData.append("id_panel", id_panel);
        formData.append("accion", "eliminar-producto");
        formData.append("ejercicio", ejercicio);
        formData.append("interface_js", interface_js);
        formData.append("id_documento_1", idDocumento);
        formData.append("id_documento_2", idLinea);
        formData.append("id_usuario", idUsuario);
        formData.append("tipo_documento", document.getElementById("tipo_documento").value);
        formData.append("tipo_librador", document.getElementById("tipo_librador").value);
        formData.append("descuento_pp", document.getElementById("descuento_pp").value);
        formData.append("descuento_librador", document.getElementById("descuento_librador").value);
        formData.append("decimales_cantidades", decimalesCantidades);
        formData.append("decimales_importes", decimalesImportes);
        xhr.send(formData);
    }
}

function editarProducto(idLinea,slug,bucle) {
    console.log("editarProducto de scripts.js raiz");
    console.log("editarProducto de scripts.js raiz window.location.href host_url + slug + idLinea");
    cargarProducto(slug + '/' + idLinea);
}

let cerrandoDocumento = false;
function cerrarDocumento(mostrar_tiquet_previo = false) {
    console.log("cerrarDocumento de scripts.js raiz");

    let forzarCierre = false;

    // Eliminamos el tiquet si no contiene productos
    if (tiquet !== undefined && tiquet[0] !== undefined && tiquet[0].totalProductos !== undefined && !tiquet[0].totalProductos && idDocumento>0) {
        eliminarDocumento(idDocumento, ejercicio);
        forzarCierre = true;
    }

    let continuar = true;
    if (mostrar_tiquet_previo && !forzarCierre) {
        continuar = false;
        let xhr = new XMLHttpRequest();
        xhr.onload = function () {
            if (xhr.status == 200) {
                let cuerpo = document.getElementById('body-tiquet-cocina-modal');
                let botonModal = document.getElementById('botonOpenModalTiquetCocina');
                if (cuerpo && botonModal) {
                    cuerpo.innerHTML = xhr.response;
                    botonModal.click();
                }
            }
        }

        xhr.open("post", "/recepcion_pedidos/", true);
        let formData = new FormData();
        formData.append("ajax", true);
        formData.append("tiquet_individual", idDocumento);
        xhr.send(formData);
    }

    /*
    if(document.getElementById("tipo_librador").value == "tak") {
        if(document.getElementById("nombre_documento").value == "" && document.getElementById("mobil_documento").value == "") {
            alert("Introducir nombre y/o movil");
            document.getElementById("nombre_documento").focus();
            continuar = false;
        }
    }
    */
    if(document.getElementById("tipo_librador").value == "del" && !forzarCierre) {
        if(document.getElementById("mobil_documento").value == "") {
            var respuesta = confirm("Faltan datos, ¿introducir movil ahora?");
            if(respuesta == true) {
                document.getElementById("mobil_documento").focus();
                continuar = false;
            }
        }else if(document.getElementById("direccion_documento").value == "") {
            var respuesta = confirm("Faltan datos, ¿introducir dirección ahora?");
            if(respuesta == true) {
                document.getElementById("direccion_documento").focus();
                continuar = false;
            }
        }
    }

    if((tipoLibrador == "pro" || tipoLibrador == "cre") && document.getElementById("numero_documento").value == "" && !forzarCierre && idDocumento > 0) {
        continuar = false;

        let botonModalFacturacion = document.getElementById('boton-modal-facturacion');
        botonModalFacturacion.click();

        document.getElementById("numero_documento").focus();
        document.getElementById("numero_aviso").style.display = 'block';
    }

    if(continuar) {
        if (document.getElementById("fecha_documento").value == "" && !forzarCierre) {
            continuar = false;

            if (document.getElementById("capa-datos-cabecera-documento").style.display != "block") {
                document.getElementById("capa-datos-cabecera-documento").style.display = "block";
            }
            window.location.hash = "fecha_documento";

            document.getElementById("fecha_documento").focus();
            document.getElementById("fecha_aviso").style.display = 'block';
        }
    }

    if(continuar) {
        cerrandoDocumento = true;

        sessionStorage.setItem('id_sesion', '');
        sessionStorage.setItem('ip', '');
        sessionStorage.setItem('so', '');
        sessionStorage.setItem('ejercicio', '');
        sessionStorage.setItem('id_documento', '0');
        sessionStorage.removeItem('id_librador');
        sessionStorage.removeItem('tipo_librador');
        sessionStorage.removeItem('id_librador_tak');
        sessionStorage.removeItem('servicio_domicilio');

        let xhr = new XMLHttpRequest();
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);

                if (res.message && Array.isArray(res.terminales) && typeof window.sendMessage === "function") {
                    for (let i = 0; i < res.terminales.length; i++) {
                        if (location.host == 'software.blendi.es') {
                            window.sendMessage(id_panel, res.terminales[i], res.message);
                        }
                    }
                }

                idDocumento = '0';
                idLibrador = '0';
                // window.location.href = host_url;
                let capaTiquetCocinaModal = document.getElementById('capa-tiquet-cocina-modal');
                let botonOpenModalTiquetCocina = document.getElementById('botonOpenModalTiquetCocina');
                if (capaTiquetCocinaModal && botonOpenModalTiquetCocina && !capaTiquetCocinaModal.classList.contains('hidden')) {
                    botonOpenModalTiquetCocina.click();
                }
                let capaCobrarModal = document.getElementById('capa-cobrar-modal');
                let botonOpenModalCobrar = document.getElementById('botonOpenModalCobrar');
                if (capaCobrarModal && botonOpenModalCobrar && !capaCobrarModal.classList.contains('hidden')) {
                    botonOpenModalCobrar.click();
                }

                let familiaActual = document.querySelector('.categoria_menu.border-b-blendi-700');
                if (familiaActual) {
                    familiaActual.click();
                }

                cerrandoDocumento = false;
                actualizarCesta();
                cargarComedor();
            }
        }

        xhr.open("post", "/web-gestion/cerrar_documento.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("id_sesion_js", id_sesion_js);
        formData.append("ip", ip);
        formData.append("interface_js", interface_js);
        if(interface_js == "web") {
            formData.append("id_panel", id_panel);
        }
        /*
        if(document.getElementById("tipo_librador").value == "tak") {
            formData.append("accion", "guardar-tak");
            formData.append("id_documento", idDocumento);
            formData.append("ejercicio", ejercicio);
            formData.append("nombre_documento", document.getElementById("nombre_documento").value);
            formData.append("mobil_documento", document.getElementById("mobil_documento").value);
            formData.append("fecha_recogida_documento", document.getElementById("fecha_recogida_documento").value);
            formData.append("hora_recogida_documento", document.getElementById("hora_recogida_documento").value);
        }else if(document.getElementById("tipo_librador").value == "del") {
            formData.append("accion", "guardar-del");
            formData.append("id_documento", idDocumento);
            formData.append("ejercicio", ejercicio);
            formData.append("nombre_documento", document.getElementById("nombre_documento").value);
            formData.append("direccion_documento", document.getElementById("direccion_documento").value);
            formData.append("numero_direccion_documento", document.getElementById("numero_direccion_documento").value);
            formData.append("escalera_direccion_documento", document.getElementById("escalera_direccion_documento").value);
            formData.append("piso_direccion_documento", document.getElementById("piso_direccion_documento").value);
            formData.append("puerta_direccion_documento", document.getElementById("puerta_direccion_documento").value);
            formData.append("localidad_documento", document.getElementById("localidad_documento").value);
            formData.append("codigo_postal_documento", document.getElementById("codigo_postal_documento").value);
            formData.append("mobil_documento", document.getElementById("mobil_documento").value);
            formData.append("fecha_entrega_documento", document.getElementById("fecha_entrega_documento").value);
            formData.append("hora_entrega_documento", document.getElementById("hora_entrega_documento").value);
        }else {
            formData.append("accion", "");
        }
        */
        xhr.send(formData);
    }

    return continuar;
}

function buscarOpciones() {
    console.log("buscarOpciones de scripts.js raiz");
    var valor = document.getElementById("input-texto-buscar").value;
    var contenedor = document.querySelector("#capa-buscar-opciones-linea");
    if(valor.length > 2) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            contenedor.innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Buscando datos" title="Buscando datos" />';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                if(res.resultado == "con datos") {
                    var datoshtml = '';
                    for (var bucle = 0; bucle < res.opciones_encontradas.length; bucle++) {
                        if(res.imagen_encontradas[bucle] != "") {
                            datoshtml += '<img src="/images/productos/' + idPanel + '/' + res.imagen_encontradas[bucle]+'?ver='+res.updated_encontradas[bucle]+'" class="img-producto"' +
                                'alt="'+res.alt_encontradas[bucle]+'"' +
                                'title="'+res.tittle_encontradas[bucle]+'"" />';
                        }else {
                            datoshtml += '&nbsp;';
                        }
                        datoshtml += '<button class="w-100 mt-8p" onclick="seleccionarOpcion(\''+res.id_encontradas[bucle]+'\',\''+res.opciones_encontradas[bucle]+'\',\''+idCompuesto+'\',\''+idRelacionado+'\');">' + res.opciones_encontradas[bucle] + "</button>";
                    }

                }else {
                    var datoshtml = '<span class="font-bold color-red">' +
                        'No se han encontrado opciones con los datos introducidos.<br />' +
                        'Escribir un mínimo de tres carácteres.<br />' +
                        'Se mostrarán un máximo de diez resultados.' +
                        '</span>';
                }
                contenedor.innerHTML = datoshtml;
            }
        }

        xhr.open("post", "/web-gestion/datos-productos-ini.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("so", so);
        formData.append("id_idioma", id_idioma);
        formData.append("accion", "buscar-opciones");
        formData.append("buscar_opcion", valor);
        xhr.send(formData);
    }else {
        contenedor.innerHTML = '<span class="font-bold color-red">Escribir un mínimo de tres carácteres.<br />Se mostrarán un máximo de diez resultados.</span>';
    }
}
function seleccionarOpcion(idProducto,descripcionProducto,idCompuesto,idRelacionado) {
    console.log("seleccionarOpcion de scripts.js raiz");

    var contenedor = document.querySelector("#capa-opciones-linea-radios_"+idCompuesto+"_"+idRelacionado);

    var datoshtml = '' +
    '';

    contenedor.innerHTML = contenedor.innerHTML + datoshtml;
}
function sumarProductoCesta(idCapa,idElemento,idRelacionado,anadidoModal) {
    console.log("sumarProductoCesta de scripts.js raiz");
    document.getElementById(idCapa + idElemento + anadidoModal).value = parseFloat(document.getElementById(idCapa + idElemento + anadidoModal).value) + 1;
    if(document.getElementById(idCapa + idElemento + anadidoModal).value == 0) {
        document.getElementById(idCapa + idElemento + anadidoModal).value = 1;
    }
    modificarCantidades(idElemento,anadidoModal, true);
}
function restarProductoCesta(idCapa,idElemento,idRelacionado,anadidoModal) {
    console.log("restarProductoCesta de scripts.js raiz");
    document.getElementById(idCapa + idElemento + anadidoModal).value = parseFloat(document.getElementById(idCapa + idElemento + anadidoModal).value) - 1;
    if(document.getElementById(idCapa + idElemento + anadidoModal).value == 0) {
        document.getElementById(idCapa + idElemento + anadidoModal).value = -1;
    }
    modificarCantidades(idElemento,anadidoModal, true);
}
function sumarIncrementoProductoCesta(idCapa,idElemento,idRelacionado,anadidoModal) {
    console.log("sumarIncrementoProductoCesta de scripts.js raiz");
    document.getElementById(idCapa + idRelacionado + anadidoModal).value = parseFloat(document.getElementById(idCapa + idRelacionado + anadidoModal).value) + 1;
    modificarCantidades(idElemento,anadidoModal, true);
}
function sumarIncrementoProductoCestaCombo(idCapa,idElemento,idRelacionado,anadidoModal) {
    console.log("sumarIncrementoProductoCestaCombo de scripts.js raiz");
    document.getElementById(idCapa + idRelacionado+anadidoModal).value = parseFloat(document.getElementById(idCapa + idRelacionado+anadidoModal).value) + 1;
    modificarCantidadesCombo(0, anadidoModal, true);
}
function restarIncrementoProductoCesta(idCapa,idElemento,idRelacionado,anadidoModal) {
    console.log("restarIncrementoProductoCesta de scripts.js raiz");
    document.getElementById(idCapa + idRelacionado + anadidoModal).value = parseFloat(document.getElementById(idCapa + idRelacionado + anadidoModal).value) - 1;
    modificarCantidades(idElemento,anadidoModal, true);
}
function restarIncrementoProductoCestaCombo(idCapa,idElemento,idRelacionado,anadidoModal) {
    console.log("restarIncrementoProductoCestaCombo de scripts.js raiz");
    document.getElementById(idCapa + idRelacionado+anadidoModal).value = parseFloat(document.getElementById(idCapa + idRelacionado+anadidoModal).value) - 1;
    modificarCantidadesCombo(0, anadidoModal, true);
}

// Scripts producto relacionado
function checkCurrentRadio(element) {
    console.log("checkCurrentRadio de scripts.js raiz");

    let inputParaModificar = element.parentNode.querySelector('input[type="radio"]');
    if (inputParaModificar.checked) {
        return;
    }
    inputParaModificar.checked = true;
}
// END Scripts producto relacionado


// Scripts producto combo y compuesto

function sumarProductoCestaCombo(idCapa,idElemento,idRelacionado,anadidoModal) {
    console.log("sumarProductoCestaCombo de scripts.js raiz");
    document.getElementById(idCapa + idElemento+anadidoModal).value = parseFloat(document.getElementById(idCapa + idElemento+anadidoModal).value) + 1;
    if(document.getElementById(idCapa + idElemento+anadidoModal).value == 0) {
        document.getElementById(idCapa + idElemento+anadidoModal).value = 1;
    }
    modificarCantidadesCombo(0, anadidoModal, true);
}
function restarProductoCestaCombo(idCapa,idElemento,idRelacionado,anadidoModal) {
    console.log("restarProductoCestaCombo de scripts.js raiz");
    document.getElementById(idCapa + idElemento+anadidoModal).value = parseFloat(document.getElementById(idCapa + idElemento+anadidoModal).value) - 1;
    if(document.getElementById(idCapa + idElemento+anadidoModal).value == 0) {
        document.getElementById(idCapa + idElemento+anadidoModal).value = -1;
    }
    modificarCantidadesCombo(0, anadidoModal, true);
}
window.productoComboContador = 0;
function reiniciarProductoComboContador() {
    window.productoComboContador = 0;
}
function anadirProductoCombo(id_grupo, id_producto_por_grupo, anadidoModal, comprar, mostrar, cantidad, id_documento_combo) {
    console.log("anadirProductoCombo de scripts.js raiz");
    window.productoComboContador++;

    if (cantidad === undefined) {
        cantidad = 1;
    }

    var cadenaBuscar = '';
    var cadenaReemplazar = '';
    let hiddenMostrar = 'hidden';
    if (mostrar) {
        hiddenMostrar = '';
    }

    document.getElementById('total_productos_anadidos'+anadidoModal).value = window.productoComboContador.toString();

    let contenido = '';
    let contenidoOpciones = '';
    if (anadidoModal) {
        contenido = document.getElementById('formulario_producto_modal').querySelector("#producto_grupo_" + id_grupo + "_" + id_producto_por_grupo).innerHTML;
        contenidoOpciones = document.getElementById('formulario_producto_modal').querySelector("#producto_opciones_" + id_grupo + "_" + id_producto_por_grupo).innerHTML;
    } else {
        contenido = document.getElementById("producto_grupo_" + id_grupo + "_" + id_producto_por_grupo).innerHTML;
        contenidoOpciones = document.getElementById("producto_opciones_" + id_grupo + "_" + id_producto_por_grupo).innerHTML;
    }
    contenido = '<div id="productoComboCesta_' + window.productoComboContador+anadidoModal +'" class="' + hiddenMostrar + '" >' + contenido + contenidoOpciones + '</div>';

    // Modificamos la id de la nota de la nueva linea
    cadenaBuscar = 'nota-linea-' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '"';
    cadenaReemplazar = 'nota-linea-' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);
    cadenaBuscar = 'nota-linea-' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + "'";
    cadenaReemplazar = 'nota-linea-' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + "'";
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos el name de la nota de la nueva linea
    cadenaBuscar = 'nota-linea-' + id_grupo + '_' + id_producto_por_grupo + '"';
    cadenaReemplazar = 'nota-linea-' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);
    cadenaBuscar = 'nota-linea-' + id_grupo + '_' + id_producto_por_grupo + "'";
    cadenaReemplazar = 'nota-linea-' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + "'";
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos las class de productos relacionados unicos de la nueva linea
    cadenaBuscar = 'opcionRelacionadaTipo0Input"';
    cadenaReemplazar = 'opcionRelacionadaTipo0Input_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);
    cadenaBuscar = 'opcionRelacionadaTipo1Input"';
    cadenaReemplazar = 'opcionRelacionadaTipo1Input_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);
    cadenaBuscar = 'opcionRelacionadaTipo2Input"';
    cadenaReemplazar = 'opcionRelacionadaTipo2Input_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);
    cadenaBuscar = 'opcionRelacionadaTipo3Input"';
    cadenaReemplazar = 'opcionRelacionadaTipo3Input_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);
    cadenaBuscar = 'opcionRelacionadaTipo5Input"';
    cadenaReemplazar = 'opcionRelacionadaTipo5Input_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos las id de productos relacionados combo de la nueva linea
    cadenaBuscar = 'id_relacionado_combo_producto_grupos_' + id_grupo + '_' + id_producto_por_grupo + '"';
    cadenaReemplazar = 'id_relacionado_combo_producto_grupos_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos las id de productos relacionados combo de la nueva linea
    cadenaBuscar = 'id_relacionado_combo_producto_grupos_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '"';
    cadenaReemplazar = 'id_relacionado_combo_producto_grupos_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos las cantidades de productos relacionados combo de la nueva linea
    cadenaBuscar = 'cantidad_relacionado_combo_producto_grupos_' + id_grupo + '_' + id_producto_por_grupo + '" id';
    cadenaReemplazar = 'cantidad_relacionado_combo_producto_grupos_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '" id';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos las cantidades de productos relacionados combo de la nueva linea
    cadenaBuscar = 'cantidad_relacionado_combo_producto_grupos_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '" value="1"';
    cadenaReemplazar = 'cantidad_relacionado_combo_producto_grupos_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '" value="' + cantidad + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos las idDocumentoCombo de productos relacionados combo de la nueva linea
    cadenaBuscar = 'id_documentos_combo_' + id_grupo + '_' + id_producto_por_grupo + '" id';
    cadenaReemplazar = 'id_documentos_combo_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '" id';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos las idDocumentoCombo de productos relacionados combo de la nueva linea
    cadenaBuscar = 'id_documentos_combo_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '" value=""';
    cadenaReemplazar = 'id_documentos_combo_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '" value="' + id_documento_combo + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos el campo modificado de productos relacionados combo de la nueva linea
    cadenaBuscar = 'modificado_documentos_combo_' + id_grupo + '_' + id_producto_por_grupo + '" id';
    cadenaReemplazar = 'modificado_documentos_combo_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '" id';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos el campo modificado de productos relacionados combo de la nueva linea
    cadenaBuscar = 'modificado_documentos_combo_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '" value=""';
    cadenaReemplazar = 'modificado_documentos_combo_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '" value="' + ((mostrar)? '1' : '0') + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos el botón desplazar de la nueva linea (id, la clase hidden, src, alt y el onclick)
    cadenaBuscar = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 hidden" id="boton_desplazar_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '" onmouseover="this.style.cursor=\'pointer\'" onclick="document.location.href = \'#productos_anadidos'+anadidoModal+'\';">';
    if(contenido.indexOf(cadenaBuscar) < 0) {
        cadenaBuscar = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" id="boton_desplazar_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '" onmouseover="this.style.cursor=\'pointer\'" onclick="document.location.href = \'#productos_anadidos'+anadidoModal+'\';">';
    }
    cadenaReemplazar = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" id="boton_desplazar_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '" onmouseover="this.style.cursor=\'pointer\'" onclick="document.location.href = \'#producto_grupo_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '\';">';
    contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);

    cadenaBuscar = '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3"></path>';
    cadenaReemplazar = '<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18"></path>';
    contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);

    // Modificamos el botón desplazar de la línea origen
    let botonDesplazar = document.getElementById("boton_desplazar_" + id_grupo + "_" + id_producto_por_grupo+anadidoModal)
    botonDesplazar.classList.remove("hidden");

    // Modificamos el botón añadir de la nueva linea (id, src, alt y onclick)
    cadenaBuscar = '<div class="mt-1 mb-1 w-8 h-8 rounded-full text-white bg-blendi-600" id="boton_anadir_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '" onmouseover="this.style.cursor=\'pointer\'" onclick="anadirProductoCombo(\'' + id_grupo + '\', \'' + id_producto_por_grupo + '\', \'' + anadidoModal + '\', true, false, 1, \'\');"';
    cadenaReemplazar = '<div class="mt-1 mb-1 w-8 h-8 rounded-full text-white bg-blendi-600" id="boton_anadir_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '" onmouseover="this.style.cursor=\'pointer\'" onclick="eliminarProductoCombo(\'' + window.productoComboContador.toString() + '\',\'' + id_grupo + '\',\'' + id_producto_por_grupo + '\',\'' + anadidoModal + '\');"';
    contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);

    cadenaBuscar = '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>';
    cadenaReemplazar = '<path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />';
    contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);

    // Modificamos las id de la nueva linea parte 1
    cadenaBuscar = 'grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + ' producto_relacionado-grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '"';
    cadenaReemplazar = 'grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + ' producto_relacionado-grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos las id de la nueva linea parte 2 (Comilla doble)
    cadenaBuscar = 'grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '"';
    cadenaReemplazar = 'grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos las id de la nueva linea parte 2 (Comilla simple)
    cadenaBuscar = 'grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + "'";
    cadenaReemplazar = 'grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + "'";
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos los ids de con/sin de la nueva linea
    cadenaBuscar = 'toggle_con_sin' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '"';
    cadenaReemplazar = 'toggle_con_sin' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos los ids de con/sin de la nueva linea
    cadenaBuscar = 'texto' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '"';
    cadenaReemplazar = 'texto' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '"';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Sustitución de names en las opciones de producto
        // Modificamos el name de las opciones de la nueva linea
        cadenaBuscar = '_opciones_' + id_grupo + '"';
        cadenaReemplazar = '_opciones_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '"';
        do {
            contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
        }while(contenido.indexOf(cadenaBuscar) >-1);

        // Modificamos el name de las opcion de la nueva linea
        cadenaBuscar = '_opcion_' + id_grupo + '"';
        cadenaReemplazar = '_opcion_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '"';
        do {
            contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
        }while(contenido.indexOf(cadenaBuscar) >-1);
        cadenaBuscar = '_opcion_' + id_grupo + "'";
        cadenaReemplazar = '_opcion_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + "'";
        do {
            contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
        }while(contenido.indexOf(cadenaBuscar) >-1);

        // Modificamos el name de las cantidad de la nueva linea
        cadenaBuscar = '_cantidad_' + id_grupo + '"';
        cadenaReemplazar = '_cantidad_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '"';
        do {
            contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
        }while(contenido.indexOf(cadenaBuscar) >-1);
    // END Sustitución de names en las opciones de producto

    // Modificamos el onchange de las opciones de la nueva linea
    cadenaBuscar = '"modificarCantidades(';
    cadenaReemplazar = '"modificarCantidadesCombo(';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Modificamos el onclick de las opciones de la nueva linea
    cadenaBuscar = '"sumarIncrementoProductoCesta(';
    cadenaReemplazar = '"sumarIncrementoProductoCestaCombo(';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);
    cadenaBuscar = '"restarIncrementoProductoCesta(';
    cadenaReemplazar = '"restarIncrementoProductoCestaCombo(';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Mostramos el botón opciones de la nueva linea
    cadenaBuscar = '<div class="hidden capa-grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '">';
    cadenaReemplazar = '<div class="capa-grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '">';
    do {
        contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);
    }while(contenido.indexOf(cadenaBuscar) >-1);

    // Quitamos la propiedad select del option de la nueva linea
    cadenaBuscar = 'option_producto-grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '" selected="">';
    cadenaReemplazar = 'option_producto-grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString() + '">';
    contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);

    // Seleccionamos el option de la nueva linea que hay seleccionado en la linea origen
    var valueOption = document.getElementById("grupos_producto-grupos-opciones_" + id_grupo + "_" + id_producto_por_grupo+anadidoModal).value;
    cadenaBuscar = valueOption + '-option_producto-grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '">';
    cadenaReemplazar = valueOption + '-option_producto-grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '" selected>';
    contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);

    // Modificamos el name del select de grupos de la nueva linea
    cadenaBuscar = 'grupos_producto-grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo + '"';
    cadenaReemplazar = 'grupos_producto-grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '"';
    contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);

    cadenaBuscar = '"grupos_producto-grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '"';
    cadenaReemplazar = '"grupos_producto-grupos-opciones_' + id_grupo + '_' + id_producto_por_grupo + '_' + window.productoComboContador.toString() + '" onchange="modificarCombo();"';
    contenido = contenido.replace(cadenaBuscar,cadenaReemplazar);

    // Añadimos el nuevo contenido de la nueva linea al DOM
    var newNode = document.createElement('div');
    newNode.innerHTML = contenido;
    let newNodeContainer = document.getElementById("productos_anadidos"+anadidoModal);
    newNodeContainer.append(newNode);

    // Modificamos la cantidad de la linea origen
    if(document.getElementById("cantidad-grupos_producto-grupos-opciones_" + id_grupo + "_" + id_producto_por_grupo+anadidoModal).innerHTML.trim() == "&nbsp;") {
        document.getElementById("cantidad-grupos_producto-grupos-opciones_" + id_grupo + "_" + id_producto_por_grupo+anadidoModal).innerHTML = "1";
    }else {
        document.getElementById("cantidad-grupos_producto-grupos-opciones_" + id_grupo + "_" + id_producto_por_grupo+anadidoModal).innerHTML = Number(document.getElementById("cantidad-grupos_producto-grupos-opciones_" + id_grupo + "_" + id_producto_por_grupo+anadidoModal).innerHTML) + 1;
    }

    checkUniqueEmpty('0opcionRelacionadaTipo3Input_' + id_grupo + '_' + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString());

    modificarCantidadesCombo(0, anadidoModal, comprar);

    // Modificamos la cantidad de la nueva linea
    newNodeContainer.querySelector("#cantidad-grupos_producto-grupos-opciones_" + id_grupo + "_" + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString()).innerHTML = "1";

    // Mostramos el selector de grupo de la linea origen
    document.getElementById("grupos_producto-grupos-opciones_" + id_grupo + "_" + id_producto_por_grupo+anadidoModal + '_' + window.productoComboContador.toString()).parentElement.style.display = 'block';

    // Reseteamos el option seleccionado de la linea origen
    document.getElementById("grupos_producto-grupos-opciones_" + id_grupo + "_" + id_producto_por_grupo+anadidoModal).selectedIndex = id_grupo;

    // Mostramos la capa productos_anadidos
    // document.getElementById("productos_anadidos"+anadidoModal).style.display = "block";

    // Hacemos click en el botón opciones de la nueva linea
    newNodeContainer.querySelector("#capa-grupos-opciones_" + id_grupo + "_" + id_producto_por_grupo+anadidoModal + "_" + window.productoComboContador.toString()).click();

    // Mostramos el botón comprar
    // document.getElementById("boton_guardar_0"+anadidoModal).style.display = "block";

    // Ocultamos la información que no sean opciones del producto añadido
    let contenedoresDeInformacionDelProductoAnadido = document.getElementById('productoComboCesta_'+window.productoComboContador+anadidoModal).getElementsByClassName('card-body');
    for (let i = 0; i < contenedoresDeInformacionDelProductoAnadido.length; i++) {
        contenedoresDeInformacionDelProductoAnadido[i].style.display = 'none';
    }
}
function modificarGrupoAnadido(anidacion, grupo) {
    document.getElementById("grupos_producto-grupos-opciones_" + anidacion).value = grupo;
}
function modificarUnicoAnadido(anidacion, id_producto_relacionado) {
    console.log("modificarUnicoAnadido de scripts.js raiz");

    let radios = document.getElementsByClassName("0opcionRelacionadaTipo3Input_" + anidacion);
    for (let i = 0; i < radios.length; i++) {
        if (radios[i].value == id_producto_relacionado) {
            radios[i].parentElement.click();
        }
    }
}
function modificarCantidadAnadido(anidacion, key_id_producto_anadido, modelo, value) {
    document.getElementsByClassName(key_id_producto_anadido + "opcionRelacionadaTipo" + modelo + "Input_" + anidacion)[0].value = value
}
function modificarObservacionAnadido(anidacion, value) {
    document.getElementById("nota-linea-" + anidacion).innerHTML = value
}
function modificarAnadidoToogle(anidacion, key_id_producto_anadido, modelo, seleccion) {
    let toogle = document.getElementById("toggle_con_sin" + key_id_producto_anadido + "-grupos-opciones_" + anidacion);
    if (toogle) {
        if (seleccion === 'con' && toogle.checked != true) {
            toogle.checked = true;
            toogleElementoProductoCompuesto("toggle_con_sin" + key_id_producto_anadido + "-grupos-opciones_" + anidacion, "capa_toggle_con_sin" + key_id_producto_anadido + "-grupos-opciones_" + anidacion)
        }
    }
}
function modificarAnadidoTexto(anidacion, key_id_producto_anadido, modelo, texto) {
    let textoCapa = document.getElementById("texto" + key_id_producto_anadido + "-grupos-opciones_" + anidacion);
    if (textoCapa) {
        textoCapa.innerHTML = texto;
    }
}
function modificarAnadido(anidacion, key_id_producto_anadido, modelo, seleccion) {
    let radios = document.getElementsByClassName(key_id_producto_anadido + "opcionRelacionadaTipo" + modelo + "Input_" + anidacion);
    for (let i = 0; i < radios.length; i++) {
        if (radios[i].value == seleccion) {
            radios[i].checked = true;
        } else {
            radios[i].checked = false;
        }
    }
}
function eliminarProductoCombo(productoComboAEliminar, id_grupo, id_producto_por_grupo, anadidoModal) {
    console.log("eliminarProductoCombo de scripts.js raiz");

    // Se pondrá el modificar a 2, para marcarlo como eliminado.
    var modificarProductoCombo = document.getElementById('modificado_documentos_combo_' + id_grupo + '_' + id_producto_por_grupo + anadidoModal + '_' + productoComboAEliminar);
    modificarProductoCombo.value = 2;

    var elementoDondeObtenerRelacionados = document.querySelector('#productoComboCesta_' + productoComboAEliminar + anadidoModal);
    elementoDondeObtenerRelacionados.querySelector('.producto_grupo').dataset.price = '0';

    let opcionesRelacionadas = elementoDondeObtenerRelacionados.getElementsByClassName('opcionRelacionada');
    let opcionesRelacionadasInputs = null;
    if (opcionesRelacionadas.length !== undefined) {
        for (let opcionRelacionada = 0; opcionRelacionada < opcionesRelacionadas.length; opcionRelacionada++) {
            if (
                opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo0') ||
                opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo1') ||
                opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo3')
            ) {
                if (opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo0')) {
                    opcionesRelacionadasInputs = opcionesRelacionadas[opcionRelacionada].getElementsByClassName('opcionRelacionadaTipo0Input');
                }
                if (opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo1')) {
                    opcionesRelacionadasInputs = opcionesRelacionadas[opcionRelacionada].getElementsByClassName('opcionRelacionadaTipo1Input');
                }
                if (opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo3')) {
                    opcionesRelacionadasInputs = opcionesRelacionadas[opcionRelacionada].getElementsByClassName('opcionRelacionadaTipo3Input');
                }
                if (opcionesRelacionadasInputs.length !== undefined) {
                    for (let opcionRelacionadaInput = 0; opcionRelacionadaInput < opcionesRelacionadasInputs.length; opcionRelacionadaInput++) {
                        if (opcionesRelacionadasInputs[opcionRelacionadaInput].checked) {
                            if (isCombo) {
                                opcionesRelacionadasInputs[opcionRelacionadaInput].dataset.price = 0;
                            } else {
                                opcionesRelacionadasInputs[opcionRelacionadaInput].dataset.price = 0;
                            }
                        }
                    }
                }
            }
            if (opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo2')) {
                opcionesRelacionadasInputs = opcionesRelacionadas[opcionRelacionada].getElementsByClassName('opcionRelacionadaTipo2Input');
                if (opcionesRelacionadasInputs.length !== undefined) {
                    for (let opcionRelacionadaInput = 0; opcionRelacionadaInput < opcionesRelacionadasInputs.length; opcionRelacionadaInput++) {
                        if (isCombo) {
                            opcionesRelacionadasInputs[opcionRelacionadaInput].dataset.price = 0;
                        } else {
                            opcionesRelacionadasInputs[opcionRelacionadaInput].dataset.price = 0;
                        }
                    }
                }
            }
        }
    }


    document.getElementById("cantidad-grupos_producto-grupos-opciones_" + id_grupo + "_" + id_producto_por_grupo + anadidoModal).innerHTML = Number(document.getElementById("cantidad-grupos_producto-grupos-opciones_" + id_grupo + "_" + id_producto_por_grupo + anadidoModal).innerHTML) - 1;

    modificarCantidadesCombo(0, anadidoModal, true);

    comprarProducto('0','insertar-producto','0','0','0', anadidoModal);
}
function checkUniqueEmpty(optionsName) {
    console.log('checkUniqueEmpty de scripts.js raiz');

    let radios = document.getElementsByClassName(optionsName);
    let isChecked = false;
    for (let i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            isChecked = true
        }
    }
    if (!isChecked && radios.length) {
        radios[0].parentElement.click();
    }
}
function calcularIncrementosYPrecioTotal(cantidad, idElemento, elementoDondeObtenerRelacionados, isCombo, anadidoModal, comprar) {
    console.log("calcularIncrementosYPrecioTotal de scripts.js raiz");
    let opcionesRelacionadas = elementoDondeObtenerRelacionados.getElementsByClassName('opcionRelacionada');
    let opcionesRelacionadasInputs = null;
    let totalPrice = parseFloat(document.getElementById("pvp_linea_"+idElemento+anadidoModal).value * cantidad).toFixed(decimalesImportes);
    let totalIncremento = 0;
    if (isCombo) {
        let productosMadre = elementoDondeObtenerRelacionados.getElementsByClassName('producto_grupo');
        let cantidadProductoMadre = null;
        for (let productoMadre = 0; productoMadre < productosMadre.length; productoMadre++) {
            cantidadProductoMadre = productosMadre[productoMadre].querySelector('.cantidad_relacionado_combo_producto_grupos').value;
            totalPrice = (parseFloat(totalPrice) + (parseFloat(productosMadre[productoMadre].dataset.price) * cantidadProductoMadre));
            totalIncremento = parseFloat(totalIncremento) + (parseFloat(productosMadre[productoMadre].dataset.price) * cantidadProductoMadre);
        }
    }
    if (opcionesRelacionadas.length !== undefined) {
        for (let opcionRelacionada = 0; opcionRelacionada < opcionesRelacionadas.length; opcionRelacionada++) {
            if (
                opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo0') ||
                opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo1') ||
                opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo3')
            ) {
                if (opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo0')) {
                    opcionesRelacionadasInputs = opcionesRelacionadas[opcionRelacionada].getElementsByClassName('opcionRelacionadaTipo0Input');
                }
                if (opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo1')) {
                    opcionesRelacionadasInputs = opcionesRelacionadas[opcionRelacionada].getElementsByClassName('opcionRelacionadaTipo1Input');
                }
                if (opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo3')) {
                    opcionesRelacionadasInputs = opcionesRelacionadas[opcionRelacionada].getElementsByClassName('opcionRelacionadaTipo3Input');
                }
                if (opcionesRelacionadasInputs.length !== undefined) {
                    for (let opcionRelacionadaInput = 0; opcionRelacionadaInput < opcionesRelacionadasInputs.length; opcionRelacionadaInput++) {
                        if (opcionesRelacionadasInputs[opcionRelacionadaInput].checked) {
                            if (isCombo) {
                                totalPrice = (parseFloat(totalPrice) + parseFloat(opcionesRelacionadasInputs[opcionRelacionadaInput].dataset.price));
                                totalIncremento = parseFloat(totalIncremento) + parseFloat(opcionesRelacionadasInputs[opcionRelacionadaInput].dataset.price);
                            } else {
                                totalPrice = (parseFloat(totalPrice) + parseFloat(opcionesRelacionadasInputs[opcionRelacionadaInput].dataset.price) * cantidad);
                                totalIncremento = parseFloat(totalIncremento) + parseFloat(opcionesRelacionadasInputs[opcionRelacionadaInput].dataset.price) * cantidad;
                            }
                        }
                    }
                }
            }
            if (opcionesRelacionadas[opcionRelacionada].classList.contains('opcionRelacionadaTipo2')) {
                opcionesRelacionadasInputs = opcionesRelacionadas[opcionRelacionada].getElementsByClassName('opcionRelacionadaTipo2Input');
                if (opcionesRelacionadasInputs.length !== undefined) {
                    for (let opcionRelacionadaInput = 0; opcionRelacionadaInput < opcionesRelacionadasInputs.length; opcionRelacionadaInput++) {
                        if (isCombo) {
                            totalPrice = (parseFloat(totalPrice) + parseFloat(opcionesRelacionadasInputs[opcionRelacionadaInput].dataset.price) * parseFloat(opcionesRelacionadasInputs[opcionRelacionadaInput].value));
                            totalIncremento = parseFloat(totalIncremento) + parseFloat(opcionesRelacionadasInputs[opcionRelacionadaInput].dataset.price) * parseFloat(opcionesRelacionadasInputs[opcionRelacionadaInput].value);
                        } else {
                            totalPrice = (parseFloat(totalPrice) + parseFloat(opcionesRelacionadasInputs[opcionRelacionadaInput].dataset.price) * parseFloat(opcionesRelacionadasInputs[opcionRelacionadaInput].value) * cantidad);
                            totalIncremento = parseFloat(totalIncremento) + parseFloat(opcionesRelacionadasInputs[opcionRelacionadaInput].dataset.price) * parseFloat(opcionesRelacionadasInputs[opcionRelacionadaInput].value) * cantidad;
                        }
                    }
                }
            }
        }
    }

    document.getElementById("incremento_linea_"+idElemento+anadidoModal).value = parseFloat(totalIncremento).toFixed(decimalesImportes);
    document.getElementById("pvp_total_"+idElemento+anadidoModal).value = parseFloat(totalPrice).toFixed(decimalesImportes);
    document.getElementById("pvp_total_info_"+idElemento+anadidoModal).innerHTML = parseFloat(totalPrice).toFixed(decimalesImportes);
    let pvpSpanCombo = document.getElementById("pvp_span_combo_"+idElemento+anadidoModal);
    if(pvpSpanCombo) {
        if (interface_js == 'web') {
            pvpSpanCombo.innerHTML = parseFloat(totalPrice).toFixed(decimalesImportes).toString() + " €";
        } else {
            if (tipoLibrador === 'pro' || tipoLibrador === 'cre') {
                let precioTotalProCre = document.getElementById("precio_total_pro_cre"+anadidoModal);
                precioTotalProCre.innerHTML = parseFloat(totalPrice).toFixed(decimalesImportes).toString();
            }
        }
    }

    if (!anadidoModal && comprar) {
        comprarProducto('0','insertar-producto','0','0','0', '');
    }
}
function modificarCantidades(idElemento, anadidoModal, comprar) {
    console.log("modificarCantidades de scripts.js raiz");
    let cantidad = null;
    if (document.getElementById("cantidad_" + idElemento+anadidoModal).value === undefined) {
        cantidad = parseFloat(document.getElementById("cantidad_" + idElemento+anadidoModal).innerHTML);
    } else {
        cantidad = parseFloat(document.getElementById("cantidad_" + idElemento+anadidoModal).value);
    }
    // INICIO Modificación precio
    let elementoDondeObtenerRelacionados = document.getElementById('capaCentral-producto'+anadidoModal);
    calcularIncrementosYPrecioTotal(cantidad, idElemento, elementoDondeObtenerRelacionados, false, anadidoModal, comprar);
    // FIN Modifiación precio
}
function modificarCantidadesCombo(idElemento, anadidoModal, comprar) {
    console.log("modificarCantidadesCombo de scripts.js raiz");
    // Modificamos la cantidad y el precio del combo

    // INICIO Modificación cantidad

    let totalCombos = 0;

    // 3 manual
    // 4 automático
    let producto_grupos_tipo = document.getElementById('producto_grupos_tipo'+anadidoModal).value;

    // Calcular cantidad de productos añadidos por grupos
    let totalGrupoLineas = [];
    let indice = 0;
    let selectsGruposCesta = document.getElementById('productos_anadidos'+anadidoModal);
    selectsGruposCesta = selectsGruposCesta.getElementsByClassName('grupos_producto-grupos-opciones');
    for (let selectGruposCesta = 0; selectGruposCesta < selectsGruposCesta.length; selectGruposCesta++) {
        indice = selectsGruposCesta[selectGruposCesta].selectedIndex;
        if (totalGrupoLineas[indice] === undefined) {
            totalGrupoLineas[indice] = 1;
        } else {
            totalGrupoLineas[indice]++;
        }
    }

    // Definir la cantidad de productos añadidos por grupo mayor
    if (producto_grupos_tipo === '3') {
        totalCombos = document.getElementById('cantidad_0' + anadidoModal).value;
    } else if (producto_grupos_tipo === '4') {
        for (let grupoActual = 0; grupoActual < totalGrupoLineas.length; grupoActual++) {
            if (totalCombos < totalGrupoLineas[grupoActual]) {
                totalCombos = totalGrupoLineas[grupoActual];
            }
        }
    }


    // Poner en el título de los grupos la cantidad de productos añadidos
    for (let grupoActual = 0; grupoActual < document.getElementById("grupos_input_grupo_combo"+anadidoModal).value ; grupoActual++) {
        if(totalGrupoLineas[grupoActual] != undefined) {
            document.getElementById("cantidad_span_grupo_combo_" + grupoActual+anadidoModal).innerHTML = totalGrupoLineas[grupoActual] + " -";
        }else {
            document.getElementById("cantidad_span_grupo_combo_" + grupoActual+anadidoModal).innerHTML = "";
        }
    }

    if (producto_grupos_tipo === '4') {
        // Poner la cantidad total del producto madre si es combo automático
        document.getElementById("cantidad_0" + anadidoModal).innerHTML = totalCombos.toString();
    }

    // Si es combo automático muestra o oculta la opción comprar, cantidad y precio del producto madre
    if(document.getElementById("tipo_producto_0" + anadidoModal).value == 4) {
        if (totalCombos.toString() == "0") {
            document.getElementById("cantidad_0" + anadidoModal).style.display = "none";
            document.getElementById("capa_precio_comprar" + anadidoModal).style.display = "none";
        } else {
            document.getElementById("cantidad_0" + anadidoModal).style.display = "inline";
            document.getElementById("capa_precio_comprar" + anadidoModal).style.display = "block";
        }
    }

    // FIN Modificación cantidad

    // INICIO Modificación precio
    let productosAnadidos = document.getElementById('productos_anadidos'+anadidoModal);
    calcularIncrementosYPrecioTotal(totalCombos, 0, productosAnadidos, true, anadidoModal, comprar);
    // FIN Modifiación precio
}
function modificarCombo(anadidoModal) {
    console.log("modificarCombo de scripts.js raiz");
    modificarCantidadesCombo(0, anadidoModal, true);
}
// END scripts producto combo

function seleccionarTipoLibrador(tipo) {
    console.log("seleccionarTipoLibrador de scripts.js raiz, tipo: "+tipo);
    if(tipo == "cli") {
        document.getElementById("capa_librador_seleccionar_pro").style.display = "none";
        document.getElementById("capa_librador_seleccionar_cre").style.display = "none";
        document.getElementById("capa_librador_seleccionar_cli").style.display = "block";
    }else if(tipo == "pro") {
        document.getElementById("capa_librador_seleccionar_cli").style.display = "none";
        document.getElementById("capa_librador_seleccionar_cre").style.display = "none";
        document.getElementById("capa_librador_seleccionar_pro").style.display = "block";
    }else {
        document.getElementById("capa_librador_seleccionar_pro").style.display = "none";
        document.getElementById("capa_librador_seleccionar_cli").style.display = "none";
        document.getElementById("capa_librador_seleccionar_cre").style.display = "block";
    }
}

function datosFacturacionCesta(id_librador,origen) {
    console.log("datosFacturacionCesta de scripts.js raiz, id librador: "+id_librador+", origen: "+origen);
    if(origen == "cabecera") {
        if (id_librador == "-1") {
            document.getElementById('capa-datos-facturacion-tpv').style.display = "block";
            document.getElementById('capa-cesta').style.display = "block";
            collapseCapa('capa-datos-cabecera-facturacion');
            document.getElementById("id_librador_cesta_cli").value = id_librador;
            document.getElementById("capa_cabecera_lineas_cesta").style.display = 'none';
            if (mostrarCesta == "superior") {
                document.getElementById("capa_totales_cesta").style.display = 'none';
            } else {
                document.getElementById("capa_totales_cesta_1").style.display = 'none';
            }
            document.getElementById("capa_otros_datos_cesta").style.display = 'none';
            if (mostrarCesta == "lateral") {
                document.getElementById("capa_otros_datos_textarea_cesta").style.display = 'none';
            }
            if (mostrarCesta == "superior") {
                document.getElementById("capa_cabecera_botones_cesta").style.display = 'none';
            }
            document.getElementById("contenido_lineas").style.display = 'none';
            datosFacturacionCesta(id_librador, 'cesta');
        } else {
            document.getElementById('id_librador_seleccionar').value = id_librador;
            identificar('3');
        }
    }else {
        document.getElementById("id_librador_seleccionar").value = id_librador;
        document.getElementById("id_librador_cesta").value = id_librador;

        if (id_librador < 0) { // Nuevo librador
            //document.getElementById("input-radio-embalajes-nuevo-cliente").style.display = "inline-grid";
            //document.getElementById("codigo_librador_documento").value = "";
            document.getElementById("nombre_documento").value = "";
            document.getElementById("apellido_1_documento").value = "";
            document.getElementById("apellido_2_documento").value = "";
            document.getElementById("razon_social_documento").value = "";
            document.getElementById("razon_comercial_documento").value = "";
            document.getElementById("nif_documento").value = "";
            document.getElementById("direccion_documento").value = "";
            document.getElementById("numero_direccion_documento").value = "";
            document.getElementById("escalera_direccion_documento").value = "";
            document.getElementById("piso_direccion_documento").value = "";
            document.getElementById("puerta_direccion_documento").value = "";
            document.getElementById("localidad_documento").value = "";
            document.getElementById("codigo_postal_documento").value = "";
            document.getElementById("provincia_documento").value = "";
            //document.getElementById("telefono_1_documento").value = "";
            //document.getElementById("telefono_2_documento").value = "";
            //document.getElementById("fax_documento").value = "";
            document.getElementById("mobil_documento").value = "";
            document.getElementById("email_documento").value = "";
            document.getElementById("persona_contacto_documento").value = "";

            document.getElementById("capa-datos-cabecera-facturacion").style.display = "block";

            document.getElementById("check_guardar_datos_facturacion_cesta").checked = true;
            document.getElementById("check_guardar_datos_facturacion_cesta").disabled = true;

            //document.getElementById("codigo_librador_documento").focus();
        } else {

            identificar('3');
        }
    }
}

function marcarVolcar(idsDocumentos,idsDocumentos2) {
    let documentoVolcar = null;
    let lineaVolcar = null;
    if(document.getElementById("checkbox-volcar-enviar").checked == true) {
        for(let bucle = 0 ; bucle < idsDocumentos.length ; bucle++) {
            documentoVolcar = document.getElementById("documento_volcar_" + bucle);
            if (documentoVolcar) {
                documentoVolcar.checked = true;
                for (let bucle2 = 0 ; bucle2 < idsDocumentos2.length ; bucle2++) {
                    lineaVolcar = document.getElementById("linea_volcar_" + bucle2);
                    if (idsDocumentos2[bucle2] == idsDocumentos[bucle] && lineaVolcar) {
                        lineaVolcar.checked = true;
                    }
                }
            }
        }
    }else {
        for(let bucle = 0 ; bucle < idsDocumentos.length ; bucle++) {
            documentoVolcar = document.getElementById("documento_volcar_" + bucle);
            if (documentoVolcar) {
                documentoVolcar.checked = false;
                for (let bucle2 = 0 ; bucle2 < idsDocumentos2.length ; bucle2++) {
                    lineaVolcar = document.getElementById("linea_volcar_" + bucle2);
                    if (idsDocumentos2[bucle2] == idsDocumentos[bucle] && lineaVolcar) {
                        lineaVolcar.checked = false;
                    }
                }
            }
        }
    }
}
function marcarDesmarcarPadreVolcar(bucle,idDocumento1,idsDocumentos2) {
    let mercarDesmarcar = false;
    let lineaVolcar = null;
    for (let bucle2 = 0 ; bucle2 < idsDocumentos2.length ; bucle2++) {
        if (idsDocumentos2[bucle2] == idDocumento1) {
            lineaVolcar = document.getElementById("linea_volcar_" + bucle2);
            if (lineaVolcar && lineaVolcar.checked) {
                mercarDesmarcar = true;
            }
        }
    }
    document.getElementById("documento_volcar_" + bucle).checked = mercarDesmarcar;
}
function marcarLineasVolcar(bucle,idDocumento1,idsDocumentos2) {
    let lineaVolcar = null;
    for (let bucle2 = 0 ; bucle2 < idsDocumentos2.length ; bucle2++) {
        if (idsDocumentos2[bucle2] == idDocumento1) {
            lineaVolcar = document.getElementById("linea_volcar_" + bucle2);
            if (document.getElementById("documento_volcar_" + bucle).checked == true) {
                if (lineaVolcar) {
                    document.getElementById("linea_volcar_" + bucle2).checked = true;
                }
            } else {
                if (lineaVolcar) {
                    document.getElementById("linea_volcar_" + bucle2).checked = false;
                }
            }
        }
    }
}
function marcarEnviar(idsDocumentos) {
    if(document.getElementById("checkbox-marcar-enviar").checked == true) {
        for(let bucle = 0 ; bucle < idsDocumentos ; bucle++) {
            document.getElementById("documento_enviar_" + bucle).checked = true;
        }
    }else {
        for(let bucle = 0 ; bucle < idsDocumentos ; bucle++) {
            document.getElementById("documento_enviar_" + bucle).checked = false;
        }
    }
}
function enviarDocumentos(documentos,ejercicios) {
    console.log("enviarDocumentos de scripts.js raiz");

    /*
    Si solo se debe enviar capa-enviar-facturas-documentosun mail, hacerlo de inmediato.
    Si hay más de un mail a enviar, abrir nueva ventana mostrando el proceso de envio.
    */

    let documentosAEnviar = [];
    let mailsAEnviar = [];
    let ejerciciosAEnviar = [];
    for (let i = 0; i < documentos.length; i++) {
        if (document.getElementById('documento_enviar_' + i).checked) {
            documentosAEnviar.push(documentos[i]);
            mailsAEnviar.push(document.getElementById('email_documento_enviar_' + i).value);
            ejerciciosAEnviar.push(ejercicios[i]);
        }
    }

    document.getElementById("boton-enviar-mail").style.display = "none";

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        document.getElementById("capa_enviando_mail").innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Enviando..." title="Enviando..." />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            document.getElementById("boton-enviar-mail").style.display = "block";
            document.getElementById("capa_enviando_mail").innerHTML = "";
        }
    }
    xhr.open("post", "/enviar_mails/gestionar_pdf.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("id_idioma", id_idioma);
    formData.append("ejercicios", ejerciciosAEnviar);
    formData.append("interface_js", interface_js);
    if(interface_js == "web") {
        formData.append("id_panel", id_panel);
    }
    formData.append("tipo_librador", tipoLibrador);
    formData.append("select", "enviar-documentos");
    formData.append("documentos", documentosAEnviar);
    formData.append("mails", mailsAEnviar);
    formData.append("decimales_cantidades", decimalesCantidades);
    formData.append("decimales_importes", decimalesImportes);
    xhr.send(formData);
}

function marcarImprimir(idsDocumentos) {
    if(document.getElementById("checkbox-marcar-imprimir").checked == true) {
        for(let bucle = 0 ; bucle < idsDocumentos ; bucle++) {
            document.getElementById("documento_imprimir_" + bucle).checked = true;
        }
    }else {
        for(let bucle = 0 ; bucle < idsDocumentos ; bucle++) {
            document.getElementById("documento_imprimir_" + bucle).checked = false;
        }
    }
}
function imprimirDocumentos(documentos,ejercicios) {
    console.log("imprimirDocumentos de scripts.js raiz");

    let documentosAImprimir = [];
    for (let i = 0; i < documentos.length; i++) {
        if (document.getElementById('documento_imprimir_' + i).checked) {
            documentosAImprimir.push(documentos[i]);
        }
    }

    document.getElementById("boton-imprimir").style.display = "none";

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        document.getElementById("capa_imprimiendo").innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Imprimiendo..." title="Imprimiendo..." />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            document.getElementById("boton-imprimir").style.display = "block";
            document.getElementById("capa_imprimiendo").innerHTML = "";
            /*
            let filesToPrint = [];
            for (let bucle = 0; bucle < res.nombrePDF.length; bucle++) {
                filesToPrint.push(host + "/enviar_mails/ficheros/" + id_panel + "/" + res.nombrePDF[bucle]);
            }
            */
            var printPage = window.open(host + "enviar_mails/ficheros/" + id_panel + "/" + res.nombrePDF , "PDF", "fullscreen=yes,scrollbars=NO");

            printPage.onload = function() {
                printPage.print();
            };
        }
    }
    xhr.open("post", "/enviar_mails/gestionar_pdf.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("id_idioma", id_idioma);
    formData.append("ejercicios", ejercicios);
    formData.append("interface_js", interface_js);
    if(interface_js == "web") {
        formData.append("id_panel", id_panel);
    }
    formData.append("tipo_librador", tipoLibrador);
    formData.append("select", "imprimir-documentos");
    formData.append("documentos", documentosAImprimir);
    formData.append("decimales_cantidades", decimalesCantidades);
    formData.append("decimales_importes", decimalesImportes);
    xhr.send(formData);
}

function comprobarCantidad(id,valorMaximo) {
    /*if(document.getElementById("cantidad_"+id).value > valorMaximo) {
        document.getElementById("cantidad_"+id).value = valorMaximo;
    }*/
}
function eliminarDocumento(id_documento, ejercicio_documentos_1,linea = false) {
    console.log("eliminarDocumento de scripts.js raiz");

    let eliminar = false;
        if (!linea || confirm("¿Eliminar el documento?")) {
            eliminar = true;
        }
    if(eliminar == true) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            if (linea) {
                document.getElementById("linea-otros-documentos-" + linea).innerHTML = "Eliminando...";
            }
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                if (linea) {
                    document.getElementById("linea-otros-documentos-" + linea).style.display = "none";
                }

                if (idDocumento) {
                    cerrarDocumento();
                }
            }
        }
        xhr.open("post", "/web-gestion/eliminar_documento.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("so", so);
        formData.append("idioma", idioma);
        formData.append("id_idioma", id_idioma);
        formData.append("interface_js", interface_js);
        if (interface_js == "web") {
            formData.append("id_panel", id_panel);
        }
        formData.append("tipo_librador", tipoLibrador);
        formData.append("id_documento", id_documento);
        formData.append("ejercicio_documentos", ejercicio_documentos_1);
        xhr.send(formData);
    }
}
function abonarDocumento(id_documento, ejercicio_documentos_1) {
    console.log("abonarDocumento de scripts.js raiz");

    let abonar = false;
    if (confirm("¿Abonar el documento?")) {
        abonar = true;
    }
    if(abonar == true && tiquet.length) {
        tipoOrigen = tipoDocumento;
        tipoVolcado = tipoDocumento;

        let datosDocumentosAVolcar = [];
        let datosDocumentoAVolcar = null;
        let lineaDocumento = null;
        datosDocumentoAVolcar = {};
        datosDocumentoAVolcar.ejercicio = ejercicio_documentos_1;
        datosDocumentoAVolcar.id = id_documento;
        datosDocumentoAVolcar.lineas = [];
        for (let bucle2 = 0; bucle2 < tiquet[0].productosPorGrupo.length; bucle2++) {
            for (let bucle3 = 0; bucle3 < tiquet[0].productosPorGrupo[bucle2].productos.length; bucle3++) {
                lineaDocumento = {};
                lineaDocumento.id = tiquet[0].productosPorGrupo[bucle2].productos[bucle3].id_documento_2;
                var productoCantidad = parseFloat(tiquet[0].productosPorGrupo[bucle2].productos[bucle3].cantidad);
                lineaDocumento.cantidad = -productoCantidad;
                lineaDocumento.lote = '';
                lineaDocumento.caducidad = '';
                lineaDocumento.numero_serie = '';
                datosDocumentoAVolcar.lineas.push(lineaDocumento);
            }
        }
        if (datosDocumentoAVolcar.lineas.length) {
            datosDocumentosAVolcar.push(datosDocumentoAVolcar)
        }

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);

                console.log(res.mensaje);

                if (idDocumento) {
                    cerrarDocumento();
                }
            }
        }

        xhr.open("post", "/web-gestion/volcar-documentos.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("so", so);
        formData.append("idioma", idioma);
        formData.append("interface_js", interface_js);
        formData.append("ejercicio", ejercicio);
        formData.append("documentos_a_volcar", JSON.stringify(datosDocumentosAVolcar));
        formData.append("tipo_origen", tipoOrigen);
        formData.append("tipo_volcado", tipoVolcado);
        formData.append("tipo_librador", tipoLibrador);
        let objectDate = new Date();
        let day = objectDate.getDate();
        let month = objectDate.getMonth() + 1;
        let year = objectDate.getFullYear();
        formData.append("fecha", year + '-' + month + '-' + day);
        if (tipoLibrador == 'cli') {
            formData.append("serie", '');
        } else {
            formData.append("numero_documento", (new Date()).valueOf());
        }
        xhr.send(formData);
    }
}
function imprimirDatos() {
    let datos = document.getElementById('capa-otros-documentos').innerHTML;
    var ventimp = window.open();
    ventimp.document.write( datos );
    ventimp.print();
    ventimp.close();
}
function seleccionarPestanaFechaHoraOtrosDocumentos(opcion) {
    let pestanaTituloVolcarFechaHoraOtrosDocumentos = document.getElementById('pestana-titulo-volcar-fecha-hora-otros-documentos');
    let pestanaTituloImprimirFechaHoraOtrosDocumentos = document.getElementById('pestana-titulo-imprimir-fecha-hora-otros-documentos');
    let pestanaTituloMailFechaHoraOtrosDocumentos = document.getElementById('pestana-titulo-mail-fecha-hora-otros-documentos');
    let pestanaTituloResultadosFechaHoraOtrosDocumentos = document.getElementById('pestana-titulo-resultados-fecha-hora-otros-documentos');
    let pestanaTituloActualFechaHoraOtrosDocumentos = document.getElementById('pestana-titulo-' + opcion + '-fecha-hora-otros-documentos');

    if (pestanaTituloVolcarFechaHoraOtrosDocumentos) {
        pestanaTituloVolcarFechaHoraOtrosDocumentos.classList.remove('font-bold');
    }
    if (pestanaTituloImprimirFechaHoraOtrosDocumentos) {
        pestanaTituloImprimirFechaHoraOtrosDocumentos.classList.remove('font-bold');
    }
    if (pestanaTituloMailFechaHoraOtrosDocumentos) {
        pestanaTituloMailFechaHoraOtrosDocumentos.classList.remove('font-bold');
    }
    if (pestanaTituloResultadosFechaHoraOtrosDocumentos) {
        pestanaTituloResultadosFechaHoraOtrosDocumentos.classList.remove('font-bold');
    }
    if (pestanaTituloActualFechaHoraOtrosDocumentos) {
        pestanaTituloActualFechaHoraOtrosDocumentos.classList.add('font-bold');
    }
}
function mostrarPestanaFechaHora(capaAMostrar) {
    let capaVolcarFechaHoraOtrosDocumentos = document.getElementById('capa-volcar-facturas-documentos');
    let capaImprimirFechaHoraOtrosDocumentos = document.getElementById('capa-imprimir-documentos');
    let capaMailFechaHoraOtrosDocumentos = document.getElementById('capa-enviar-facturas-documentos');
    let capaResultadosFechaHoraOtrosDocumentos = document.getElementById('capa-titulos-listado-otros-documentos');
    let capaListadoResultados = document.getElementById('capa_listado_resultados');
    let capaActualFechaHoraOtrosDocumentos = document.getElementById(capaAMostrar);

    if (capaVolcarFechaHoraOtrosDocumentos && !capaVolcarFechaHoraOtrosDocumentos.classList.contains('hidden')) {
        capaVolcarFechaHoraOtrosDocumentos.classList.add('hidden');
    }
    if (capaImprimirFechaHoraOtrosDocumentos && !capaImprimirFechaHoraOtrosDocumentos.classList.contains('hidden')) {
        capaImprimirFechaHoraOtrosDocumentos.classList.add('hidden');
    }
    if (capaMailFechaHoraOtrosDocumentos && !capaMailFechaHoraOtrosDocumentos.classList.contains('hidden')) {
        capaMailFechaHoraOtrosDocumentos.classList.add('hidden');
    }
    if (capaResultadosFechaHoraOtrosDocumentos && !capaResultadosFechaHoraOtrosDocumentos.classList.contains('hidden')) {
        capaResultadosFechaHoraOtrosDocumentos.classList.add('hidden');
    }
    if (capaListadoResultados && !capaListadoResultados.classList.contains('hidden')) {
        capaListadoResultados.classList.add('hidden');
    }
    if (capaActualFechaHoraOtrosDocumentos && capaActualFechaHoraOtrosDocumentos.classList.contains('hidden')) {
        capaActualFechaHoraOtrosDocumentos.classList.remove('hidden');

        if (capaAMostrar == 'capa-titulos-listado-otros-documentos') {
            capaListadoResultados.classList.remove('hidden');
            if (capaResultadosFechaHoraOtrosDocumentos) {
                capaResultadosFechaHoraOtrosDocumentos.classList.remove('hidden');
            }
        }
    }
}
function seleccionarPestanaOtrosDocumentos(apartado, opcion) {
    let pestanaTituloAbiertosRecogidasOtrosDocumentos = document.getElementById('pestana-titulo-abiertos-recogidas-otros-documentos');
    let pestanaTituloAbiertosDomicilioOtrosDocumentos = document.getElementById('pestana-titulo-abiertos-entregas-otros-documentos');
    let pestanaTituloAbiertosLocalOtrosDocumentos = document.getElementById('pestana-titulo-abiertos-local-otros-documentos');
    let pestanaTituloAbiertosGlobalOtrosDocumentos = document.getElementById('pestana-titulo-abiertos-global-otros-documentos');
    let pestanaTituloUltimosOtrosDocumentos = document.getElementById('pestana-titulo-ultimos-global-otros-documentos');
    let pestanaTituloAbiertosOtrosDocumentos = document.getElementById('pestana-titulo-abiertos-global-otros-documentos');
    let pestanaTituloFechaHoraOtrosDocumentos = document.getElementById('pestana-titulo-fecha-hora-global-otros-documentos');
    let pestanaTituloActualOtrosDocumentos = document.getElementById('pestana-titulo-' + opcion + '-' + apartado + '-otros-documentos');

    if (pestanaTituloAbiertosRecogidasOtrosDocumentos) {
        pestanaTituloAbiertosRecogidasOtrosDocumentos.classList.remove('bg-white');
    }
    if (pestanaTituloAbiertosDomicilioOtrosDocumentos) {
        pestanaTituloAbiertosDomicilioOtrosDocumentos.classList.remove('bg-white');
    }
    if (pestanaTituloAbiertosLocalOtrosDocumentos) {
        pestanaTituloAbiertosLocalOtrosDocumentos.classList.remove('bg-white');
    }
    if (pestanaTituloAbiertosGlobalOtrosDocumentos) {
        pestanaTituloAbiertosGlobalOtrosDocumentos.classList.remove('bg-white');
    }
    if (pestanaTituloUltimosOtrosDocumentos) {
        pestanaTituloUltimosOtrosDocumentos.classList.remove('bg-white');
    }
    if (pestanaTituloAbiertosOtrosDocumentos) {
        pestanaTituloAbiertosOtrosDocumentos.classList.remove('bg-white');
    }
    if (pestanaTituloFechaHoraOtrosDocumentos) {
        pestanaTituloFechaHoraOtrosDocumentos.classList.remove('bg-white');
    }
    if (pestanaTituloActualOtrosDocumentos) {
        pestanaTituloActualOtrosDocumentos.classList.add('bg-white');
    }

    // Reseteamos la capa-otros-documentos como la visible
    let capaOtrosDocumentos = document.getElementById('capa-otros-documentos');
    let capaVolcarFechaHoraOtrosDocumentos = document.getElementById('capa-volcar-facturas-documentos');
    let capaImprimirFechaHoraOtrosDocumentos = document.getElementById('capa-imprimir-documentos');
    let capaMailFechaHoraOtrosDocumentos = document.getElementById('capa-enviar-facturas-documentos');
    let capaResultadosFechaHoraOtrosDocumentos = document.getElementById('capa-titulos-listado-otros-documentos');
    capaOtrosDocumentos.classList.remove('hidden');
    capaResultadosFechaHoraOtrosDocumentos.classList.remove('hidden');
    capaVolcarFechaHoraOtrosDocumentos.classList.add('hidden');
    capaImprimirFechaHoraOtrosDocumentos.classList.add('hidden');
    capaMailFechaHoraOtrosDocumentos.classList.add('hidden');
}
window.aod_capa = 'capa-otros-documentos';
window.aod_apartado = 'global';
window.aod_opcion = 'fecha-hora';
window.aod_accion = '';
window.aod_titulo = '';
window.pagina = 1;
window.resultados = 10;
function actualizarOtrosDocumentos(capa,apartado,opcion,accion,titulo = '') {
    window.aod_capa = capa;
    window.aod_apartado = apartado;
    window.aod_opcion = opcion;
    window.aod_accion = accion;
    window.aod_titulo = titulo;
    // Actualizar otros documentos

    let filtrosActualizarDocumentos = document.getElementsByClassName('filtro_actualizar_documentos');
    for (let i = 0; i < filtrosActualizarDocumentos.length; i++) {
        filtrosActualizarDocumentos[i].checked = false;
    }
    let filterToCheck = document.getElementById('pestana-titulo-' + opcion + '-' + apartado + '-otros-documentos');
    if (filterToCheck) {
        let capaTituloOtrosDocumentos = document.getElementById('titulo-otros-documentos');
        if (capaTituloOtrosDocumentos) {
            capaTituloOtrosDocumentos.innerHTML = (titulo == '')? opcion : titulo;
        }
        filterToCheck.checked = true;
    }

    let capaSeries = document.getElementById('serie-otros-documento');
    let serie = '';
    if (capaSeries) {
        serie = capaSeries.value;
    }

    zonaDisplay = 'documentos';
    gestionDeCapasGenerales();


    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            let capaOtrosDocumentos = document.getElementById('capa-otros-documentos');
            capaOtrosDocumentos.innerHTML = this.responseText;

            nodeScriptReplace(capaOtrosDocumentos);
        }
    }

    xhr.open("post", host_url, true);
    let formData = new FormData();
    formData.append("apartado", apartado);
    formData.append("opcion", opcion);
    formData.append("id_librador", document.getElementById('id-librador-otros-documento').value);
    formData.append("fecha_desde", document.getElementById('fecha-desde-otros-documento').value);
    formData.append("fecha_hasta", document.getElementById('fecha-hasta-otros-documento').value);
    formData.append("hora_desde", document.getElementById('hora-desde-otros-documento').value);
    formData.append("hora_hasta", document.getElementById('hora-hasta-otros-documento').value);
    formData.append("pagina", window.pagina);
    formData.append("resultados", window.resultados);
    formData.append("serie", serie);
    formData.append("ajax", 1);
    formData.append("ajax_documentos", 1);
    xhr.send(formData);
}
function actualizarOtrosDocumentosDownloadCsv() {
    // Actualizar otros documentos download csv

    let aodLayer_id_sesion = document.getElementById('actualizar-otros-documentos-csv-id_sesion');
    aodLayer_id_sesion.value = idSesion;
    let aodLayer_ip = document.getElementById('actualizar-otros-documentos-csv-ip');
    aodLayer_ip.value = ip;
    let aodLayer_so = document.getElementById('actualizar-otros-documentos-csv-so');
    aodLayer_so.value = so;
    let aodLayer_idioma = document.getElementById('actualizar-otros-documentos-csv-idioma');
    aodLayer_idioma.value = idSesion;
    let aodLayer_id_idioma = document.getElementById('actualizar-otros-documentos-csv-id_idioma');
    aodLayer_id_idioma.value = id_idioma;
    let aodLayer_ejercicio = document.getElementById('actualizar-otros-documentos-csv-ejercicio');
    aodLayer_ejercicio.value = ejercicio;
    let aodLayer_interface_js = document.getElementById('actualizar-otros-documentos-csv-interface_js');
    aodLayer_interface_js.value = interface_js;
    let aodLayer_tipo_documento = document.getElementById('actualizar-otros-documentos-csv-tipo_documento');
    aodLayer_tipo_documento.value = tipoDocumento;
    let aodLayer_tipo_librador = document.getElementById('actualizar-otros-documentos-csv-tipo_librador');
    aodLayer_tipo_librador.value = tipoLibrador;
    let aodLayer_apartado = document.getElementById('actualizar-otros-documentos-csv-apartado');
    aodLayer_apartado.value = window.aod_apartado;
    let aodLayer_id_librador_tak = document.getElementById('actualizar-otros-documentos-csv-id_librador_tak');
    aodLayer_id_librador_tak.value = idLibradorTak;
    let aodLayer_servicio_domicilio = document.getElementById('actualizar-otros-documentos-csv-servicio_domicilio');
    aodLayer_servicio_domicilio.value = servicioDomicilio;
    let aodLayer_opcion = document.getElementById('actualizar-otros-documentos-csv-opcion');
    aodLayer_opcion.value = window.aod_opcion;
    let aodLayer_fecha_desde = document.getElementById('actualizar-otros-documentos-csv-fecha_desde');
    aodLayer_fecha_desde.value = '';
    let aodLayer_fecha_hasta = document.getElementById('actualizar-otros-documentos-csv-fecha_hasta');
    aodLayer_fecha_hasta.value = '';
    let aodLayer_hora_desde = document.getElementById('actualizar-otros-documentos-csv-hora_desde');
    aodLayer_hora_desde.value = '';
    let aodLayer_hora_hasta = document.getElementById('actualizar-otros-documentos-csv-hora_hasta');
    aodLayer_hora_hasta.value = '';
    let aodLayer_id_librador = document.getElementById('actualizar-otros-documentos-csv-id_librador');
    aodLayer_id_librador.value = '';
    let aodLayer_serie = document.getElementById('actualizar-otros-documentos-csv-serie');
    aodLayer_serie.value = '';
    if(window.aod_apartado == "global" || window.aod_apartado == "global-fecha-hora") {
        aodLayer_fecha_desde.value = document.getElementById("fecha-desde-otros-documento").value;
        aodLayer_fecha_hasta.value = document.getElementById("fecha-hasta-otros-documento").value;
        aodLayer_hora_desde.value = document.getElementById("hora-desde-otros-documento").value;
        aodLayer_hora_hasta.value = document.getElementById("hora-hasta-otros-documento").value;
        aodLayer_id_librador.value = document.getElementById("id-librador-otros-documento").value;
        let serieOtrosDocumentos = document.getElementById("serie-otros-documento");
        if (serieOtrosDocumentos) {
            aodLayer_serie.value = serieOtrosDocumentos.value;
        } else {
            aodLayer_serie.value = "-2";
        }
    }
    let aodLayer_descarga_url = document.getElementById('actualizar-otros-documentos-csv-descarga_url');
    aodLayer_descarga_url.value = 'csv';

    let aodLayer_form = document.getElementById('actualizar-otros-documentos-csv');
    aodLayer_form.action = host_url;
}
function loadDropdownResultadosOtrosDocumentosListado() {
    // set the dropdown menu element
    let targetElResultados = document.getElementById('dropdownResultadosMenu');

    // set the element that trigger the dropdown menu on click
    let triggerElResultados = document.getElementById('dropdownResultados');

    // options with default values
    let optionsResultados = {
        placement: 'bottom',
    };

    let dropdown = new Dropdown(targetElResultados, triggerElResultados, optionsResultados);
}
function listadoOtrosDocumentosPagina(pagina) {
    window.pagina = pagina;

    actualizarOtrosDocumentos(window.aod_capa, window.aod_apartado, window.aod_opcion, window.aod_accion, window.aod_titulo);
}

function listadoOtrosDocumentosMostrarResultados(resultados) {
    window.pagina = 1;
    window.resultados = resultados;

    actualizarOtrosDocumentos(window.aod_capa, window.aod_apartado, window.aod_opcion, window.aod_accion, window.aod_titulo);
}
function abrirDocumento(idDocumentoAbrir,ejercicio,idLibrador,documentoBloqueado=0) {
    console.log("abrirDocumento de scripts.js raiz");

    if (documentoBloqueado && documentoBloqueado > 0) {
        let continuarConDocumentoBloqueado = confirm('El documento está bloqueado por tanto podría estar trabajando otro compañero con él. ¿Quieres continuar de todas formas?');

        if (!continuarConDocumentoBloqueado) {
            return;
        }
    }

    sessionStorage.setItem('ejercicio', ejercicio);
    sessionStorage.setItem('id_documento', idDocumentoAbrir);
    idDocumento = idDocumentoAbrir;
    sessionStorage.setItem('id_librador', idLibrador);

    datosFacturacionCesta(idLibrador, 'abrirDocumento');
    /*let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            window.location.href = host_url + 'abrir-documento';
        }
    }
    xhr.open("post", "/web-gestion/abrir_documento.php", true);
    let formData = new FormData();
    formData.append("ejercicio", ejercicio);
    formData.append("id_documento", idDocumentoAbrir);
    formData.append("id_sesion_js", id_sesion_js);
    xhr.send(formData);*/
}

function datosEnvioCesta(id, id_librador, accion) {
    if(accion == "seleccionar-envio") {
        console.log("datosEnvioCesta seleccionar-envio de scripts.js raiz");
        //var contenedor = document.querySelector("#capa_eliminar_producto_"+idLinea);

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            //contenedor.innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Eliminando datos" title="Cargando datos" />';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);

                document.getElementById("nombre_envio_documento").value = res.librador_nombre;
                document.getElementById("razon_social_envio_documento").value = res.librador_social;
                document.getElementById("razon_comercial_envio_documento").value = res.librador_comercial;
                document.getElementById("direccion_envio_documento").value = res.direccion;
                document.getElementById("numero_direccion_envio_documento").value = res.numero;
                document.getElementById("escalera_direccion_envio_documento").value = res.escalera;
                document.getElementById("piso_direccion_envio_documento").value = res.piso;
                document.getElementById("puerta_direccion_envio_documento").value = res.puerta;
                document.getElementById("localidad_envio_documento").value = res.localidad;
                document.getElementById("codigo_postal_envio_documento").value = res.codigo_postal;
                document.getElementById("provincia_envio_documento").value = res.provincia;
                document.getElementById("telefono_1_envio_documento").value = res.telefono_1;
                document.getElementById("telefono_2_envio_documento").value = res.telefono_2;
                document.getElementById("mobil_envio_documento").value = res.mobil;
                document.getElementById("persona_contacto_envio_documento").value = res.persona_contacto;
                document.getElementById("observaciones_envio_documento").value = res.observaciones;

                document.getElementById("capa-datos-cabecera-envio").style.display = "block";
                document.getElementById('icono-collapse-capa-datos-cabecera-envio').src = "/icons/System/arrow-drop-up-line.svg";

                document.getElementById("check_guardar_datos_envio_cesta").checked = false;
                document.getElementById("check_guardar_datos_envio_cesta").disabled = false;
            }
        }

        xhr.open("post", "/web-gestion/datos-pre-librador.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("id_sesion_js", id_sesion_js);
        formData.append("ip", ip);
        formData.append("so", so);
        formData.append("idioma", idioma);
        formData.append("id_idioma", id_idioma);
        formData.append("select", accion);
        formData.append("ejercicio", ejercicio);
        formData.append("interface_js", interface_js);
        formData.append("id_librador", id_librador);
        formData.append("id_documento", idDocumento);
        formData.append("id_datos_envio", id);
        xhr.send(formData);
    }else if(accion == "guardar-envio") {
        console.log("datosEnvioCesta guardar-envio de scripts.js raiz");
        //var contenedor = document.querySelector("#capa_eliminar_producto_"+idLinea);

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            //contenedor.innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Eliminando datos" title="Cargando datos" />';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);

                document.getElementById("nombre_envio_documento").value = res.librador_nombre;
                document.getElementById("razon_social_envio_documento").value = res.librador_social;
                document.getElementById("razon_comercial_envio_documento").value = res.librador_comercial;
                document.getElementById("direccion_envio_documento").value = res.direccion;
                document.getElementById("numero_direccion_envio_documento").value = res.numero;
                document.getElementById("escalera_direccion_envio_documento").value = res.escalera;
                document.getElementById("piso_direccion_envio_documento").value = res.piso;
                document.getElementById("puerta_direccion_envio_documento").value = res.puerta;
                document.getElementById("localidad_envio_documento").value = res.localidad;
                document.getElementById("codigo_postal_envio_documento").value = res.codigo_postal;
                document.getElementById("provincia_envio_documento").value = res.provincia;
                document.getElementById("telefono_1_envio_documento").value = res.telefono_1;
                document.getElementById("telefono_2_envio_documento").value = res.telefono_2;
                document.getElementById("mobil_envio_documento").value = res.mobil;
                document.getElementById("persona_contacto_envio_documento").value = res.persona_contacto;
                document.getElementById("observaciones_envio_documento").value = res.observaciones;

                document.getElementById("capa-datos-cabecera-envio").style.display = "block";
                document.getElementById('icono-collapse-capa-datos-cabecera-envio').src = "/icons/System/arrow-drop-up-line.svg";

                document.getElementById("check_guardar_datos_envio_cesta").checked = false;
                document.getElementById("check_guardar_datos_envio_cesta").disabled = false;
            }
        }

        xhr.open("post", "/web-gestion/datos-pre-librador.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("id_sesion_js", id_sesion_js);
        formData.append("ip", ip);
        formData.append("so", so);
        formData.append("idioma", idioma);
        formData.append("id_idioma", id_idioma);
        formData.append("select", accion);
        formData.append("ejercicio", ejercicio);
        formData.append("interface_js", interface_js);
        formData.append("id_librador", id_librador);
        formData.append("id_documento", idDocumento);
        formData.append("id_datos_envio", id);
        formData.append( "nombre_envio_documento", document.getElementById("nombre_envio_documento").value);
        formData.append( "apellido_1_envio", document.getElementById("apellido_1_envio").value);
        formData.append( "apellido_2_envio", document.getElementById("apellido_2_envio").value);
        formData.append( "razon_social_envio_documento", document.getElementById("razon_social_envio_documento").value);
        formData.append( "razon_comercial_envio_documento", document.getElementById("razon_comercial_envio_documento").value);
        formData.append( "direccion_envio_documento", document.getElementById("direccion_envio_documento").value);
        formData.append( "numero_direccion_envio_documento", document.getElementById("numero_direccion_envio_documento").value);
        formData.append( "escalera_direccion_envio_documento", document.getElementById("escalera_direccion_envio_documento").value);
        formData.append( "piso_direccion_envio_documento", document.getElementById("piso_direccion_envio_documento").value);
        formData.append( "puerta_direccion_envio_documento", document.getElementById("puerta_direccion_envio_documento").value);
        formData.append( "localidad_envio_documento", document.getElementById("localidad_envio_documento").value);
        formData.append( "codigo_postal_envio_documento", document.getElementById("codigo_postal_envio_documento").value);
        formData.append( "provincia_envio_documento", document.getElementById("provincia_envio_documento").value);
        formData.append( "id_zona_envio", document.getElementById("id_zona_envio").value);
        formData.append( "telefono_1_envio_documento", document.getElementById("telefono_1_envio_documento").value);
        formData.append( "telefono_2_envio_documento", document.getElementById("telefono_2_envio_documento").value);
        formData.append( "mobil_envio_documento", document.getElementById("mobil_envio_documento").value);
        formData.append( "persona_contacto_envio_documento", document.getElementById("persona_contacto_envio_documento").value);
        formData.append( "observaciones_envio_documento", document.getElementById("observaciones_envio_documento").value);
        if(document.getElementById("check_guardar_datos_envio_cesta").checked) {
            formData.append( "actualizar_ficha", 1);
        }else {
            formData.append( "actualizar_ficha", 0);
        }
        xhr.send(formData);
    }
}
function copiarDatosFacturacion(id, id_librador) {
    document.getElementById("nombre_envio_documento").value = document.getElementById("nombre_documento").value;
    document.getElementById("apellido_1_envio").value = document.getElementById("apellido_1_documento").value;
    document.getElementById("apellido_2_envio").value = document.getElementById("apellido_2_documento").value;
    document.getElementById("razon_social_envio_documento").value = document.getElementById("razon_social_documento").value;
    document.getElementById("razon_comercial_envio_documento").value = document.getElementById("razon_comercial_documento").value;
    document.getElementById("direccion_envio_documento").value = document.getElementById("direccion_documento").value;
    document.getElementById("numero_direccion_envio_documento").value = document.getElementById("numero_direccion_documento").value;
    document.getElementById("escalera_direccion_envio_documento").value = document.getElementById("escalera_direccion_documento").value;
    document.getElementById("piso_direccion_envio_documento").value = document.getElementById("piso_direccion_documento").value;
    document.getElementById("puerta_direccion_envio_documento").value = document.getElementById("puerta_direccion_documento").value;
    document.getElementById("localidad_envio_documento").value = document.getElementById("localidad_documento").value;
    document.getElementById("codigo_postal_envio_documento").value = document.getElementById("codigo_postal_documento").value;
    document.getElementById("provincia_envio_documento").value = document.getElementById("provincia_documento").value;
    document.getElementById("telefono_1_envio_documento").value = document.getElementById("telefono_1_documento").value;
    document.getElementById("telefono_2_envio_documento").value = document.getElementById("telefono_2_documento").value;
    document.getElementById("mobil_envio_documento").value = document.getElementById("mobil_documento").value;
    document.getElementById("persona_contacto_envio_documento").value = document.getElementById("persona_contacto_documento").value;

    document.getElementById("check_guardar_datos_envio_cesta").checked = true;
    datosEnvioCesta(id, id_librador,'guardar-envio');
}

function mostrarCapasEnvio(id) {
    if(id == 1) {
        if(mostrarCesta == "superior") {
            document.getElementById("capa_cabecera_cesta").setAttribute("class", "grid-2-cesta");
        }
        document.getElementById("id_modalidad_sin_envio").style.display = "block";
        document.getElementById("id_modalidad_envio").style.display = "none";
        document.getElementById("capa_envio_cesta").style.display = "none";
    }else {
        if(mostrarCesta == "superior") {
            document.getElementById("capa_cabecera_cesta").setAttribute("class", "grid-3-cesta");
        }
        document.getElementById("id_modalidad_sin_envio").style.display = "none";
        document.getElementById("id_modalidad_envio").style.display = "block";
        document.getElementById("capa_envio_cesta").style.display = "block";
    }
}
function modificarBancoCobro(bucle) {
    console.log("modificarBancoCobro de scripts.js raiz");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        /* contenedor.innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Actualizando datos" title="Actualizando datos" />'; */
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            cobrarModal();
        }
    }
    xhr.open("post", "/web-gestion/guardar_pago_datos_varios.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("ejercicio", ejercicio);
    formData.append("id_documento_1", idDocumento);
    formData.append("accion", "banco");
    formData.append("id_accion", document.getElementById("select-banco_pagado_" + bucle).value);
    formData.append("numero_efecto", (bucle + 1));
    xhr.send(formData);
}
function modificarFechaCobro(bucle) {
    console.log("modificarFechaCobro de scripts.js raiz");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        /* contenedor.innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Actualizando datos" title="Actualizando datos" />'; */
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            cobrarModal();
        }
    }
    xhr.open("post", "/web-gestion/guardar_pago_datos_varios.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("ejercicio", ejercicio);
    formData.append("id_documento_1", idDocumento);
    formData.append("accion", "fecha-cobro");
    formData.append("fecha_accion", document.getElementById("fecha_pagado_" + bucle).value);
    formData.append("numero_efecto", (bucle + 1));
    xhr.send(formData);
}
function modificarMetodoCobro(bucle) {
    console.log("modificarMetodoCobro de scripts.js raiz");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        /* contenedor.innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Actualizando datos" title="Actualizando datos" />'; */
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            cobrarModal();
        }
    }
    xhr.open("post", "/web-gestion/guardar_pago_datos_varios.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("ejercicio", ejercicio);
    formData.append("id_documento_1", idDocumento);
    formData.append("accion", "metodo-cobro");
    formData.append("id_accion", document.getElementById("select-metodo_pagado_" + bucle).value);
    formData.append("numero_efecto", (bucle + 1));
    xhr.send(formData);
}
function modificarUsuarioCobro(bucle) {
    console.log("modificarBancoCobro de scripts.js raiz");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        /* contenedor.innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Actualizando datos" title="Actualizando datos" />'; */
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            cobrarModal();
        }
    }
    xhr.open("post", "/web-gestion/guardar_pago_datos_varios.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("ejercicio", ejercicio);
    formData.append("id_documento_1", idDocumento);
    formData.append("accion", "usuario");
    formData.append("id_accion", document.getElementById("select-usuario_pagado_" + bucle).value);
    formData.append("numero_efecto", (bucle + 1));
    xhr.send(formData);
}
function datosCobrar(productos) {
    console.log("datosCobrar de scripts.js raiz");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        /* contenedor.innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Actualizando datos" title="Actualizando datos" />'; */
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            let tipoDocumento = "factura";
            if(res.tipo_documento == "tiq") {
                tipoDocumento = "tiquet";
            }
            document.getElementById("total_fraccionar").value = res.total;
            document.getElementById("capa_cobrar_dato_total").innerHTML = res.total + " €";
            document.getElementById("capa-dividir_cobro").style.display = "block";
            document.getElementById("capa-boton-dividir_cobro").style.display = "block";
            document.getElementById("capa-boton-por_producto_cobro").style.display = "none";
            if(res.estado != 2 && res.id_recibos && res.id_recibos.length == 1) {
                let cantidaProductosDividir = 0;
                for (let bucle_cantidad = 0 ; bucle_cantidad < res.cantidad.length ; bucle_cantidad++) {
                    cantidaProductosDividir += parseFloat(res.cantidad[bucle_cantidad]);
                }
                if(cantidaProductosDividir > 1) {
                    document.getElementById("capa-boton-por_producto_cobro").style.display = "block";
                }
            }

            if(res.estado != 0) {
                document.getElementById("id_modalidad_pago_cobrar").disabled = true;
            }else {
                document.getElementById("id_modalidad_pago_cobrar").disabled = false;
            }

            if(res.id_recibos) {
                for (let bucle = 0 ; bucle < res.id_recibos.length ; bucle++) {
                    if(res.pagado_recibos[bucle] == 1) {
                        document.getElementById("capa-dividir_cobro").style.display = "none";
                        document.getElementById("capa-boton-dividir_cobro").style.display = "none";
                        document.getElementById("capa-datos-pago_realizado_"+bucle).style.display = "inline-grid";
                        document.getElementById("capa-datos-realizar_pago_"+bucle).style.display = "none";
                        document.getElementById("capa-botones-cambio_a_devolver_"+bucle).style.display = "none";
                        document.getElementById("capa-botones-imprimir_pago_"+bucle).style.display = "none";
                        document.getElementById("capa-botones-metodos_pago_ejecutar_"+bucle).style.display = "none";
                        document.getElementById("capa-documento_bancario_"+bucle).style.display = "none";
                        document.getElementById("capa-vencimiento_documento_bancario_"+bucle).style.display = "none";
                        document.getElementById("capa-fecha_pago_"+bucle).style.display = "none";
                        document.getElementById("capa-nota_"+bucle).style.display = "none";
                        document.getElementById("capa-banco_pago_"+bucle).style.display = "none";
                        document.getElementById("capa-importe_pagado_"+bucle).innerHTML = "Importe cobrado:<br />" + res.importe_recibos[bucle] + " €";
                        document.getElementById("capa-vencimiento_pagado_"+bucle).innerHTML = "Vencimiento:<br />" + res.vencimiento_recibos[bucle];
                        document.getElementById("capa-documento_bancario_pagado_"+bucle).innerHTML = "Documento bancario:<br />" + res.documento_bancario[bucle];
                        document.getElementById("capa-vencimiento_documento_bancario_pagado_"+bucle).innerHTML = "Vencimiento d. bancario:<br />" + res.vencimiento_documento_bancario[bucle];
                        document.getElementById("capa-nota_pagado_"+bucle).innerHTML = "Nota:<br />" + res.nota[bucle];

                        /* document.getElementById("capa-banco_pagado_"+bucle).innerHTML = "Banco / Caja:<br />" + res.id_banco_caja_ingreso_recibos[bucle]; */
                        var contenido = "";
                        contenido += '<label class="py-2">Banco / Caja</label><br>';
                        contenido += '<select class="w-100" id="select-banco_pagado_' + bucle + '" name="select-banco_pagado_' + bucle + '" onchange="modificarBancoCobro(' + bucle + ');" required>\n';
                            if(res.id_bancos_cajas_ingreso_recibos.length) {
                                for (let bucleBancos = 0; bucleBancos < res.id_bancos_cajas_ingreso_recibos.length; bucleBancos++) {
                                    let selected = "";
                                    if (res.id_banco_caja_ingreso_recibos[bucle] == res.id_bancos_cajas_ingreso_recibos[bucleBancos]) {
                                        selected = " selected";
                                    }
                                    contenido += '<option value="' + res.id_bancos_cajas_ingreso_recibos[bucleBancos] + '"' + selected + '>' + res.bancos_cajas_ingreso_recibos[bucleBancos] + '' + res.iban_bancos_cajas_ingreso_recibos[bucleBancos] + '</option>\n';
                                }
                            }else {
                                contenido += '<option value="' + res.id_bancos_cajas_ingreso_recibos + '" selected>' + res.bancos_cajas_ingreso_recibos + '' + res.iban_bancos_cajas_ingreso_recibos + '</option>\n';
                            }
                        contenido += '</select>\n';
                        document.getElementById("capa-banco_pagado_"+bucle).innerHTML = contenido;

                        /* document.getElementById("capa-fecha_pagado_"+bucle).innerHTML = "Fecha cobro:<br />" + res.fecha_pago_recibos[bucle]; */
                        contenido = '<label class="py-2">Fecha cobro</label><br>';
                        contenido += '<input type="date" name="fecha_pagado_' + bucle + '" id="fecha_pagado_' + bucle + '" class="w-full" value="' + res.fecha_pago_recibos[bucle] + '" onchange="modificarFechaCobro(' + bucle + ');" />\n';
                        document.getElementById("capa-fecha_pagado_"+bucle).innerHTML = contenido;

                        contenido = '<label class="py-2">Método cobro</label><br>';
                        contenido += '<select id="select-metodo_pagado_' + bucle + '" name="select-metodo_pagado_' + bucle + '" onchange="modificarMetodoCobro(' + bucle + ');" required>\n';
                        if(res.id_metodos_pago_recibos.length) {
                            for (let bucleMetodos = 0 ; bucleMetodos < res.id_metodos_pago_recibos.length ; bucleMetodos++) {
                                let selected = "";
                                if (res.id_metodo_pago_recibos[bucle] == res.id_metodos_pago_recibos[bucleMetodos]) {
                                    selected = " selected";
                                }
                                contenido += '<option value="' + res.id_metodos_pago_recibos[bucleMetodos] + '"' + selected + '>' + res.metodos_pago_recibos[bucleMetodos] + '</option>\n';
                            }
                        }else {
                            contenido += '<option value="' + res.id_metodos_pago_recibos + '" selected>' + res.metodos_pago_recibos + '</option>\n';
                        }
                        contenido += '</select>\n';
                        document.getElementById("capa-metodo_pagado_"+bucle).innerHTML = contenido;
                        contenido = "";

                        document.getElementById("capa-efecto_pagado_"+bucle).innerHTML = "Número efecto:<br />" + res.numero_efecto_recibos[bucle];

                        /* document.getElementById("capa-usuario_pagado_"+bucle).innerHTML = "Usuario responsable:<br />" + res.id_usuario_pago_recibos[bucle]; */
                        /*
                        $logs->id_usuario_pago_recibos = $id_usuario_pago_recibos;

                        $logs->id_usuarios_pago_recibos = $id_usuarios_pago_recibos;
                        $logs->usuarios_pago_recibos = $usuarios_pago_recibos;
                        */
                        contenido = '<label class="py-2">Usuario responsable</label><br>';
                        contenido += '<select id="select-usuario_pagado_' + bucle + '" name="select-usuario_pagado_' + bucle + '" onchange="modificarUsuarioCobro(' + bucle + ');" required>\n';
                        if(res.id_usuarios_pago_recibos.length) {
                            for (let bucleUsuarios = 0 ; bucleUsuarios < res.id_usuarios_pago_recibos.length ; bucleUsuarios++) {
                                let selected = "";
                                if (res.id_usuario_pago_recibos[bucle] == res.id_usuarios_pago_recibos[bucleUsuarios]) {
                                    selected = " selected";
                                }
                                contenido += '<option value="' + res.id_usuarios_pago_recibos[bucleUsuarios] + '"' + selected + '>' + res.usuarios_pago_recibos[bucleUsuarios] + '</option>\n';
                            }
                        }else {
                            contenido += '<option value="' + res.id_usuarios_pago_recibos + '" selected>' + res.usuarios_pago_recibos + '</option>\n';
                        }
                        contenido += '</select>\n';
                        document.getElementById("capa-usuario_pagado_"+bucle).innerHTML = contenido;
                        contenido = "";

                        if(res.impreso_recibos[bucle] == 1) {
                            document.getElementById("capa-impreso_pagado_" + bucle).innerHTML = '<div class="py-2">Recibo impreso<br />SI</div>';
                        }else {
                            document.getElementById("capa-impreso_pagado_" + bucle).innerHTML = '<div class="py-2">Recibo impreso<br />NO</div>';
                        }

                    }else {
                        if (document.getElementById('proximo_recibo_a_pagar').value < 0) {
                            document.getElementById('proximo_recibo_a_pagar').value = bucle;
                        }
                        document.getElementById("capa-datos-pago_realizado_"+bucle).style.display = "none";
                        document.getElementById("capa-datos-realizar_pago_"+bucle).style.display = "inline-grid";
                        document.getElementById("capa-botones-cambio_a_devolver_"+bucle).style.display = "block";
                        document.getElementById("capa-botones-imprimir_pago_"+bucle).style.display = "block";
                        document.getElementById("capa-importe-cobrar_"+bucle).innerHTML = res.importe_recibos[bucle]; /* +++ */
                        document.getElementById("importe-cobrar_"+bucle).value = res.importe_recibos[bucle]; /* +++ */
                        document.getElementById("importe-entregado_"+bucle).value = res.importe_recibos[bucle]; /* +++ */
                        if(ultimoElementoImporteEntregado == -1) {
                            ultimoElementoImporteEntregado = bucle;
                        }
                    }
                }
            }
            if(productos == "1") {
                porProductoCobro();
            }
        }
    }
    xhr.open("post", "/web-gestion/documento_actualizar.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("ejercicio", ejercicio);
    formData.append("interface_js", interface_js);
    formData.append("tipo_librador", tipoLibrador);
    if(interface_js == "web") {
        $id_panel = id_panel;
    }
    formData.append("id_documento_1", idDocumento);
    formData.append("decimales_cantidades", decimalesCantidades);
    formData.append("decimales_importes", decimalesImportes);
    formData.append("funcion_origen", "datosCobrar");
    xhr.send(formData);
}
function mostrarCambio(numero_efecto) {
    console.log("mostrarCambio de scripts.js raiz");

    let importeCobrar = document.getElementById("importe-cobrar_"+numero_efecto).value;
    let importeEntregado = document.getElementById("importe-entregado_"+numero_efecto).value;
    let cambio = (parseFloat(importeEntregado) - parseFloat(importeCobrar)).toFixed(2);

    if(parseFloat(cambio) >= 0.00) {
        document.getElementById("importe-cambio_" + numero_efecto).innerHTML = "Cambio: " + cambio + " €";
    }else {
        document.getElementById("importe-cambio_" + numero_efecto).innerHTML = "Generar cobro parcial.";
    }
    document.getElementById("importe-entregado_"+numero_efecto).focus();
}
function mostrarCambio_1(numero_efecto) {
    console.log("mostrarCambio_1 de scripts.js raiz");

    let importeCobrar = document.getElementById("importe-cobrar_1_"+numero_efecto).value;
    let importeEntregado = document.getElementById("importe-entregado_1_"+numero_efecto).value;
    let cambio = (parseFloat(importeEntregado) - parseFloat(importeCobrar)).toFixed(2);

    if(parseFloat(cambio) >= 0.00) {
        document.getElementById("importe-cambio_1_" + numero_efecto).innerHTML = "Cambio: " + cambio + " €";
    }else {
        document.getElementById("importe-cambio_1_" + numero_efecto).innerHTML = "Faltan " + parseFloat(cambio).toFixed(2) + " €";
    }
    document.getElementById("importe-entregado_1_"+numero_efecto).focus();
}
function seleccionarMetodoDePago(elementoMetodoSeleccionado, claseTodosLosMetodos) {
    let borderSelected = 'border-blendi-600';
    let borderNotSelected = 'border-gray-300';
    if (document.getElementById('toggle_dark_mode').checked) {
        borderSelected = 'border-gray-300';
        borderNotSelected = 'border-blendi-600';
    }

    let metodosDePago = document.getElementsByClassName(claseTodosLosMetodos);
    let metodoRadioSeleccionado = null;
    let metodoRadioASeleccionar = null;
    let checkMetodo = null;
    let descripcionMetodo = null;
    for (let i = 0; i < metodosDePago.length; i++) {
        if (metodosDePago[i].classList.contains(borderSelected)) {
            metodosDePago[i].classList.remove(borderSelected);
            metodosDePago[i].classList.add(borderNotSelected);
            metodoRadioSeleccionado = metodosDePago[i].querySelector('input[name=id_' + claseTodosLosMetodos + ']:checked');
            if (metodoRadioSeleccionado) {
                metodoRadioSeleccionado.checked = false;
            }
            checkMetodo = metodosDePago[i].querySelector('.check_' + claseTodosLosMetodos);
            if (checkMetodo) {
                if (!checkMetodo.classList.contains('hidden')) {
                    checkMetodo.classList.add('hidden');
                }
            }
            descripcionMetodo = metodosDePago[i].querySelector('.descripcion_' + claseTodosLosMetodos);
            if (descripcionMetodo) {
                if (!descripcionMetodo.classList.contains('mr-10')) {
                    descripcionMetodo.classList.add('mr-10');
                }
            }
        }
    }

    if (elementoMetodoSeleccionado.classList.contains(borderNotSelected)) {
        elementoMetodoSeleccionado.classList.remove(borderNotSelected);
        elementoMetodoSeleccionado.classList.add(borderSelected);
        metodoRadioASeleccionar = elementoMetodoSeleccionado.querySelector('input[name=id_' + claseTodosLosMetodos + ']');
        if (metodoRadioASeleccionar) {
            metodoRadioASeleccionar.checked = true;
        }
    }

    checkMetodo = elementoMetodoSeleccionado.querySelector('.check_' + claseTodosLosMetodos);
    if (checkMetodo) {
        if (checkMetodo.classList.contains('hidden')) {
            checkMetodo.classList.remove('hidden');
        }
    }

    descripcionMetodo = elementoMetodoSeleccionado.querySelector('.descripcion_' + claseTodosLosMetodos);
    if (descripcionMetodo) {
        if (descripcionMetodo.classList.contains('mr-10')) {
            descripcionMetodo.classList.remove('mr-10');
        }
    }
}
function cobrarDocumento(libradorTipo) {
    console.log("cobrarDocumento de scripts.js raiz");
    console.log("cobrarDocumento de scripts.js raiz window.location.href host_url + libradorTipo");
    window.location.href = host_url + libradorTipo;
}
function enviarDoucmento(numeroEfecto) {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {

        }
    }
    xhr.open("post", "/enviar_mails/enviar_documento.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("id_usuario", idUsuario);
    formData.append("ejercicio", ejercicio);
    formData.append("id_documento_1", idDocumento);
    formData.append("mail", document.getElementById("enviar_al_cobrar_mail_"+numeroEfecto).value);
    xhr.send(formData);
}
function cobrarDocumentoEjecutar(libradorTipo,idMetodosPago,numeroEfecto) {
    console.log("cobrarDocumentoEjecutar de scripts.js raiz");
    document.getElementById("capa-banco_pago_"+numeroEfecto).style.display = "none";

    if (document.getElementById("enviar_al_cobrar_si_"+numeroEfecto).checked) {
        enviarDoucmento(numeroEfecto);
    }

    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            if(document.getElementById("imprimir_al_cobrar_si_" + numeroEfecto).checked) {
                if (res.resultado == "cobrado-total") {
                    var ejecutarCerrar = "cobrado-total";
                } else {
                    var ejecutarCerrar = libradorTipo;
                }
                imprimirDocumento(res.id_documento_1,res.ejercicio,ejecutarCerrar,numeroEfecto);
            }else {
                if (res.resultado == "cobrado-total") {
                    cerrarDocumento();
                } else {
                    cobrarModal();
                }
            }
        }
    }
    xhr.open("post", "/web-gestion/guardar_pago.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("id_usuario", idUsuario);
    formData.append("ejercicio", ejercicio);
    formData.append("id_documento_1", idDocumento);
    formData.append("id_metodos_pago", idMetodosPago);
    formData.append("documento_bancario", document.getElementById("documento_bancario_"+numeroEfecto).value);
    formData.append("vencimiento_documento_bancario", document.getElementById("vencimiento_documento_bancario_"+numeroEfecto).value);
    formData.append("fecha_pago", document.getElementById("fecha_pago_"+numeroEfecto).value);
    formData.append("nota", document.getElementById("nota_"+numeroEfecto).value);
    formData.append("id_banco_cobro", document.getElementById("id_banco_cobro_"+numeroEfecto).value);
    formData.append("importe_cobrar", document.getElementById("importe-cobrar_"+numeroEfecto).value);
    formData.append("importe_entregado", document.getElementById("importe-entregado_"+numeroEfecto).value);
    formData.append("numero_efecto", numeroEfecto);
    xhr.send(formData);
}
function cobrarDocumentoEjecutarDirecto(idMetodosPago) {
    console.log("cobrarDocumentoEjecutarDirecto de scripts.js raiz");

    let bancoCobro = document.getElementById('id_banco_cobro_defecto');
    let bancoCobroValor = 0;
    if (bancoCobro) {
        bancoCobroValor = bancoCobro.value;
    }

    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            cerrarDocumento();
        }
    }
    xhr.open("post", "/web-gestion/guardar_pago.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("id_usuario", idUsuario);
    formData.append("ejercicio", ejercicio);
    formData.append("id_documento_1", idDocumento);
    formData.append("id_metodos_pago", idMetodosPago);
    formData.append("documento_bancario", '');
    formData.append("vencimiento_documento_bancario", '');
    formData.append("nota", '');
    formData.append("id_banco_cobro", bancoCobroValor);
    formData.append("importe_cobrar", 1);
    formData.append("importe_entregado", 1);
    formData.append("numero_efecto", 0);
    xhr.send(formData);
}
function cobrarDocumentoEleccionEjecucion(libradorTipo) {
    let idMetodosPago = document.querySelector('input[name="id_metodo_pago_0"]:checked').value;
    let numeroEfecto = document.getElementById('proximo_recibo_a_pagar').value;
    if (numeroEfecto < 0) {
        return;
    }
    let hayProductosDesmarcados = false;
    let productosNuevoTiquet = document.getElementsByClassName("productosCobroTiquetOriginal");
    for (let i = 0; i < productosNuevoTiquet.length; i++) {
        if (!productosNuevoTiquet[i].checked) {
            hayProductosDesmarcados = true;
        }
    }
    if (hayProductosDesmarcados) {
        cobrarDocumentoEjecutarCrearTiquet(libradorTipo,idMetodosPago,numeroEfecto);
    } else {
        cobrarDocumentoEjecutar(libradorTipo,idMetodosPago,numeroEfecto);
    }
}
function cobrarDocumentoEjecutarCrearTiquet(libradorTipo,idMetodosPago,numeroEfecto) {
    console.log("cobrarDocumentoEjecutarCrearTiquet de scripts.js raiz");
    let cobrar = true;
    if (document.getElementById("importe-cobrar_" + numeroEfecto).value == 0) {
        cobrar = false;
        alert('Selecciona algún producto para poder proceder.')
    }
    if(cobrar == true) {
        var contenedor = document.querySelector("#capa-botones-metodos_pago_ejecutar_" + numeroEfecto);
        document.getElementById("capa-banco_pago_" + numeroEfecto).style.display = "none";

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            contenedor.innerHTML = 'Procesando...';
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);

                if(document.getElementById("imprimir_al_cobrar_si_"+numeroEfecto).checked) {
                    imprimirDocumento(res.id_documento_1,res.ejercicio,"cobrar-productos",numeroEfecto);
                }else {
                    cobrarModal();
                }
            }
        }
        xhr.open("post", "/web-gestion/guardar_pago_crear.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("so", so);
        formData.append("idioma", idioma);
        formData.append("id_usuario", idUsuario);
        formData.append("ejercicio", ejercicio);
        formData.append("id_documento_1", idDocumento);
        formData.append("id_metodos_pago", idMetodosPago);
        formData.append("documento_bancario", document.getElementById("documento_bancario_" + numeroEfecto).value);
        formData.append("vencimiento_documento_bancario", document.getElementById("vencimiento_documento_bancario_" + numeroEfecto).value);
        formData.append("fecha_pago", document.getElementById("fecha_pago_" + numeroEfecto).value);
        formData.append("nota", document.getElementById("nota_" + numeroEfecto).value);
        formData.append("id_banco_cobro", document.getElementById("id_banco_cobro_" + numeroEfecto).value);
        formData.append("importe_cobrar", document.getElementById("importe-cobrar_" + numeroEfecto).value);
        formData.append("importe_entregado", document.getElementById("importe-entregado_" + numeroEfecto).value);
        formData.append("numero_efecto", numeroEfecto);
        formData.append("crear_tiquet", "1");
        let productosTraspasar = "";
        let productosNuevoTiquet = document.getElementsByClassName("productosCobroTiquetOriginal");
        for (let i = 0; i < productosNuevoTiquet.length; i++) {
            if (productosNuevoTiquet[i].checked) {
                if (productosTraspasar != '') {
                    productosTraspasar += ',' + productosNuevoTiquet[i].dataset['iddocumento2']
                } else {
                    productosTraspasar = productosNuevoTiquet[i].dataset['iddocumento2']
                }
            }
        }
        formData.append("productos_nuevo_tiquet", productosTraspasar);
        let productosCantidadTraspasar = "";
        for (let i = 0; i < productosNuevoTiquet.length; i++) {
            if (productosNuevoTiquet[i].checked) {
                if (productosCantidadTraspasar != '') {
                    productosCantidadTraspasar += ',' + productosNuevoTiquet[i].dataset['cantidad']
                } else {
                    productosCantidadTraspasar = productosNuevoTiquet[i].dataset['cantidad']
                }
            }
        }
        formData.append("productos_nuevo_tiquet_cantidad", productosCantidadTraspasar);
        formData.append("decimales_cantidades", decimalesCantidades);
        formData.append("decimales_importes", decimalesImportes);
        xhr.send(formData);
    }
}
function dividirCobro() {
    console.log("dividirCobro de scripts.js raiz");
    identificar('7');
}
function unificarCobro() {
    console.log("unificarCobro de scripts.js raiz");
    identificar('70');
}
function sumarDividirCobro(capa) {
    if(parseInt(document.getElementById(capa).value) < 100) {
        document.getElementById(capa).value = parseInt(document.getElementById(capa).value) + 1;
    }
}
function restarDividirCobro(capa) {
    if(parseInt(document.getElementById(capa).value) > 2) {
        document.getElementById(capa).value = parseInt(document.getElementById(capa).value) - 1;
    }
}
function porProductoCobro() {
    document.getElementById("capa-documentos_pago_1_0").style.display = "block";
    document.getElementById("capa-cancelar-cobro-por-productos_0").style.display = "block";
    document.getElementById("importe-entregado_1_0").disabled = true;
    document.getElementById("imprimir_al_cobrar_1_0_si").disabled = true;
    document.getElementById("capa-cancelar-cobro-por-productos_0").style.display = "none";
    document.getElementById("documento_bancario_1_0").disabled = true;
    document.getElementById("vencimiento_documento_bancario_1_0").disabled = true;
    document.getElementById("fecha_pago_1_0").disabled = true;
    document.getElementById("nota_1_0").disabled = true;
    document.getElementById("id_banco_cobro_1_0").disabled = true;

    productosCobro();

}

function buscar(valor) {
    console.log("buscar de scripts.js raiz: " + valor);

    window.location.href = urlCompleta + "buscar-productos/" + formatoURL(valor);
}

function imprimirDocumento(idDocumento1,ejercicio,accionCerrar,numeroEfecto) {
    console.log("imprimirDocumento de scripts.js raiz");


    if (mobileCheck() || iOSCheck()) {
        let xhrCrearDocumento = new XMLHttpRequest();
        xhrCrearDocumento.onload = function () {
            if (xhrCrearDocumento.status == 200) {
                if (iOSCheck()) {
                    setTimeout(() => {
                        let res = JSON.parse(this.responseText);
                        let ventimp = window.open(res.documento, 'popimpr');

                        if (accionCerrar == "cobrado-total") {
                            cerrarDocumento();
                        }else if(accionCerrar == "cobrar-productos") {
                            cobrarModal();
                        }else if(accionCerrar == "cobrar") {
                            cobrarModal();
                        }
                    })
                } else {
                    let res = JSON.parse(this.responseText);
                    let ventimp = window.open(res.documento, 'popimpr');

                    if (accionCerrar == "cobrado-total") {
                        cerrarDocumento();
                    }else if(accionCerrar == "cobrar-productos") {
                        cobrarModal();
                    }else if(accionCerrar == "cobrar") {
                        cobrarModal();
                    }
                }
            }
        }
        xhrCrearDocumento.open("post", "/enviar_mails/generar_documento_unico.php", true);
        let formDataCrearDocumento = new FormData();
        formDataCrearDocumento.append("id_sesion", idSesion);
        formDataCrearDocumento.append("ip", ip);
        formDataCrearDocumento.append("so", so);
        formDataCrearDocumento.append("idioma", idioma);
        formDataCrearDocumento.append("id_usuario", idUsuario);
        formDataCrearDocumento.append("ejercicio", ejercicio);
        formDataCrearDocumento.append("id_documento_1", idDocumento);
        xhrCrearDocumento.send(formDataCrearDocumento);
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {

    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            let contenidoImprimir = "";
            contenidoImprimir += "<html><head>";
            contenidoImprimir += "<meta charset='utf-8'>";
            contenidoImprimir += "<link rel='stylesheet' href='" + host + "styles.css' type='text/css' />";
            contenidoImprimir += "<link rel='stylesheet' href='" + host + "css/flowbite.min.css' />";
            contenidoImprimir += "<meta name='theme-color' content='#7952b3' />";
            contenidoImprimir += "<script src='" + host + "js/tailwind.js'></script>";
            contenidoImprimir += "<script src='" + host + "js/tailwind-config.js'></script>";
            contenidoImprimir += "<script src='" + host + "js/flowbite.js'></script>'";
            contenidoImprimir += "<title></title>";
            contenidoImprimir += "</head><body class='text-xs' style='font-family: \"Helvetica\", \"Arial\", \"sans-serif\"'>";
            if(res.logo != "") {
                contenidoImprimir += "<div class='mx-10 text-center'><img src='" + host + "images/datos_empresa/" + res.logo + "' id='imgPopup' width='265px' style='margin: 0 auto;' /></div>";
            }
            contenidoImprimir += "<div class='text-center font-bold'>" + res.nombre_comercial + "</strong></div>";
            contenidoImprimir += "<div class='text-center'>" + res.nombre_fiscal + "</div>";
            contenidoImprimir += "<div class='text-center'>" + res.nif + "</div>";
            contenidoImprimir += "<div class='text-center'>" + res.direccion + "</div>";
            contenidoImprimir += "<div class='text-center'>" + res.codigo_postal + " " + res.poblacion + "</div>";
            contenidoImprimir += "<div class='text-center'>" + res.provincia + "</div>";
            if(res.tel1 != "") {
                contenidoImprimir += "<div class='text-center'>Tel.:" + res.tel1 + "</div>";
            }
            if(res.movil != "") {
                contenidoImprimir += "<div class='text-center'>Móvil:" + res.movil + "</div>";
            }
            if(res.email != "") {
                contenidoImprimir += "<div class='text-center'>" + res.email + "</div>";
            }
            contenidoImprimir += "<hr />";
            if(res.nombre_librador != "" || res.apellido_1_librador != "" || res.apellido_2_librador != "") {
                contenidoImprimir += "<div class='text-left'>";
                    contenidoImprimir += res.nombre_librador + " " + res.apellido_1_librador + " " + res.apellido_2_librador;
                contenidoImprimir += "</div>";
            }
            if(res.razon_social_librador != "") {
                contenidoImprimir += "<div class='text-left'>" + res.razon_social_librador + "</div>";
            }
            let titulo_documento_para_tickets = 'TICKET';
            if(res.nif_librador != "") {
                contenidoImprimir += "<div class='text-left'>" + res.nif_librador + "</div>";
                titulo_documento_para_tickets = 'FACTURA';
            }
            if(res.direccion_librador != "") {
                contenidoImprimir += "<div class='text-left'>" + res.direccion_librador + "</div>";
            }
            if(res.numero_librador != "") {
                contenidoImprimir += "<div class='text-left'>Número: " + res.numero_librador + "</div>";
            }
            if(res.escalera_librador != "") {
                contenidoImprimir += "<div class='text-left'>Escalera: " + res.escalera_librador + "</div>";
            }
            if(res.piso_librador != "") {
                contenidoImprimir += "<div class='text-left'>Piso: " + res.piso_librador + "</div>";
            }
            if(res.puerta_librador != "") {
                contenidoImprimir += "<div class='text-left'>Puerta: " + res.puerta_librador + "</div>";
            }
            if(res.codigo_postal_librador != "" || res.localidad_librador != "") {
                contenidoImprimir += "<div class='text-left'>";
                    contenidoImprimir += res.codigo_postal_librador + " " + res.localidad_librador;
                contenidoImprimir += "</div>";
            }
            if(res.provincia_librador != "") {
                contenidoImprimir += "<div class='text-left'>" + res.provincia_librador + "</div>";
            }
            contenidoImprimir += "<hr />";
            let tipoDocumentoImprimir = "";
            if(res.tipo_documento == "pre") {
                tipoDocumentoImprimir = "PRESUPUESTO";
            }else if(res.tipo_documento == "ped") {
                tipoDocumentoImprimir = "PEDIDO";
            }else if(res.tipo_documento == "alb") {
                tipoDocumentoImprimir = "ALBARAN";
            }else if(res.tipo_documento == "fac") {
                tipoDocumentoImprimir = "FACTURA";
            }else if(res.tipo_documento == "tiq") {
                tipoDocumentoImprimir = titulo_documento_para_tickets;
            }
            contenidoImprimir += "<div class='flex'>";
            contenidoImprimir += "<div class='mr-1 text-left'>";
            contenidoImprimir += "<div>";
                contenidoImprimir += tipoDocumentoImprimir + ": " + res.serie_documento + res.numero_documento;
            contenidoImprimir += "</div>";
            contenidoImprimir += "<div>";
                contenidoImprimir += res.fecha_documento;
            contenidoImprimir += "</div>";
            if(res.tipo_documento == "alb") {
                if (res.modalidad_envio != "") {
                    contenidoImprimir += "<div>";
                    contenidoImprimir += "Envio: " + res.modalidad_envio;
                    contenidoImprimir += "</div>";
                }
                if (res.modalidad_entrega != "") {
                    contenidoImprimir += "<div>";
                    contenidoImprimir += "Entrega: " + res.modalidad_entrega;
                    contenidoImprimir += "</div>";
                }
            }
            contenidoImprimir += "</div>";
            contenidoImprimir += "<div class='grow'>";
            contenidoImprimir += "</div>";
            contenidoImprimir += "<div class='ml-1 text-right'>";
            if(res.usuario_documento != "") {
                contenidoImprimir += "<div>";
                if (sector == 'restauracion') {
                    contenidoImprimir += "Camarero: " + res.usuario_documento;
                } else {
                    contenidoImprimir += "Atención: " + res.usuario_documento;
                }
                contenidoImprimir += "</div>";
            }
            if(res.comensales != 0) {
                contenidoImprimir += "<div>";
                contenidoImprimir += "Comensales : " + res.comensales;
                contenidoImprimir += "</div>";
            }
            if(res.modalidad_pago != "") {
                contenidoImprimir += "<div>";
                contenidoImprimir += "Pago: " + res.modalidad_pago;
                if(res.metodos_pago) {
                    contenidoImprimir += " (";
                    for (let bucle = 0; bucle < res.metodos_pago.length; bucle++) {
                        contenidoImprimir += res.metodos_pago;
                        if (bucle < (res.metodos_pago.length - 1)) {
                            contenidoImprimir += " / ";
                        }
                    }
                    contenidoImprimir += ")";
                }
                contenidoImprimir += "</div>";
                if(document.getElementById("importe-entregado_"+numeroEfecto)) {
                    contenidoImprimir += "<div>";
                    contenidoImprimir += "Entregado: " + document.getElementById("importe-entregado_"+numeroEfecto).value + " €";
                    contenidoImprimir += "</div>";
                    if(document.getElementById("importe-cambio_"+numeroEfecto)) {
                        if(document.getElementById("importe-cambio_"+numeroEfecto).innerHTML != "") {
                            contenidoImprimir += "<div>";
                            contenidoImprimir += document.getElementById("importe-cambio_"+numeroEfecto).innerHTML;
                            contenidoImprimir += "</div>";
                        }
                    }
                }
            }
            contenidoImprimir += "</div>";
            contenidoImprimir += "</div>";
            if(res.lineas) {
                contenidoImprimir += "<div class='mb-1 border-1 border-y'>";
                contenidoImprimir += "<div class='grid grid-cols-8'>";
                    contenidoImprimir += "<div class='text-right'>";
                        contenidoImprimir += "Cant.";
                    contenidoImprimir += "</div>";
                    contenidoImprimir += "<div class='col-span-5 text-left ml-1'>";
                        contenidoImprimir += "Producto";
                    contenidoImprimir += "</div>";
                    contenidoImprimir += "<div class='col-span-2 text-right ml-1'>";
                        contenidoImprimir += "P.V.P.";
                    contenidoImprimir += "</div>";
                contenidoImprimir += "</div>";
                for (var bucle = 0; bucle < res.id_documento_2.length; bucle++) {
                    var numeroCantidad = parseFloat(res.cantidad[bucle]);
                    var unidad = (res.unidad[bucle])? ' ' + res.unidad[bucle] : '';
                    contenidoImprimir += "<div class='grid grid-cols-8'>";
                        contenidoImprimir += "<div class='text-right'>";
                            contenidoImprimir += numeroCantidad + unidad + 'x ';
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "<div class='col-span-5 text-left ml-1'>";
                            contenidoImprimir += res.descripcion_producto[bucle];
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "<div class='col-span-2 text-right ml-1'>";
                            contenidoImprimir += (res.pvp_unidad_sin_incrementos[bucle] * numeroCantidad).toFixed(2);
                        contenidoImprimir += "</div>";
                    contenidoImprimir += "</div>";
                    if (res.referencia_producto[bucle] != "") {
                        contenidoImprimir += "<div class='grid grid-cols-1'>";
                            contenidoImprimir += "<div class='row text-left'>";
                                contenidoImprimir += "Referencia: " + res.referencia_producto[bucle];
                            contenidoImprimir += "</div>";
                        contenidoImprimir += "</div>";
                    }
                    if (res.lote[bucle] != "" && res.lote[bucle] != undefined) {
                        contenidoImprimir += "<div class='grid grid-cols-1'>";
                            contenidoImprimir += "<div class='row text-left'>";
                                contenidoImprimir += "Lote: " + res.lote[bucle];
                            contenidoImprimir += "</div>";
                        contenidoImprimir += "</div>";
                    }
                    if (res.detalles_producto[bucle] != "") {
                        contenidoImprimir += "<div class='grid grid-cols-1'>";
                            contenidoImprimir += "<div class='row text-left'>";
                                contenidoImprimir += res.detalles_producto[bucle];
                            contenidoImprimir += "</div>";
                        contenidoImprimir += "</div>";
                    }
                    if (res.descripcion_oferta[bucle] != "") {
                        contenidoImprimir += "<div class='grid grid-cols-1'>";
                            contenidoImprimir += "<div class='row text-left'>";
                                contenidoImprimir += res.descripcion_oferta[bucle];
                            contenidoImprimir += "</div>";
                        contenidoImprimir += "</div>";
                    }
                    if (res.nota_producto[bucle] != "") {
                        contenidoImprimir += "<div class='grid grid-cols-1'>";
                            contenidoImprimir += "<div class='row text-left'>";
                                contenidoImprimir += res.nota_producto[bucle];
                            contenidoImprimir += "</div>";
                        contenidoImprimir += "</div>";
                    }
                    contenidoImprimir += "<br />";
                }
                contenidoImprimir += "</div>";
            }
            contenidoImprimir += "<div class='mb-1 border-1 border-y'>";
            for (let bucle = 0 ; bucle < res.indice.length ; bucle++) {
                if(res.importe_iva[bucle] != 0) {
                    contenidoImprimir += "<div class='text-right'>";
                        /* contenidoImprimir += res.iva[bucle] + "% IVA sobre " + res.base_iva[bucle] + " €: " + res.importe_iva[bucle].toFixed(2) + " €"; */
                        contenidoImprimir += res.iva[bucle] + "% IVA sobre " + parseFloat(res.base_iva[bucle]).toFixed(2) + " €: " + parseFloat(res.importe_iva[bucle]).toFixed(2) + " €";
                    contenidoImprimir += "</div>";
                }
                if(res.importe_recargo[bucle] != 0) {
                    contenidoImprimir += "<div class='text-right'>";
                        /* contenidoImprimir += res.recargo[bucle] + "% R.E. sobre " + res.base_iva[bucle] + " €: " + res.importe_recargo[bucle].toFixed(2) + " €"; */
                        contenidoImprimir += res.recargo[bucle] + "% R.E. sobre " + parseFloat(res.base_iva[bucle]).toFixed(2) + " €: " + res.importe_recargo[bucle].toFixed(2) + " €";
                    contenidoImprimir += "</div>";
                }
            }
            if(res.irpf != 0) {
                contenidoImprimir += "<div class='text-right'>";
                    contenidoImprimir += res.irpf + "% IRPF: " + parseFloat(res.importe_irpf).toFixed(2) + " €";
                contenidoImprimir += "</div>";
            }
            if(res.descuento_pp != 0) {
                contenidoImprimir += "<div class='text-right'>";
                    contenidoImprimir += res.descuento_pp + "% descuento p.p.: " + parseFloat(res.importe_descuento_pp).toFixed(2) + " €";
                contenidoImprimir += "</div>";
            }
            if(res.descuento_librador != 0) {
                contenidoImprimir += "<div class='text-right'>";
                contenidoImprimir += res.descuento_librador + "% descuento: " + parseFloat(res.importe_descuento_librador).toFixed(2) + " €";
                contenidoImprimir += "</div>";
            }
            contenidoImprimir += "<div class='text-right font-bold text-xl'>";
                contenidoImprimir += "TOTAL " + tipoDocumentoImprimir + ": " + res.total + " €";
            contenidoImprimir += "</div>";
            contenidoImprimir += "</div>";
            if (res.nota_documento != "") {
                contenidoImprimir += "<div class='text-left'>";
                contenidoImprimir += "Nota: " + res.nota_documento;
                contenidoImprimir += "</div>";
            }

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

            if (accionCerrar == "cobrado-total") {
                cerrarDocumento();
            }else if(accionCerrar == "cobrar-productos") {
                cobrarModal();
            }else if(accionCerrar == "cobrar") {
                cobrarModal();
            }
        }
    }
    xhr.open("post", "/web-gestion/documento_actualizar.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("ejercicio", ejercicio);
    formData.append("interface_js", interface_js);
    formData.append("tipo_librador", tipoLibrador);
    if(interface_js == "web") {
        formData.append("id_panel", id_panel);
    }
    formData.append("id_documento_1", idDocumento1);
    formData.append("decimales_cantidades", decimalesCantidades);
    formData.append("decimales_importes", decimalesImportes);
    formData.append("funcion_origen", "imprimirDocumento");
    xhr.send(formData);
}
function imprimirDocumentoPDF(idDocumento1,ejercicio,id_modelos_impresion_1) {
    console.log("imprimirDocumentoPDF de scripts.js raiz, ID documento: "+idDocumento1+", modelo: "+id_modelos_impresion_1);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        // document.getElementById("capa_enviando_mail").innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Enviando..." title="Enviando..." />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);

            if(res.logs == "imprimir-documento") {
                var printPage = window.open(host + "enviar_mails/ficheros/" + id_panel + "/" + res.nombrePDF , "PDF", "fullscreen=yes,scrollbars=NO");

                printPage.onload = function() {
                    printPage.print();
                    //printPage.close();
                };

            }
        }
    }
    xhr.open("post", "/enviar_mails/gestionar_pdf.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("id_idioma", id_idioma);
    formData.append("id_usuario", idUsuario);
    formData.append("ejercicio", ejercicio);
    formData.append("id_documento_1", idDocumento1);
    formData.append("decimales_cantidades", decimalesCantidades);
    formData.append("decimales_importes", decimalesImportes);
    formData.append("modelo_documento", id_modelos_impresion_1);
    formData.append("interface_js", interface_js);
    formData.append("funcion_origen", 'imprimirDocumento');
    if(interface_js == "web") {
        formData.append("id_panel", id_panel);
    }
    formData.append("tipo_librador", tipoLibrador);
    formData.append("select", "imprimir-documento");
    xhr.send(formData);
}

function imprimirEtiquetaPDF(idDocumento1,ejercicio) {
    console.log("imprimirEtiquetaPDF de scripts.js raiz, ID documento1: "+idDocumento1+", ejercicio: "+ejercicio);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        // document.getElementById("capa_enviando_mail").innerHTML = '<img src="/images/loader.gif" class="mw-20p" alt="Enviando..." title="Enviando..." />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);

            // if(res.logs == "imprimir-documento") {
                var printPage = window.open(host + "enviar_mails/ficheros/" + id_panel + "/" + res.nombrePDF , "PDF", "fullscreen=yes,scrollbars=NO");

                printPage.onload = function() {
                    printPage.print();
                    //printPage.close();
                };

            // }
        }
    }
    xhr.open("post", "/enviar_mails/gestionar_etiqueta.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("id_idioma", id_idioma);
    formData.append("id_usuario", idUsuario);
    formData.append("ejercicio", ejercicio);
    formData.append("id_documento_1", idDocumento1);
    formData.append("decimales_cantidades", decimalesCantidades);
    formData.append("decimales_importes", decimalesImportes);
    xhr.send(formData);
}

function formatoURL(cadena) {
    /*let caracter = "";
    let caracterOK = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.', ','];
    cadena = cadena.toLowerCase();
    let cadenaFinal = "";
    for (let bucleCadena = 0 ; bucleCadena < cadena.length ; bucleCadena++) {
        caracter = cadena.substring(bucleCadena, (bucleCadena + 1));
        if(caracterOK.indexOf(caracter) == -1) {
            cadenaFinal += "-";
        }else {
            cadenaFinal += caracter;
        }
    }
    return cadenaFinal;*/
    return cadena.toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, '-')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '-');
}

function controlListaComensales(capa) {
    console.log("controlListaComensales " + capa);
    if (document.getElementById("lista_comensales"+capa+"_guardar").value == -1) {
        document.getElementById("numero_comensales"+capa+"_guardar").value = "";
        document.getElementById("comensales"+capa+"-guardar").value = "";
        document.getElementById("numero_comensales"+capa+"_guardar").style.display = "block";
        document.getElementById("boton-capa-comensales"+capa).style.display = "block";
        document.getElementById("numero_comensales"+capa+"_guardar").focus();
    } else {
        document.getElementById("comensales"+capa+"-guardar").value = document.getElementById("lista_comensales"+capa+"_guardar").value;
        if (capa) {
            guardarComensales(capa);
        }
    }
}
function editarComensales(idMesa,mesa,comensalesActuales,idDocumentoMesa,ejercicioDocumentoMesa) {
    console.log("editarComensales");

    document.getElementById("id-mesa-comensales-guardar").value = idMesa;
    document.getElementById("comensales-guardar").value = comensalesActuales;
    document.getElementById("lista_comensales_guardar").value = comensalesActuales;

    if(idDocumentoMesa == 0 && idDocumento != 0) {
        document.getElementById("id-documento-comensales-guardar").value = idDocumento;
    }else {
        document.getElementById("id-documento-comensales-guardar").value = idDocumentoMesa;
        sessionStorage.setItem('id_documento', idDocumentoMesa);
        idDocumento = idDocumentoMesa;
    }

    document.getElementById("ejercicio-documento-comensales-guardar").value = ejercicioDocumentoMesa;
    document.getElementById("id-librador-comensales-guardar").value = idMesa;

    document.getElementById("descripcion_boton_abrir_mesa").innerHTML = mesa;

    document.getElementById("capa_mesa_seleccionada").innerHTML = "Número de comensales de la " + mesa;

    if(document.getElementById("id-documento-comensales-guardar").value != 0) {
        guardarComensales('');
    }
}
function guardarComensales(capa) {
    console.log("numero_comensales"+capa+"_guardar");
    if(document.getElementById("numero_comensales"+capa+"_guardar").value != "") {
        document.getElementById("comensales"+capa+"-guardar").value = document.getElementById("numero_comensales"+capa+"_guardar").value;
    }

    if(document.getElementById("comensales"+capa+"-guardar").value == "") {
        document.getElementById("comensales"+capa+"-guardar").focus();
    }else {
        /*
        alert("id-documento-comensales-guardar: "+document.getElementById("id-documento-comensales-guardar").value);
        return;
        */
        if (idDocumento == 0) {
            /* document.getElementById('comensales').value = document.getElementById("comensales-guardar").value; */
            document.getElementById('tipo_librador').value = 'mes';
            document.getElementById('boton-mesas').style.display = 'inline-grid';
            document.getElementById('main').style.display = "block";
            datosFacturacionCesta(document.getElementById("id-mesa-comensales-guardar").value, 'cabecera');
        } else {
            guardarComensalesFinal(capa,idDocumento, document.getElementById("comensales"+capa+"-guardar").value, document.getElementById('ejercicio-documento-comensales-guardar').value);
        }
    }
}
function guardarComensalesFinal(capa,idDocumentoGuardar, comensalesGuardar, ejercicio) {
    console.log("guardarComensalesFinal, capa "+capa+" ID doc: "+idDocumentoGuardar+" Comensales: "+comensalesGuardar+" Ejercicio: "+ejercicio+" de scripts.js raiz");

    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            /*
            alert("Capa: "+capa+" ID librador. "+document.getElementById("id-mesa-comensales-guardar").value);
            return;
            */
            if(capa == "") {
                datosFacturacionCesta(document.getElementById("id-mesa-comensales-guardar").value, 'cabecera');
            }

            cargarCabeceraCesta();
        }
    }
    xhr.open("post", "/web-gestion/guardar_comensales.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("id_sesion_js", id_sesion_js);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("id_usuario", idUsuario);
    formData.append("ejercicio", ejercicio);
    formData.append("id_documento_1", idDocumentoGuardar);
    formData.append("comensales_guardar", comensalesGuardar);
    xhr.send(formData);
}

function mostrarEtiquetas(idDocumento1,ejercicio) {
    console.log("mostrarEtiquetas de scripts.js raiz");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {

    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);

            let contenidoImprimir = "";
            contenidoImprimir += "<html><head>";
            contenidoImprimir += "<meta charset='utf-8'>";
            contenidoImprimir += "<link rel='stylesheet' href='" + host + "styles.css' type='text/css' />";
            contenidoImprimir += "<title></title>";
            contenidoImprimir += "<link rel='stylesheet' href='/css/flowbite.min.css' />";
            contenidoImprimir += "<script src='/js/tailwind.js'></script>";
            contenidoImprimir += "<script src='/js/tailwind-config.js'></script>";
            contenidoImprimir += "<script src='/js/flowbite.js'></script>";
            contenidoImprimir += "<script src='/scripts_etiquetes.js?ver=1.8'></script>";
            contenidoImprimir += "</head><body>";
            if(res.lineas) {
                contenidoImprimir += "<div class='grid grid-cols-5 space-x-2'>";
                    contenidoImprimir += "<div class='text-right'>";
                        contenidoImprimir += "Imprimir etiquetas";
                    contenidoImprimir += "</div>";
                    contenidoImprimir += "<div class='text-right'>";
                        contenidoImprimir += "Cantidad";
                    contenidoImprimir += "</div>";
                    contenidoImprimir += "<div class='text-left ml-1'>";
                        contenidoImprimir += "Producto";
                    contenidoImprimir += "</div>";
                    contenidoImprimir += "<div class='text-right ml-1'>";
                        contenidoImprimir += "Unid.";
                    contenidoImprimir += "</div>";
                    contenidoImprimir += "<div class='text-right ml-1'>";
                        contenidoImprimir += "P.V.P.";
                    contenidoImprimir += "</div>";
                contenidoImprimir += "</div>";
                contenidoImprimir += "<hr />";
                for (var bucle = 0; bucle < res.id_documento_2.length; bucle++) {
                    var numeroCantidad = parseFloat(res.cantidad[bucle]);
                    contenidoImprimir += "<div class='grid grid-cols-5 items-center'>";
                        contenidoImprimir += "<div class='text-right'>";
                            contenidoImprimir += "<span class='label-input'>SI</span>";
                            contenidoImprimir += "<input type='radio' name='imprimir_"+res.id_documento_2[bucle]+"' value='1' checked />";
                            contenidoImprimir += "<span class='label-input'>NO</span>";
                            contenidoImprimir += "<input type='radio' name='imprimir_"+res.id_documento_2[bucle]+"' value='0' />";
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "<div class='text-right flex space-x-2 items-center'>";
                            contenidoImprimir += '<svg onMouseOver="this.style.cursor=\'pointer\'" onClick="sumarEtiquetas(\'cantidad_'+bucle+'\');" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                            contenidoImprimir += "<input type='number' class='input-cantidad' name='cantidad_"+bucle+"' id='cantidad_"+bucle+"' placeholder='Cantidad' value='"+numeroCantidad+"' min='1'/>";
                            contenidoImprimir += '<svg onMouseOver="this.style.cursor=\'pointer\'" onClick="restarEtiquetas(\'cantidad_'+bucle+'\');" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "<div class='text-left ml-1'>";
                            contenidoImprimir += res.descripcion_producto[bucle];
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "<div class='text-right ml-1'>";
                            contenidoImprimir += res.unidad[bucle];
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
                        contenidoImprimir += "<div class='grid grid-cols-4'>";
                        contenidoImprimir += "<div class='text-left'>";
                        contenidoImprimir += res.descripcion_oferta[bucle];
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "<div class='text-left'>";
                        contenidoImprimir += res.oferta_desde[bucle];
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "<div class='text-left'>";
                        contenidoImprimir += res.oferta_hasta[bucle];
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "<div class='text-left'>";
                        contenidoImprimir += res.pvp_oferta[bucle];
                        contenidoImprimir += "</div>";
                        contenidoImprimir += "</div>";
                    }
                    contenidoImprimir += "<br />";
                }
            }
            contenidoImprimir += "<hr />";
            contenidoImprimir += "<div class='grid grid-cols-2'>";
                contenidoImprimir += "<div class='text-center'>";
                    contenidoImprimir += "<button type=\"button\" class=\"botones-cesta\" onClick=\"imprimirEtiquetas(\'" + idDocumento1 + "\',\'" + ejercicio + "\',\'" + idSesion + "\',\'" + ip + "\',\'" + so + "\',\'" + idioma + "\',\'" + idUsuario + "\')\">";
                        contenidoImprimir += "Imprimir etiquetas";
                    contenidoImprimir += "</button>";
                contenidoImprimir += "</div>";
                contenidoImprimir += "<div class='text-center'>";
                    contenidoImprimir += "<button type='button' class='botones-cesta' onClick='window.close();'>";
                        contenidoImprimir += "Cerrar";
                    contenidoImprimir += "</button>";
                contenidoImprimir += "</div>";
            contenidoImprimir += "</div>";
            contenidoImprimir += "</body></html>";

            var ventimp = window.open(host + 'generar-etiquetas.php', '_blank');
            ventimp.document.write( contenidoImprimir );
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

function nuevaEntregaDomicilio () {
    document.getElementById('tipo_librador').value='del';
    document.getElementById('id_librador_seleccionar').value=0;
    document.getElementById('botonOpenModalEntregaDomicilio').click();
    document.getElementById('boton-mesas').style.display = 'inline-grid';

    document.getElementById('capa-nombre-del').style.display = 'none';
    document.getElementById('capa-direccion-del').style.display = 'none';
    document.getElementById('capa-numero-del').style.display = 'none';
    document.getElementById('capa-escalera-del').style.display = 'none';
    document.getElementById('capa-piso-del').style.display = 'none';
    document.getElementById('capa-puerta-del').style.display = 'none';
    document.getElementById('capa-localidad-del').style.display = 'none';
    document.getElementById('capa-codigo-postal-del').style.display = 'none';
    document.getElementById('capa-mobil-del').style.display = 'inline-grid';
    document.getElementById('capa-fecha-entrega-del').style.display = 'none';
    document.getElementById('capa-hora-entrega-del').style.display = 'none';
    document.getElementById('capa-guardar-del').style.display = 'none';
    document.getElementById('capa-guardar-nueva-direccion-del').style.display = 'none';
    document.getElementById('capa-cancelar-nueva-direccion-del').style.display = 'inline-grid';
    document.getElementById('capa-otras-direcciones-del').style.display = 'none';
    document.getElementById('capa-nombres-del').style.display = 'none';
    document.getElementById('capa-direcciones-del').style.display = 'none';
    document.getElementById('capa-numeros-del').style.display = 'none';
    document.getElementById('capa-escaleras-del').style.display = 'none';
    document.getElementById('capa-pisos-del').style.display = 'none';
    document.getElementById('capa-puertas-del').style.display = 'none';
    document.getElementById('capa-localidades-del').style.display = 'none';
    document.getElementById('capa-codigos-postal-del').style.display = 'none';
    document.getElementById('capa-mobiles-del').style.display = 'none';
    document.getElementById('capa-fechas-entrega-del').style.display = 'none';
    document.getElementById('capa-horas-entrega-del').style.display = 'none';
    document.getElementById('capas-guardar-del').style.display = 'none';
    document.getElementById('capas-cancelar-nueva-direccion-del').style.display = 'none';

    document.getElementById('mobil_documento_buscar').value = "";
    document.getElementById('mobil_documento_buscar').focus();
}
function cambiarSelectBuscar(id) {
    var datosOtrasDirecciones = document.getElementById("otras_direcciones_documento_buscar").value.split(" -> ");
    for(var bucle = 0 ; bucle < datosOtrasDirecciones.length ; bucle++) {
        document.getElementById("nombres_documento_buscar").value = datosOtrasDirecciones[0];
        document.getElementById("direcciones_documento_buscar").value = datosOtrasDirecciones[1];
        document.getElementById("numeros_direccion_documento_buscar").value = datosOtrasDirecciones[2];
        document.getElementById("escaleras_direccion_documento_buscar").value = datosOtrasDirecciones[3];
        document.getElementById("pisos_direccion_documento_buscar").value = datosOtrasDirecciones[4];
        document.getElementById("puertas_direccion_documento_buscar").value = datosOtrasDirecciones[5];
        document.getElementById("localidades_documento_buscar").value = datosOtrasDirecciones[6];
        document.getElementById("codigos_postal_documento_buscar").value = datosOtrasDirecciones[7];
    }
}
function crearNuevaDireccion() {
    var today =new Date();
    var dd =String(today.getDate()).padStart(2,'0');
    var mm =String(today.getMonth()+1).padStart(2,'0');
    var yyyy = today.getFullYear();
    var fechaActual = mm +'/'+ dd +'/'+ yyyy;

    document.getElementById("capa-otras-direcciones-del").style.display = "none";
    document.getElementById("capa-nombres-del").style.display = "none";
    document.getElementById("capa-direcciones-del").style.display = "none";
    document.getElementById("capa-numeros-del").style.display = "none";
    document.getElementById("capa-escaleras-del").style.display = "none";
    document.getElementById("capa-pisos-del").style.display = "none";
    document.getElementById("capa-puertas-del").style.display = "none";
    document.getElementById("capa-localidades-del").style.display = "none";
    document.getElementById("capa-codigos-postal-del").style.display = "none";
    document.getElementById("capa-mobiles-del").style.display = "none";
    document.getElementById("capa-fechas-entrega-del").style.display = "none";
    document.getElementById("capa-horas-entrega-del").style.display = "none";
    document.getElementById("capas-guardar-del").style.display = "none";
    document.getElementById("capas-cancelar-nueva-direccion-del").style.display = "none";

    document.getElementById("fecha_entrega_documento_buscar").value = fechaActual;
    document.getElementById("hora_entrega_documento_buscar").value = today.getHours() + ":" + today.getMinutes();
    document.getElementById("capa-nombre-del").style.display = "inline-grid";
    document.getElementById("capa-direccion-del").style.display = "inline-grid";
    document.getElementById("capa-numero-del").style.display = "inline-grid";
    document.getElementById("capa-escalera-del").style.display = "inline-grid";
    document.getElementById("capa-piso-del").style.display = "inline-grid";
    document.getElementById("capa-puerta-del").style.display = "inline-grid";
    document.getElementById("capa-localidad-del").style.display = "inline-grid";
    document.getElementById("capa-codigo-postal-del").style.display = "inline-grid";
    document.getElementById("capa-mobil-del").style.display = "inline-grid";
    document.getElementById("capa-fecha-entrega-del").style.display = "inline-grid";
    document.getElementById("capa-hora-entrega-del").style.display = "inline-grid";
    document.getElementById("capa-guardar-nueva-direccion-del").style.display = "inline-grid";
    document.getElementById("capa-cancelar-nueva-direccion-del").style.display = "inline-grid";
    document.getElementById("nombre_documento_buscar").value = document.getElementById("nombres_documento_buscar").value;
    document.getElementById("fecha_entrega_documento_buscar").value = document.getElementById("fechas_entrega_documento_buscar").value;
    document.getElementById("hora_entrega_documento_buscar").value = document.getElementById("horas_entrega_documento_buscar").value;
    document.getElementById("direccion_documento_buscar").focus();
}
function buscarDatosDel(longuitud) {
    console.log("buscarDatosDel, longuitud: " + longuitud + " en scripts.js");
    if(document.getElementById("mobil_documento_buscar").value.length >= longuitud) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            document.getElementById("mobil_documento_buscar").style.pointerEvents = "none";
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                document.getElementById("tipo_librador").value = "del";
                document.getElementById("capa-cancelar-nueva-direccion-del").style.display = "none";

                var today =new Date();
                var dd =String(today.getDate()).padStart(2,'0');
                var mm =String(today.getMonth()+1).padStart(2,'0');
                var yyyy = today.getFullYear();
                var fechaActual = yyyy +'-'+ mm +'-'+ dd;
                console.log('res.id_librador = ' + res.id_librador);
                if(res.id_librador == 0) {
                    document.getElementById('id_librador_cesta').value = -1;
                    document.getElementById('id_librador_seleccionar').value = -1;
                    document.getElementById("fecha_entrega_documento_buscar").value = fechaActual;
                    document.getElementById("hora_entrega_documento_buscar").value = today.getHours() + ":" + today.getMinutes();
                    document.getElementById("capa-nombre-del").style.display = "inline-grid";
                    document.getElementById("capa-direccion-del").style.display = "inline-grid";
                    document.getElementById("capa-numero-del").style.display = "inline-grid";
                    document.getElementById("capa-escalera-del").style.display = "inline-grid";
                    document.getElementById("capa-piso-del").style.display = "inline-grid";
                    document.getElementById("capa-puerta-del").style.display = "inline-grid";
                    document.getElementById("capa-localidad-del").style.display = "inline-grid";
                    document.getElementById("capa-codigo-postal-del").style.display = "inline-grid";
                    document.getElementById("capa-mobil-del").style.display = "inline-grid";
                    document.getElementById("capa-fecha-entrega-del").style.display = "inline-grid";
                    document.getElementById("capa-hora-entrega-del").style.display = "inline-grid";
                    document.getElementById("capa-guardar-del").style.display = "inline-grid";
                    document.getElementById("capa-cancelar-nueva-direccion-del").style.display = "inline-grid";
                    document.getElementById("direccion_documento_buscar").focus();
                }else {
                    console.log('res.nombre_del.length = ' + res.nombre_del.length);
                    if(res.nombre_del.length > 1) {
                        var opcionesOtrasDirecciones = document.getElementById("otras_direcciones_documento_buscar");
                        while (opcionesOtrasDirecciones.options.length > 0) {
                            opcionesOtrasDirecciones.remove(0);
                        }
                        document.getElementById("capa-otras-direcciones-del").style.display = "inline-grid";
                        for(var bucle = 0 ; bucle < res.nombre_del.length ; bucle++) {
                            var nuevaOpcion = document.getElementById("otras_direcciones_documento_buscar");
                            var valorOpcion = res.nombre_del[bucle]+" -> "+res.direccion_del[bucle]+" -> "+res.numero_del[bucle]+" -> "+res.escalera_del[bucle]+" -> "+res.piso_del[bucle]+" -> "+res.puerta_del[bucle]+" -> "+res.localidad_del[bucle]+" -> "+res.codigo_postal_del[bucle];
                            var opcion = document.createElement("option");
                            opcion.text = valorOpcion;
                            opcion.value = valorOpcion;
                            nuevaOpcion.add(opcion);
                        }
                    }
                    document.getElementById("nombres_documento_buscar").value = res.nombre_del[0];
                    document.getElementById("direcciones_documento_buscar").value = res.direccion_del[0];
                    document.getElementById("numeros_direccion_documento_buscar").value = res.numero_del[0];
                    document.getElementById("escaleras_direccion_documento_buscar").value = res.escalera_del[0];
                    document.getElementById("pisos_direccion_documento_buscar").value = res.piso_del[0];
                    document.getElementById("puertas_direccion_documento_buscar").value = res.puerta_del[0];
                    document.getElementById("localidades_documento_buscar").value = res.localidad_del[0];
                    document.getElementById("codigos_postal_documento_buscar").value = res.codigo_postal_del[0];

                    document.getElementById("capa-mobil-del").style.display = "none";

                    document.getElementById("mobiles_documento_buscar").innerHTML = document.getElementById("mobil_documento_buscar").value;

                    document.getElementById('id_librador_cesta').value = res.id_librador;
                    document.getElementById('id_librador_seleccionar').value = res.id_librador;
                    document.getElementById("fechas_entrega_documento_buscar").value = fechaActual;
                    document.getElementById("horas_entrega_documento_buscar").value = today.getHours() + ":" + today.getMinutes();
                    document.getElementById("capa-nombres-del").style.display = "inline-grid";
                    document.getElementById("capa-direcciones-del").style.display = "inline-grid";
                    document.getElementById("capa-numeros-del").style.display = "inline-grid";
                    document.getElementById("capa-escaleras-del").style.display = "inline-grid";
                    document.getElementById("capa-pisos-del").style.display = "inline-grid";
                    document.getElementById("capa-puertas-del").style.display = "inline-grid";
                    document.getElementById("capa-localidades-del").style.display = "inline-grid";
                    document.getElementById("capa-codigos-postal-del").style.display = "inline-grid";
                    document.getElementById("capa-mobiles-del").style.display = "inline-grid";
                    document.getElementById("capa-fechas-entrega-del").style.display = "inline-grid";
                    document.getElementById("capa-horas-entrega-del").style.display = "inline-grid";
                    document.getElementById("capas-guardar-del").style.display = "inline-grid";
                    document.getElementById("capas-cancelar-nueva-direccion-del").style.display = "inline-grid";
                    document.getElementById("direcciones_documento_buscar").focus();
                }
            }
        }

        xhr.open("post", "/web-gestion/datos-pre-librador.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("so", so);
        formData.append("idioma", idioma);
        formData.append("interface_js", interface_js);
        formData.append("select", "buscar-librador-del");
        formData.append("ejercicio", ejercicio);
        formData.append("mobil_envio_documento", document.getElementById("mobil_documento_buscar").value);
        xhr.send(formData);
    }
}
function controlSpacios(event) {
    console.log("buscarDatosDel en scripts.js");
    var key = event.keyCode || event.charCode;

    if( key == 13) {
        buscarDatosDel(3);
    }
    if( key == 32) {
        return false;
    }
}

function volcarDocumentos(tipoOrigen,tipoVolcado,idsDocumentos1,idsDocumentos2,ejercicios) {
    console.log("volcarDocumentos tipo: "+tipoOrigen+" a "+tipoVolcado);

    let datosDocumentosAVolcar = [];
    let datosDocumentoAVolcar = null;
    let lineaDocumento = null;
    let lineaDocumentoCheckbox = null;
    for(let bucle1 = 0 ; bucle1 < idsDocumentos1.length ; bucle1++) {
        datosDocumentoAVolcar = {};
        datosDocumentoAVolcar.ejercicio = ejercicios[bucle1];
        datosDocumentoAVolcar.id = idsDocumentos1[bucle1];
        datosDocumentoAVolcar.lineas = [];
        lineaDocumentoCheckbox = document.getElementById("documento_volcar_"+bucle1);
        if(lineaDocumentoCheckbox && lineaDocumentoCheckbox.checked) {
            for (let bucle2 = 0; bucle2 < idsDocumentos2.length; bucle2++) {
                if (idsDocumentos2[bucle2] == idsDocumentos1[bucle1]) {
                    let lineaDocumento2 = document.getElementById("linea_volcar_" + bucle2);
                    if (lineaDocumento2 && lineaDocumento2.checked) {
                        lineaDocumento = {};
                        lineaDocumento.id = lineaDocumento2.value;
                        lineaDocumento.coste = document.getElementById("coste_" + bucle2).value;
                        lineaDocumento.importe = document.getElementById("importe_" + bucle2).value;
                        lineaDocumento.cantidad = document.getElementById("cantidad_" + bucle2).value;
                        lineaDocumento.lote = document.getElementById("lote_" + bucle2).value;
                        lineaDocumento.caducidad = document.getElementById("caducidad_" + bucle2).value;
                        lineaDocumento.numero_serie = document.getElementById("numero_serie_" + bucle2).value;
                        datosDocumentoAVolcar.lineas.push(lineaDocumento);
                    }
                }
            }
        }
        if (datosDocumentoAVolcar.lineas.length) {
            datosDocumentosAVolcar.push(datosDocumentoAVolcar)
        }
    }

    let contenidoBotonVolcarDocumento = document.getElementById("boton_volcar_documento");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        contenidoBotonVolcarDocumento.innerHTML = "Cargando...";
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);

            contenidoBotonVolcarDocumento.innerHTML = res.mensaje;

            actualizarOtrosDocumentos('capa-otros-documentos','global','fecha-hora','');
        }
    }

    xhr.open("post", "/web-gestion/volcar-documentos.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("interface_js", interface_js);
    formData.append("ejercicio", ejercicio);
    formData.append("documentos_a_volcar", JSON.stringify(datosDocumentosAVolcar));
    formData.append("tipo_origen", tipoOrigen);
    formData.append("tipo_volcado", tipoVolcado);
    formData.append("tipo_librador", tipoLibrador);
    formData.append("fecha", document.getElementById('fecha_documento_volcado').value);
    if (tipoLibrador == 'cli') {
        formData.append("serie", document.getElementById('serie_volcado').value);
    } else {
        formData.append("numero_documento", document.getElementById('numero_documento_volcado').value);
    }
    xhr.send(formData);
}

function establecerIdProductosRelacionadosGrupos(id) {
    console.log("establecerIdProductosRelacionadosGrupos de scripts.js raiz");

    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            const originalClasses = document.querySelectorAll('.botones-categorias-grupos-sel');
            originalClasses.forEach(element => {
                element.className = 'botones-categorias-grupos text-sm px-4 h-8';
            });
            document.getElementById("boton-categorias-grupos_" + id).className = "botones-categorias-grupos-sel bg-blendi-35 font-bold text-sm px-4 h-8";
        }
    }

    xhr.open("post", "/web-gestion/establecer_categoria.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("id_sesion_js", id_sesion_js);
    formData.append("ip", ip);
    formData.append("interface_js", interface_js);
    if(interface_js == "web") {
        formData.append("id_panel", id_panel);
    }
    formData.append("id_categoria", id);
    xhr.send(formData);
}

function detallesProductoModal(descripcion_producto, id_producto, id_documento_producto_relacionado_combo, tipo_producto, id_linea, borrar_linea, modificar_linea, dato_buscar) {
    console.log("detallesProductoModal de scripts.js raiz");
    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            let bodyProductoModal = document.getElementById('body-producto-modal');
            bodyProductoModal.innerHTML = this.responseText;

            nodeScriptReplace(bodyProductoModal);

            document.getElementById('titulo-producto-modal').innerHTML = descripcion_producto.stripSlashes();

            let cantidadInput = document.getElementById('cantidad_0_modal');
            if (cantidadInput && !(mobileCheck() || iOSCheck())) {
                cantidadInput.focus();
                cantidadInput.select();
            }
        }
    }

    window.productoComboContador = 0;
    xhr.open("post", "/web-gestion/producto_ajax.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("id_idioma", id_idioma);
    formData.append("interface_js", interface_js);
    formData.append("ejercicio", ejercicio);
    formData.append("id_librador", idLibrador);
    formData.append("tipo_librador", tipoLibrador);
    formData.append("tipo_documento", tipoDocumento);
    formData.append("decimales_cantidades", decimalesCantidades);
    formData.append("decimales_importes", decimalesImportes);
    formData.append("id_tarifa_web", idTarifaWeb);
    formData.append("descuento_librador", descuentoLibrador);
    formData.append("id_irpf", idIrpf);
    formData.append("iva_librador", ivaLibrador);
    formData.append("pvp_iva_incluido", pvpIvaIncluido);
    formData.append("recargo", recargo);
    formData.append("recargo_librador", recargoLibrador);
    formData.append("descuento_pp", descuentoPp);
    formData.append("dato_buscar", dato_buscar);
    formData.append("id_producto", id_producto);
    formData.append("id_documento_producto_relacionado_combo", id_documento_producto_relacionado_combo);
    formData.append("tipo_producto", tipo_producto);
    formData.append("id_linea", id_linea);
    formData.append("descripcion_categoria", descripcionCategoria);
    formData.append("borrar_linea", borrar_linea);
    formData.append("modificar_linea", modificar_linea);
    xhr.send(formData);
}

function setTituloCobrarModal(valor) {
    document.getElementById('titulo-cobrar-modal').innerHTML = valor;
}
function setUltimoElementoImporteEntregado(valor) {
    window.ultimoElementoImporteEntregado = valor;
}
function selectUltimoElementoImporteEntregado() {
    if(window.ultimoElementoImporteEntregado >= 0) {
        document.getElementById("importe-entregado_" + window.ultimoElementoImporteEntregado).select();
        document.getElementById("importe-entregado_" + window.ultimoElementoImporteEntregado).focus();
    }
}
function cobrarModal() {
    console.log("cobrarModal de scripts.js raiz");
    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            let bodyCobrarModal = document.getElementById('body-cobrar-modal');
            bodyCobrarModal.innerHTML = this.responseText;

            nodeScriptReplace(bodyCobrarModal);
        }
    }

    xhr.open("post", host_url + 'cobrar', true);
    let formData = new FormData();
    formData.append("ajax", 1);
    xhr.send(formData);
}

function toggleModalMesas(idMesa,mesa,comensalesActuales,idDocumentoMesa,ejercicioDocumentoMesa,idLibradorMesa=0,documentoBloqueado=false) {
    if (cerrandoDocumento) {
        return;
    }
    if (documentoBloqueado && documentoBloqueado > 0) {
        let continuarConDocumentoBloqueado = confirm('El documento está bloqueado por tanto podría estar trabajando otro compañero con él. ¿Quieres continuar de todas formas?');

        if (!continuarConDocumentoBloqueado) {
            return;
        }
    }

    if(idDocumentoMesa != 0 || idDocumento != 0) {
        document.getElementById('botonOpenModalComensalesLoading').click();
    } else {
        document.getElementById('botonOpenModalComensales').click();
    }

    editarComensales(idMesa,mesa,comensalesActuales,idDocumentoMesa,ejercicioDocumentoMesa);
}

function setHeights() {
    if (window.innerWidth >= 640) {
        setCapaCestaHeight();
        setCapaProductosHeight();
        setCapaComedorHeight();
    }
    setCapasModalBodyMaxHeight();
}
function setCapaCestaProductosHeight() {
    let capaCestaProductos = document.getElementById('capa_cesta_productos');
    let capaCestaLateral = document.getElementById('capa-cesta-lateral');
    if (capaCestaProductos && capaCestaLateral) {
        if (window.innerWidth > 750) {
            let newHeight = window.innerHeight - capaCestaProductos.offsetTop - capaCestaLateral.offsetTop - 180;
            if (newHeight < capaCestaProductos.offsetHeight) {
                capaCestaProductos.style.height = newHeight.toString() + 'px';
            }
        }
    }
}
function setCapaCestaHeight() {
    let capaCesta = document.getElementById('capa-cesta-lateral');
    if (capaCesta) {
        if (window.innerWidth > 750) {
            capaCesta.style.height = (window.innerHeight - capaCesta.offsetTop - 37).toString() + 'px';
        }
    }
}

function setCapasModalBodyMaxHeight() {
    let capaModalBody = document.getElementsByClassName('modal-body');
    for (let i = 0; i < capaModalBody.length; i++) {
        if (capaModalBody[i]) {
            capaModalBody[i].style.maxHeight = (window.innerHeight - 200).toString() + 'px';
        }
    }
}

function setCapaProductosHeight() {
    let capaProductos = document.getElementById('capa-grid-productos');
    if (capaProductos) {
        if (window.innerWidth > 750) {
            let newHeight = window.innerHeight - capaProductos.offsetTop - 46;
            if (newHeight < capaProductos.offsetHeight) {
                capaProductos.style.height = newHeight.toString() + 'px';
            }
        }
    }
}

function setCapaComedorHeight() {
    let capaComedor = document.getElementById('capa_comedor');
    if (capaComedor) {
        let newHeight = window.innerHeight - capaComedor.offsetTop - 10;
        if (newHeight < capaComedor.offsetHeight) {
            capaComedor.style.height = newHeight.toString() + 'px';
        }
    }
}

function setCapaComedorListasHeight() {
    if (window.innerWidth > 639) {
        let capasListas = [];
        capasListas.push(document.getElementById('capa-mesas-lista'));
        capasListas.push(document.getElementById('capa-mesas-recogida-local'));
        capasListas.push(document.getElementById('capa-mesas-entrega-domicilio'));
        let newHeight = null;
        for (let i = 0; i < capasListas.length; i++) {
            if (capasListas[i]) {
                newHeight = window.innerHeight - capasListas[i].offsetTop - 40;
                if (newHeight < capasListas[i].offsetHeight) {
                    capasListas[i].style.height = newHeight.toString() + 'px';
                }
            }
        }

        let capasListaGrupo = document.getElementsByClassName('capa-lista-grupo');
        for (let z = 0; z < capasListaGrupo.length; z++) {
            if (capasListaGrupo[z]) {
                newHeight = window.innerHeight - capasListaGrupo[z].offsetTop - 60;
                if (newHeight < capasListaGrupo[z].offsetHeight) {
                    capasListaGrupo[z].style.height = newHeight.toString() + 'px';
                }
            }
        }
    }
}

function setCapaProductoComboHeight(anadidoModal) {
    let capaProductoCombo = document.getElementById('capa-grid-producto-combo'+anadidoModal);
    if (capaProductoCombo) {
        let newHeight = window.innerHeight - capaProductoCombo.offsetTop - 60;
        capaProductoCombo.style.height = newHeight.toString() + 'px';
    }
}

function calcularMesaSegunAnchoPantalla(idCapaMesas, leftMesaOriginal, anchoMesaOriginal, anchoComedorOriginal) {
    let widthPantalla = window.innerWidth * 0.98;

    let leftMesaSegunPantalla = (leftMesaOriginal / anchoComedorOriginal) * widthPantalla;
    let factorAncho = leftMesaSegunPantalla / leftMesaOriginal;
    let anchoMesaSegunPantalla = factorAncho * anchoMesaOriginal;

    let capaMesa = document.getElementById(idCapaMesas);
    capaMesa.style.left = leftMesaSegunPantalla + 'px';
    capaMesa.style.width = anchoMesaSegunPantalla + 'px';
    capaMesa.children[0].style.width = anchoMesaSegunPantalla + 'px';
}

function toggleFullScreen(elem) {
    // ## The below if statement seems to work better ## if ((document.fullScreenElement && document.fullScreenElement !== null) || (document.msfullscreenElement && document.msfullscreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)) {
    if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
        if (elem.requestFullScreen) {
            elem.requestFullScreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullScreen) {
            elem.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }

    setTimeout(function() {
        if (window.innerWidth >= 640) {
            setCapaCestaHeight();
            setCapaProductosHeight();
            setCapaComedorHeight();
        }
        setCapasModalBodyMaxHeight();
    }, 300);
}

function toogleMapaLista(selector) {
    window.mostrarMesaLista = selector;

    if (selector == 'mesa') {
        document.getElementById('capa-mesas-comedor').style.display='block';
        document.getElementById('capa-mesas-lista').style.display='none';
        document.getElementById('boton_mapa').classList.remove('bg-white');
        document.getElementById('boton_mapa').classList.add('bg-gray-50');
        document.getElementById('boton_lista').classList.remove('bg-gray-50');
        document.getElementById('boton_lista').classList.add('bg-white');
        document.getElementById('boton_mapa').classList.remove('font-medium');
        document.getElementById('boton_mapa').classList.add('font-bold');
        document.getElementById('boton_lista').classList.remove('font-bold');
        document.getElementById('boton_lista').classList.add('font-medium');
    } else {
        document.getElementById('capa-mesas-comedor').style.display='none';
        document.getElementById('capa-mesas-lista').style.display='block';
        document.getElementById('boton_lista').classList.remove('bg-white');
        document.getElementById('boton_lista').classList.add('bg-gray-50');
        document.getElementById('boton_mapa').classList.remove('bg-gray-50');
        document.getElementById('boton_mapa').classList.add('bg-white');
        document.getElementById('boton_lista').classList.remove('font-medium');
        document.getElementById('boton_lista').classList.add('font-bold');
        document.getElementById('boton_mapa').classList.remove('font-bold');
        document.getElementById('boton_mapa').classList.add('font-medium');
    }
    setCapaComedorListasHeight();
}

function activarElementoUnicoProductoCompuesto(id_a_activar, id_capa_a_activar, clase_capas_opciones) {
    console.log('activarElementoUnicoProductoCompuesto de scripts.js raiz');

    document.getElementById(id_a_activar).click();

    let capaEllipseCheck = null;
    let capas_opciones = document.getElementsByClassName(clase_capas_opciones);
    for (let i = 0; i < capas_opciones.length; i++) {
        capas_opciones[i].style.borderColor = '#9fa6b2';

        capaEllipseCheck = capas_opciones[i].querySelector('.ellipseCheck');

        if (capaEllipseCheck) {
            if (!capaEllipseCheck.classList.contains('hidden')) {
                capaEllipseCheck.classList.add('hidden');
            }
        }
    }
    let capaAActivar = document.getElementById(id_capa_a_activar);
    if (capaAActivar) {
        capaAActivar.style.borderColor = '#156772';

        capaEllipseCheck = capaAActivar.querySelector('.ellipseCheck');

        if (capaEllipseCheck) {
            if (capaEllipseCheck.classList.contains('hidden')) {
                capaEllipseCheck.classList.remove('hidden');
            }
        }
    }
}

function toogleElementoProductoCompuesto(id_a_activar, id_capa_a_activar) {
    console.log('toogleElementoProductoCompuesto de scripts.js raiz');

    document.getElementById(id_a_activar).checked = !document.getElementById(id_a_activar).checked;

    let capaEllipseCheck = null;
    let capaAActivar = document.getElementById(id_capa_a_activar);
    if (capaAActivar) {
        capaEllipseCheck = capaAActivar.querySelector('.ellipseCheck');

        if (capaEllipseCheck) {
            if (capaEllipseCheck.classList.contains('hidden')) {
                capaEllipseCheck.classList.remove('hidden');
                capaAActivar.style.borderColor = '#156772';
            } else {
                capaEllipseCheck.classList.add('hidden');
                capaAActivar.style.borderColor = '#9fa6b2';
            }
        }
    }
}

function updateTituloRelacionado(idTitulo, id, descripcion) {
    let descripcionTrigger = document.getElementById('titulo_relacionado_dropdown_descripcion_' + idTitulo + '_trigger');
    let inputDescripcion = document.getElementById('titulo_relacionado_dropdown_descripcion_' + idTitulo + '_trigger').children[0];
    let inputProducto = document.getElementById('titulo_relacionado_cliente_' + idTitulo);

    if (descripcion && inputDescripcion) {
        inputDescripcion.value = descripcion;
    }
    if (inputProducto) {
        inputProducto.value = id;
    }
    if (descripcionTrigger && id !== 0) {
        descripcionTrigger.click();
    }
}
function buscadorClientes(idTitulo) {
    updateTituloRelacionado(idTitulo, 0, '');

    let descripcionABuscar = document.getElementById('titulo_relacionado_dropdown_descripcion_' + idTitulo + '_trigger').children[0].value;

    let capaResultados = document.getElementById('titulo_relacionado_dropdown_descripcion_' + idTitulo);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        capaResultados.innerHTML = 'Buscando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            if (res.descripciones && res.descripciones.length > 0) {
                let capaResultadosContenido = '';
                for (let i = 0; i < res.descripciones.length; i++) {
                    capaResultadosContenido += '<div onclick="updateTituloRelacionado(' + idTitulo + ', ' + res.ids[i] + ', \'' + res.descripciones[i] + '\'); datosFacturacionCesta(' + res.ids[i] + ',\'cesta\');" class="grid grid-cols-7 items-center space-x-2 h-12 px-3 hover:bg-gray-50">'
                    capaResultadosContenido += '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                    capaResultadosContenido += '<div class="col-span-6">' + res.descripciones[i] + '</div>';
                    capaResultadosContenido += '</div>';
                }

                capaResultados.innerHTML = capaResultadosContenido;
            } else {
                capaResultados.innerHTML = 'Clientes no encontrados.';
            }
        }
    }

    xhr.open("post", "/web-gestion/datos-pre-librador.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("id_idioma", id_idioma);
    formData.append("interface_js", interface_js);
    formData.append("ejercicio", ejercicio);
    formData.append("tipo_librador", tipoLibrador);
    formData.append("select", "buscar-libradores");
    formData.append("texto_buscar", descripcionABuscar);
    xhr.send(formData);
}

function loadDropdownDescripcionBuscador(idTitulo) {
    let targetElResultados = document.getElementById('titulo_relacionado_dropdown_descripcion_' + idTitulo);

    let triggerElResultados = document.getElementById('titulo_relacionado_dropdown_descripcion_' + idTitulo + '_trigger');

    let optionsResultados = {
        placement: 'bottom',
    };

    let dropdown = new Dropdown(targetElResultados, triggerElResultados, optionsResultados);
}

function mostrarComedor(id_comedor) {
    console.log('mostrarComedor (id_comedor: ' + id_comedor + ') -> ' + window.mostrarMesaLista + ' de scripts.js raiz');

    window.comedorActivo = 'comedor_' + id_comedor;
    let titulos_comedores = document.getElementsByClassName('titulo_comedor');
    for (let i = 0; i < titulos_comedores.length; i++) {
        titulos_comedores[i].classList.remove("bg-blendi-35");
    }
    document.getElementById('comedor_' + id_comedor).classList.add("bg-blendi-35");

    if(id_comedor != 'tak' && id_comedor != 'del') {
        document.getElementById('boton_nueva_recogida_local').style.display = 'none';
        document.getElementById('boton_nueva_entrega_domicilio').style.display = 'none';
        let linkEditarDisctroMes = document.getElementById('link_editar_distribucion_mesas');
        if (linkEditarDisctroMes) {
            linkEditarDisctroMes.style.display = 'inline-flex';
        }
        document.getElementById('boton_mapa').style.display = 'block';
        document.getElementById('boton_lista').style.display = 'block';
        if(window.mostrarMesaLista == 'mesa') {
            document.getElementById('capa-mesas-comedor').style.display = 'block';
            document.getElementById('capa-mesas-lista').style.display='none';
        }
        if(window.mostrarMesaLista == 'lista') {
            document.getElementById('capa-mesas-comedor').style.display = 'none';
            document.getElementById('capa-mesas-lista').style.display = 'block';
        }

        let mesas = document.getElementsByClassName('capa-mesa');
        for (let z = 0; z < mesas.length; z++) {
            if (mesas[z].dataset.idComedor == id_comedor) {
                mesas[z].style.display = 'block';
            } else {
                mesas[z].style.display = 'none';
            }
        }
        let lista = document.getElementsByClassName('capa-lista');
        for (let z = 0; z < lista.length; z++) {
            if (lista[z].dataset.idComedor == id_comedor) {
                lista[z].style.display = 'block';
            } else {
                lista[z].style.display = 'none';
            }
        }

        let lineas = document.getElementsByClassName('capa-linea');
        for (let y = 0; y < lineas.length; y++) {
            if (lineas[y].dataset.idComedor == id_comedor) {
                lineas[y].style.display = 'block';
            } else {
                lineas[y].style.display = 'none';
            }
        }
    }else {
        let linkEditarDisctroMes = document.getElementById('link_editar_distribucion_mesas');
        if (linkEditarDisctroMes) {
            linkEditarDisctroMes.style.display = 'none';
        }
        document.getElementById('boton_mapa').style.display = 'none';
        document.getElementById('boton_lista').style.display = 'none';
        document.getElementById('capa-mesas-comedor').style.display='none';
        document.getElementById('capa-mesas-lista').style.display='none';
    }
    if(id_comedor == 'tak') {
        document.getElementById('capa-mesas-recogida-local').style.display = 'block';
        document.getElementById('boton_nueva_recogida_local').style.display = 'inline-flex';
        document.getElementById('boton_nueva_entrega_domicilio').style.display = 'none';
    } else {
        document.getElementById('capa-mesas-recogida-local').style.display = 'none';
    }
    if(id_comedor == 'del') {
        document.getElementById('capa-mesas-entrega-domicilio').style.display = 'block';
        document.getElementById('boton_nueva_recogida_local').style.display = 'none';
        document.getElementById('boton_nueva_entrega_domicilio').style.display = 'inline-flex';
    } else {
        document.getElementById('capa-mesas-entrega-domicilio').style.display='none';
    }
}

function obtenerInfoVolcados(idDocumentoABuscar) {
    let capaResultados = document.getElementById('obtener_info_volcados_' + idDocumentoABuscar);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {
        capaResultados.innerHTML = 'Buscando...';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            if (res.length > 0) {
                let capaResultadosContenido = '';
                for (let i = 0; i < res.length; i++) {
                    capaResultadosContenido += '<div>' + res[i].info + '</div>';
                }

                capaResultados.innerHTML = capaResultadosContenido;
            } else {
                capaResultados.innerHTML = 'No hay información de documentos volcados.';
            }
        }
    }

    xhr.open("post", "/web-gestion/datos-pre-documentos.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("id_idioma", id_idioma);
    formData.append("interface_js", interface_js);
    formData.append("ejercicio", ejercicio);
    formData.append("select", "obtener_info_volcados");
    formData.append("id_documento", idDocumentoABuscar);
    xhr.send(formData);
}

function establecerTerminal(idTerminal) {
    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        window.location.href = "/admin/";
    }

    formData = new FormData();
    formData.append("ip", ip);
    formData.append("id_panel", id_panel);
    formData.append("id_terminal", idTerminal);

    xhr.open("POST", "/admin/usuarios/gestion/datos-cambio-terminal.php");
    xhr.send(formData);
}

function toggleCapa(capaId) {
    let capa = document.getElementById(capaId);
    let capaArrow = document.getElementById(capaId + 'Arrow');

    if (capa) {
        capa.classList.toggle('hidden');

        if (capaArrow) {
            if (capa.classList.contains('hidden')) {
                capaArrow.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>';
            } else {
                capaArrow.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />';
            }
        }
    }
}
function toggleAll(capaClass) {
    let capas = document.getElementsByClassName(capaClass);

    if (capas && capas.length) {
        for (let i = 0; i < capas.length; i++) {
            if (!capas[i].classList.contains('hidden')) {
                toggleCapa(capas[i].id);
            }
        }
    }
}
function toggleVersion() {
    let capas = document.getElementsByClassName('versiones');
    let selectorVersionAMostrar = document.getElementById('version');

    if (capas && capas.length) {
        for (let i = 0; i < capas.length; i++) {
            if (!capas[i].classList.contains('hidden')) {
                capas[i].classList.add('hidden');
            }
        }
    }
    if (selectorVersionAMostrar) {
        let capaVersionAMostrar = document.getElementById('capa_version_' + selectorVersionAMostrar.value);
        if (capaVersionAMostrar) {
            capaVersionAMostrar.classList.remove('hidden');
        }
    }
}

function toggleEstado(accion, estado, id_documento_1, id_documento_2, id_producto_relacionado) {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            alert('Prioridad enviada.');
        }
    }

    xhr.open("post", "/recepcion_pedidos/web-gestion/guardar-estados.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("id_sesion_js", id_sesion_js);
    formData.append("id_panel", id_panel);
    formData.append("ip", ip);
    formData.append("accion", accion);
    formData.append("id_documento_1", id_documento_1);
    formData.append("id_documento_2", id_documento_2);
    formData.append("id_producto_relacionado", id_producto_relacionado);
    formData.append("estado", estado);
    xhr.send(formData);
}

function toggleDisplay(idCapa) {
    let capa = document.getElementById(idCapa);

    if (capa) {
        if (capa.classList.contains('hidden')) {
            capa.classList.remove('hidden');
        } else {
            capa.classList.add('hidden');
        }
    }
}

function toggleIniciarSesionRegistro() {
    let iniciarSesion = document.getElementById('iniciar_sesion');
    if (iniciarSesion.classList.contains('hidden')) {
        iniciarSesion.classList.remove('hidden');
    } else {
        iniciarSesion.classList.add('hidden');
    }

    let registro = document.getElementById('registro');
    if (registro.classList.contains('hidden')) {
        registro.classList.remove('hidden');
    } else {
        registro.classList.add('hidden');
    }
}

function toggleOlvidasteTuContrasena() {
    let iniciarSesion = document.getElementById('iniciar_sesion');
    if (iniciarSesion.classList.contains('hidden')) {
        iniciarSesion.classList.remove('hidden');
    } else {
        iniciarSesion.classList.add('hidden');
    }

    let password_olvidado = document.getElementById('password_olvidado');
    if (password_olvidado.classList.contains('hidden')) {
        password_olvidado.classList.remove('hidden');
    } else {
        password_olvidado.classList.add('hidden');
    }
}

function restaurarContrasena() {
    console.log("restaurarContrasena de scripts.js raiz");
    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            document.getElementById('boton_restaurar_password').innerHTML = 'Sigue las instrucciones que te hemos enviado al correo.';
        }
    }

    xhr.open("post", "/admin/accesos/password_olvidado.php", true);
    let formData = new FormData();
    formData.append("email", document.getElementById('empresa_password_olvidado').value);
    xhr.send(formData);
}

function modificarContrasena(email, token) {
    console.log("restaurarContrasena de scripts.js raiz");
    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            window.location.href = '/';
        }
    }

    xhr.open("post", "/admin/accesos/restaurar_password.php", true);
    let formData = new FormData();
    formData.append("email", email);
    formData.append("token", token);
    formData.append("nuevo_password", document.getElementById('empresa_password_restaurar').value);
    xhr.send(formData);
}

function cerrarSesion() {
    if(window.sessionStorage) {
        sessionStorage.clear();
    }else {
        idSesion = '';
    }
    window.location.assign("/admin/cerrar-sesion");
}

// EJECUTAR SCRIPTS DESDE HTML DE UN AJAX
function nodeScriptReplace(node) {
    if ( nodeScriptIs(node) === true ) {
        node.parentNode.replaceChild( nodeScriptClone(node) , node );
    }
    else {
        var i = -1, children = node.childNodes;
        while ( ++i < children.length ) {
            nodeScriptReplace( children[i] );
        }
    }

    return node;
}
function nodeScriptClone(node){
    var script  = document.createElement("script");
    script.text = node.innerHTML;

    var i = -1, attrs = node.attributes, attr;
    while ( ++i < attrs.length ) {
        script.setAttribute( (attr = attrs[i]).name, attr.value );
    }
    return script;
}

function nodeScriptIs(node) {
    return node.tagName === 'SCRIPT';
}
// FIN EJECUTAR SCRIPTS DESDE HTML DE UN AJAX

// PUSH NOTIFICATIONS SCRIPTS
/**
 * functions to support PUSH notifications (PN) on user client
 */

/**
 * subscribe Push notifications (PN)
 * - check, if PN's are available
 * - request users permission, if not done so far
 * - register service worker, if permisson is granted
 */
async function pnSubscribe() {
    if (pnAvailable()) {
        // if not granted or denied so far...
        if (window.Notification.permission === "default") {
            await window.Notification.requestPermission();
        }
        if (Notification.permission === 'granted') {
            // register service worker
            await pnRegisterSW();
        }
    }
}

/**
 * helper while testing
 * unsubscribe Push notifications
 */
async function pnUnsubscribe() {
    var swReg = null;
    if (pnAvailable()) {
        // unfortunately there is no function to reset Notification permission...
        // unregister service worker
        await pnUnregisterSW();
    }
}

/**
 * helper while testing
 * update service worker.
 * works not correct on each browser/os -> sometimes brwoser have to
 * be restarted to update service worker
 */
async function pnUpdate() {
    var swReg = null;
    if (pnAvailable()) {
        // unfortunately there is no function to reset Notification permission...
        // unregister service worker
        await pnUpdateSW();
    }
}

/**
 * helper while testing
 * check if PN already subscribed
 */
async function pnSubscribed() {
    var swReg;
    if (pnAvailable()) {
        swReg = await navigator.serviceWorker.getRegistration();
    }
    return (swReg !== undefined);
}

/**
 * checks whether all requirements for PN are met
 * 1. have to run in secure context
 *    - window.isSecureContext = true
 * 2. browser should implement at least
 *    - navigatpr.serviceWorker
 *    - window.PushManager
 *    - window.Notification
 *
 * @returns boolen
 */
function pnAvailable() {
    var bAvailable = false;
    if (window.isSecureContext) {
        // running in secure context - check for available Push-API
        bAvailable = (('serviceWorker' in navigator) &&
            ('PushManager' in window) &&
            ('Notification' in window));
    } else {
        console.log('Para habilitar las notificaciones debes abrir la web con https.');
    }
    return bAvailable;
}

/**
 * register the service worker.
 * there is no check for multiple registration necessary - browser/Push-API
 * takes care if same service-worker ist already registered
 */
async function pnRegisterSW() {
    navigator.serviceWorker.register('/PNServiceWorker.js')
        .then((swReg) => {
            // registration worked
            console.log('Te has suscrito a las notificaciones de Blendi.');
            console.log('Scope de la suscripción de notificaciones ' + swReg.scope);
            checkNotificaciones();
        }).catch((error) => {
            // registration failed
            console.log('Registro fallido con el siguiente error: ' + error);
            checkNotificaciones();
        });
}

/**
 * helper while testing
 * unregister the service worker.
 */
async function pnUnregisterSW() {
    navigator.serviceWorker.getRegistration()
        .then(function(reg) {
            reg.unregister()
                .then(function(bOK) {
                    if (bOK) {
                        console.log('Has eliminado la suscripción de las notificaciones de Blendi.');
                    } else {
                        console.log('Ha fallado la eliminación a la suscripción de las notificaciones de Blendi.');
                    }
                    checkNotificaciones();
                });
        });
}

/**
 * helper while testing
 * update service worker.
 */
async function pnUpdateSW() {
    navigator.serviceWorker.getRegistration()
        .then(function(reg) {
            reg.update()
                .then(function(bOK) {
                    if (bOK) {
                        console.log('Modificada la suscripción a las notificaciones de Blendi.');
                    } else {
                        console.log('Fallo en la modificación de la suscripción a las notificaciones de Blendi.');
                    }
                    checkNotificaciones();
                });
        });
}

function checkNotificaciones() {
    let notificacionesBody = document.getElementById('dropdown_notificaciones');

    if (window.Notification.permission === "denied") {
        notificacionesBody.innerHTML = 'Se han denegado las notificaciones. Para activarlas tienes que restablecerlas, actualizar la web y volver a registrarte.';
    } else {
        var strMsg;
        pnSubscribed()
            .then(function(subscribed) {
                if (subscribed) {
                    notificacionesBody.innerHTML = 'Estas suscrito a las notificaciones. Para desactivarlas haz click <a href="#" onclick="pnUnsubscribe()">aquí</a>.';
                } else {
                    notificacionesBody.innerHTML = 'No estas suscrito a las notificaciones. Para activarlas haz click <a href="#" onclick="pnSubscribe()">aquí</a>.';
                }
            });
    }
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function refreshNotificaciones() {
    let notificacion = getCookie('notificacion');

    if (!notificacion) {
        return;
    }

    setCookie('notificacion', '', 1)

    notificacion = notificacion.split(':');
    let titulo = (notificacion[0] !== undefined)? notificacion[0] : '';
    let body = (notificacion[1] !== undefined)? notificacion[1] : '';

    let notificaciones = document.getElementById('notificaciones-mensajes');
    if (notificaciones) {
        let notificacionesTitulo = document.getElementById('notificaciones-mensajes-titulo');
        let notificacionesBody = document.getElementById('notificaciones-mensajes-body');

        if (notificacionesTitulo && notificacionesBody) {
            notificacionesTitulo.innerHTML = titulo;
            notificacionesBody.innerHTML = body;

            notificaciones.classList.remove('hidden');

            ocultarNotificaciones = setTimeout(function () {
                let notificaciones = document.getElementById('notificaciones-mensajes');
                if (notificaciones) {
                    notificaciones.classList.add('hidden');
                }
            }, 10000);
        }
    }
}
setInterval(refreshNotificaciones, 3000);
// FIN PUSH NOTIFICATIONS SCRIPTS

// INICIO KEYBOARD
let kioskBoardInitialized = false;
function loadKeyboard(inputIdToFocus) {
    if (!kioskBoardInitialized) {
        kioskBoardInitialized = true;
        KioskBoard.run('.js-virtual-keyboard', {
            /*!
            * Required
            * An Array of Objects has to be defined for the custom keys. Hint: Each object creates a row element (HTML) on the keyboard.
            * e.g. [{"key":"value"}, {"key":"value"}] => [{"0":"A","1":"B","2":"C"}, {"0":"D","1":"E","2":"F"}]
            */
            keysArrayOfObjects: null,

            /*!
            * Required only if "keysArrayOfObjects" is "null".
            * The path of the "kioskboard-keys-${langugage}.json" file must be set to the "keysJsonUrl" option. (XMLHttpRequest to get the keys from JSON file.)
            * e.g. '/Content/Plugins/KioskBoard/dist/kioskboard-keys-english.json'
            */
            keysJsonUrl: '/lib/kioskboard/kioskboard-keys-spanish.json',

            /*
            * Optional: An Array of Strings can be set to override the built-in special characters.
            * e.g. ["#", "€", "%", "+", "-", "*"]
            */
            keysSpecialCharsArrayOfStrings: null,

            /*
            * Optional: An Array of Numbers can be set to override the built-in numpad keys. (From 0 to 9, in any order.)
            * e.g. [1, 2, 3, 4, 5, 6, 7, 8, 9, 0]
            */
            keysNumpadArrayOfNumbers: null,

            // Optional: (Other Options)

            specialCharacters: true,

            // Language Code (ISO 639-1) for custom keys (for language support) => e.g. "de" || "en" || "fr" || "hu" || "tr" etc...
            language: 'es',

            // The theme of keyboard => "light" || "dark" || "flat" || "material" || "oldschool"
            theme: 'dark',

            // Scrolls the document to the top or bottom(by the placement option) of the input/textarea element. Prevented when "false"
            autoScroll: true,

            // Uppercase or lowercase to start. Uppercased when "true"
            capsLockActive: false,

            /*
            * Allow or prevent real/physical keyboard usage. Prevented when "false"
            * In addition, the "allowMobileKeyboard" option must be "true" as well, if the real/physical keyboard has wanted to be used.
            */
            allowRealKeyboard: true,

            // Allow or prevent mobile keyboard usage. Prevented when "false"
            allowMobileKeyboard: false,

            // CSS animations for opening or closing the keyboard
            cssAnimations: true,

            // CSS animations duration as millisecond
            cssAnimationsDuration: 360,

            // CSS animations style for opening or closing the keyboard => "slide" || "fade"
            cssAnimationsStyle: 'slide',

            // Enable or Disable Spacebar functionality on the keyboard. The Spacebar will be passive when "false"
            keysAllowSpacebar: true,

            // Text of the space key (Spacebar). Without text => " "
            keysSpacebarText: 'Space',

            // Font family of the keys
            keysFontFamily: 'sans-serif',

            // Font size of the keys
            keysFontSize: '16px',

            // Font weight of the keys
            keysFontWeight: 'normal',

            // Size of the icon keys
            keysIconSize: '19px',

            // Text of the Enter key (Enter/Return). Without text => " "
            keysEnterText: 'Enter',

            // The callback function of the Enter key. This function will be called when the enter key has been clicked.
            keysEnterCallback: undefined,

            // The Enter key can close and remove the keyboard. Prevented when "false"
            keysEnterCanClose: true,
        });
    }

    setTimeout((function() {
        let inputToFocus = document.getElementById(inputIdToFocus);
        if (inputToFocus) {
            inputToFocus.focus();
        }
    }), 1000);
}
// FIN KEYBOARD

// INICIO SWIPE DETECTION
function swipedetect(el, callback){

    var touchsurface = el,
        swipedir,
        startX,
        startY,
        distX,
        distY,
        threshold = 150, //required min distance traveled to be considered swipe
        restraint = 100, // maximum distance allowed at the same time in perpendicular direction
        allowedTime = 300, // maximum time allowed to travel that distance
        elapsedTime,
        startTime,
        handleswipe = callback || function(swipedir){}

    touchsurface.addEventListener('touchstart', function(e){
        var touchobj = e.changedTouches[0]
        swipedir = 'none'
        dist = 0
        startX = touchobj.pageX
        startY = touchobj.pageY
        startTime = new Date().getTime() // record time when finger first makes contact with surface
        //e.preventDefault()
    }, false)

    touchsurface.addEventListener('touchmove', function(e){
        //e.preventDefault() // prevent scrolling when inside DIV
    }, false)

    touchsurface.addEventListener('touchend', function(e){
        var touchobj = e.changedTouches[0]
        distX = touchobj.pageX - startX // get horizontal dist traveled by finger while in contact with surface
        distY = touchobj.pageY - startY // get vertical dist traveled by finger while in contact with surface
        elapsedTime = new Date().getTime() - startTime // get time elapsed
        if (elapsedTime <= allowedTime){ // first condition for awipe met
            if (Math.abs(distX) >= threshold && Math.abs(distY) <= restraint){ // 2nd condition for horizontal swipe met
                swipedir = (distX < 0)? 'left' : 'right' // if dist traveled is negative, it indicates left swipe
            }
            else if (Math.abs(distY) >= threshold && Math.abs(distX) <= restraint){ // 2nd condition for vertical swipe met
                swipedir = (distY < 0)? 'up' : 'down' // if dist traveled is negative, it indicates up swipe
            }
        }
        handleswipe(swipedir)
        //e.preventDefault()
    }, false)
}
// FIN SWIPE DETECTION
