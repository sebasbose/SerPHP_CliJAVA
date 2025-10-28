<?php
// Servidor PHP simple con SOAP
header('Content-Type: text/xml');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

function stringToArray($str) {
    // Quita los corchetes y espacios
    $str = trim($str, "[] ");
    
    // Divide la cadena por comas
    $items = explode(",", $str);
    
    // Convierte cada elemento en número entero
    $numbers = array_map('intval', $items);
    
    return $numbers;
}

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
    $dividends = '';
    $divider = 1;

    if (preg_match('/<dividends>(.*?)<\/dividends>/', $soap_input, $matches)) {
        $dividends = $matches[1];
    }
    if (preg_match('/<divider>(.*?)<\/divider>/', $soap_input, $matches)) {
        $divider = intval($matches[1]);
    }

    // Lógica para procesar los numeros recibidos
    $dividends = stringToArray($dividends);
    $output = array_filter($dividends, function($num) use ($divider) {
        return $num % $divider == 0;
    });

    $soap_response = 
    '<?xml version="1.0" encoding="UTF-8"?>
    <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
            <output>' . htmlspecialchars(implode(", ", $output)) . '</output>
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