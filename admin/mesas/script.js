interact('#capa-comedor')
    .resizable({
        // resize from all edges and corners
        edges: { left: true, right: true, bottom: true, top: true },

        listeners: {
            move (event) {
                var target = event.target
                var x = (parseFloat(target.getAttribute('data-x')) || 0)
                var y = (parseFloat(target.getAttribute('data-y')) || 0)

                // update the element's style
                target.style.width = event.rect.width + 'px'
                target.style.height = event.rect.height + 'px'

                // translate when resizing from top or left edges
                x += event.deltaRect.left
                y += event.deltaRect.top

                target.style.transform = 'translate(' + x + 'px,' + y + 'px)'

                target.setAttribute('data-x', x)
                target.setAttribute('data-y', y)
                // target.textContent = Math.round(event.rect.width) + '\u00D7' + Math.round(event.rect.height)
            }
        },
        modifiers: [
            // keep the edges inside the parent
            interact.modifiers.restrictEdges({
                outer: 'parent'
            }),

            // minimum size
            interact.modifiers.restrictSize({
                min: { width: 100, height: 50 }
            })
        ],

        inertia: true
    })

interact('.capa-mesa')
    .resizable({
        // resize from all edges and corners
        edges: { left: true, right: true, bottom: true, top: true },

        listeners: {
            move (event) {
                var target = event.target;

                // update the element's style
                target.style.width = event.rect.width + 'px';
                target.style.height = event.rect.height + 'px';
                target.children[0].style.width = event.rect.width + 'px';
                target.children[0].style.height = event.rect.height + 'px';

                document.mesaMoviendose = true
            },
            end (event) {
                window.guardarDatosComedor(event);
            }
        },
        modifiers: [
            // keep the edges inside the parent
            interact.modifiers.restrictEdges({
                outer: 'parent'
            }),

            // minimum size
            interact.modifiers.restrictSize({
                min: { width: 100, height: 50 }
            })
        ],

        inertia: true
    })
    .draggable({
        listeners: {
            move(event) {
                window.dragMoveListener(event);
            },
            end(event) {
                window.guardarDatosComedor(event);
            }
        },
        inertia: true,
        modifiers: [
            interact.modifiers.restrictRect({
                restriction: 'parent',
                endOnly: true
            })
        ]
    });

interact('.capa-linea')
    .resizable({
        // resize from all edges and corners
        edges: { left: true, right: true, bottom: true, top: true },

        listeners: {
            move (event) {
                var target = event.target;

                // update the element's style
                target.style.width = event.rect.width + 'px';
                target.style.height = event.rect.height + 'px';
                target.children[0].style.width = event.rect.width + 'px';
                target.children[0].style.height = event.rect.height + 'px';

                document.mesaMoviendose = true
            },
            end (event) {
                window.guardarDatosLineas(event);
            }
        },
        modifiers: [
            // keep the edges inside the parent
            interact.modifiers.restrictEdges({
                outer: 'parent'
            }),

            // minimum size
            interact.modifiers.restrictSize({
                min: { width: 50, height: 50 }
            })
        ],

        inertia: true
    })
    .draggable({
        listeners: {
            move(event) {
                window.dragMoveListener(event);
            },
            end(event) {
                window.guardarDatosLineas(event);
            }
        },
        inertia: true,
        modifiers: [
            interact.modifiers.restrictRect({
                restriction: 'parent',
                endOnly: true
            })
        ]
    });

