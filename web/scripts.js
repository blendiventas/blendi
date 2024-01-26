// Burger menus
document.addEventListener('DOMContentLoaded', function() {
    // open
    const burger = document.querySelectorAll('.navbar-burger');
    const menu = document.querySelectorAll('.navbar-menu');

    if (burger.length && menu.length) {
        for (var i = 0; i < burger.length; i++) {
            burger[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    // close
    const close = document.querySelectorAll('.navbar-close');
    const backdrop = document.querySelectorAll('.navbar-backdrop');

    if (close.length) {
        for (var i = 0; i < close.length; i++) {
            close[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    if (backdrop.length) {
        for (var i = 0; i < backdrop.length; i++) {
            backdrop[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }
});

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

function actualizarObtenerTotalPrice() {
    let checkoutResumenPedido = document.getElementById('resumen_pedido');
    if (!checkoutResumenPedido) {
        return false;
    }
    let totalPriceElement = checkoutResumenPedido.querySelector('.total-price');
    if (!totalPriceElement) {
        return false;
    }
    return parseFloat(totalPriceElement.innerHTML.replace(',', '.'));
}

function actualizarObtenerTotalEnvio() {
    let checkoutResumenPedido = document.getElementById('resumen_pedido');
    if (!checkoutResumenPedido) {
        return false;
    }

    let totalPriceEnvioElement = checkoutResumenPedido.querySelector('.total-price-envio');
    if (!totalPriceEnvioElement) {
        return false;
    }
    return parseFloat(totalPriceEnvioElement.innerHTML.replace(',', '.'));
}

function actualizarObtenerTotalPago() {
    let checkoutResumenPedido = document.getElementById('resumen_pedido');
    if (!checkoutResumenPedido) {
        return false;
    }

    let totalPricePagoElement = checkoutResumenPedido.querySelector('.total-price-pago');
    if (!totalPricePagoElement) {
        return false;
    }
    return parseFloat(totalPricePagoElement.innerHTML.replace(',', '.'));
}

function actualizarTotalCesta() {
    let totalPrice = actualizarObtenerTotalPrice();
    if (!totalPrice) {
        return;
    }
    let modalidadEnvioPrice = actualizarObtenerTotalEnvio();
    let metodoPagoPrice = actualizarObtenerTotalPago();

    let checkoutResumenPedido = document.getElementById('resumen_pedido');
    if (!checkoutResumenPedido) {
        return false;
    }
    let totalPriceCestaElement = checkoutResumenPedido.querySelector('.total-price-cesta');
    if (!totalPriceCestaElement) {
        return false;
    }
    totalPriceCestaElement.innerHTML = (totalPrice + modalidadEnvioPrice + metodoPagoPrice).toFixed(2);
}

function checkEmailCheckout(emailInput) {
    if (!emailInput) {
        return;
    }

    let correo = emailInput.value;

    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            let metodosPagoInputs = document.getElementsByClassName('metodo_pago');
            for (let z = 0; z < metodosPagoInputs.length; z++) {
                metodosPagoInputs[z].parentElement.style.display = 'block';
                metodosPagoInputs[z].parentElement.nextElementSibling.style.display = 'block';
            }
            for (let i = 0; i < res.id_metodo_pago_metodos_pago_bans.length; i++) {
                for (let z = 0; z < metodosPagoInputs.length; z++) {
                    if (metodosPagoInputs[z].value == res.id_metodo_pago_metodos_pago_bans[i]) {
                        metodosPagoInputs[z].parentElement.style.display = 'none';
                        metodosPagoInputs[z].parentElement.nextElementSibling.style.display = 'none';
                    }
                }
            }
        }
    }

    xhr.open("post", "/web-gestion/datos-pre-checkout.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("ejercicio", 'temp');
    formData.append("interface_js", 'web');
    formData.append("tipo_librador", tipoLibrador);
    formData.append("tienda", tienda);
    formData.append("correo", correo);
    xhr.send(formData);
}

function loadMetodosEnvio(idZona) {
    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            let capaMetodosEnvio = document.getElementById('metodos_envio_checkout');
            if (capaMetodosEnvio) {
                capaMetodosEnvio.innerHTML = this.responseText;

                nodeScriptReplace(capaMetodosEnvio);
            }
        }
    }

    xhr.open("post", "/web-gestion/datos-pre-checkout.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("ejercicio", 'temp');
    formData.append("interface_js", 'web');
    formData.append("tipo_librador", tipoLibrador);
    formData.append("tienda", tienda);
    formData.append("id_zona", idZona);
    formData.append("select", 'obtener_metodos_envio_html');
    xhr.send(formData);
}

function actualizarMetodosPago() {
    let metodoPagoElement = document.querySelector('input[name="metodo_pago"]:checked');
    if (!metodoPagoElement) {
        return;
    }
    let keyMetodoPago = metodoPagoElement.dataset.keyMetodoPago;
    let metodosPagoPriceElement = document.getElementById('metodo_pago_precio_' + keyMetodoPago);
    if (!metodosPagoPriceElement) {
        return;
    }
    let metodosPagoPrice = parseFloat(metodosPagoPriceElement.innerHTML);

    let checkoutResumenPedido = document.getElementById('resumen_pedido');
    if (!checkoutResumenPedido) {
        return false;
    }
    let totalPricePagoElement = checkoutResumenPedido.querySelector('.total-price-pago');
    if (!totalPricePagoElement) {
        return false;
    }
    totalPricePagoElement.innerHTML = metodosPagoPrice.toFixed(2);

    actualizarTotalCesta();
}

function actualizarModalidadEnvio(keyModalidadEnvio) {
    let modalidadEnvioElement = document.getElementById('modalidad_envio_' + keyModalidadEnvio);
    if (!modalidadEnvioElement) {
        return;
    }
    let modalidadEnvioPrice = parseFloat(modalidadEnvioElement.dataset.precio);

    let checkoutResumenPedido = document.getElementById('resumen_pedido');
    if (!checkoutResumenPedido) {
        return false;
    }
    let totalPriceEnvioElement = checkoutResumenPedido.querySelector('.total-price-envio');
    if (!totalPriceEnvioElement) {
        return false;
    }
    totalPriceEnvioElement.innerHTML = modalidadEnvioPrice.toFixed(2);

    actualizarPreciosMetodosPago();
    actualizarMetodosPago();
}

function actualizarPreciosMetodosPago() {
    let metodosPagoInputs = document.querySelectorAll('.metodo_pago');
    if (!metodosPagoInputs) {
        return;
    }
    let totalPrice = actualizarObtenerTotalPrice();
    if (!totalPrice) {
        return;
    }
    let totalEnvio = actualizarObtenerTotalEnvio();
    totalPrice = totalPrice + totalEnvio;

    let keyMetodoPago = null;
    let metodosPagoPriceElement = null;
    let metodosPagoPricePercentage = null;
    let metodosPagoPrice = null;
    for (let i = 0; i < metodosPagoInputs.length; i++) {
        keyMetodoPago = metodosPagoInputs[i].dataset.keyMetodoPago;
        metodosPagoPriceElement = document.getElementById('metodo_pago_precio_' + keyMetodoPago);
        if (!metodosPagoPriceElement) {
            continue;
        }
        metodosPagoPricePercentage = parseFloat(metodosPagoPriceElement.dataset.precioPorcentaje);
        if (metodosPagoPricePercentage) {
            metodosPagoPrice = (totalPrice / 100) * metodosPagoPricePercentage;
            metodosPagoPriceElement.innerHTML = metodosPagoPrice.toFixed(2) + '€';
        }
    }
}

function actualizarCarrito(mostrarCarrito = true, checkout = false) {
    console.log("actualizarCarrito de scripts.js raiz");
    if (!id_documento_1) {
        return;
    }

    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            let bodyProductoModal = document.getElementById('carrito');
            bodyProductoModal.innerHTML = this.responseText;

            nodeScriptReplace(bodyProductoModal);

            if (mostrarCarrito) {
                document.getElementById('carrito').classList.remove('hidden');
            }

            if (checkout) {
                let carritoDatosGenerales = document.getElementById('carrito_datos_generales');
                let checkoutResumenPedido = document.getElementById('resumen_pedido');
                if (carritoDatosGenerales && checkoutResumenPedido) {
                    checkoutResumenPedido.innerHTML = carritoDatosGenerales.innerHTML;
                    let quantityInputs = checkoutResumenPedido.getElementsByClassName('quantity-inputs');
                    if (quantityInputs.length) {
                        for (let i = 0; i < quantityInputs.length; i++) {
                            quantityInputs[i].innerHTML = '';
                        }
                    }
                }

                actualizarPreciosMetodosPago();
            }
        }
    }

    xhr.open("post", "/web-gestion/documento_actualizar.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("ejercicio", 'temp');
    formData.append("interface_js", 'web');
    formData.append("tipo_librador", tipoLibrador);
    formData.append("tienda", tienda);
    formData.append("id_documento_1", id_documento_1);
    formData.append("decimales_cantidades", decimalesCantidades);
    formData.append("decimales_importes", decimalesImportes);
    formData.append("funcion_origen", "carritoWeb");
    xhr.send(formData);
}

function anadirAlCarrito(slug, id_producto, cantidad, id_linea) {
    console.log("anadirAlCarrito de scripts.js raiz");
    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            if (!id_documento_1) {
                window.location = window.location.pathname + '?abrir_cesta=1' + window.location.search.replace('?', '&');
            }

            actualizarCarrito();
        }
    }

    xhr.open("post", "/web-gestion/documento_guardar.php", true);
    let formData = new FormData();
    formData.append("tienda", tienda);
    formData.append("accion", 'insertar-producto');
    formData.append("slug", slug);
    formData.append("id_producto", id_producto);
    let id_pack = document.getElementById('id_pack');
    if (id_pack) {
        formData.append("id_pack", id_pack.value);
    } else {
        formData.append("id_pack", 0);
    }
    formData.append("cantidad", cantidad);
    formData.append("id_linea", id_linea);
    xhr.send(formData);
}

function modificarCantidadArticulos(cantidad) {
    let capasCantidadArticulos = document.getElementsByClassName('cantidad-articulos');

    if (capasCantidadArticulos && capasCantidadArticulos.length > 0) {
        for (let i = 0; i < capasCantidadArticulos.length; i++) {
            capasCantidadArticulos[i].innerHTML = cantidad;
        }
    }
}

function mostrarPvpPack() {
    let pvp_mostrar_capa = document.getElementsByClassName('pvp_mostrar');
    if (pvp_mostrar_capa.length) {
        for (let i = 0; i < pvp_mostrar_capa.length; i++) {
            if (pvp_mostrar_capa[i] && !pvp_mostrar_capa[i].classList.contains('hidden')) {
                pvp_mostrar_capa[i].classList.add('hidden');
            }
        }
    }

    let select_pack = document.getElementById('id_pack');
    if (select_pack) {
        let pvp_mostrar_pack_capa = document.getElementById('pvp_mostrar_pack_' + select_pack.value);
        if (pvp_mostrar_pack_capa && pvp_mostrar_pack_capa.classList.contains('hidden')) {
            pvp_mostrar_pack_capa.classList.remove('hidden');
        }
    }

}

function procederAlCheckout() {
    window.location = host_web_tienda + 'procesar-pedido';
}

function volcarPedido() {
    console.log("volcarPedido de scripts.js raiz");
    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);

            if (res.id_documentos_1) {
                enviarCorreo(res.id_documentos_1);
            }
        }
    }

    xhr.open("post", "/web-gestion/volcar-documentos.php", true);
    let formData = new FormData();
    formData.append("tienda", tienda);
    xhr.send(formData);
}

