import java.io.*;
import java.net.HttpURLConnection;
import java.net.URL;

public class Cliente {
    private static final String SERVER_URL = "http://localhost:8000/servidor.php";
    
    public static void main(String[] args) {
        Cliente cliente = new Cliente();
        
        System.out.println("=== Cliente Java - Comunicación con Servidor PHP ===\n");
        
        // Hacer petición GET
        System.out.println("1. Haciendo petición GET...");
        cliente.hacerPeticionGET();
        
        System.out.println("\n" + "=".repeat(50) + "\n");
        
        // Hacer petición POST
        System.out.println("2. Haciendo petición POST...");
        cliente.hacerPeticionPOST();
    }
    
    public void hacerPeticionGET() {
        try {
            URL url = new URL(SERVER_URL);
            HttpURLConnection conexion = (HttpURLConnection) url.openConnection();
            conexion.setRequestMethod("GET");
            
            int responseCode = conexion.getResponseCode();
            System.out.println("Código de respuesta: " + responseCode);
            
            BufferedReader reader = new BufferedReader(new InputStreamReader(conexion.getInputStream()));
            String linea;
            StringBuilder respuesta = new StringBuilder();
            
            while ((linea = reader.readLine()) != null) {
                respuesta.append(linea);
            }
            reader.close();
            
            System.out.println("Respuesta del servidor: " + respuesta.toString());
            
        } catch (Exception e) {
            System.out.println("Error en petición GET: " + e.getMessage());
        }
    }
    
    public void hacerPeticionPOST() {
        try {
            URL url = new URL(SERVER_URL);
            HttpURLConnection conexion = (HttpURLConnection) url.openConnection();
            conexion.setRequestMethod("POST");
            conexion.setRequestProperty("Content-Type", "application/json");
            conexion.setDoOutput(true);
            
            // Datos a enviar
            String jsonData = "{\"nombre\":\"Juan\",\"edad\":25,\"mensaje\":\"Hola desde Java!\"}";
            
            // Enviar datos
            OutputStream os = conexion.getOutputStream();
            os.write(jsonData.getBytes());
            os.flush();
            os.close();
            
            int responseCode = conexion.getResponseCode();
            System.out.println("Código de respuesta: " + responseCode);
            
            BufferedReader reader = new BufferedReader(new InputStreamReader(conexion.getInputStream()));
            String linea;
            StringBuilder respuesta = new StringBuilder();
            
            while ((linea = reader.readLine()) != null) {
                respuesta.append(linea);
            }
            reader.close();
            
            System.out.println("Respuesta del servidor: " + respuesta.toString());
            
        } catch (Exception e) {
            System.out.println("Error en petición POST: " + e.getMessage());
        }
    }
}