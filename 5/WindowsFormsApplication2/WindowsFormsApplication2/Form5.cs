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
    public partial class Form5 : Form
    {
        public Form5()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            string zona = textBox6.Text;
            decimal superficie = Convert.ToDecimal(textBox4.Text);
            string distrito = textBox5.Text;
            string ci = textBox1.Text; // CI de la persona registrada
            decimal xini = Convert.ToDecimal(textBox8.Text);
            decimal yini = Convert.ToDecimal(textBox10.Text);
            decimal xfin = Convert.ToDecimal(textBox9.Text);
            decimal yfin = Convert.ToDecimal(textBox11.Text);
            Random rand = new Random();
            int primerDigito = rand.Next(1, 4); // Generar un número entre 1 y 3
            string codigoCatastral = primerDigito.ToString() + rand.Next(0, 10000).ToString("D4"); // Crear un código catastral de 5 dígitos

            using (SqlConnection con = new SqlConnection("server=(local);database=BDFernando;Integrated Security=True;"))
            {
                try
                {
                    con.Open();
                    
                    // Verificar si el CI existe en la tabla 'persona'
                    string verificarCIQuery = "SELECT COUNT(*) FROM persona WHERE ci = @ci";
                    using (SqlCommand cmdVerificar = new SqlCommand(verificarCIQuery, con))
                    {
                        cmdVerificar.Parameters.AddWithValue("@ci", ci);
                        int count = (int)cmdVerificar.ExecuteScalar();

                        if (count == 0)
                        {
                            MessageBox.Show("La persona con el CI especificado no está registrada.");
                            return;
                        }
                    }

                    // Consulta SQL para insertar la propiedad en la tabla 'Catastro'
                    string query = "INSERT INTO Catastro (codigoCatastral, zona, superficie, distrito, ci, xini, yini, xfin, yfin) " +
                                   "VALUES (@codigoCatastral, @zona, @superficie, @distrito, @ci, @xini, @yini, @xfin, @yfin)";

                    using (SqlCommand cmd = new SqlCommand(query, con))
                    {
                        // Añadir parámetros
                        cmd.Parameters.AddWithValue("@codigoCatastral", codigoCatastral);
                        cmd.Parameters.AddWithValue("@zona", zona);
                        cmd.Parameters.AddWithValue("@superficie", superficie);
                        cmd.Parameters.AddWithValue("@distrito", distrito);
                        cmd.Parameters.AddWithValue("@ci", ci); // Asociar el CI de la persona registrada
                        cmd.Parameters.AddWithValue("@xini", xini);
                        cmd.Parameters.AddWithValue("@yini", yini);
                        cmd.Parameters.AddWithValue("@xfin", xfin);
                        cmd.Parameters.AddWithValue("@yfin", yfin);

                        // Ejecutar la consulta
                        int rowsAffected = cmd.ExecuteNonQuery();

                        if (rowsAffected > 0)
                        {
                            MessageBox.Show("Propiedad registrada correctamente.");
                            Form3 form3 = new Form3();
                            form3.Show(); // Muestra Form3
                            this.Close(); // Cierra el formulario actual (Form3)
                        }
                        else
                        {
                            MessageBox.Show("No se pudo registrar la propiedad.");
                        }
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Error al registrar la propiedad: " + ex.Message);
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
        private void button2_Click(object sender, EventArgs e)
        {
            Form3 form3 = new Form3();
            form3.Show(); // Muestra Form3
            this.Close(); // Cierra el formulario actual (Form3)
        }
    }
        
    
}
