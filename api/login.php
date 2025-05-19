<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Security: Disable error reporting in production
if (getenv('APP_ENV') !== 'development') {
    error_reporting(0);
    ini_set('display_errors', 0);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

require '../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController {
    private const SECRET_KEY = 'clousoftware'; // In production, use environment variables
    private const TOKEN_EXPIRATION = 3600; // 1 hour
    
    // In a real application, this would be a database
    private $users = [
        'cloudsoftware' => [
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // hash of 'admin123'
            'uid' => '1001',
            'role' => 'admin'
        ]
    ];

    public function handleRequest(): void {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->sendResponse(405, ['success' => false, 'message' => 'Method not allowed']);
                return;
            }

            $data = $this->getJsonInput();
            $this->validateInput($data);

            $username = $data['username'];
            $password = $data['password'];

            if (!$this->isValidUser($username, $password)) {
                $this->sendResponse(401, ['success' => false, 'message' => 'Invalid credentials']);
                return;
            }

            $token = $this->generateJwtToken($username);
            $user = $this->users[$username];

            $this->sendResponse(200, [
                'success' => true,
                'token' => $token,
                'user' => [
                    'username' => $username,
                    'uid' => $user['uid'],
                    'role' => $user['role']
                ]
            ]);

        } catch (InvalidArgumentException $e) {
            $this->sendResponse(400, ['success' => false, 'message' => $e->getMessage()]);
        } catch (Exception $e) {
            $this->sendResponse(500, ['success' => false, 'message' => 'An error occurred']);
            // Log the full error in production: error_log($e->getMessage());
        }
    }

    private function getJsonInput(): array {
        $json = file_get_contents('php://input');
        if (empty($json)) {
            throw new InvalidArgumentException('Empty request body');
        }

        $data = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Invalid JSON: ' . json_last_error_msg());
        }

        return $data;
    }

    private function validateInput(array $data): void {
        if (empty($data['username']) || empty($data['password'])) {
            throw new InvalidArgumentException('Username and password are required');
        }
    }

    private function isValidUser(string $username, string $password): bool {
        if (!isset($this->users[$username])) {
            return false;
        }

        return password_verify($password, $this->users[$username]['password']);
    }

    private function generateJwtToken(string $username): string {
        $user = $this->users[$username];
        
        $payload = [
            'iss' => $_SERVER['HTTP_HOST'],
            'iat' => time(),
            'exp' => time() + self::TOKEN_EXPIRATION,
            'sub' => $user['uid'], // Standard JWT claim for subject
            'data' => [
                'userId' => $user['uid'],
                'username' => $username,
                'role' => $user['role']
            ]
        ];

        return JWT::encode($payload, self::SECRET_KEY, 'HS256');
    }

    private function sendResponse(int $statusCode, array $data): void {
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
}

// Execute the authentication
(new AuthController())->handleRequest();