function dragMoveListener (event) {
    var target = event.target
    // keep the dragged position in the data-x/data-y attributes
    var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
    var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy

    // translate the element
    target.style.transform = 'translate(' + x + 'px, ' + y + 'px)'

    // update the posiion attributes
    target.setAttribute('data-x', x)
    target.setAttribute('data-y', y)

    document.mesaMoviendose = true
}
window.eventInteractable = null;
window.targetInteractable = null;
function guardarDatosComedor(event) {
    console.log("ENTRA en guardarDatosComedor");
    window.eventInteractable = event.interactable;
    window.targetInteractable = event.target;
    var target = event.target
    var x = (parseFloat(target.getAttribute('data-x')) || 0)
    var y = (parseFloat(target.getAttribute('data-y')) || 0)
    var idLibrador = target.getAttribute('data-id-librador')
    var width = event.rect.width
    var heigth = event.rect.height

    console.log('Posición izquierda: ' + x + 'px')
    console.log('Posición arriba: ' + y + 'px')

    console.log('Ancho: ' + width + 'px')
    console.log('Alto: ' + heigth + 'px')

    console.log('Id librador: ' + idLibrador)

    if (heigth < 143) {
        heigth = 143;
    }

    document.getElementById("id_mesa").value = idLibrador;
    document.getElementById("ancho_pos_mesa").value = x;
    document.getElementById("alto_pos_mesa").value = y;
    document.getElementById("ancho_mesa").value = width;
    document.getElementById("alto_mesa").value = heigth;

    window.guardandoMesa = true;
    window.eventInteractable.options.drag.enabled = false;
    if(x == 0 && y == 0) {
        setTimeout(function () {
            document.mesaMoviendose = false;
            guardarMesa("dimensionar");
        }, 1000)
    }else {
        setTimeout(function () {
            document.mesaMoviendose = false;
            guardarMesa("mover");
        }, 1000)
    }
}

function guardarDatosLineas(event) {
    console.log("ENTRA en guardarDatosLineas");
    window.eventInteractable = event.interactable;
    window.targetInteractable = event.target;
    var target = event.target
    var x = (parseFloat(target.getAttribute('data-x')) || 0)
    var y = (parseFloat(target.getAttribute('data-y')) || 0)
    var idLinea = target.getAttribute('data-id-linea')

    console.log('Posición izquierda: ' + x + 'px')
    console.log('Posición arriba: ' + y + 'px')

    console.log('Ancho: ' + event.rect.width + 'px')
    console.log('Alto: ' + event.rect.height + 'px')

    console.log('Id linea: ' + idLinea)

    document.getElementById("id_linea").value = idLinea;
    document.getElementById("ancho_pos_linea").value = x;
    document.getElementById("alto_pos_linea").value = y;
    document.getElementById("ancho_linea").value = event.rect.width;
    document.getElementById("alto_linea").value = event.rect.height;

    window.guardandoMesa = true;
    window.eventInteractable.options.drag.enabled = false;
    setTimeout(function () {
        document.mesaMoviendose = false;
        guardarLinea("guardar-linea");
    }, 1000);
}

document.mesaMoviendose = false

function cargarDatosMesa(id, enviarAAlmacen = false) {
    console.log("ENTRA en cargarDatosMesa, id="+id);
    if (document.mesaMoviendose === false) {
        document.getElementById("id_mesa").value = id;

        document.getElementById('capa-boton-eliminar-mesa').classList.add('hidden');
        if(id != 0) {
            document.getElementById('capa-boton-eliminar-mesa').classList.remove('hidden');
        }

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {

        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                console.log("prueba: "+res.prueba);
                console.log("Consulta_sql: "+res.consulta_sql);
                console.log("nombre_libradores: "+res.nombre_libradores);
                console.log("imagen_mesa: "+res.imagen_mesa);
                console.log("imagen_mesa_ocupada: "+res.imagen_mesa_ocupada);
                console.log("radio: "+res.radio);
                console.log("comensales: "+res.comensales);
                console.log("ancho_pos: "+res.ancho_pos);
                console.log("alto_pos: "+res.alto_pos);
                console.log("ancho: "+res.ancho);
                console.log("alto: "+res.alto);
                console.log("Activa: "+res.activo_libradores);

                document.getElementById('botonOpenModalFichaMesa').click();

                document.getElementById("nombre_libradores").value = res.nombre_libradores;
                document.getElementById("imagen_mesa").value = res.imagen_mesa;
                document.getElementById("imagen_mesa_ocupada").value = res.imagen_mesa_ocupada;
                if (res.radio < 50) {
                    activarElementoUnicoFicha('radio_mesas_1', 'capa_radio_mesas_1', "capa_unicos_radio_mesas");
                } else {
                    activarElementoUnicoFicha('radio_mesas_2', 'capa_radio_mesas_2', "capa_unicos_radio_mesas");
                }
                document.getElementById("id_comedor").value = res.id_comedor;
                document.getElementById("comensales_mesas").value = res.comensales
                document.getElementById("ancho_pos_mesa").value = res.ancho_pos
                document.getElementById("alto_pos_mesa").value = res.alto_pos
                document.getElementById("ancho_mesa").value = res.ancho
                document.getElementById("alto_mesa").value = res.alto
                document.getElementById('id_modalidades_pago_libradores').value = res.id_modalidades_pago_libradores;
                document.getElementById('id_tarifa_tpv_libradores').value = res.id_tarifa_tpv_libradores;
                document.getElementById('id_banco_cobro_libradores').value = res.id_banco_cobro_libradores;

                if (enviarAAlmacen) {
                    document.getElementById("inactivo_libradores").checked = true;
                    guardarMesa('guardar');
                } else {
                    if (res.activo_libradores == 1) {
                        document.getElementById("activo_libradores").checked = true;
                    } else {
                        document.getElementById("inactivo_libradores").checked = true;
                    }
                }
            }
        }

        xhr.open("post", "/admin/libradores/gestion/datos-select.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("id_libradores", id);
        formData.append("select", "editar-ficha");
        xhr.send(formData);
    }
}

