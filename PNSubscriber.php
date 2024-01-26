<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sw/autoloader.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/sw/PNSendWelcome.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/sw/MyLogger.php';

use SKien\PNServer\PNDataProvider;
use SKien\PNServer\PNDataProviderMySQL;
use SKien\PNServer\PNSubscription;

require ($_SERVER['DOCUMENT_ROOT'].'/sw/PNHostData.php');

// set to true, if you will send songle welcome notification to each new subscription
$bSendWelcome = true;

$result = array();
// only serve POST request containing valid json data
if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
	if (isset($_SERVER['CONTENT_TYPE'])	&& trim(strtolower($_SERVER['CONTENT_TYPE']) == 'application/json')) {
		// get posted json data
		if (($strJSON = trim(file_get_contents('php://input'))) === false) {
			$result['msg'] = 'invalid JSON data!';
		} else {
		    // create any PSR-3 logger of your choice in MyLogger.php
			$oDP = new PNDataProviderMySQL($bbddHost, $bbddUser, $bbddPass, $bbddDB, null, createLogger(), $id_terminal_sys);
			if ($oDP->saveSubscription($strJSON) !== false) {
				$result['msg'] = 'subscription saved on server!';
				if ($bSendWelcome) {
				    sendWelcome(PNSubscription::fromJSON($strJSON));
				}
			} else {
				$result['msg'] = 'error saving subscription!';
			}
		}
	} else {
		$result['msg'] = 'invalid content type!';
	}
} else {
	$result['msg'] = 'no post request!';
}
// let the service-worker know the result
echo json_encode($result);
