using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using System.Net.Http;

namespace ClientEsercizio
{
    /// <summary>
    /// Logica di interazione per MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        public MainWindow()
        {
            InitializeComponent();
        }

        private void btn_GET_Click(object sender, RoutedEventArgs e)
        {

            string url = "http://10.13.100.29/Lavoro/EsercizioTPI/index.php?op=1&name=" + txt_Libro.Text;
            GetRequest(url);

        }


        async static void GetRequest(string url)
        {
            using (HttpClient client = new HttpClient())
            {
                // Richiesta al server
                using (HttpResponseMessage response = await (client.GetAsync(url)))
                {
                    // Estrazione del contenuto
                    using (HttpContent content = response.Content)
                    {
                        string myContent = await (content.ReadAsStringAsync());

                        MessageBox.Show(myContent);
                    }
                }
            }
        }

        private void btn_Quantità_Click(object sender, RoutedEventArgs e)
        {
            // URL a cui inoltrare la richiesta
            string url = @"http://10.13.100.29/Lavoro/EsercizioTPI/" +
                         "?op=2";

            GetRequest(url);
        }

        private void btn_sconto_Click(object sender, RoutedEventArgs e)
        {
            string url = @"http://10.13.100.29/Lavoro/EsercizioTPI/" +
                         "?op=3";
            GetRequest(url);
        }

        private void btn_Date_Click(object sender, RoutedEventArgs e)
        {
           string url = @"http://10.13.100.29/Lavoro/EsercizioTPI/" +
                       "?op=4&data1="+txt_data1.Text+"&data2="+txt_Data2.Text;
            //string url = @"http://10.13.100.29/Lavoro/EsercizioTPI/" +
              //          "?op=4&data1=2001-01-01&data2=2020-01-01";
            GetRequest(url);
        }
    }
}
