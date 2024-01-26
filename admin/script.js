function sideBar(mostrar) {
    if(mostrar == "1") {
        document.getElementById('sidebar').style.display = "block";
    }else if(mostrar == "0") {
        document.getElementById('sidebar').style.display = "none";
    }else {
        if (document.getElementById('sidebar').style.display == "none") {
            document.getElementById('sidebar').style.display = "block";
        } else {
            document.getElementById('sidebar').style.display = "none";
        }
    }
    /*
    if(window.innerWidth > 500) {
        if (document.getElementById('sidebar').style.right == '0px') {
            document.getElementById('sidebar').style.right = '-25%';
            document.getElementById('capa_filtros').style.width = '100%';
            document.getElementById('capa_filtros').style.marginRight = '0%';
            document.getElementById('capa_lista').style.width = '100%';
            document.getElementById('capa_lista').style.marginRight = '0%';
            document.getElementById('capa_ficha').style.width = '100%';
            document.getElementById('capa_ficha').style.marginRight = '0%';
            document.getElementById('info-main').style.width = '100%';
            document.getElementById('info-main').style.marginRight = '0%';
        } else {
            window.scrollTo(0, 0);
            document.getElementById('sidebar').style.right = '0px';
            document.getElementById('capa_filtros').style.width = '75%';
            document.getElementById('capa_filtros').style.marginRight = '25%';
            document.getElementById('capa_lista').style.width = '75%';
            document.getElementById('capa_lista').style.marginRight = '25%';
            document.getElementById('capa_ficha').style.width = '75%';
            document.getElementById('capa_ficha').style.marginRight = '25%';
            document.getElementById('info-main').style.width = '75%';
            document.getElementById('info-main').style.marginRight = '25%';
        }
    }else {
        if (document.getElementById('sidebar').style.right == '0px') {
            document.getElementById('sidebar').style.right = '-100%';
            document.getElementById('capa_filtros').style.display = 'block';
            document.getElementById('capa_lista').style.display = 'block';
            document.getElementById('capa_ficha').style.display = 'block';
            document.getElementById('info-main').style.display = 'block';
        } else {
            window.scrollTo(0, 0);
            document.getElementById('sidebar').style.width = '100%';
            document.getElementById('sidebar').style.right = '0px';
            document.getElementById('capa_filtros').style.display = 'none';
            document.getElementById('capa_lista').style.display = 'none';
            document.getElementById('capa_ficha').style.display = 'none';
            document.getElementById('info-main').style.display = 'none';
        }
    }
    */
}
function collapseCapa(capa) {
    let capaToToogleVisibility = document.getElementById(capa);
    let capaToToogleVisibilityArrowHidden = document.getElementById(capa + '-hidden');
    let capaToToogleVisibilityArrowShow = document.getElementById(capa + '-show');
    if(capaToToogleVisibility.classList.contains('hidden')) {
        capaToToogleVisibility.classList.remove('hidden');
    }else {
        capaToToogleVisibility.classList.add('hidden');
    }
    if (capaToToogleVisibilityArrowHidden && capaToToogleVisibilityArrowShow) {
        collapseCapa(capa + '-hidden');
        collapseCapa(capa + '-show');
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
    formData.append("id_panel", idPanel);
    formData.append("ip", ip);
    formData.append("select", "guardar-dark-mode");
    formData.append("dark_mode", darkMode);
    xhr.send(formData);
}

function selectReset(selectElement) {
    var i, L = selectElement.options.length - 1;
    for(i = L; i >= 0; i--) {
        selectElement.remove(i);
    }
}
function selectCompletar(idSelect,tabla) {
    var main = document.querySelector("#main");
    var infoMain = document.querySelector("#info-main");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(res){
        (xhr.readyState < 4) ? main.style.display = "none" : main.style.display = "block";
        infoMain.innerHTML = '<img src="../images/loader.gif" alt="Cargando datos" title="Cargando datos" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            var indiceSelected = 0;
            var optionSelect = document.getElementById(idSelect);
            for(var bucle = 0 ; bucle < res.id.length ; bucle++) {
                optionSelect.options[bucle] = new Option(res.idioma[bucle], res.id[bucle]);
                if(res.id[bucle] == idIdioma) {
                    indiceSelected = bucle;
                }
            }
            optionSelect.options[indiceSelected].defaultSelected = true;
        }
    }
    if(tabla == "idiomas") {
        var ruta = "/admin/idiomas/gestion/datos-select.php";
    }
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "idioma");
    formData.append("id", "");
    xhr.open("POST", ruta);
    xhr.send(formData);
}

