<?php
$empresa = $_POST['empresa'];
$clave = $_POST['clave'];
$sector = $_POST['sector'];
$codigo_promocional = $_POST['codigo_promocional'];

function generateRandomPassword()
{
    $string = "";
    $length = '12';
    $chars = "abcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        $string .= $chars[rand(0, $size - 1)];
    }
    return $string;
}

$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$result = $conn->query("SELECT COUNT(id) as numero_bases_de_datos FROM identificacion_panel;");
$idNuevaBaseDeDatos = $result[0]['numero_bases_de_datos'] + 1;
unset($conn);

// Create database to user
$urlApi = 'https://dinahosting.com/special/api.php';
$username = 'megagestio';
$password = 'MONEGROS2014jwn8387';
$command = 'Hosting_Ddbb_Mysql_Create';
$dbHost = 'tpv-e.es';
$dbName = 'tpv_e_' . $idNuevaBaseDeDatos . 'es';
$dbUser = $dbName;
$dbPassword = generateRandomPassword();
if (!$urlApi || !$username || !$password || !$dbHost || !$command || !$dbUser || !$dbName || !$dbPassword) {
    throw new \Exception('Cannot get hosting data from config');
}

$conn = new db(0);
$conn->query("SET NAMES 'utf8'");
$codigo_promocional = empty($codigo_promocional) ? '' : trim($codigo_promocional);
$result = $conn->query('INSERT INTO identificacion_panel VALUES(
                                        NULL,
                                        "' . $empresa . '",
                                        "' . $clave . '",
                                        "' . $sector . '",
                                        "",
                                        0,
                                        0,
                                        "' . $codigo_promocional . '",
                                        "' . date('Y-m-d H:i:s') . '",
                                        "software-blendi-es.espacioseguro.com",
                                        "softwareblendi",
                                        "E5sC7x/}:076",
                                        "' . $dbHost . '",
                                        "' . $dbName .'",
                                        "' . $dbUser . '",
                                        "' . $dbPassword . '",
                                        0,
                                        "2000-01-01 00:00:00"
                                        );');
unset($conn);

$args = array('responseType' => 'Json',
    'hosting' => $dbHost,
    'ddbbName' => $dbName,
    'userName' => $dbUser,
    'userPassword' => $dbPassword,
    'accessHost' => 'any',
    'command' => $command,
) ;
$args = ( is_array ( $args ) ? http_build_query ( $args, '', '&' ) : $args );
$headers = array();
$handle = curl_init($urlApi);
if( $handle === false ) // error starting curl
{
    throw new \Exception('0 - Couldnot start curl');
} else {
    curl_setopt ( $handle, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt ( $handle, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $handle, CURLOPT_URL, $urlApi );

    curl_setopt( $handle, CURLOPT_USERPWD, $username.':'.$password );
    curl_setopt( $handle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );

    curl_setopt( $handle, CURLOPT_TIMEOUT, 60 );
    curl_setopt( $handle, CURLOPT_CONNECTTIMEOUT, 4); // set higher if you get a "28 - SSL connection timeout" error

    curl_setopt ( $handle, CURLOPT_HEADER, true );
    curl_setopt ( $handle, CURLOPT_HTTPHEADER, $headers );

    $curlversion = curl_version();
    curl_setopt ( $handle, CURLOPT_USERAGENT, 'PHP '.phpversion().' + Curl '.$curlversion['version'] );
    curl_setopt ( $handle, CURLOPT_REFERER, null );

    curl_setopt ( $handle, CURLOPT_SSL_VERIFYPEER, false ); // set false if you get a "60 - SSL certificate problem" error

    curl_setopt ( $handle, CURLOPT_POSTFIELDS, $args );
    curl_setopt ( $handle, CURLOPT_POST, true );

    $response = curl_exec ( $handle );

    if ($response)
    {
        $response = substr( $response,  strpos( $response, "\r\n\r\n" ) + 4 ); // remove http headers
        // parse response

        $responseDecoded = json_decode($response, true);
        if( $responseDecoded === false )
        {
            throw new \Exception('0 - Invalid json respond');
        }
        else
        {
            // parse response
            if( false == isset($responseDecoded['responseCode']) )
            {
                throw new \Exception('0 - Unexpected internal error');
            }
            else if( $responseDecoded['responseCode'] == 1000  )
            {
                $data = $responseDecoded['data'];
            }
            else
            {
                // normal error
                $errors = $responseDecoded['errors'];

                throw new \Exception('0 - Error logged');
            }
        }
    }
    else // http response code != 200
    {
        $error = curl_errno ( $handle ) . ' - ' . curl_error ( $handle );

        throw new \Exception($error);
    }

    curl_close($handle);
}
// End create database to user
?>

<form id="formulario-registro-hidden" action="/admin/usuarios-inicio" target="_self" method="post">
    <input type="hidden" name="empresa" value="<?php echo $empresa; ?>" />
    <input type="hidden" name="clave" value="<?php echo $clave; ?>" />
</form>
<script type="application/javascript">
    document.getElementById('formulario-registro-hidden').submit();
</script>
