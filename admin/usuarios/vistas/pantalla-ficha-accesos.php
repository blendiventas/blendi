<?php
$select_sys = "editar-ficha-accesos";
require($_SERVER['DOCUMENT_ROOT']."/admin/usuarios/gestion/datos-select-php.php");

?>
<div class="grid grid-cols-1 sm:grid-cols-4 mt-3 items-center space-x-3">
    <div>IP</div>
    <div>DIA</div>
    <div>HORA</div>
    <div>TERMINAL</div>
</div>
<?php
foreach ($ip as $key_ip => $valor_ip) {
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-4 mt-3 items-center space-x-3">
        <div><?php echo $valor_ip; ?></div>
        <div><?php echo $dia[$key_ip]; ?></div>
        <div><?php echo $hora[$key_ip]; ?></div>
        <div><?php echo $terminal_accesos[$key_ip]; ?></div>
    </div>
    <?php
}
?>
<script type="text/javascript">
    desactivarBotonesPorDefectoFicha();
</script>
