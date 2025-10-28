# Servidor PHP - Cliente Java

Comunicación simple entre un servidor PHP y un cliente Java.

## Archivos incluidos:
- `servidor.php`: Servidor PHP que responde a peticiones GET y POST
- `Cliente.java`: Cliente Java que envía peticiones al servidor

## Cómo ejecutar:

### 1. Iniciar el servidor PHP:
```bash
php -S localhost:8000
```

### 2. Compilar y ejecutar el cliente Java:
En otra terminal:
```bash
javac Cliente.java
java Cliente
```

## Qué hace:

**Servidor PHP:**
- Responde a peticiones GET con un mensaje de saludo
- Acepta peticiones POST con datos JSON y los devuelve
- Retorna respuestas en formato JSON

**Cliente Java:**
- Hace una petición GET al servidor
- Hace una petición POST enviando datos JSON
- Muestra las respuestas del servidor

## Ejemplo de salida:

El cliente mostrará algo como:
```
=== Cliente Java - Comunicación con Servidor PHP ===

Haciendo petición GET...
Código de respuesta: 200
Respuesta SOAP del servidor: 
<?xml version="1.0" encoding="UTF-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <output>Hola desde el servidor PHP!</output>
  </soap:Body>
</soap:Envelope>

==================================================

Haciendo petición POST...
Código de respuesta: 200
Respuesta SOAP del servidor: 
  <?xml version="1.0" encoding="UTF-8"?>    
  <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
      <output>5, 25, 35, 30</output>
    </soap:Body>
  </soap:Envelope>

Código de respuesta: 200
Respuesta SOAP del servidor: 
<?xml version="1.0" encoding="UTF-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <output>3, 15</output>
  </soap:Body>
</soap:Envelope>
```