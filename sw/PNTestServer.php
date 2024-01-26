<?php
require_once 'autoloader.php';
require_once 'MyVapid.php';
require_once 'MyLogger.php';

use SKien\PNServer\PNDataProvider;
use SKien\PNServer\PNDataProviderMySQL;
use SKien\PNServer\PNPayload;
use SKien\PNServer\PNServer;
use SKien\PNServer\PNSubscription;

require ($_SERVER['DOCUMENT_ROOT'].'/sw/PNHostData.php');

// check, if PHP version is sufficient and all required extensions are installed
$bExit = false;
if (version_compare(phpversion(), '7.4', '<')) {
	trigger_error('At least PHP Version 7.4 is required (current Version is ' . phpversion() . ')!', E_USER_WARNING);
	$bExit = true;
}
$aExt = array('curl', 'gmp', 'mbstring', 'openssl', 'bcmath');
foreach ($aExt as $strExt) {
	if (!extension_loaded($strExt)) {
		trigger_error('Extension ' . $strExt . ' must be installed!', E_USER_WARNING);
		$bExit = true;
	}
}
if ($bExit) {
	exit();
}

// for this test we use SQLite database
$logger = createLogger();
$oDP = new PNDataProviderMySQL($bbddHost, $bbddUser, $bbddPass, $bbddDB, null, $logger, $id_usuario_sys);
if (!$oDP->isConnected()) {
    echo $oDP->getError();
	exit();
}

echo 'Count of subscriptions: ' . $oDP->count() . '<br/><br/>' . PHP_EOL;
if (!$oDP->init()) {
	echo $oDP->getError();
	exit();
}

// the server to handle all
$oServer = new PNServer($oDP);
$oServer->setLogger($logger);

// Set our VAPID keys
$oServer->setVapid(getMyVapid());

// create and set payload
// - we don't set a title - so service worker uses default
// - URL to icon can be
//    * relative to the origin location of the service worker
//    * absolute from the homepage (begining with a '/')
//    * complete URL (beginning with https://)
$oPayload = new PNPayload('Título de prueba', "Texto de prueba.", '/images/logo_cuadrado_120x120.jpg');
$oPayload->setTag('news', true);
$oPayload->setURL('/where-to-go.php');

$oServer->setPayload($oPayload);

// load subscriptions from database
if (!$oServer->loadSubscriptions()) {
    echo $oDP->getError();
    exit();
}

// ... and finally push !
if (!$oServer->push()) {
	echo '<h2>' . $oServer->getError() . '</h2>' . PHP_EOL;
} else {
	$aLog = $oServer->getLog();
	echo '<h2>Summary:</h2>' . PHP_EOL;
	$summary = $oServer->getSummary();
	echo 'total:&nbsp;' . $summary['total'] . '<br/>' . PHP_EOL;
	echo 'pushed:&nbsp;' . $summary['pushed'] . '<br/>' . PHP_EOL;
	echo 'failed:&nbsp;' . $summary['failed'] . '<br/>' . PHP_EOL;
	echo 'expired:&nbsp;' . $summary['expired'] . '<br/>' . PHP_EOL;
	echo 'removed:&nbsp;' . $summary['removed'] . '<br/>' . PHP_EOL;

	echo '<h2>Push - Log:</h2>' . PHP_EOL;
	foreach ($aLog as $strEndpoint => $aMsg ) {
	    echo PNSubscription::getOrigin($strEndpoint) . ':&nbsp;' .$aMsg['msg'] . '<br/>' . PHP_EOL;
	}
}
