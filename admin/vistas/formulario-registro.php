<form  class="formulario" action="registro-completar" id="identificacion_form" target="_self" method="post">
    <div class="capa_identificacion_form">
        <ul>
            <li>
                <h2>Registro usuario</h2>
                <span class="required_notification">* Datos requeridos</span>
            </li>
            <li>
                <label for="empresa">Empresa:</label>
                <input type="text" name="empresa" id="empresa" placeholder="Nombre empresa" required />
            </li>
            <li>
                <label for="clave">Clave:</label>
                <input type="password" name="clave" id="clave" placeholder="Clave empresa" required />
            </li>
            <li>
                <label for="clave">Sector:</label>
                <select name="sector" id="sector" required>
                    <option value="restauracion" selected>Restauración</option>
                    <option value="comercio">Comercio</option>
                    <option value="estetica">Estética</option>
                    <option value="empresa">Empresa</option>
                </select>
            </li>
            <li>
                <button class="submit" type="submit">Registrarse</button>
            </li>
        </ul>
    </div>
</form>