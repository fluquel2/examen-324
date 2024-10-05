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
    public partial class Form2 : Form
    {
        public Form2()
        {
            InitializeComponent();
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void label2_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            // Obtener los datos de los campos de entrada del formulario
            string ci = textBox1.Text; // Asegúrate de tener un TextBox llamado txtCi
            string nombre = textBox2.Text; // TextBox para el nombre
            string paterno = textBox3.Text; // TextBox para el apellido paterno
            string materno = textBox7.Text; // TextBox para el apellido materno
            string zona = textBox6.Text; // TextBox para la zona
            decimal superficie = decimal.Parse(textBox4.Text); // TextBox para la superficie
            string distrito = textBox5.Text; // TextBox para el distrito
            decimal xini = decimal.Parse(textBox8.Text); // TextBox para coordenada inicial X
            decimal yini = decimal.Parse(textBox10.Text); // TextBox para coordenada inicial Y
            decimal xfin = decimal.Parse(textBox9.Text); // TextBox para coordenada final X
            decimal yfin = decimal.Parse(textBox11.Text); // TextBox para coordenada final Y

            // Generar el código catastral
            Random rand = new Random();
            int primerDigito = rand.Next(1, 4); // Generar un número entre 1 y 3
            string codigoCatastral = primerDigito.ToString() + rand.Next(0, 10000).ToString("D4"); // Crear un código catastral de 5 dígitos

            // Conectar a la base de datos
            using (SqlConnection con = new SqlConnection("server=(local);database=BDFernando;Integrated Security=True;"))
            {
                try
                {
                    con.Open();

                    // Insertar en la tabla usuario
                    string insertUsuarioQuery = "INSERT INTO usuario (usuario, contrasenia, rol) OUTPUT INSERTED.idUsuario VALUES (@usuario, @contrasenia, 'usuario')";
                    int idUsuario;

                    using (SqlCommand cmd = new SqlCommand(insertUsuarioQuery, con))
                    {
                        cmd.Parameters.AddWithValue("@usuario", nombre);
                        cmd.Parameters.AddWithValue("@contrasenia", ci);
                        // Ejecutar el comando y obtener el idUsuario generado
                        idUsuario = (int)cmd.ExecuteScalar();
                    }

                    // Insertar en la tabla persona
                    string insertPersonaQuery = "INSERT INTO persona (ci, nombre, paterno, materno, idUsuario) VALUES (@ci, @nombre, @paterno, @materno, @idUsuario)";
                    using (SqlCommand cmd = new SqlCommand(insertPersonaQuery, con))
                    {
                        cmd.Parameters.AddWithValue("@ci", ci);
                        cmd.Parameters.AddWithValue("@nombre", nombre);
                        cmd.Parameters.AddWithValue("@paterno", paterno);
                        cmd.Parameters.AddWithValue("@materno", materno);
                        cmd.Parameters.AddWithValue("@idUsuario", idUsuario);
                        cmd.ExecuteNonQuery();
                    }

                    // Insertar en la tabla Catastro
                    string insertCatastroQuery = "INSERT INTO Catastro (codigoCatastral, zona, superficie, distrito, ci, xini, yini, xfin, yfin) VALUES (@codigoCatastral, @zona, @superficie, @distrito, @ci, @xini, @yini, @xfin, @yfin)";
                    using (SqlCommand cmd = new SqlCommand(insertCatastroQuery, con))
                    {
                        cmd.Parameters.AddWithValue("@codigoCatastral", codigoCatastral);
                        cmd.Parameters.AddWithValue("@zona", zona);
                        cmd.Parameters.AddWithValue("@superficie", superficie);
                        cmd.Parameters.AddWithValue("@distrito", distrito);
                        cmd.Parameters.AddWithValue("@ci", ci);
                        cmd.Parameters.AddWithValue("@xini", xini);
                        cmd.Parameters.AddWithValue("@yini", yini);
                        cmd.Parameters.AddWithValue("@xfin", xfin);
                        cmd.Parameters.AddWithValue("@yfin", yfin);
                        cmd.ExecuteNonQuery();
                    }

                    MessageBox.Show("Registro insertado exitosamente.");
                    // Redirigir a Form3
                    Form3 form3 = new Form3();
                    form3.Show(); // Muestra Form3
                    this.Hide(); // Opcional: Oculta el formulario actual
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Error al insertar en la base de datos: " + ex.Message);
                }
            }
        }
        private string GenerarCodigoCatastral(SqlConnection con)
        {
            string codigoCatastral;
            int count;
            Random rand = new Random();

            do
            {
                // Generar el primer dígito entre 1 y 3
                int primerDigito = rand.Next(1, 4);

                // Generar los 4 dígitos restantes
                string codigoAleatorio = "";
                for (int i = 0; i < 4; i++)
                {
                    codigoAleatorio += rand.Next(0, 10).ToString();
                }

                codigoCatastral = primerDigito + codigoAleatorio;

                // Verificar si el código ya existe
                string query = "SELECT COUNT(*) FROM Catastro WHERE codigoCatastral = @codigoCatastral";
                using (SqlCommand cmd = new SqlCommand(query, con))
                {
                    cmd.Parameters.AddWithValue("@codigoCatastral", codigoCatastral);

                    // Si la conexión está cerrada, abrirla
                    if (con.State == ConnectionState.Closed)
                    {
                        con.Open();
                    }

                    count = (int)cmd.ExecuteScalar();  // Obtener el resultado de la consulta
                }

            } while (count > 0);

            return codigoCatastral;
        }

        private void label9_Click(object sender, EventArgs e)
        {

        }

        private void label11_Click(object sender, EventArgs e)
        {

        }

        private void Form2_Load(object sender, EventArgs e)
        {

        }

        private void button2_Click(object sender, EventArgs e)
        {
            Form3 form3 = new Form3();
            form3.Show(); // Muestra Form3
            this.Hide(); // Opcional: Oculta el formulario actual
        }
    }
}
