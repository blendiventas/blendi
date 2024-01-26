function anadirLinea() {
    let nuevaCapa = document.getElementById('lineas_modalidad_pago').cloneNode(true);
    let nuevaCapaBoton = document.createElement('li');
    let capaDondeAnadir = document.getElementById('formModalidadesPago');

    nuevaCapa.attributes.id = '';
    nuevaCapaBoton.innerHTML = '<button type="button" onclick="eliminarLinea(this);">Eliminar</button>';

    capaDondeAnadir.appendChild(nuevaCapa);
    capaDondeAnadir.appendChild(nuevaCapaBoton);
}

function eliminarLinea(buttonCapaAEliminar) {
    let capaBotonAEliminar = buttonCapaAEliminar.parentElement;
    let capaInputsAEliminar = capaBotonAEliminar.previousElementSibling;

    capaInputsAEliminar.remove();
    capaBotonAEliminar.remove();
}