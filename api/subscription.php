<?php

ob_start(); 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

//  error output 
ini_set('display_errors', 0);
error_reporting(0);

require 'auth/validate_token.php';
$data = require __DIR__ . '/../data/subscription_data.php';

try {
  //validate user is logged
    $decoded = validateToken();

    $requestMethod = $_SERVER['REQUEST_METHOD'];
    
    if ($requestMethod === 'GET') {
        $response = [
            'success' => true,
            'message' => 'Subscriptions retrieved successfully',
            'data' =>$data
        ];
        
        // Clear
        ob_end_clean();
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        throw new Exception('Method not allowed', 405);
    }
} catch (Exception $e) {
    // Clear 
    ob_end_clean();
    
    http_response_code($e->getCode() ?: 500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
    exit;
}
