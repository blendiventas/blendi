<form  class="formulario" action="usuarios-inicio" id="identificacion_form" target="_self" method="post">
    <div class="capa_identificacion_form">
        <ul>
            <li>
                <h2>Identificación usuario</h2>
                <span class="required_notification">* Datos requeridos</span>
            </li>
            <li>
                <label for="empresa">Empresa:</label>
                <input type="text" name="empresa" id="empresa" placeholder="Nombre empresa" required />
            </li>
            <li>
                <label for="clave">Clave:</label>
                <input type="password" name="clave" id="clave" placeholder="clave empresa" required />
            </li>
            <li>
                <button class="submit" type="submit">Validar</button>
            </li>
        </ul>
    </div>
</form>