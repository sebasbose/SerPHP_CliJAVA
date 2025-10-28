import java.io.*;
import java.net.HttpURLConnection;
import java.net.URL;

public class Cliente {
    private static final String SERVER_URL = "http://localhost:8000/servidor.php";
    
    public static void main(String[] args) {
        Cliente cliente = new Cliente();
        
        System.out.println("=== Cliente Java - Comunicación SOAP con Servidor PHP ===\n");
        
        // // Hacer petición GET
        // System.out.println("Haciendo petición GET...");
        // cliente.hacerPeticionGET();
        
        // System.out.println("\n" + "=".repeat(50) + "\n");
        
        // Hacer petición POST
        System.out.println("Haciendo petición POST...");
        cliente.hacerPeticionPOST("[1, 5, 23, 25, 35, 78, 30, 96]", 5);
        cliente.hacerPeticionPOST("[3, 20, 15]", 3);
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
            
            System.out.println("Respuesta SOAP del servidor: " + respuesta.toString());
            
        } catch (Exception e) {
            System.out.println("Error en petición GET: " + e.getMessage());
        }
    }
    
    public void hacerPeticionPOST(String dividends, int divider) {
        try {
            URL url = new URL(SERVER_URL);
            HttpURLConnection conexion = (HttpURLConnection) url.openConnection();
            conexion.setRequestMethod("POST");
            conexion.setRequestProperty("Content-Type", "text/xml");
            conexion.setDoOutput(true);
            
            // Datos SOAP a enviar
            String soapData = 
            "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" +
            "<soap:Envelope xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">" +
                "<soap:Body>" +
                    "<dividends>" + dividends + "</dividends>" +
                    "<divider>" + divider + "</divider>" +
                "</soap:Body>" +
            "</soap:Envelope>";
            
            // Enviar datos
            OutputStream os = conexion.getOutputStream();
            os.write(soapData.getBytes());
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
            
            System.out.println("Respuesta SOAP del servidor: " + respuesta.toString());
            
        } catch (Exception e) {
            System.out.println("Error en petición POST: " + e.getMessage());
        }
    }
}