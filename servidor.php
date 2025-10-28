<?php
// Servidor PHP simple con SOAP
header('Content-Type: text/xml');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Responder con un mensaje simple en SOAP
    $soap_response = 
    '<?xml version="1.0" encoding="UTF-8"?>
    <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
            <output>Hola desde el servidor PHP!</output>
        </soap:Body>
    </soap:Envelope>';
    echo $soap_response;
    
} elseif ($method == 'POST') {
    // Leer datos SOAP enviados desde el cliente
    $soap_input = file_get_contents('php://input');
    
    // Extraer datos simples del SOAP
    $input = '';
    
    if (preg_match('/<input>(.*?)<\/input>/', $soap_input, $matches)) {
        $input = $matches[1];
    }

    // Lógica para procesar los numeros recibidos
    $output = intval($input) * 5; // Ejemplo: multiplicar por 5
    
    $soap_response = 
    '<?xml version="1.0" encoding="UTF-8"?>
    <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
            <output>' . htmlspecialchars($output) . '</output>
        </soap:Body>
    </soap:Envelope>';
    echo $soap_response;
    
} else {
    // Método no soportado
    http_response_code(405);
    echo 
    '<?xml version="1.0" encoding="UTF-8"?>
    <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
            <output>Método no permitido</output>
        </soap:Body>
    </soap:Envelope>';
}
?>