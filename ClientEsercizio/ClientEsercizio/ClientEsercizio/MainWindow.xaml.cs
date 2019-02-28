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


    public partial class MainWindow : Window
    {

        public MainWindow()
        {
            InitializeComponent();
        }

        //static string quantità = "0";


        async static Task GetRequest(string url)
        {
            using (HttpClient client = new HttpClient())
            {
                using (HttpResponseMessage response = await client.GetAsync(url))
                {
                    using (HttpContent content = response.Content)
                    {
                        //int start = 0;
                        string mycontent = await content.ReadAsStringAsync();
                        //start = mycontent.IndexOf("quantity", start);
                        MessageBox.Show(mycontent);

                        //if (mycontent.Substring(start).Contains("quantity"))
                        //quantità = mycontent.Substring(start + 17, mycontent.Length - start -18);


                    }

                }

            }
        }

        private async void btn_fumetti_Click(object sender, RoutedEventArgs e)
        {
            string url = @"http://10.13.100.29/Lavoro/EsercizioTPI/" + "?op=2";
            Task task = GetRequest(url);
            await task;

            //lbl_libri.Content = quantità;
        }

        private async void btn_sconto_Click(object sender, RoutedEventArgs e)
        {
            string url = @"http://10.13.100.29/Lavoro/EsercizioTPI/" + "?op=3";
            Task task = GetRequest(url);
            await task;

            //lbl_libri.Content = quantità;
        }

        private async void btn_data_Click(object sender, RoutedEventArgs e)
        {
            try
            {
                bool ok = true;

                int month1 = int.Parse(txt_month1.Text);
                int year1 = int.Parse(txt_year1.Text);
                int day1 = int.Parse(txt_day1.Text);

                int month2 = int.Parse(txt_month2.Text);
                int year2 = int.Parse(txt_year2.Text);
                int day2 = int.Parse(txt_day2.Text);

                if (year1 > year2)
                {
                    ok = false;
                    MessageBox.Show("Il primo anno inserito è maggiore rispetto al secondo");
                }
                else
                {
                    if (month1 > month2)
                    {
                        ok = false;
                        MessageBox.Show("Il primo mese inserito è maggiore rispetto al secondo");
                    }
                }

                if (ok == true)
                {
                    string st1 = year1 + "-" + month1 + "-" + day1;
                    string st2 = year2 + "-" + month2 + "-" + day2;
                    string url = @"http://10.13.100.29/Lavoro/EsercizioTPI/" + "?op=4&data1=" + st1 + "&data2=" + st2;
                    Task task = GetRequest(url);
                    await task;
                }
            }
            catch (SystemException ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        private async void btn_carrello_Click(object sender, RoutedEventArgs e)
        {
            string url = @"http://10.13.100.29/Lavoro/EsercizioTPI/" + "?op=5&id=" + Txt_codice_carrello.Text;
            Task task = GetRequest(url);
            await task;
        }
    }
}