function nombreImagen() {
    if(document.getElementById("nombre_imagen").value == "") {
        alert("Especificar un nombre para la imagen.");
        document.getElementById("nombre_imagen").focus();
        return false;
    }
}

function SavePhoto(imagen,ruta,destino,nombre,idFoto,idProducto,idEnlazado,idMultiple,idPack,username=null,password=null) {
    nombre = nombre.replace(/[^a-zA-Z0-9]/g,'-').replace(/--/g,'-');
    nombre = nombre.toLowerCase();
    var messages = document.querySelector("#capa_boton_subir_imagen");
    let xhr = new XMLHttpRequest();
    let file = imagen.files[0];

    xhr.onreadystatechange = function (res) {
        messages.innerHTML = "Cargando imagen. <img src='/images/loader.gif' class='w-20p' alt='Cargando' />";
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            if (window.apartado) {
                cambiarApartadoFicha(window.apartado);
            } else if (username !== null && password !== null) {
                window.location.reload();
            } else {
                cambiarApartadoFicha('');
            }
        }
    }

    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("ruta", ruta);
    formData.append("destino", "images/"+destino);
    formData.append("nombre", nombre);
    formData.append("id_foto", idFoto);
    formData.append("id_producto", idProducto);
    formData.append("id_enlazado", idEnlazado);
    formData.append("id_multiple", idMultiple);
    formData.append("id_pack", idPack);
    formData.append("file", file);
    if (username && password) {
        formData.append("empresa", username);
        formData.append("clave", password);
    }
    xhr.timeout = 5000;
    xhr.open("POST", "/admin/subir_imagen.php");
    xhr.send(formData);
}

function cambiarEstadoImagenes(idProductosImages) {
    var contenedor = document.querySelector("#capa_img_activo_"+idProductosImages);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(res){
        contenedor.innerHTML = '<img src="../../../images/loader.gif" class="w-20p" alt="Cambiando estado" title="Cambiando estado" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            if(res.valor == 1) {
                contenedor.innerHTML = '<img src="../../../images/valid-20.png" id="img-activo-'+idProductosImages+'" class="w-20p" alt="Activo" title="Activo" onmouseover="this.style.cursor=\'pointer\'" onclick="cambiarEstadoImagenes(\''+idProductosImages+'\');" />';
            }else {
                contenedor.innerHTML = '<img src="../../../images/invalid-20.png" id="img-activo-'+idProductosImages+'" class="w-20p" alt="Inactivo" title="Inactivo" onmouseover="this.style.cursor=\'pointer\'" onclick="cambiarEstadoImagenes(\''+idProductosImages+'\');" />';
            }
        }
    }
    xhr.open("post", "/admin/productos/imagenes/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id_productos_images", idProductosImages);
    formData.append("select", "estado");
    xhr.send(formData);
}

function filtrarKey(id,valor,tipo) {
    var newValor = "";
    if(tipo == "nombre_foto") {
        var validsKey = "abcdefghijklmnopqrstuvwxyz1234567890-";
        var changesKey = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    }else if(tipo == "importe") {
        var validsKey = "1234567890-.";
    }
    for(var bucleValor=0 ; bucleValor<valor.length ; bucleValor++) {
        var decimal = 0;
        var valido = false;
        var caracter = valor.charAt(bucleValor);
        for(var bucleValidsKey=0 ; bucleValidsKey<validsKey.length ; bucleValidsKey++) {
            if (validsKey.charAt(bucleValidsKey) == caracter) {
                if (tipo == "importe") {
                    if (caracter != "-" && caracter != ".") {
                        valido = true;
                    } else if (caracter == "-" && bucle == 0) {
                        valido = true;
                    } else if (caracter == "," || caracter == ".") {
                        decimal += 1;
                        if (decimal == 1) {
                            caracter = ".";
                            valido = true;
                        }
                    }
                } else {
                    valido = true;
                }
            }else {
                if (tipo == "nombre_foto") {
                    for(var bucleChangesKey=0 ; bucleChangesKey<changesKey.length ; bucleChangesKey++) {
                        if (changesKey.charAt(bucleChangesKey) == caracter) {
                            caracter = validsKey.charAt(bucleChangesKey);
                            valido = true;
                        }else if (caracter == " ") {
                            caracter = "-";
                            valido = true;
                        }
                    }
                }
            }
        }
        if (valido == true) {
            newValor += caracter;
        }
    }
    if(newValor != valor) {
        if(tipo == "nombre_foto") {
            alert("Sólo se permiten letras minúsculas, números y guión medio.");
        }else if(tipo == "importe") {
            alert("Sólo se permiten guión medio (negativo), números y . (decimal).");
        }
        document.getElementById(id).focus();
        document.getElementById(id).value = newValor;
    }
}

