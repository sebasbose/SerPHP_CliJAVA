<?php
// Servidor PHP simple
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Responder con un mensaje simple
    $response = array(
        'status' => 'success',
        'message' => 'Hola desde el servidor PHP!',
        'timestamp' => date('Y-m-d H:i:s')
    );
    echo json_encode($response);
    
} elseif ($method == 'POST') {
    // Leer datos enviados desde el cliente
    $input = json_decode(file_get_contents('php://input'), true);
    
    $response = array(
        'status' => 'success',
        'message' => 'Datos recibidos correctamente',
        'received_data' => $input,
        'timestamp' => date('Y-m-d H:i:s')
    );
    echo json_encode($response);
    
} else {
    // Método no soportado
    http_response_code(405);
    echo json_encode(array('status' => 'error', 'message' => 'Método no permitido'));
}
?>