function cargarDatosLinea(id) {
    console.log("ENTRA en cargarDatosLinea, id="+id);
    if (document.mesaMoviendose === false) {
        document.getElementById("id_linea").value = id;

        document.getElementById('capa-boton-eliminar-linea').classList.add('hidden');
        document.getElementById('botonOpenModalFichaLinea').click();
        if(id != 0) {
            document.getElementById('capa-boton-eliminar-linea').classList.remove('hidden');
        }
    }
}
function guardarLinea(accion) {
    console.log("ENTRA en guardarLinea, accion="+accion);

    if (document.mesaMoviendose === false) {
        if (accion == "insertar-linea") {
            document.getElementById("id_linea").value = -1;

            document.getElementById("ancho_pos_linea").value = 0;
            document.getElementById("alto_pos_linea").value = 0;

            document.getElementById("ancho_linea").value = 50;
            document.getElementById("alto_linea").value = 100;
        }

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {

        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);
                window.guardandoMesa = false;
                let target = window.targetInteractable;
                if (window.eventInteractable) {
                    window.eventInteractable.options.drag.enabled = true;
                }
                if (target) {
                    target.style.left = (parseFloat(target.style.left.substr(0, target.style.left.length - 2)) + parseFloat(target.getAttribute('data-x'))) + 'px';
                    target.style.top = (parseFloat(target.style.top.substr(0, target.style.top.length - 2)) + parseFloat(target.getAttribute('data-y'))) + 'px';
                    target.style.transform = 'none';
                    target.setAttribute('data-x', 0)
                    target.setAttribute('data-y', 0)
                }

                if (accion != "guardar-linea" && accion != "dimensionar") {
                    console.log("redirección guardar linea");
                    window.location.href = '/admin/gestion-mesas/id_comedor=' + document.getElementById("id_comedor").value;
                }
            }
        }

        xhr.open("post", "/admin/mesas/gestion/datos-update.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("select", accion);
        formData.append("id_linea", parseInt(document.getElementById("id_linea").value));
        formData.append("id_comedor", document.getElementById("id_comedor").value);
        formData.append("ancho_pos_linea", parseInt(document.getElementById("ancho_pos_linea").value));
        formData.append("alto_pos_linea", parseInt(document.getElementById("alto_pos_linea").value));
        formData.append("ancho_linea", parseInt(document.getElementById("ancho_linea").value));
        formData.append("alto_linea", parseInt(document.getElementById("alto_linea").value));

        xhr.send(formData);
    }
}
window.guardandoMesa = false;
function guardarMesa(accion) {
    console.log("ENTRA en guardarMesa, accion="+accion);
    let select = 'guardar';
    if(accion == "insertar") {
        activarElementoUnicoFicha('radio_mesas_1', 'capa_radio_mesas_1', "capa_unicos_radio_mesas");
        document.getElementById("nombre_libradores").value = "Nueva";

        document.getElementById("comensales_mesas").value = 1;
        document.getElementById("ancho_pos_mesa").value = 0;
        document.getElementById("alto_pos_mesa").value = 0;

        document.getElementById("id_mesa").value = 0;
        document.getElementById("id_comedor").value = document.getElementById('id_comedor').value;
        document.getElementById("activo_libradores").checked = true;

        document.getElementById("ancho_mesa").value = 100;
        document.getElementById("alto_mesa").value = 143;
    }else {
        select = accion;
    }

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {

    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            window.guardandoMesa = false;
            let target = window.targetInteractable;
            if (window.eventInteractable) {
                window.eventInteractable.options.drag.enabled = true;
            }
            if (target) {
                target.style.left = (parseFloat(target.style.left.substr(0, target.style.left.length - 2)) + parseFloat(target.getAttribute('data-x'))) + 'px';
                target.style.top = (parseFloat(target.style.top.substr(0, target.style.top.length - 2)) + parseFloat(target.getAttribute('data-y'))) + 'px';
                target.style.transform = 'none';
                target.setAttribute('data-x', 0)
                target.setAttribute('data-y', 0)
            }

            if(accion != "mover" && accion != "dimensionar") {
                console.log("redirección guardar mesa");
                window.location.href = '/admin/gestion-mesas/id_comedor=' + document.getElementById("id_comedor").value;
            }
        }
    }

    console.log("Alto mesa en guardarMesa: "+document.getElementById("alto_mesa").value);

    xhr.open("post", "/admin/libradores/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id_libradores", document.getElementById("id_mesa").value);
    formData.append("select", select);
    formData.append("tipo_librador", "mes");
    formData.append("codigo_librador_libradores", "");
    formData.append("nombre_libradores", document.getElementById("nombre_libradores").value);
    formData.append("apellido_1_libradores", "");
    formData.append("apellido_2_libradores", "");
    formData.append("razon_social_libradores", "");
    formData.append("razon_comercial_libradores", "");
    formData.append("nif_libradores", "");
    formData.append("direccion_libradores", "");
    formData.append("numero_libradores", "");
    formData.append("escalera_libradores", "");
    formData.append("piso_libradores", "");
    formData.append("puerta_libradores", "");
    formData.append("localidad_libradores", "");
    formData.append("codigo_postal_libradores", "");
    formData.append("provincia_libradores", "");
    formData.append("id_zona_libradores", 0);
    formData.append("telefono_1_libradores", "");
    formData.append("telefono_2_libradores", "");
    formData.append("fax_libradores", "");
    formData.append("mobil_libradores", "");
    formData.append("email_libradores", "");
    formData.append("password_acceso_libradores", "");
    formData.append("id_categoria_sms_libradores", 0);
    formData.append("id_categoria_email_libradores", 0);
    formData.append("persona_contacto_libradores", "");
    formData.append("banco_libradores", "");
    formData.append("entidad_libradores", "");
    formData.append("agencia_libradores", "");
    formData.append("dc_libradores", "");
    formData.append("cuenta_libradores", "");
    formData.append("iban_libradores", "");
    formData.append("sexo_libradores", 0);
    formData.append("fecha_nacimiento_libradores", "");
    formData.append("observaciones_libradores", "");
    formData.append("id_modalidades_envio_libradores", 0);
    formData.append("id_modalidades_entrega_libradores", 0);
    formData.append("id_modalidades_pago_libradores", document.getElementById("id_modalidades_pago_libradores").value);
    formData.append("plazo_entrega_libradores", 0);
    formData.append("id_iva_libradores", -1);
    formData.append("recargo_libradores", 0);
    formData.append("id_irpf_libradores", 0);
    formData.append("dia_pago_1_libradores", "");
    formData.append("dia_pago_2_libradores", "");
    formData.append("descuento_pp_libradores", 0);
    formData.append("descuento_librador_libradores", 0);
    formData.append("id_tarifa_web_libradores", 1);
    formData.append("id_tarifa_tpv_libradores", document.getElementById("id_tarifa_tpv_libradores").value);
    formData.append("procedencia_libradores", "");
    formData.append("id_cliente_origen_libradores", 0);
    formData.append("id_vendedor_libradores", 0);
    formData.append("id_nivel_comisiones_libradores", 0);
    if(document.getElementById("activo_libradores").checked) {
        formData.append("activo_libradores", 1);
    }else
    {
        formData.append("activo_libradores", 0);
    }
    formData.append("id_banco_cobro_libradores", document.getElementById("id_banco_cobro_libradores").value);
    formData.append("tipo", "mes");
    formData.append("imagen_mesa", "");
    formData.append("imagen_mesa_ocupada", "");
    if(document.getElementById("radio_mesas_1").checked) {
        formData.append("radio_mesa", document.getElementById("radio_mesas_1").value);
    }else
    {
        formData.append("radio_mesa", document.getElementById("radio_mesas_2").value);
    }
    formData.append("id_comedor", document.getElementById("id_comedor").value);
    formData.append("comensales_mesa", document.getElementById("comensales_mesas").value);
    formData.append("ancho_pos_mesa", parseInt(document.getElementById("ancho_pos_mesa").value));
    formData.append("alto_pos_mesa", parseInt(document.getElementById("alto_pos_mesa").value));
    formData.append("ancho_mesa", parseInt(document.getElementById("ancho_mesa").value));
    formData.append("alto_mesa", parseInt(document.getElementById("alto_mesa").value));

    xhr.send(formData);
}
function duplicarMesa() {
    let accion = 'insertar';
    let select = 'guardar';
    console.log("ENTRA en duplicarMesa, accion="+accion);
    if(accion == "insertar") {
        activarElementoUnicoFicha('radio_mesas_1', 'capa_radio_mesas_1', "capa_unicos_radio_mesas");
        document.getElementById("nombre_libradores").value = document.getElementById("nombre_libradores").value + 'D';

        document.getElementById("id_mesa").value = 0;
        document.getElementById("id_comedor").value = document.getElementById('id_comedor').value;
        document.getElementById("activo_libradores").checked = true;

        document.getElementById("ancho_pos_mesa").value = parseInt(document.getElementById("ancho_pos_mesa").value) + 10;
        document.getElementById("alto_pos_mesa").value = parseInt(document.getElementById("alto_pos_mesa").value) + 10;
    }

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function (res) {

    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(res);
            if(accion != "mover") {
                console.log("redirección guardar mesa");
                window.location.href = '/admin/gestion-mesas/id_comedor=' + document.getElementById("id_comedor").value;
            }
        }
    }

    console.log("Alto mesa en guardarMesa: "+document.getElementById("alto_mesa").value);

    xhr.open("post", "/admin/libradores/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id_libradores", document.getElementById("id_mesa").value);
    formData.append("select", select);
    formData.append("tipo_librador", "mes");
    formData.append("codigo_librador_libradores", "");
    formData.append("nombre_libradores", document.getElementById("nombre_libradores").value);
    formData.append("apellido_1_libradores", "");
    formData.append("apellido_2_libradores", "");
    formData.append("razon_social_libradores", "");
    formData.append("razon_comercial_libradores", "");
    formData.append("nif_libradores", "");
    formData.append("direccion_libradores", "");
    formData.append("numero_libradores", "");
    formData.append("escalera_libradores", "");
    formData.append("piso_libradores", "");
    formData.append("puerta_libradores", "");
    formData.append("localidad_libradores", "");
    formData.append("codigo_postal_libradores", "");
    formData.append("provincia_libradores", "");
    formData.append("id_zona_libradores", 0);
    formData.append("telefono_1_libradores", "");
    formData.append("telefono_2_libradores", "");
    formData.append("fax_libradores", "");
    formData.append("mobil_libradores", "");
    formData.append("email_libradores", "");
    formData.append("password_acceso_libradores", "");
    formData.append("id_categoria_sms_libradores", 0);
    formData.append("id_categoria_email_libradores", 0);
    formData.append("persona_contacto_libradores", "");
    formData.append("banco_libradores", "");
    formData.append("entidad_libradores", "");
    formData.append("agencia_libradores", "");
    formData.append("dc_libradores", "");
    formData.append("cuenta_libradores", "");
    formData.append("iban_libradores", "");
    formData.append("sexo_libradores", 0);
    formData.append("fecha_nacimiento_libradores", "");
    formData.append("observaciones_libradores", "");
    formData.append("id_modalidades_envio_libradores", 0);
    formData.append("id_modalidades_entrega_libradores", 0);
    formData.append("id_modalidades_pago_libradores", document.getElementById("id_modalidades_pago_libradores").value);
    formData.append("plazo_entrega_libradores", 0);
    formData.append("id_iva_libradores", -1);
    formData.append("recargo_libradores", 0);
    formData.append("id_irpf_libradores", 0);
    formData.append("dia_pago_1_libradores", "");
    formData.append("dia_pago_2_libradores", "");
    formData.append("descuento_pp_libradores", 0);
    formData.append("descuento_librador_libradores", 0);
    formData.append("id_tarifa_web_libradores", 1);
    formData.append("id_tarifa_tpv_libradores", document.getElementById("id_tarifa_tpv_libradores").value);
    formData.append("procedencia_libradores", "");
    formData.append("id_cliente_origen_libradores", 0);
    formData.append("id_vendedor_libradores", 0);
    formData.append("id_nivel_comisiones_libradores", 0);
    if(document.getElementById("activo_libradores").checked) {
        formData.append("activo_libradores", 1);
    }else
    {
        formData.append("activo_libradores", 0);
    }
    formData.append("id_banco_cobro_libradores", document.getElementById("id_banco_cobro_libradores").value);
    formData.append("tipo", "mes");
    formData.append("imagen_mesa", "");
    formData.append("imagen_mesa_ocupada", "");
    if(document.getElementById("radio_mesas_1").checked) {
        formData.append("radio_mesa", document.getElementById("radio_mesas_1").value);
    }else
    {
        formData.append("radio_mesa", document.getElementById("radio_mesas_2").value);
    }
    formData.append("id_comedor", document.getElementById("id_comedor").value);
    formData.append("comensales_mesa", document.getElementById("comensales_mesas").value);
    formData.append("ancho_pos_mesa", parseInt(document.getElementById("ancho_pos_mesa").value));
    formData.append("alto_pos_mesa", parseInt(document.getElementById("alto_pos_mesa").value));
    formData.append("ancho_mesa", parseInt(document.getElementById("ancho_mesa").value));
    formData.append("alto_mesa", parseInt(document.getElementById("alto_mesa").value));
    xhr.send(formData);
}

