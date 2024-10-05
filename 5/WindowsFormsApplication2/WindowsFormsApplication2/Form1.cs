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
    public partial class Form1 : Form
    {

        
        public Form1()
        {
            InitializeComponent();
 
            
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
        }

        private void button2_Click(object sender, EventArgs e)
        {
            string usuario = textBox1.Text;
            string contrasenia = textBox2.Text;

            using (SqlConnection con = new SqlConnection("server=(local);database=BDFernando;Integrated Security=True;"))
            {
                try
                {
                    con.Open();
                    // Consulta para validar el usuario y obtener su idUsuario y rol
                    string query = "SELECT idUsuario, rol FROM usuario WHERE usuario = @usuario AND contrasenia = @contrasenia";
                    using (SqlCommand cmd = new SqlCommand(query, con))
                    {
                        cmd.Parameters.AddWithValue("@usuario", usuario);
                        cmd.Parameters.AddWithValue("@contrasenia", contrasenia);

                        using (SqlDataReader reader = cmd.ExecuteReader())
                        {
                            if (reader.Read())
                            {
                                int idUsuario = reader.GetInt32(0); // Obtener el idUsuario
                                string rol = reader.GetString(1); // Obtener el rol

                                // Guardar los valores en la sesión
                                Sesion.NombreUsuario = usuario;
                                Sesion.IdUsuario = idUsuario;

                                // Validar el rol y redirigir según corresponda
                                if (rol.Equals("usuario", StringComparison.OrdinalIgnoreCase))
                                {
                                    Form4 f4 = new Form4();
                                    f4.Show();
                                    this.Hide();
                                }
                                else if (rol.Equals("funcionario", StringComparison.OrdinalIgnoreCase) || rol.Equals("admin", StringComparison.OrdinalIgnoreCase))
                                {
                                    Form3 f3 = new Form3();
                                    f3.Show();
                                    this.Hide();
                                }
                            }
                            else
                            {
                                MessageBox.Show("Usuario o contraseña incorrectos.");
                            }
                        }
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Error al conectar a la base de datos: " + ex.Message);
                }
            }
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }
    }
}
