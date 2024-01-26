function modificarPermisosPorCargo() {
    let cargoSelect = document.getElementById('permisos_usuarios');
    if (!cargoSelect || !cargoSelect.value) {
        return
    }
    let cargo = cargoSelect.value;
    let permisos = {};

    if (cargo == 1) {
        permisos.menu_clientes = "1";
        permisos.clientes = "1";
        permisos.presupuestos_clientes = "1";
        permisos.pedidos_clientes = "1";
        permisos.albaranes_clientes = "1";
        permisos.facturas_clientes = "1";
        permisos.tiquets_clientes = "1";
        permisos.mesas = "1";
        permisos.zonas = "1";
        permisos.modalidades_envio = "1";
        permisos.modalidades_entrega = "1";
        permisos.modalidades_pago = "1";
        permisos.menu_proveedores = "1";
        permisos.proveedores = "1";
        permisos.presupuestos_proveedores = "1";
        permisos.pedidos_proveedores = "1";
        permisos.albaranes_proveedores = "1";
        permisos.facturas_proveedores = "1";
        permisos.tiquets_proveedores = "1";
        permisos.menu_creditores = "1";
        permisos.creditores = "1";
        permisos.presupuestos_creditores = "1";
        permisos.pedidos_creditores = "1";
        permisos.albaranes_creditores = "1";
        permisos.facturas_creditores = "1";
        permisos.tiquets_creditores = "1";
        permisos.menu_productos = "1";
        permisos.productos = "1";
        permisos.categorias = "1";
        permisos.categorias_elaborados = "1";
        permisos.detalles_productos = "1";
        permisos.grupos = "1";
        permisos.menu_listados = "1";
        permisos.stocks_listados = "1";
        permisos.mas_vendidos_listados = "1";
        permisos.recepcion_pedidos = "1";
        permisos.menu_general = "1";
        permisos.tipos_iva = "1";
        permisos.tipos_irpf = "1";
        permisos.bancos_cajas = "1";
        permisos.tarifas = "1";
        permisos.usuarios = "1";
        permisos.idiomas = "0";
        permisos.datos_empresa = "1";
        permisos.impresion_documentos = "1";
        permisos.iconos = "0";
        permisos.gestor = "0";
        permisos.terminales = "1";
    } else if (cargo == 2 || cargo == 3 || cargo == 4) {
        permisos.menu_clientes = "0";
        permisos.clientes = "0";
        permisos.presupuestos_clientes = "0";
        permisos.pedidos_clientes = "0";
        permisos.albaranes_clientes = "0";
        permisos.facturas_clientes = "0";
        permisos.tiquets_clientes = "1";
        permisos.mesas = "1";
        permisos.zonas = "0";
        permisos.modalidades_envio = "0";
        permisos.modalidades_entrega = "0";
        permisos.modalidades_pago = "0";
        permisos.menu_proveedores = "0";
        permisos.proveedores = "0";
        permisos.presupuestos_proveedores = "0";
        permisos.pedidos_proveedores = "0";
        permisos.albaranes_proveedores = "0";
        permisos.facturas_proveedores = "0";
        permisos.tiquets_proveedores = "0";
        permisos.menu_creditores = "0";
        permisos.creditores = "0";
        permisos.presupuestos_creditores = "0";
        permisos.pedidos_creditores = "0";
        permisos.albaranes_creditores = "0";
        permisos.facturas_creditores = "0";
        permisos.tiquets_creditores = "0";
        permisos.menu_productos = "0";
        permisos.productos = "0";
        permisos.categorias = "1";
        permisos.categorias_elaborados = "0";
        permisos.detalles_productos = "1";
        permisos.grupos = "1";
        permisos.menu_listados = "0";
        permisos.stocks_listados = "0";
        permisos.mas_vendidos_listados = "0";
        permisos.recepcion_pedidos = "1";
        permisos.menu_general = "0";
        permisos.tipos_iva = "0";
        permisos.tipos_irpf = "0";
        permisos.bancos_cajas = "0";
        permisos.tarifas = "0";
        permisos.usuarios = "0";
        permisos.idiomas = "0";
        permisos.datos_empresa = "0";
        permisos.impresion_documentos = "0";
        permisos.iconos = "0";
        permisos.gestor = "0";
        permisos.terminales = "1";
    } else {
        permisos.menu_clientes = "0";
        permisos.clientes = "0";
        permisos.presupuestos_clientes = "0";
        permisos.pedidos_clientes = "0";
        permisos.albaranes_clientes = "0";
        permisos.facturas_clientes = "0";
        permisos.tiquets_clientes = "1";
        permisos.mesas = "1";
        permisos.zonas = "0";
        permisos.modalidades_envio = "0";
        permisos.modalidades_entrega = "0";
        permisos.modalidades_pago = "0";
        permisos.menu_proveedores = "0";
        permisos.proveedores = "0";
        permisos.presupuestos_proveedores = "0";
        permisos.pedidos_proveedores = "0";
        permisos.albaranes_proveedores = "0";
        permisos.facturas_proveedores = "0";
        permisos.tiquets_proveedores = "0";
        permisos.menu_creditores = "0";
        permisos.creditores = "0";
        permisos.presupuestos_creditores = "0";
        permisos.pedidos_creditores = "0";
        permisos.albaranes_creditores = "0";
        permisos.facturas_creditores = "0";
        permisos.tiquets_creditores = "0";
        permisos.menu_productos = "0";
        permisos.productos = "0";
        permisos.categorias = "1";
        permisos.categorias_elaborados = "0";
        permisos.detalles_productos = "1";
        permisos.grupos = "1";
        permisos.menu_listados = "0";
        permisos.stocks_listados = "0";
        permisos.mas_vendidos_listados = "0";
        permisos.recepcion_pedidos = "1";
        permisos.menu_general = "0";
        permisos.tipos_iva = "0";
        permisos.tipos_irpf = "0";
        permisos.bancos_cajas = "0";
        permisos.tarifas = "0";
        permisos.usuarios = "0";
        permisos.idiomas = "0";
        permisos.datos_empresa = "0";
        permisos.impresion_documentos = "0";
        permisos.iconos = "0";
        permisos.gestor = "0";
        permisos.terminales = "1";
    }

    let permisoValor = 0;
    let permisoInput = null;
    for (let permisoNombre in permisos) {
        if (!permisos.hasOwnProperty(permisoNombre)) continue;

        permisoValor = permisos[permisoNombre];
        permisoInput = document.getElementById(permisoNombre + '_' + permisoValor);
        if (permisoInput) {
            permisoInput.checked = true;
        }
    }
}

function guardarPermisos(id) {
    document.getElementById("capa_guardar_update").style.display = "none";
    var capaInfo = document.querySelector("#info-main");

    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(res.logs);

            cambiarApartadoFicha('permisos');
        }
    }

    xhr.open("post", "/admin/usuarios/gestion/datos-update.php", true);
    let form = document.querySelector("#form_datos_post");
    formData = new FormData(form);
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "guardar-permisos");
    xhr.send(formData);
}