function enviarCorreo(idDocumento) {
    console.log("enviarCorreo de scripts.js raiz");
    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            window.location = host_web_tienda;
        }
    }

    let correoInput = document.getElementsByName("email_documento");
    let correoEnviar = '';
    if (correoInput) {
        correoEnviar = correoInput[0].value;
    }

    xhr.open("post", "/enviar_mails/gestionar_pdf.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("so", so);
    formData.append("idioma", idioma);
    formData.append("ejercicios", (new Date()).getFullYear());
    formData.append("interface_js", 'web');
    formData.append("tipo_librador", tipoLibrador);
    formData.append("select", 'enviar-documentos');
    formData.append("tienda", tienda);
    formData.append("documentos", idDocumento);
    formData.append("correo_enviar", correoEnviar);
    formData.append("decimales_cantidades", decimalesCantidades);
    formData.append("decimales_importes", decimalesImportes);
    xhr.send(formData);
}

function insertarPago() {
    console.log("anadirAlCarrito de scripts.js raiz");
    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            if (!id_documento_1) {
                location.reload();
            }

            volcarPedido();
        }
    }

    xhr.open("post", "/web-gestion/documento_guardar.php", true);
    let form = document.querySelector("#checkout_form");
    let formData = new FormData(form);
    formData.append("tienda", tienda);
    formData.append("accion", 'insertar-producto');
    formData.append("slug", '');
    formData.append("id_producto", 0);
    formData.append("insertar_metodo_pago", 1);
    formData.append("cantidad", 1);
    formData.append("id_linea", '');
    xhr.send(formData);
}

