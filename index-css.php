<?php
require("index-datos.php");
?>
<!doctype html>
<html lang="<?php echo $lang; ?>" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="copyright" content="https://www.ciclotic.com" />
    <meta http-equiv="content-language" content="<?php echo $lang; ?>" />
    <meta name="description" content="<?php echo $descripcion_meta; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="author" content="cicloTIC">
    <meta name="generator" content="Hugo 0.83.1">

    <meta name="robots" content="<?php echo $robots; ?>">

    <title><?php echo $descripcion_title; ?></title>

    <?php
    if(!empty($foto_meta)) {
        ?>
        <!-- Twitter Card data -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="<?php echo $descripcion_title; ?>">
        <meta name="twitter:description" content="<?php echo $descripcion_meta; ?>">
        <meta name="twitter:image" content="<?php echo $foto_meta; ?>">
        <meta name="twitter:image:alt" content="<?php echo $foto_alt; ?>">

        <!-- Open Graph data -->
        <meta property="og:locale" content="<?php echo $locale_og; ?>" />
        <meta property="og:title" content="<?php echo $descripcion_title; ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?php echo $url_completa; ?>" />
        <meta property="og:image" content="<?php echo $foto_meta; ?>" />
        <meta property="og:description" content="<?php echo $descripcion_meta; ?>" />
        <meta property="og:site_name" content="compra-e" />
        <?php
        if(!empty($pvp_meta)) {
            ?>
            <meta property="og:price:amount" content="<?php echo $pvp_meta; ?>" />
            <meta property="og:price:currency" content="EUR" />
            <?php
        }
    }
    ?>

    <link rel="canonical" href="<?php echo $host; ?>">

    <link href="<?php echo $host; ?>styles.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?php echo $host; ?>assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="<?php echo $host; ?>assets/img/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="<?php echo $host; ?>assets/img/favicon-16x16.png" sizes="16x16" type="image/png">
    <!-- <link rel="manifest" href="<?php echo $host; ?>assets/img/favicons/manifest.json"> -->
    <link rel="mask-icon" href="<?php echo $host; ?>assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="<?php echo $host; ?>assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">

</head>
<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="row w-100 align-items-center">
                        <div class="col-12 col-sm-2 text-center">
                            <a class="navbar-brand" href="<?php echo $host; ?>">
                                <img src="<?php echo $host; ?>images/doctor-vinilo-redondo.png" class="w-100p"
                                     alt="<?php echo $productos['descripcion'][$key]; ?>"
                                     title="<?php echo $productos['descripcion'][$key]; ?>">
                            </a>
                        </div>
                        <div class="col-12 col-sm-8 d-flex justify-content-center">
                            <ul class="navbar-nav text-center align-items-center">
                                <li class="nav-item">
                                    <a class="nav-link text-white bg-dark menu_superior" href="#" title="">
                                        <img class="icon" src="icons/Business/at-fill.svg" alt="My Happy SVG"/>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white bg-dark menu_superior" href="#" title="">
                                        Acceso / Registro
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white bg-dark menu_superior" href="#" title="">
                                        Quienes somos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white bg-dark menu_superior" href="#" title="">
                                        Contacto
                                    </a>
                                </li>
                                <li class="nav-item menu_superior">
                                    <a class="nav-link text-white bg-dark menu_superior" href="#" title="">
                                        Condiciones de venta
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white bg-dark menu_superior" href="#" title="">
                                        Garantías
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white bg-dark menu_superior" href="#" title="">
                                        Mis pedidos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white bg-dark menu_superior" href="#" title="">
                                        Doctor Vinilo
                                    </a>
                                </li>
                                <li class="nav-item" id="li_sidebar">
                                    <i class="bi bi-arrow-bar-right text-white bg-dark"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-2 text-center">
                            <a class="navbar-brand" href="<?php echo $host; ?>">
                                <img src="<?php echo $host; ?>images/acceso-profesionales.png" id="logos-cabecera"
                                     alt="<?php echo $productos['descripcion'][$key]; ?>"
                                     title="<?php echo $productos['descripcion'][$key]; ?>">
                            </a>
                        </div>
                    </div>
                    <!--
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    -->
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col mx-2 d-flex justify-content-start">
                <a class="navbar-brand" href="<?php echo $host; ?>">
                    <img src="<?php echo $host; ?>images/logo_cuidatumusica_300.jpg" class="w-100p"
                         alt="<?php echo $productos['descripcion'][$key]; ?>"
                         title="<?php echo $productos['descripcion'][$key]; ?>">
                </a>
            </div>
            <div class="col me-2 justify-content-end">
                <?php
                if ($idioma == "castellano") { $valor_idioma = "Buscar productos..."; } else
                { $valor_idioma = "Cercar productes..."; }
                ?><br />
                <div class="input-group mt-1" style="flex-wrap: unset;">
                    <input type="text" class="form-control" id="textoBuscar" name="textoBuscar" placeholder="<?php echo $valor_idioma; ?>">
                    <input type="hidden" id="cercar_poblacion" name="poblacion" value="">
                    <input type="hidden" id="cercar_provincia" name="provincia" value="">
                    <input type="hidden" id="cercar_sector" name="sector" value="">
                    <div class="input-group-append" style="height: 38px; margin-left: -3px;">
                        <button class="btn btn-secondary" id="boton_buscador" type="button" onclick="cercar($('#textoBuscar').val());">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div>
        <ul id="lista-menu">
            <li>
                <a href="https://informaticapc.com/" class="menu">Ir a InformaticaPC</a>
            </li>
            <li>
                <a href="https://informaticapc.com/blog/" class="menu">Ir al blog</a>
            </li>
            <li>
                <a href="http://www.google.es/" class="menu">Ir a Google</a>
            </li>
            <li>
                <a href="http://www.yahoo.es/" class="menu">Ir a Yahoo</a>
            </li>
            <li>
                <a href="http://www.bing.es/" class="menu">Ir a Bing</a>
            </li>
        </ul>
    </div>

    <main>
        <div class="container">
            <div class="text-muted">Place sticky main content here.</div>
            <div class="text-muted">Place sticky main content here.</div>
            <div class="text-muted">Place sticky main content here.</div>
        </div>
    </main>

    <footer class="footer bg-light">
        <div class="container">
            <span class="text-muted">Place sticky footer content here.</span>
        </div>
    </footer>

</body>
</html>