<?php
// This script should be accessible via the CALLBACK_URL specified in the config.php
header('Content-Type: application/json');
$response = file_get_contents('php://input');
$logFile = 'mpesaResponse.txt';
$log = fopen($logFile, 'a');
fwrite($log, $response);
fclose($log);

// You can process the response further as needed
?>;
