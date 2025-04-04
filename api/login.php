<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Add error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verify the vendor path is correct
require  '../vendor/autoload.php';
use Firebase\JWT\JWT;

$secretKey = 'clousoftware';

// database
$users = [
    'cloudsoftware' => [
        'password' => password_hash('admin123', PASSWORD_BCRYPT),
        'uid' => '1001',
        'role' => 'admin'
    ]
];

try {
    // Get raw input and decode JSON
    $json = file_get_contents('php://input');
    if (empty($json)) {
        throw new Exception('Empty request body');
    }
    
    $data = json_decode($json, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON: ' . json_last_error_msg());
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        exit;
    }

    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';
    
    if (!isset($users[$username]) || !password_verify($password, $users[$username]['password'])) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
        exit;
    }
    
    $user = $users[$username];
    
    $payload = [
        'iss' => $_SERVER['HTTP_HOST'],
        'iat' => time(),
        'exp' => time() + 3600,
        'data' => [
            'userId' => $user['uid'],
            'username' => $username,
            'role' => $user['role']
    ]
        ];
    
    $jwt = JWT::encode($payload, $secretKey, 'HS256');
    
    echo json_encode([
        'success' => true,
        'token' => $jwt,
        'user' => [
            'username' => $username,
            'uid' => $user['uid'],
            'role' => $user['role']
        ]
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}