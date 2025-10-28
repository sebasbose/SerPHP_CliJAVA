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

1. Haciendo petición GET...
Código de respuesta: 200
Respuesta del servidor: {"status":"success","message":"Hola desde el servidor PHP!","timestamp":"2024-10-27 20:45:30"}

==================================================

2. Haciendo petición POST...
Código de respuesta: 200
Respuesta del servidor: {"status":"success","message":"Datos recibidos correctamente","received_data":{"nombre":"Juan","edad":25,"mensaje":"Hola desde Java!"},"timestamp":"2024-10-27 20:45:30"}
```