function toogleDatosDeFacturacion() {
    let facturacionElemento = document.getElementById('datos_facturacion_checkout');
    if (facturacionElemento.classList.contains('hidden')) {
        facturacionElemento.classList.remove('hidden');
    } else {
        facturacionElemento.classList.add('hidden');
    }
}

function terminarPedido() {
    console.log("anadirAlCarrito de scripts.js raiz");

    let password = document.getElementById('signup_password');
    if (password && signup_password.value.length < 6) {
        alert('El password debe contener almenos 6 carácteres.');
        return false;
    }
    let modalidad_envio = document.querySelector('input[name="modalidad_envio"]:checked');
    if (!modalidad_envio || !modalidad_envio.value) {
        alert('Debes ecojer una modalidad de envío.');
        return false;
    }
    let modalidad_entrega = document.querySelector('input[name="modalidad_entrega"]:checked');
    if (!modalidad_entrega || !modalidad_entrega.value) {
        alert('Debes ecojer una modalidad de entrega.');
        return false;
    }
    let metodo_pago = document.querySelector('input[name="metodo_pago"]:checked');
    if (!metodo_pago || !metodo_pago.value) {
        alert('Debes ecojer un método de pago.');
        return false;
    }

    validarCheckout(tienda, id_documento_1, false, true).then((re) => {
        if (re) {
            return false;
        } else {
            let xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200) {
                    if (!id_documento_1) {
                        location.reload();
                    }
                    insertarPago();
                }
            }
            xhr.open("post", "/web-gestion/documento_guardar.php", true);
            let form = document.querySelector("#checkout_form");
            let formData = new FormData(form);
            formData.append("tienda", tienda);
            formData.append("accion", 'insertar-producto');
            formData.append("slug", '');
            formData.append("id_producto", 0);
            formData.append("insertar_modalidad_envio", 1);
            formData.append("cantidad", 1);
            formData.append("id_linea", '');
            xhr.send(formData);
        }
    });
}

