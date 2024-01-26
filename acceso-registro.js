function enviarAccesoRegistro(form_dades)
{
    var valor_pais=document.form_dades.pais.selectedIndex;
    valor_pais=document.form_dades.pais.options[valor_pais].value;
    if (document.form_dades.nom.value=="" | document.form_dades.cognoms.value=="" | document.form_dades.cognoms2.value=="")
    {
        alert("Los campos 'Nombre', 'Primer apellido' y 'Segundo apellido' son obligatorios.");
        if (document.form_dades.nom.value!="")
        {
            document.form_dades.cognoms.focus();
        }else if(document.form_dades.cognoms.value!="")
        {
            document.form_dades.cognoms2.focus();
        }else
        {
            document.form_dades.nom.focus();
        }
        return false;
    }
    if (document.form_dades.nom.value==0 | document.form_dades.cognoms.value==0 | document.form_dades.cognoms2.value==0)
    {
        alert("Los campos 'Nombre', 'Primer apellido' y 'Segundo apellido' son obligatorios. Los valores nulos no están admitidos.");
        if (document.form_dades.nom.value!="")
        {
            document.form_dades.cognoms.focus();
        }else if(document.form_dades.cognoms.value!="")
        {
            document.form_dades.cognoms2.focus();
        }else
        {
            document.form_dades.nom.focus();
        }
        return false;
    }
    if (document.form_dades.dni.value=="")
    {
        alert("El campo 'DNI' es obligatorio");
        document.form_dades.dni.focus();
        return false;
    }
    if (document.form_dades.pais.value=="")
    {
        alert("El campo 'Zona' es obligatorio.");
        document.form_dades.pais.focus();
        return false;
    }
    if (document.form_dades.pais.value==0)
    {
        alert("El campo 'Zona' es obligatorio. Los valores nulos no están admitidos.");
        document.form_dades.pais.focus();
        return false;
    }
    if (document.form_dades.nom.value!="" && document.form_dades.dni.value=="" && valor_pais==17)
    {
        alert("El campo 'DNI' es obligatorio");
        document.form_dades.dni.focus();
        return false;
    }
    if (document.form_dades.dni.value==0 && valor_pais==17)
    {
        alert("El campo 'DNI' es obligatorio. Los valores nulos no están admitidos.");
        document.form_dades.dni.focus();
        return false;
    }
    if (document.form_dades.adresa.value=="")
    {
        alert("El campo 'dirección' es obligatorio.");
        document.form_dades.adresa.focus();
        return false;
    }
    if (document.form_dades.adresa.value==0)
    {
        alert("El campo 'dirección' es obligatorio. Los valores nulos no están admitidos.");
        document.form_dades.adresa.focus();
        return false;
    }
    if (document.form_dades.mobil.value=="")
    {
        alert("El campo 'Móvil' es obligatorio.");
        document.form_dades.mobil.focus();
        return false;
    }
    if (document.form_dades.mobil.value==0)
    {
        alert("El campo 'Móvil' es obligatorio. Los valores nulos no están admitidos.");
        document.form_dades.mobil.focus();
        return false;
    }
    var tel_mob = /[0-9]/
    if (document.form_dades.mobil.value!="")
    {
        if(!tel_mob.test(document.form_dades.mobil.value))
        {
            alert("El 'Móvil' es incorrecto.");
            document.form_dades.mobil.focus();
            return false;
        }
    }
    if (document.form_dades.telefon.value!="")
    {
        if(!tel_mob.test(document.form_dades.telefon.value))
        {
            alert("El 'Teléfono' es incorrecto.");
            document.form_dades.telefon.focus();
            return false;
        }
    }
    if (document.form_dades.codi_postal.value=="")
    {
        alert("El campo 'Código Postal' es obligatorio.");
        document.form_dades.codi_postal.focus();
        return false;
    }
    if (document.form_dades.codi_postal.value==0)
    {
        alert("El campo 'Código Postal' es obligatorio. Los valores nulos no están admitidos.");
        document.form_dades.codi_postal.focus();
        return false;
    }
    var postal = /[0-9]/
    if(!postal.test(document.form_dades.codi_postal.value))
    {
        alert("El 'Código Postal' es incorrecto.");
        document.form_dades.codi_postal.focus();
        return false;
    }
    if (document.form_dades.localitat.value=="")
    {
        alert("El campo 'Localidad' es obligatorio.");
        document.form_dades.localitat.focus();
        return false;
    }
    if (document.form_dades.localitat.value==0)
    {
        alert("El campo 'localidad' es obligatorio. Los valores nulos no están admitidos.");
        document.form_dades.localitat.focus();
        return false;
    }
    if (document.form_dades.provincia.value=="")
    {
        alert("El campo 'Provincia' es obligatorio.");
        document.form_dades.provincia.focus();
        return false;
    }
    if (document.form_dades.provincia.value==0)
    {
        alert("El campo 'Provincia' es obligatorio. Los valores nulos no están admitidos.");
        document.form_dades.provincia.focus();
        return false;
    }
    if (document.form_dades.nombre_tienda.value=="")
    {
        alert("El campo 'Nombre de la tienda' es obligatorio.");
        document.form_dades.nombre_tienda.focus();
        return false;
    }
    if (document.form_dades.nombre_tienda.value==0)
    {
        alert("El campo 'Nombre de la tienda' es obligatorio. Los valores nulos no están admitidos.");
        document.form_dades.nombre_tienda.focus();
        return false;
    }
    if (document.form_dades.webs.value=="")
    {
        alert("El campo 'Nombre de la Tienda o web de la empresa o web en donde eres vendedor' es obligatorio.");
        document.form_dades.webs.focus();
        return false;
    }
    if (document.form_dades.webs.value==0)
    {
        alert("El campo 'Nombre de la Tienda o web de la empresa o web en donde eres vendedor' es obligatorio. Los valores nulos no están admitidos.");
        document.form_dades.webs.focus();
        return false;
    }
    if (document.form_dades.numero.value=="")
    {
        alert("El campo 'Número' es obligatorio. En caso de no tener número se tiene que poner 's/n'.");
        document.form_dades.numero.focus();
        return false;
    }
    if (document.form_dades.numero.value==0)
    {
        alert("El campo 'Número' es obligatorio. En caso de no tener número se tiene que poner 's/n'.");
        document.form_dades.numero.focus();
        return false;
    }
    if (document.form_dades.mail.value=="")
    {
        alert("El campo 'E-mail' es obligatorio.");
        document.form_dades.mail.focus();
        return false;
    }
    if (document.form_dades.mail.value!=document.form_dades.mail2.value)
    {
        alert("El 'E-mail' es incorrecto.");
        document.form_dades.mail2.value='';
        document.form_dades.mail.focus();
        return false;
    }
    var er_email = /(.+\@.+\..+)$/
    if(!er_email.test(document.form_dades.mail.value))
    {
        alert("El formato de 'E-mail' es incorrecto.");
        document.form_dades.mail.focus();
        return false;

    }
    var check_condiciones_uso=document.form_dades.chec_condiciones_uso.checked;
    if(check_condiciones_uso == false)
    {
        alert("Es obligatorio leerse y aceptar las Condiciones de Venta.");
        return false;
    }
    var check_chec_mailings=document.form_dades.chec_mailings.checked;
    if(check_chec_mailings == false)
    {
        alert("Debes marcar la casilla de envio de emails de Ofertas o no podremos darte de alta como comprador Profesional ya que no podremos enviarte las informaciones que necesitas.");
        return false;
    }
    if (document.form_dades.pagament[0].checked==false && document.form_dades.pagament[1].checked==false && document.form_dades.pagament[2].checked==false)
    {
        alert("Elegir el 'método de pago' es obligatorio.");
        return false;
    }
    if (document.form_dades.password.value=="")
    {
        alert("El campo 'Password' es obligatorio.");
        document.form_dades.password.focus();
        return false;
    }
    if (document.form_dades.password.value==0)
    {
        alert("El campo 'Password' es obligatorio. Los valores nulos no están admitidos");
        document.form_dades.password.focus();
        return false;
    }
    if (document.form_dades.password.value!=document.form_dades.password2.value)
    {
        alert("El campo 'Repetir password' debe ser el mismo que el campo 'Password'.");
        document.form_dades.password.focus();
        return false;
    }
}