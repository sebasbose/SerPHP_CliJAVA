<?php
// Servidor PHP simple con SOAP
header('Content-Type: text/xml');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Responder con un mensaje simple en SOAP
    $soap_response = '<?xml version="1.0" encoding="UTF-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <output>
            <status>success</status>
            <message>Hola desde el servidor PHP!</message>
        </output>
    </soap:Body>
</soap:Envelope>';
    echo $soap_response;
    
} elseif ($method == 'POST') {
    // Leer datos SOAP enviados desde el cliente
    $soap_input = file_get_contents('php://input');
    
    // Extraer datos simples del SOAP
    $nombre = '';
    $edad = '';
    $mensaje = '';
    
    if (preg_match('/<mensaje>(.*?)<\/mensaje>/', $soap_input, $matches)) {
        $mensaje = $matches[1];
    }
    
    $soap_response = '<?xml version="1.0" encoding="UTF-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <output>
            <status>success</status>
            <message>' . htmlspecialchars($mensaje) . '</message>
        </output>
    </soap:Body>
</soap:Envelope>';
    echo $soap_response;
    
} else {
    // Método no soportado
    http_response_code(405);
    echo '<?xml version="1.0" encoding="UTF-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <output>
            <status>error</status>
            <message>Método no permitido</message>
        </output>
    </soap:Body>
</soap:Envelope>';
}
?>