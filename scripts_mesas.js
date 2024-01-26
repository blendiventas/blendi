function editarComensales(idMesa,mesa,comensalesActuales,idDocumentoMesa,ejercicioDocumentoMesa,idLibradorMesa) {
    document.getElementById('boton-mesas').style.display = 'inline-grid';
    document.getElementById("capa-nuevos-tiquets").style.display = "none";
    document.getElementById("capa_mesa_seleccionada").innerHTML = mesa;

    document.getElementById("id-mesa-comensales-guardar").value = idMesa;
    if(idDocumento != 0) {
        document.getElementById("comensales-guardar").value = comensalesActuales;
    }
    document.getElementById("id-documento-comensales-guardar").value = idDocumentoMesa;
    document.getElementById("ejercicio-documento-comensales-guardar").value = ejercicioDocumentoMesa;
    document.getElementById("id-librador-comensales-guardar").value = idLibradorMesa;

    document.getElementById("capa-comensales").style.display = "block";
}
function guardarComensales(idMesa,comensalesGuardar,idDocumentoMesa,ejercicioDocumentoMesa,idLibradorDocumentoMesa) {
    if(idDocumento == 0) {
        document.getElementById('comensales').value = comensalesGuardar;
        document.getElementById('tipo_librador').value = 'mes';
        datosFacturacionCesta(idMesa,'cabecera');
    }else {
        /*
        Guardar comensalesGuardar en el documento

        <input type="hidden" id="id-mesa-comensales-guardar" value="" />
        <input type="number" id="comensales-guardar" value="" />
        <input type="hidden" id="id-documento-comensales-guardar" value="" />
        <input type="hidden" id="ejercicio-documento-comensales-guardar" value="" />
        <input type="hidden" id="id-librador-comensales-guardar" value="" />
        */
        abrirDocumento(document.getElementById('id-mesa-comensales-guardar').value, document.getElementById('ejercicio-documento-comensales-guardar').value, document.getElementById('id-librador-comensales-guardar').value);
    }
}