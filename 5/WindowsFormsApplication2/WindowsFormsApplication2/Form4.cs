using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApplication2
{
    public partial class Form4 : Form
    {
        public Form4()
        {
            InitializeComponent();
        }


        private void button1_Click(object sender, EventArgs e)
        {
            Form1 form1 = new Form1();
            form1.Show(); // Muestra Form3
            this.Close(); // Cierra el formulario actual (Form3)
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }

        private void Form4_Load(object sender, EventArgs e)
        {
            ListarPropiedades();
            CargarInformacionUsuario();
        }
        private void CargarInformacionUsuario()
{
    // Obtener el idUsuario desde la sesión actual
    int idUsuario = Sesion.IdUsuario;

    // Cadena de conexión a la base de datos
    string connectionString = "server=(local);database=BDFernando;Integrated Security=True;";

    using (SqlConnection con = new SqlConnection(connectionString))
    {
        try
        {
            con.Open();
            // Consulta SQL para obtener la información del usuario logueado
            string query = @"
                SELECT p.nombre, p.paterno, p.ci
                FROM persona p
                JOIN usuario u ON p.idUsuario = u.idUsuario
                WHERE u.idUsuario = @idUsuario;
            ";

            using (SqlCommand cmd = new SqlCommand(query, con))
            {
                // Añadir parámetro a la consulta
                cmd.Parameters.AddWithValue("@idUsuario", idUsuario);

                // Ejecutar la consulta y leer los datos
                using (SqlDataReader reader = cmd.ExecuteReader())
                {
                    if (reader.Read())
                    {
                        // Obtener los datos de la persona
                        string nombre = reader["nombre"].ToString();
                        string paterno = reader["paterno"].ToString();
                        string ci = reader["ci"].ToString();

                        // Asignar los valores al Label1
                        label1.Text = string.Format("Nombre: {0} {1}, CI: {2}", nombre, paterno, ci);
                    }
                }
            }
        }
        catch (Exception ex)
        {
            MessageBox.Show("Error al cargar la información del usuario: " + ex.Message);
        }
    }
}

        private void ListarPropiedades()
        {
            // Obtener el idUsuario desde la sesión actual
            int idUsuario = Sesion.IdUsuario;

            // Cadena de conexión a la base de datos
            string connectionString = "server=(local);database=BDFernando;Integrated Security=True;";

            using (SqlConnection con = new SqlConnection(connectionString))
            {
                try
                {
                    con.Open();
                    // Consulta SQL para listar las propiedades del usuario
                    string query = @"
                SELECT c.codigoCatastral, c.zona, c.superficie, c.distrito
                FROM Catastro c
                JOIN persona p ON c.ci = p.ci
                JOIN usuario u ON p.idUsuario = u.idUsuario
                WHERE u.idUsuario = @idUsuario;
            ";

                    using (SqlCommand cmd = new SqlCommand(query, con))
                    {
                        // Añadir parámetro a la consulta
                        cmd.Parameters.AddWithValue("@idUsuario", idUsuario);

                        // Ejecutar la consulta y obtener los datos
                        SqlDataAdapter da = new SqlDataAdapter(cmd);
                        DataTable dt = new DataTable();
                        da.Fill(dt);

                        // Asignar los datos obtenidos al DataGridView para mostrar las propiedades
                        dataGridView1.DataSource = dt;
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Error al listar las propiedades: " + ex.Message);
                }
            }
        }


    }
}
