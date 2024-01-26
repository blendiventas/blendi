<?php
$valor_1 = "";
$valor_2 = "";
if(isset($_POST['id_1']) && isset($_POST['id_2'])) {
    $valor_1 = $_POST['id_1'];
    $valor_2 = $_POST['id_2'];
}
?>
<form action="<?php echo $protocol . $_SERVER['HTTP_HOST']; ?>/prueba_datos_documentos.php" target="_self" method="post">
    ID 1: <input type="text" name="id_1" value="<?php echo $valor_1; ?>" />
    ID 2: <textarea name="id_2"><?php echo $valor_2; ?></textarea>
    <input type="submit" value="Consultar" />
</form>
<?php
if(isset($_POST['id_1']) && isset($_POST['id_2'])) {
    require("assets/conn/ddbb.php");
    $conn = new db(2);
    $conn->query("SET NAMES 'utf8'");

    function mostrar_paso_2($conn, $tabla, $sentencia)
    {
        echo "<strong>" . $tabla . "</strong><br />";
        $result = $conn->query($sentencia);
        if($conn->registros() >= 1) {
            foreach ($result as $key => $valor) {
                foreach ($valor as $key_valor => $valor_valor) {
                    echo $key_valor . ": " . $valor_valor . "<br />";
                }
                echo "<hr />";
            }
        }else {
            echo "Sin registros.<hr />";
        }
    }

    function mostrar_paso_1($conn, $id_1, $id_2)
    {
        $tabla = "documentos_2022_1";
        $sentencia = "SELECT * FROM documentos_2022_1 WHERE id=" . $id_1;
        mostrar_paso_2($conn, $tabla, $sentencia);
        $tabla = "documentos_2022_2";
        $sentencia = "SELECT * FROM documentos_2022_2 WHERE id_documentos_1=" . $id_1;
        mostrar_paso_2($conn, $tabla, $sentencia);
        $tabla = "documentos_2022_iva";
        $sentencia = "SELECT * FROM documentos_2022_iva WHERE id_documentos_1=" . $id_1;
        mostrar_paso_2($conn, $tabla, $sentencia);
        $tabla = "documentos_2022_libradores";
        $sentencia = "SELECT * FROM documentos_2022_libradores WHERE id_documentos_1=" . $id_1;
        mostrar_paso_2($conn, $tabla, $sentencia);
        $tabla = "documentos_2022_libradores_envio";
        $sentencia = "SELECT * FROM documentos_2022_libradores_envio WHERE id_documentos_1=" . $id_1;
        mostrar_paso_2($conn, $tabla, $sentencia);
        $tabla = "documentos_2022_observaciones";
        $sentencia = "SELECT * FROM documentos_2022_observaciones WHERE id_documentos_1=" . $id_1;
        mostrar_paso_2($conn, $tabla, $sentencia);
        $tabla = "documentos_2022_productos_costes";
        foreach ($id_2 as $key_2 => $valor_2) {
            $sentencia = "SELECT * FROM documentos_2022_productos_costes WHERE id_documentos_2=" . $valor_2;
            mostrar_paso_2($conn, $tabla, $sentencia);
        }
        $tabla = "documentos_2022_productos_relacionados";
        foreach ($id_2 as $key_2 => $valor_2) {
            $sentencia = "SELECT * FROM documentos_2022_productos_relacionados WHERE id_documentos_2=" . $valor_2;
            mostrar_paso_2($conn, $tabla, $sentencia);
        }
        $tabla = "documentos_2022_productos_relacionados_combo";
        foreach ($id_2 as $key_2 => $valor_2) {
            $sentencia = "SELECT * FROM documentos_2022_productos_relacionados_combo WHERE id_documentos_2=" . $valor_2;
            mostrar_paso_2($conn, $tabla, $sentencia);
        }
        $tabla = "documentos_2022_productos_relacionados_elaborados";
        foreach ($id_2 as $key_2 => $valor_2) {
            $sentencia = "SELECT * FROM documentos_2022_productos_relacionados_elaborados WHERE id_documentos_2=" . $valor_2;
            mostrar_paso_2($conn, $tabla, $sentencia);
        }
        $tabla = "documentos_2022_productos_sku_stock";
        $sentencia = "SELECT * FROM documentos_2022_productos_sku_stock WHERE id_documento_1=" . $id_1;
        mostrar_paso_2($conn, $tabla, $sentencia);
        $tabla = "documentos_2022_recibos";
        $sentencia = "SELECT * FROM documentos_2022_recibos WHERE id_documento=" . $id_1;
        mostrar_paso_2($conn, $tabla, $sentencia);
    }
    $id_1 = $_POST['id_1'];
    $id_2 = explode(",",$_POST['id_2']);
    mostrar_paso_1($conn,$id_1,$id_2);

}