function renombrarImagen(modulo,tabla,etiquetaRetorno,id,linkOtros) {
    var nombre = document.getElementById("nombre_imagen").value;
    nombre = nombre.replace(/[^a-zA-Z0-9\/]/g,'-').replace(/--/g,'-');
    nombre = nombre.toLowerCase();
    var messages = document.querySelector("#capa_boton_renombrar_imagen");
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function (res) {
        messages.innerHTML = "Renombrando imagen. <img src='/images/loader.gif' class='w-20p' alt='Cargando' />";
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            if (window.apartado) {
                cambiarApartadoFicha(window.apartado);
            } else {
                cambiarApartadoFicha('');
            }
        }
    }

    let form = document.querySelector("#form_datos_post");
    formData = new FormData(form);
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("nombre", nombre);
    formData.append("select", "renombrar");
    formData.append("modulo", modulo);
    formData.append("tabla", tabla);
    formData.append("id_renombrar", id);

    xhr.open("POST", "/admin/imagenes/ftp/datos-ftp.php");
    xhr.send(formData);
}

function establecerTerminal(idTerminal) {
    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        window.location.href = "/admin/";
    }

    formData = new FormData();
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_terminal", idTerminal);

    xhr.open("POST", "/admin/usuarios/gestion/datos-cambio-terminal.php");
    xhr.send(formData);
}

function FullScreenMode(url){
    var win = window.open("", "full", "dependent=yes, fullscreen=yes");
    win.location = url;
    win.moveTo(0,0);
    win.resizeTo(screen.width, screen.height);
    window.opener = null;
}

function cerrarSesion() {
    if(window.sessionStorage) {
        sessionStorage.clear();
    }else {
        idSesion = '';
    }
    window.location.assign("/admin/cerrar-sesion");
}

/* Funciones listados */
window.pagina = 1;
window.resultados = 10;
window.busqueda = '';
window.filtros = [];
window.valoresFiltros = [];
function cargarListado() {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            let capaLista = document.getElementById('capa_lista');

            if (capaLista) {
                capaLista.innerHTML = this.responseText;

                nodeScriptReplace(capaLista);
            }
        }
    }

    let parametrosFiltros = '';
    let capaListadoFiltros = document.getElementById('listadoFiltros');
    let contenidoCapaListadoFiltros = '';
    for (let indexFiltro = 0; indexFiltro < window.filtros.length; indexFiltro++) {
        if (capaListadoFiltros) {
            contenidoCapaListadoFiltros += '<div class="flex rounded-full bg-gray-250 p-2 ml-2 h-10 leading-6 cursor-pointer text-gray-650"><div>' + window.filtros[indexFiltro] + ': ' + ((window.valoresFiltros[indexFiltro] == 1 || window.valoresFiltros[indexFiltro] == 0)? ((window.valoresFiltros[indexFiltro] == 0)? 'No' : 'Sí') : window.valoresFiltros[indexFiltro]) + '</div><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" onclick="eliminarFiltro(' + indexFiltro + ')"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></div>';
        }

        parametrosFiltros += '/' + window.filtros[indexFiltro] + '=' + encodeURIComponent(window.valoresFiltros[indexFiltro]);
    }
    if (capaListadoFiltros) {
        capaListadoFiltros.innerHTML = contenidoCapaListadoFiltros;
    }

    xhr.open("get", window.location.href.split('#')[0] + '/ajax=1/pagina=' + window.pagina + '/resultados=' + window.resultados + '/busqueda=' + encodeURIComponent(window.busqueda) + parametrosFiltros, true);
    xhr.send();
}

function descargarListado(tipoDescarga) {
    let parametrosFiltros = '';
    for (let indexFiltro = 0; indexFiltro < window.filtros.length; indexFiltro++) {
        parametrosFiltros += '/' + window.filtros[indexFiltro] + '=' + encodeURIComponent(window.valoresFiltros[indexFiltro]);
    }

    window.location.href = window.location.href.split('#')[0] + '/ajax=1/pagina=' + window.pagina + '/resultados=' + window.resultados + '/busqueda=' + encodeURIComponent(window.busqueda) + '/descarga=' + tipoDescarga + parametrosFiltros;
}

