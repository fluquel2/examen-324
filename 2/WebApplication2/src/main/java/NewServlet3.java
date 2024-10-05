/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author Luque
 */
@WebServlet(urlPatterns = {"/NewServlet3"})
public class NewServlet3 extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
         response.setContentType("text/html;charset=UTF-8");
        String codigoCatastral = request.getParameter("codigoCatastral");
        String tipoImpuesto;

        if (codigoCatastral != null && !codigoCatastral.isEmpty()) {
            char primerCaracter = codigoCatastral.charAt(0);
            switch (primerCaracter) {
                case '1':
                    tipoImpuesto = "Alto";
                    break;
                case '2':
                    tipoImpuesto = "Medio";
                    break;
                case '3':
                    tipoImpuesto = "Bajo";
                    break;
                default:
                    tipoImpuesto = "No válido";
            }
        } else {
            tipoImpuesto = "Código catastral no proporcionado.";
        }

        try (PrintWriter out = response.getWriter()) {
 out.println("<!DOCTYPE html>");
            out.println("<html lang='es'>");
            out.println("<head>");
            out.println("<meta charset='UTF-8'>");
            out.println("<title>Resultado de Consulta</title>");
            out.println("<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>");
            out.println("<style>");
            out.println("body { background-color: #f8f9fa; }");
            out.println("h2 { color: #343a40; }");
            out.println("h3 { color: #6c757d; }");
            out.println("</style>");
            out.println("</head>");
            out.println("<body>");
            out.println("<div class='container mt-5'>");
            out.println("<div class='card'>");
            out.println("<div class='card-body'>");
            out.println("<h3 class='text-center'>Tipo de Impuesto: " + tipoImpuesto + "</h3>");
            out.println("<div class='text-center mt-4'>");
            out.println("<a href='http://localhost:8081/exam/2/inicio_usuario.php' class='btn btn-primary'>Volver</a>");
            out.println("</div>");
            out.println("</div>");
            out.println("</div>"); // Fin de card
            out.println("</div>"); // Fin de container
            out.println("</body>");
            out.println("</html>");
        }
    }
  

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
