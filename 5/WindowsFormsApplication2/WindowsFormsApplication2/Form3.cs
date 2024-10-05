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

    public partial class Form3 : Form
    {
        DataSet ds = new DataSet();
        public void datos()
        {
            SqlConnection con = new SqlConnection();
            //con.ConnectionString = "server=(local);user=moises;pwd=123456;database=academica";
            con.ConnectionString = "server=(local);database=BDFernando;Integrated Security=True;";
            SqlDataAdapter ada = new SqlDataAdapter();
            ada.SelectCommand = new SqlCommand();
            ada.SelectCommand.Connection = con;
            ada.SelectCommand.CommandText = "SELECT   c.codigoCatastral, c.zona, c.superficie, c.distrito, p.ci,  p.nombre, p.paterno, p.materno FROM persona p, catastro c where p.ci = c.ci";
            ada.SelectCommand.CommandType = CommandType.Text;
            ada.Fill(ds, "persona");
            dataGridView1.DataSource = ds;
            dataGridView1.DataMember = "persona";

        }
        public Form3()
        {
            InitializeComponent();
            dataGridView1.ReadOnly = false;
            dataGridView1.CellEndEdit += dataGridView1_CellEndEdit;
        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }

        private void button3_Click(object sender, EventArgs e)
        {

            string codigoCatastral = textBox1.Text; // Obtener el código catastral del TextBox
            string ci = textBox2.Text; // Obtener el CI del TextBox

            using (SqlConnection con = new SqlConnection("server=(local);database=BDFernando;Integrated Security=True;"))
            {
                con.Open();
                SqlTransaction transaction = con.BeginTransaction();

                try
                {
                    // 1. Obtener el idUsuario asociado a la persona
                    int idUsuario = 0;
                    using (SqlCommand cmd = new SqlCommand("SELECT idUsuario FROM persona WHERE ci = @ci", con, transaction))
                    {
                        cmd.Parameters.AddWithValue("@ci", ci);
                        object result = cmd.ExecuteScalar();
                        if (result != null)
                        {
                            idUsuario = (int)result;
                        }
                    }

                    // 2. Eliminar el Catastro
                    using (SqlCommand cmd = new SqlCommand("DELETE FROM Catastro WHERE codigoCatastral = @codigoCatastral", con, transaction))
                    {
                        cmd.Parameters.AddWithValue("@codigoCatastral", codigoCatastral);
                        cmd.ExecuteNonQuery();
                    }

                    // 3. Comprobar si la persona tiene más catastros
                    int countCatastros = 0;
                    using (SqlCommand cmd = new SqlCommand("SELECT COUNT(*) FROM Catastro WHERE ci = @ci", con, transaction))
                    {
                        cmd.Parameters.AddWithValue("@ci", ci);
                        countCatastros = (int)cmd.ExecuteScalar();
                    }

                    // 4. Si no tiene más catastros, eliminar la persona y su usuario
                    if (countCatastros == 0)
                    {
                        // Eliminar la persona
                        using (SqlCommand cmd = new SqlCommand("DELETE FROM persona WHERE ci = @ci", con, transaction))
                        {
                            cmd.Parameters.AddWithValue("@ci", ci);
                            cmd.ExecuteNonQuery();
                        }

                        // Eliminar el usuario
                        using (SqlCommand cmd = new SqlCommand("DELETE FROM usuario WHERE idUsuario = @idUsuario", con, transaction))
                        {
                            cmd.Parameters.AddWithValue("@idUsuario", idUsuario);
                            cmd.ExecuteNonQuery();
                        }
                    }

                    // Confirmar la transacción
                    transaction.Commit();
                    MessageBox.Show("Registro eliminado exitosamente.");
                    Form3 form3 = new Form3();
                    form3.Show();
                    this.Close(); // Cierra el formulario actual (Form3)
                }
                catch (Exception ex)
                {
                    // Revertir la transacción en caso de error
                    transaction.Rollback();
                    MessageBox.Show("Error al eliminar: " + ex.Message);
                }
            }
        }

        private void Form3_Load(object sender, EventArgs e)
        {
            datos();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Form2 form2 = new Form2();

            // Mostrar Form3
            form2.Show();

            // Opcional: Cerrar el formulario actual (Form1)
            this.Hide(); 
        }

        private void button4_Click(object sender, EventArgs e)
        {
            Form1 form1 = new Form1();
            form1.Show(); // Muestra Form3
            this.Close(); // Cierra el formulario actual (Form3)

        }

        private void button2_Click(object sender, EventArgs e)
        {
            Form5 form5 = new Form5();
            form5.Show(); // Muestra Form3
            this.Hide(); 
        }

        private void dataGridView1_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex >= 0) // Asegurarse de que se ha clicado en una fila válida
            {
                // Obtener el código catastral y CI de la fila seleccionada
                string codigoCatastral = dataGridView1.Rows[e.RowIndex].Cells["codigoCatastral"].Value.ToString();
                string ci = dataGridView1.Rows[e.RowIndex].Cells["ci"].Value.ToString();

                // Mostrar en los TextBox
                textBox1.Text = codigoCatastral; // Asegúrate de que tienes un TextBox llamado textBox1
                textBox2.Text = ci; // Asegúrate de que tienes un TextBox llamado textBox2
            }
        }

        private void dataGridView1_CellEndEdit(object sender, DataGridViewCellEventArgs e)
        {
            int rowIndex = e.RowIndex;
            int colIndex = e.ColumnIndex;

            // Asegurarse de que se ha clicado en una fila válida
            if (rowIndex >= 0)
            {
                // Obtener el código catastral y el CI de la fila seleccionada
                string codigoCatastral = dataGridView1.Rows[rowIndex].Cells["codigoCatastral"].Value.ToString();
                string ci = dataGridView1.Rows[rowIndex].Cells["ci"].Value.ToString();

                // Obtener el nuevo valor de la celda editada
                string newValue = dataGridView1.Rows[rowIndex].Cells[colIndex].Value.ToString();

                using (SqlConnection con = new SqlConnection("server=(local);database=BDFernando;Integrated Security=True;"))
                {
                    con.Open();
                    SqlTransaction transaction = con.BeginTransaction();
                    try
                    {
                        // Determinar qué campo se está editando
                        string columnName = dataGridView1.Columns[colIndex].Name;

                        // Crear el comando de actualización
                        using (SqlCommand cmd = new SqlCommand())
                        {
                            cmd.Connection = con;
                            cmd.Transaction = transaction;

                            if (columnName == "zona" || columnName == "superficie" || columnName == "distrito")
                            {
                                // Actualizar Catastro
                                cmd.CommandText = "UPDATE Catastro SET " + columnName + " = @newValue WHERE codigoCatastral = @codigoCatastral";
                                cmd.Parameters.AddWithValue("@newValue", newValue);
                                cmd.Parameters.AddWithValue("@codigoCatastral", codigoCatastral);
                            }
                            else if (columnName == "nombre" || columnName == "paterno" || columnName == "materno")
                            {
                                // Actualizar Persona
                                cmd.CommandText = "UPDATE persona SET " + columnName + " = @newValue WHERE ci = @ci";
                                cmd.Parameters.AddWithValue("@newValue", newValue);
                                cmd.Parameters.AddWithValue("@ci", ci);
                            }

                            // Ejecutar el comando
                            cmd.ExecuteNonQuery();
                        }

                        // Confirmar la transacción
                        transaction.Commit();
                    }
                    catch (Exception ex)
                    {
                        // Revertir la transacción en caso de error
                        transaction.Rollback();
                        MessageBox.Show("Error al actualizar: " + ex.Message);
                    }
                }
            }
        }

        private void dataGridView1_CellValueChanged(object sender, DataGridViewCellEventArgs e)
        {
       
        }

        private void dataGridView1_CurrentCellDirtyStateChanged(object sender, EventArgs e)
        {

        }
    }
}