function listadoPagina(pagina) {
    window.pagina = pagina;

    cargarListado();
}

function listadoMostrarResultados(resultados) {
    window.pagina = 1;
    window.resultados = resultados;

    cargarListado();
}

function listadoBusqueda(texto) {
    window.pagina = 1;
    window.busqueda = texto;

    cargarListado();
}

function listadoFiltrar(filtro, valorFiltro) {
    window.pagina = 1;

    if (!window.filtros.includes(filtro)) {
        window.filtros.push(filtro);
    }

    let indexFiltro = window.filtros.findIndex(function (filtroFind) {
        return filtro === filtroFind;
    });

    window.valoresFiltros[indexFiltro] = valorFiltro;

    let capaDropdownFiltrosMenu = document.getElementById('dropdownFiltros');
    if (capaDropdownFiltrosMenu) {
        capaDropdownFiltrosMenu.click();
    }

    let capaCheckboxFiltros = document.getElementsByClassName('filtro_' + filtro);
    for (let i = 0; i < capaCheckboxFiltros.length; i++) {
        if (capaCheckboxFiltros[i]) {
            capaCheckboxFiltros[i].checked = false;
        }
    }
    let capaCheckboxFiltro = document.getElementById('filtro_' + filtro + '_' + valorFiltro);
    if (capaCheckboxFiltro) {
        capaCheckboxFiltro.checked = true;
    }

    cargarListado();
}

function eliminarFiltro(indexFiltro) {
    let capaCheckboxFiltro = document.getElementById('filtro_' + window.filtros[indexFiltro] + '_' + window.valoresFiltros[indexFiltro]);
    if (capaCheckboxFiltro) {
        capaCheckboxFiltro.checked = false;
    }

    window.filtros.splice(indexFiltro, 1);
    window.valoresFiltros.splice(indexFiltro, 1);

    cargarListado();
}

function loadDropdownResultadosListado() {
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

function setCapaListadosHeight() {
    let capaListadoResultados = document.getElementById('capa_listado_resultados');
    if (capaListadoResultados) {
        let newHeight = window.innerHeight - capaListadoResultados.offsetTop - 100;
        capaListadoResultados.style.height = newHeight.toString() + 'px';
    }
}

function setCapaBodyFichaModalHeight() {
    let capaBodyFichaModal = document.getElementById('body-ficha-modal');
    if (capaBodyFichaModal) {
        let newHeight = window.innerHeight - capaBodyFichaModal.offsetTop - 219;
        capaBodyFichaModal.style.height = newHeight.toString() + 'px';
    }
}

function toogleHabilitar(id, apartado) {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(res.logs);
        }
    }
    xhr.open("post", "/admin/" + apartado + "/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id_" + apartado, id);
    formData.append("select", "estado");
    xhr.send(formData);
}

/* Fin funciones listado */

/* Funciones ficha */

window.ruta_sys = '';
function guardarFicha(accion) {
    console.log('Guardar ficha.');

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
    }else {
        /* AQUI CONTROLAMOS LOS CAMPOS OBLIGATORIOS */
        /*if(document.getElementById("nombre_libradores").value == "" && document.getElementById("razon_social_libradores").value == "") {
            alert("El nombre o la razón social deben rellenarse.");
            document.getElementById("nombre_libradores").focus();
            guardar = false;
        }*/
    }
    if(guardar == true) {
        let botonFichaModal = document.getElementById("boton-guardar-ficha-modal");
        if (accion == 'eliminar') {
            botonFichaModal = document.getElementById("boton-eliminar-ficha-modal");
        }

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {
            botonFichaModal.disabled = true;
            if (accion == 'eliminar') {
                botonFichaModal.innerHTML = 'Eliminando...';
            } else {
                botonFichaModal.innerHTML = 'Guardando...';
            }
        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                console.log(res.logs);

                if (accion == 'eliminar') {
                    botonFichaModal.innerHTML = 'Eliminado';
                } else {
                    if (res.id) {
                        window.id_ficha = res.id;
                    }
                    botonFichaModal.disabled = false;
                    botonFichaModal.innerHTML = 'Guardar';
                }

                if(res.resultado == "DELETE") {
                    cerrarFicha();
                } else {
                    if (window.apartado) {
                        cambiarApartadoFicha(window.apartado);
                    } else {
                        cambiarApartadoFicha('');
                    }
                }
                cargarListado();
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
}

function setRutaSys(ruta) {
    window.ruta_sys = ruta;
}

window.id_ficha = null;
function setIdFicha(id) {
    window.id_ficha = id;
}
function abrirFicha(id, extraUrl = '') {
    console.log('Abrir ficha.');

    setIdFicha(id);

    let botonGuardarFichaModal = document.getElementById("boton-guardar-ficha-modal");
    if (botonGuardarFichaModal) {
        botonGuardarFichaModal.disabled = false;
        botonGuardarFichaModal.innerHTML = 'Guardar';
    }
    let botonEliminarFichaModal = document.getElementById("boton-eliminar-ficha-modal");
    if (botonEliminarFichaModal) {
        botonEliminarFichaModal.disabled = false;
        botonEliminarFichaModal.innerHTML = 'Eliminar';

        if (id == 0 && !botonEliminarFichaModal.classList.contains('hidden')) {
            botonEliminarFichaModal.classList.add('hidden');
        }
        if (id != 0){
            botonEliminarFichaModal.classList.remove('hidden');
        }
    }


    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            let capaBodyListaModal = document.getElementById('body-ficha-modal');

            if (capaBodyListaModal) {
                capaBodyListaModal.innerHTML = this.responseText;

                nodeScriptReplace(capaBodyListaModal);

                let capaBotonOpenModalFicha = document.getElementById('botonOpenModalFicha');
                if (capaBotonOpenModalFicha) {
                    capaBotonOpenModalFicha.click();
                }
            }
        }
    }

    xhr.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha + extraUrl, true);
    xhr.send();
}