function historialPedidos() {
    window.location = host_web_tienda + 'historial_pedidos';
}

function logout() {
    window.location = host_web_tienda + 'logout';
}

function condicionesRegistro() {
    let correcto = true;
    let contenedorErrores = document.getElementById('mensajes_errores_signup');
    if (document.getElementById('signup_nombre').value === '') {
        correcto = false;
        contenedorErrores.innerHTML = 'El nombre no puede estar vacío.';
    }
    if (document.getElementById('signup_user').value === '') {
        correcto = false;
        contenedorErrores.innerHTML = 'El correo no puede estar vacío.';
    }
    if (document.getElementById('password').value === '') {
        correcto = false;
        contenedorErrores.innerHTML = 'El password no puede estar vacío.';
    }
    if (document.getElementById('password').value !== document.getElementById('password_repeat').value) {
        correcto = false;
        contenedorErrores.innerHTML = 'La repetición del password no coincide.';
    }
    if (!document.getElementById('check_conditions').checked) {
        correcto = false;
        contenedorErrores.innerHTML = 'Debes aceptar las condiciones del registro.';
    }
    return correcto;
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

function notificarExistaStock(elementId) {
    event.preventDefault();
    const form = document.getElementById(elementId);

    if (form) {
        // Verificar si el formulario contiene un campo de email
        const emailInput = form.querySelector('input[name="notificacion[email]"]');
        const idLibradorInput = form.querySelector('input[name="notificacion[id_librador]"]');
        const productoInput = form.querySelector('input[name="notificacion[id_producto]"]');
        const tiendaInput = form.querySelector('input[name="notificacion[tienda]"]');
        const spinnerIcon = document.getElementById('spinnerIcon'+productoInput.value);
        spinnerIcon.style.display = 'inline-block';

        if (emailInput && !isValidEmail(emailInput.value)) {
            spinnerIcon.style.display = 'none';
            alert('El email no es válido.');
            return;
        }

        let xhr = new XMLHttpRequest();

        xhr.onload = function () {

            if ( xhr.status === 200 ) {
                spinnerIcon.style.display = 'none';
                alert(JSON.parse(xhr.response).message);
                emailInput.value = '';
                return;
            }
        }

        xhr.open("post", "/web-gestion/listado_notificaciones_stock.php", true);
        let formData = new FormData();
        if (idLibradorInput) {
            formData.append("notificacion[id_librador]", idLibradorInput.value);
        }
        if (emailInput) {
            formData.append("notificacion[email]", emailInput.value);
        }
        formData.append("notificacion[id_producto]", productoInput.value);
        formData.append("notificacion[tienda]", tiendaInput.value);
        formData.append("notificacion[ididoma_sys]", 'es/');
        formData.append("notificacion[id_idioma_sys]", 4);
        xhr.send(formData);
    }
}

function isValidEmail(email) {
    // Expresión regular para validar un correo electrónico básico
    var emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    return emailRegex.test(email);
}

function enviarSolicitudPOST(url, formData) {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.onload = function () {
      if (xhr.status === 200) {
        resolve(xhr.responseText);
      } else {
        reject(new Error(`Error ${xhr.status}: ${xhr.statusText}`));
      }
    };
    xhr.open("POST", url, true);
    xhr.send(formData);
  });
}

