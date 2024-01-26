<?php
$directorio[] = "Buildings";
$directorio[] = "Business";
$directorio[] = "Communication";
$directorio[] = "Design";
$directorio[] = "Development";
$directorio[] = "Device";
$directorio[] = "Document";
$directorio[] = "Editor";
$directorio[] = "Finance";
$directorio[] = "Health";
$directorio[] = "Logos";
$directorio[] = "Map";
$directorio[] = "Media";
$directorio[] = "Others";
$directorio[] = "System";
$directorio[] = "User";
$directorio[] = "Weather";
foreach ($directorio as $key_directorio => $valor_directorio) {
    $iconos = scandir($valor_directorio);
    foreach ($iconos as $key_iconos => $valor_iconos) {
        if($valor_iconos != "." AND $valor_iconos != "..") {
            ?>
            <img src="<?php echo $valor_directorio."/".$valor_iconos; ?>" alt="<?php echo $valor_iconos; ?>" style="width: 25px;" /><?php echo "&nbsp;".$valor_directorio."/".$valor_iconos; ?><br />
            <?php
        }
    }
}