window.apartado = null;
function cambiarApartadoFicha(apartado) {
    console.log('Cambiar apartado ficha.');

    window.apartado = apartado;

    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            let capaBodyListaModal = document.getElementById('body-ficha-modal');

            if (capaBodyListaModal) {
                capaBodyListaModal.innerHTML = this.responseText;

                nodeScriptReplace(capaBodyListaModal);
            }
        }
    }

    let apartadoUrl = (window.apartado)? '/apartado=' + window.apartado : '';
    xhr.open("get", window.location.href.split('#')[0] + '/ajax=1/id=' + window.id_ficha + apartadoUrl, true);
    xhr.send();
}
function activarBotonesPorDefectoFicha() {
    let botones_por_defecto_ficha = document.getElementById('botones_por_defecto_ficha');

    if (botones_por_defecto_ficha.classList.contains('hidden')) {
        botones_por_defecto_ficha.classList.remove('hidden')
    }
}
function desactivarBotonesPorDefectoFicha() {
    let botones_por_defecto_ficha = document.getElementById('botones_por_defecto_ficha');

    if (!botones_por_defecto_ficha.classList.contains('hidden')) {
        botones_por_defecto_ficha.classList.add('hidden')
    }
}

function cerrarFicha() {
    window.id_ficha = null;
    window.apartado = null;

    let capaBotonOpenModalFicha = document.getElementById('botonOpenModalFicha');
    if (capaBotonOpenModalFicha) {
        capaBotonOpenModalFicha.click();
    }
}

function modificarTituloFichaModal(valor) {
    let capaTituloFichaModal = document.getElementById('titulo-ficha-modal');
    if (capaTituloFichaModal) {
        capaTituloFichaModal.innerHTML = valor;
    }
}

function activarElementoUnicoFicha(id_a_activar, id_capa_a_activar, clase_capas_opciones) {
    console.log('activarElementoUnicoFicha de scripts.js raiz');

    document.getElementById(id_a_activar).click();

    let capas_opciones = document.getElementsByClassName(clase_capas_opciones);
    for (let i = 0; i < capas_opciones.length; i++) {
        capas_opciones[i].style.borderColor = '#9fa6b2';
    }
    document.getElementById(id_capa_a_activar).style.borderColor = '#156772';

    let checkADesactivar = document.getElementsByClassName('check_' + clase_capas_opciones);
    for (let i = 0; i < checkADesactivar.length; i++) {
        if (checkADesactivar[i] && !checkADesactivar[i].classList.contains('hidden')) {
            checkADesactivar[i].classList.add('hidden');
        }
    }

    let checkAActivar = document.getElementById('check_' + id_a_activar);
    if (checkAActivar && checkAActivar.classList.contains('hidden')) {
        checkAActivar.classList.remove('hidden');
    }

    let contracheckAActivar = document.getElementsByClassName('contracheck_' + clase_capas_opciones);
    for (let i = 0; i < contracheckAActivar.length; i++) {
        if (contracheckAActivar[i] && contracheckAActivar[i].classList.contains('hidden')) {
            contracheckAActivar[i].classList.remove('hidden');
        }
    }

    let contracheckADesctivar = document.getElementById('contracheck_' + id_a_activar);
    if (contracheckADesctivar && !contracheckADesctivar.classList.contains('hidden')) {
        contracheckADesctivar.classList.add('hidden');
    }
}

