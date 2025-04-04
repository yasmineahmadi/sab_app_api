<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require __DIR__ . '/../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secretKey = 'clousoftware';

function validateToken() {
    global $secretKey;
    
    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? '';
    
    if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        $jwt = $matches[1];
        
        try {
            $decoded = JWT::decode($jwt, new Key($secretKey, 'HS256'));
            return $decoded;
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Invalid or expired token']);
            exit;
        }
    } else {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Authorization header missing']);
        exit;
    }
}

// // Example protected endpoint
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     $decoded = validateToken();
    
//     // Token is valid, proceed with protected operation
//     echo json_encode([
//         'success' => true,
//         'message' => 'Access granted',
//         'user' => $decoded->data
//     ]);
// } else {
//     http_response_code(405);
//     echo json_encode(['success' => false, 'message' => 'Method not allowed']);
// }