async function validarYActualizarCarrito(formDataValidar, mostrarCarrito, isCheckout) {
    let huboActualizacion = false;

    const validarCarrito = await enviarSolicitudPOST("/web-gestion/validar_checkout.php", formDataValidar);
    const mensajeActualizacionCarrito = document.getElementById("mensaje-actualizacion-carrito");
    const textoActualizacionCarrito = document.getElementById("texto-actualizacion-carrito");

    const res = JSON.parse(validarCarrito);
    // Filtrar solo las líneas con acciones 'update' o 'delete'

    const lineasAProcesar = res.valid.length;
    console.log('Inicio validación', lineasAProcesar);

    for (let linea of res.valid) {
        if (linea.action === 'delete') {
            const formDataActualizar = new FormData();
            formDataActualizar.append("tienda", tienda);
            formDataActualizar.append("accion", "eliminar-producto");
            formDataActualizar.append("slug", linea.slug);
            formDataActualizar.append("id_pack", 0);
            formDataActualizar.append("id_documento_2", linea.id_producto);
            formDataActualizar.append("id_producto", linea.id_producto);
            formDataActualizar.append("id_linea", linea.id_linea);
            formDataActualizar.append("line_clean", true);


            await enviarSolicitudPOST("/web-gestion/documento_guardar.php", formDataActualizar);
            textoActualizacionCarrito.textContent = "Hemos actualizado tu carrito con los productos disponibles.";
            mensajeActualizacionCarrito.style.display = "block";
            mensajeActualizacionCarrito.scrollIntoView({behavior: "smooth"});
        } else if (linea.action === 'update') {
            const formDataActualizar = new FormData();
            formDataActualizar.append("tienda", tienda);
            formDataActualizar.append("accion", 'modificar-producto');
            formDataActualizar.append("slug", linea.slug);
            formDataActualizar.append("id_producto", linea.id_producto);
            formDataActualizar.append("id_pack", 0);
            formDataActualizar.append("cantidad", linea.cantidad);
            formDataActualizar.append("id_linea", linea.id_linea);

            await enviarSolicitudPOST("/web-gestion/documento_guardar.php", formDataActualizar);
            textoActualizacionCarrito.textContent = "Hemos actualizado tu carrito con los productos disponibles.";
            mensajeActualizacionCarrito.style.display = "block";
            mensajeActualizacionCarrito.scrollIntoView({behavior: "smooth"});
        }
    }
    console.log('Inicio validación', lineasAProcesar );
    if (lineasAProcesar > 0) {
        actualizarCarrito(false, true);
    }
    return new Promise((resolve) => {
        resolve(lineasAProcesar > 0);
    });
}

async function validarCheckout(tienda, id_documento_1, mostrarCarrito, isCheckout) {
    const formDataValidar = new FormData();
    formDataValidar.append("tienda", tienda);
    formDataValidar.append("id_documento_1", id_documento_1);
    return  await validarYActualizarCarrito(formDataValidar, mostrarCarrito, isCheckout);
}