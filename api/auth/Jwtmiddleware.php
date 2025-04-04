<?php
require __DIR__ . '/../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtMiddleware {
    private $secretKey;
    
    public function __construct(string $secretKey) {
        $this->secretKey = $secretKey;
    }
    
    public function __invoke($request, $handler) {
        // For PSR-7 implementations (like Slim)
        return $this->handlePsr7($request, $handler);
    }
    
    public function handleTraditional() {
        // For traditional PHP applications
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';
        
        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Authorization header missing']);
            exit;
        }
        
        $jwt = $matches[1];
        
        try {
            $decoded = JWT::decode($jwt, new Key($this->secretKey, 'HS256'));
            return $decoded;
        } catch (Exception $e) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid or expired token']);
            exit;
        }
    }
    
    private function handlePsr7($request, $handler) {
        $authHeader = $request->getHeaderLine('Authorization');
        
        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $response = new \Slim\Psr7\Response();
            $response->getBody()->write(json_encode([
                'success' => false, 
                'message' => 'Authorization header missing'
            ]));
            return $response->withStatus(401)
                           ->withHeader('Content-Type', 'application/json');
        }
        
        $jwt = $matches[1];
        
        try {
            $decoded = JWT::decode($jwt, new Key($this->secretKey, 'HS256'));
            // Add decoded token to request attributes for controllers to use
            $request = $request->withAttribute('token', $decoded);
            return $handler->handle($request);
        } catch (Exception $e) {
            $response = new \Slim\Psr7\Response();
            $response->getBody()->write(json_encode([
                'success' => false, 
                'message' => 'Invalid or expired token'
            ]));
            return $response->withStatus(401)
                           ->withHeader('Content-Type', 'application/json');
        }
    }
}