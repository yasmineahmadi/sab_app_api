<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

//validate user is logged
require 'auth/validate_token.php';
$decoded=validateToken();

$data = require __DIR__ . '/../data/schedule_data.php';


// request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  
    echo json_encode($data); 
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
?>