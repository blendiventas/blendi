function identificarUsuario(id) {
    //var infoMain = document.querySelector("#info-main");

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(res){
        //(xhr.readyState < 4) ? main.style.display = "none" : main.style.display = "block";
        //infoMain.innerHTML = '<img src="../../images/loader.gif" alt="Cargando datos" title="Cargando datos" />';
    }
    xhr.onload = function () {
        if (xhr.status == 200) {
            let res = JSON.parse(this.responseText);
            if(res.correcto == true) {
                if (id == 1) {
                    window.location.href = "/admin/gestion-home";
                } else if (res.sector == 'restauracion') {
                    window.location.href = "/tiquets/" + idSesion + "/tpv/ventas-inicio";
                } else {
                    window.location.href = "/admin/index.php";
                }
            }
        }
    }

    let formData = new FormData();
    formData.append("id_sesion", idSesion);
    formData.append("ip", ip);
    formData.append("id_panel", idPanel);
    formData.append("id_idioma", idIdioma);
    formData.append("select", "id-password");
    formData.append("id", id);
    formData.append("password", document.getElementById("password_usuarios_"+id).value);
    xhr.open("POST", "/admin/usuarios/gestion/datos-select.php");
    xhr.send(formData);
}

window.showPasswordLogin = false;
function toogleShowPasswordLogin(inputId, showPasswordLoginElemetId) {
    window.showPasswordLogin = !window.showPasswordLogin;

    let capaShowPasswordLogin = document.getElementById(showPasswordLoginElemetId);
    let inputClave = document.getElementById(inputId);
    const actualInput = inputClave.type;

    if (actualInput === 'password'){
        inputClave.type = 'text';
        capaShowPasswordLogin.innerText = 'Ocultar';
    } else if (actualInput === 'text'){
        inputClave.type = 'password';
        capaShowPasswordLogin.innerText = 'Mostrar';
    }
}

function toggleFormIdentificarUsuario(e, elementId){
    e.classList.toggle('hidden', !e.classList.contains('hidden'));
    const capaFormIdentificarUsuario = document.getElementById(elementId);
    capaFormIdentificarUsuario.classList.toggle('hidden', !capaFormIdentificarUsuario.classList.contains('hidden'));
}