function abrirFichaEnNuevaPestana(id, url = '') {
    if (url === '') {
        url = window.location.href.split('#')[0];
    }
    url += '/ancla_ficha_modal=' + id;

    window.open(url, '_blank').focus();
}

/* Fin funciones ficha */

/* Pasos registro */
function sendFromSteps(idForm, omitir) {
    let xhr = new XMLHttpRequest();
    let botonOmitir = document.getElementById(idForm + '-omitir');
    let botonContinuar = document.getElementById(idForm + '-continuar');
    xhr.onreadystatechange = function (res) {
        botonContinuar.disabled = true;
        botonOmitir.disabled = true;
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            document.getElementById('formulario-steps-hidden').submit();
        }
    }
    xhr.open("post", "/admin/usuarios/gestion/steps.php", true);
    let formData = document.querySelector("#" + idForm);
    formData = new FormData(formData);
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("empresa", document.getElementById('formulario-steps-hidden-empresa').value);
    formData.append("clave", document.getElementById('formulario-steps-hidden-clave').value);
    formData.append("omitir", omitir);
    xhr.send(formData);
}
/* Fin pasos registro */

/* Suscripción */
function suscripcionModificarIVAyTotal() {
    let softwareTotal = document.getElementById('software-total');
    let planTotal = document.getElementById('plan-total');
    let terminalesAdicionales = document.getElementById('terminales-adicionales');
    let terminalesTotal = document.getElementById('terminales-total');
    let pagarIva = document.getElementById('pagar-iva');
    let pagarTotal = document.getElementById('pagar-total');

    let softwareCompra = document.querySelectorAll('input[name="software-compra"]');
    let softwareCompraSelected = null;

    for (let i=0; i<softwareCompra.length; ++i)
        if (softwareCompra[i].checked) softwareCompraSelected = softwareCompra[i];

    let softwarePlan = document.querySelectorAll('input[name="software-plan"]');
    let softwarePlanSelected = null;

    for (let z=0; z<softwarePlan.length; ++z)
        if (softwarePlan[z].checked) softwarePlanSelected = softwarePlan[z];

    if (softwareCompraSelected && softwarePlanSelected && pagarIva && pagarTotal && softwareTotal && planTotal) {
        let subtotal = parseFloat(softwareCompraSelected.dataset.precio) + parseFloat(softwarePlanSelected.dataset.precio) + (parseFloat(terminalesAdicionales.value) * 15);
        let total = subtotal * 1.21;
        let iva = total - subtotal;

        softwareTotal.innerHTML = parseFloat(softwareCompraSelected.dataset.precio).toFixed(2);
        planTotal.innerHTML = parseFloat(softwarePlanSelected.dataset.precio).toFixed(2);
        terminalesTotal.innerHTML = (parseFloat(terminalesAdicionales.value) * 15).toFixed(2);
        pagarIva.innerHTML = iva.toFixed(2);
        pagarTotal.innerHTML = total.toFixed(2);
    }
}

function sendFromSuscription() {
    let xhr = new XMLHttpRequest();
    let botonSuscribirse = document.getElementById('config-suscripcion-continuar');
    let botonCancelarSuscribirse = document.getElementById('config-cancelar-suscripcion-continuar');
    xhr.onreadystatechange = function (res) {
        botonSuscribirse.disabled = true;
        if (botonCancelarSuscribirse) {
            botonCancelarSuscribirse.disabled = true;
        }
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            document.getElementById('link-suscripcion-back').click();
        }
    }
    xhr.open("post", "/admin/usuarios/gestion/suscripcion.php", true);
    let formData = document.querySelector("#config-suscripcion");
    formData = new FormData(formData);
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    xhr.send(formData);
}
/* Fin Suscripción */

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

function cargarImagen(miImagen) {
    //verificar una imagen segun su ratio

        const diffImage = miImagen.naturalWidth - miImagen.naturalHeight;

        if (diffImage > 15) {
            // Si es horizontal, aplica la clase max-h-[20px]
            miImagen.classList.add("max-h-[20px]");
        } else {
            // Si es vertical, aplica la clase max-h-[50px]
            miImagen.classList.add("max-h-[50px]");
        }

}