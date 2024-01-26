function cerrarSesion() {
    if(window.sessionStorage) {
        sessionStorage.clear();
    }else {
        idSesion = '';
    }
    window.location.assign("/admin/cerrar-sesion");
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
    formData.append("id_panel", id_panel);
    formData.append("ip", ip);
    formData.append("select", "guardar-dark-mode");
    formData.append("dark_mode", darkMode);
    xhr.send(formData);
}

function toggleEstado(accion, estado, id_documento_1, id_documento_2, id_producto_relacionado) {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            actualizarCocina();
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

function actualizarCocina() {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            let cuerpo = document.getElementById('cuerpo');
            if (cuerpo) {
                cuerpo.innerHTML = xhr.response;
                nodeScriptReplace(cuerpo);
            }
        }
    }

    xhr.open("post", "/recepcion_pedidos/", true);
    let formData = new FormData();
    formData.append("ajax", true);
    xhr.send(formData);
}

function eliminarRecepcionPedido(id_det) {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            actualizarCocina();
        }
    }

    xhr.open("post", "/web-gestion/eliminar_recepcion_pedido.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_det", id_det);
    xhr.send(formData);
}

function notificarPlatosHechos(id_documento_1) {
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

            actualizarCocina();
        }
    }

    xhr.open("post", "/recepcion_pedidos/web-gestion/notificar-platos-hechos.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_documento_1", id_documento_1);
    xhr.send(formData);
}

function imprimirTiquet(capaTiquetId) {
    let capaTiquet = document.getElementById(capaTiquetId);
    if (capaTiquet) {
        let ventimp=window.open(' ','_blank');
        ventimp.document.write('<html>' + document.querySelector('head').outerHTML + '<body>' + capaTiquet.innerHTML + '</body></html>');
        ventimp.document.close();
        ventimp.onload = function() {
            ventimp.print();
            ventimp.close();
        }
    }
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
        let actualizarCocinaBoton = document.getElementById('actualizarCocinaBoton');

        if (notificacionesTitulo && notificacionesBody) {
            notificacionesTitulo.innerHTML = titulo;
            notificacionesBody.innerHTML = body;

            notificaciones.classList.remove('hidden');

            if (actualizarCocinaBoton) {
                actualizarCocinaBoton.click();
            }

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