function eliminarMargenIzquierdo(margen) {
    margen = margen - 10;
    console.log("ENTRA en eliminarMargenIzquierdo, margen="+margen);

    var guardar = true;
    if (!confirm('Confirmar para eliminar el margen.')) {
        guardar = false;
    }

    if (guardar) {
        document.getElementById('capa_total_mesas').innerHTML = 'Recalculando datos...';

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function (res) {

        }
        xhr.onload = function () {
            if (xhr.status == 200) {
                window.location.href = '/admin/gestion-mesas/id_comedor=' + document.getElementById("id_comedor").value;
            }
        }

        xhr.open("post", "/admin/mesas/gestion/datos-update.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("id_comedor", document.getElementById("id_comedor").value);
        formData.append("margen", margen);
        formData.append("select", "eliminar-margen-izquierda");
        xhr.send(formData);
    }
}

function toggleEditarSala() {
    let capaSala = document.getElementById('capa_editar_sala');
    let capaSalaBody = document.getElementById('body-editar-sala-modal');
    let enlaceOpcionesSala = document.getElementById('enlace_opciones_sala');

    if (capaSala && enlaceOpcionesSala) {
        if (capaSala.classList.contains('hidden')) {
            capaSala.classList.remove('hidden');
        } else {
            capaSala.classList.add('hidden');
        }

        capaSala.style.top = (enlaceOpcionesSala.offsetTop + 45) + 'px';
        if (capaSalaBody) {
            capaSalaBody.style.height = (window.innerHeight - enlaceOpcionesSala.offsetTop - 200) + 'px';
        }
    }
}

function toggleFichaLinea() {
    let capaSala = document.getElementById('capa_editar_sala');
    let capaFichaLinea = document.getElementById('capa_ficha_linea');

    if (capaFichaLinea) {
        if (capaFichaLinea.classList.contains('hidden')) {
            capaFichaLinea.classList.remove('hidden');
            if (capaSala.classList.contains('hidden')) {
                toggleEditarSala();
            }
        } else {
            capaFichaLinea.classList.add('hidden');
        }
    }
}

function toggleFichaMesa() {
    let capaSala = document.getElementById('capa_editar_sala');
    let capaFichaMesa = document.getElementById('capa_ficha_mesa');

    if (capaFichaMesa) {
        if (capaFichaMesa.classList.contains('hidden')) {
            capaFichaMesa.classList.remove('hidden');
            if (capaSala.classList.contains('hidden')) {
                toggleEditarSala();
            }
        } else {
            capaFichaMesa.classList.add('hidden');
        }
    }
}

function toggleEditarComedor() {
    let capaComedor = document.getElementById('capa_editar_comedor');

    if (capaComedor) {
        if (capaComedor.classList.contains('hidden')) {
            capaComedor.classList.remove('hidden');
        } else {
            capaComedor.classList.add('hidden');
        }
    }
}

function editarComedor(idComedor) {
    let inputIdComedor = document.getElementById('id_comedor_edicion');
    let inputDescripcionComedor = document.getElementById('descripcion_comedor');
    let inputOrdenComedor = document.getElementById('orden_comedor');

    if (!inputIdComedor || !inputDescripcionComedor || !inputOrdenComedor) {
        return;
    }

    // Comedor nuevo
    inputIdComedor.value = idComedor;
    inputDescripcionComedor.value = '';
    if (idComedor === -1) {
        activarElementoUnicoFicha('radio_comedor_activo_1', 'capa_radio_comedor_activo_1', 'capa_unicos_radio_comedor_activo');
        activarElementoUnicoFicha('radio_comedor_principal_2', 'capa_radio_comedor_principal_2', 'capa_unicos_radio_comedor_principal');

        let botonEditarComedor = document.getElementById('botonOpenModalEditarComedor');
        if (botonEditarComedor) {
            botonEditarComedor.click();
        }
    } else {
        let xhr = new XMLHttpRequest();
        xhr.onload = function () {
            if (xhr.status == 200) {
                let res = JSON.parse(this.responseText);

                inputDescripcionComedor.value = res.descripcion;
                inputOrdenComedor.value = res.orden;
                console.log(res.principal);
                if (res.principal > 0) {
                    activarElementoUnicoFicha('radio_comedor_principal_1', 'capa_radio_comedor_principal_1', 'capa_unicos_radio_comedor_principal');
                } else {
                    activarElementoUnicoFicha('radio_comedor_principal_2', 'capa_radio_comedor_principal_2', 'capa_unicos_radio_comedor_principal');
                }
                if (res.activo > 0) {
                    activarElementoUnicoFicha('radio_comedor_activo_1', 'capa_radio_comedor_activo_1', 'capa_unicos_radio_comedor_activo');
                } else {
                    activarElementoUnicoFicha('radio_comedor_activo_2', 'capa_radio_comedor_activo_2', 'capa_unicos_radio_comedor_activo');
                }

                let botonEditarComedor = document.getElementById('botonOpenModalEditarComedor');
                if (botonEditarComedor) {
                    botonEditarComedor.click();
                }
            }
        }

        xhr.open("post", "/admin/mesas/comedores/gestion/datos-select.php", true);
        let formData = new FormData();
        formData.append("id_sesion", idSesion);
        formData.append("ip", ip);
        formData.append("id_panel", idPanel);
        formData.append("id_idioma", idIdioma);
        formData.append("id_comedor", idComedor);
        formData.append("select", "editar-ficha");
        xhr.send(formData);
    }
}

function guardarComedor(accion = 'guardar-completo') {
    let inputIdComedor = document.getElementById('id_comedor_edicion');
    let inputDescripcionComedor = document.getElementById('descripcion_comedor');
    let inputOrdenComedor = document.getElementById('orden_comedor');

    if (!inputIdComedor || !inputDescripcionComedor || !inputOrdenComedor) {
        return;
    }

    let inputIdComedorValue = inputIdComedor.value;
    let inputDescripcionComedorValue = inputDescripcionComedor.value;
    let inputOrdenComedorValue = inputOrdenComedor.value;
    let inputActivoComedorValue = document.querySelector('input[name="radio_comedor_activo"]:checked').value;
    let inputPrincipalComedorValue = document.querySelector('input[name="radio_comedor_principal"]:checked').value;

    let xhr = new XMLHttpRequest();

    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            window.location.href = '/admin/gestion-mesas/id_comedor=' + res.id_comedores;
        }
    }

    xhr.open("post", "/admin/mesas/comedores/gestion/datos-update.php", true);
    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("id_comedores", inputIdComedorValue);
    formData.append("descripcion", inputDescripcionComedorValue);
    formData.append("activo", inputActivoComedorValue);
    formData.append("orden", inputOrdenComedorValue);
    formData.append("principal", inputPrincipalComedorValue);
    formData.append("select", accion);
    xhr.send(formData);
}

window.onload = function() {
    const element = document.getElementById("capa-scroll-comedor");
    element.scrollLeft = anchoScroll;
};