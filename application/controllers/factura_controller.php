<?php



Class Factura_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();



        $this->load->helper('url');

        // Cargar libraría form helper
        $this->load->helper('form');

        // Cargar libraría form validation
        $this->load->library('form_validation');

        $this->load->helper('security');

        // Cargar libraría session
        $this->load->library('session');

        // Cargar base de datos

        $this->load->model('factura_model');


    }

    public function index()
    {
        $data['clienteInfo'] = $this->factura_model->getUserInfo();
        $data['country']     = getCountries();
        $this->load->view('facturacion', $data);
    }



    public function addNewFacturacion()
    {

        $this->form_validation->set_rules('pago', 'Pago', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('pais', 'País', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|max_length[64]|xss_clean');
        $this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|max_length[64]|xss_clean');
        $this->form_validation->set_rules('dni', 'DNI', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('tel', 'Télefono', 'required|min_length[10]|xss_clean');
        $this->form_validation->set_rules('ciudad', 'Ciudad', 'trim|required|max_length[128]|xss_clean');
        $this->form_validation->set_rules('region', 'Estado/Territorio/Región', 'trim|required|max_length[128]|xss_clean');
        $this->form_validation->set_rules('direccion', 'Dirección', 'trim|required|max_length[128]|xss_clean');
        $this->form_validation->set_rules('postal', 'Código Postal', 'trim|numeric|min_length[4]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            redirect('facturacion');
        }


        $facturaInfo = array(
            'pago_cli' => $this->input->post('pago'),
            'pais_cli' => $this->input->post('pais'),
            'nombre_cli' => $this->input->post('nombre'),
            'apellido_cli' => $this->input->post('apellido'),
            'dni_cli' => $this->input->post('dni'),
            'telefono_cli' => $this->input->post('tel'),
            'ciudad_cli' => $this->input->post('ciudad'),
            'region_cli' => $this->input->post('region'),
            'direccion_cli' => $this->input->post('direccion'),
            'postal_cli' => $this->input->post('postal'),
            'user_id_fk' => $this->session->userdata['logged_in']['id']

        );



        $this->factura_model->addFactura($facturaInfo);


        redirect('tarjeta');



    }


    public function tarjeta()
    {
        $this->load->view('tarjeta');
    }

    public function pagar()
    {
        $_POST['tnum'] = str_replace(' ', '', $_POST['tnum']);

        $this->form_validation->set_rules('tnum', 'Número de tarjeta', 'trim|required|numeric|xss_clean');
        $this->form_validation->set_rules('exp_date', 'Número de tarjeta', 'trim|required|xss_clean|min_length[5]|max_length[5]');
        $this->form_validation->set_rules('sec_code', 'Código de seguridad', 'trim|required|numeric|xss_clean|min_length[3]|max_length[3]');

        if ($this->form_validation->run() == FALSE) {
            redirect('tarjeta');
        }

        $pagoInfo = array(
            'card_num_p' => $this->input->post('tnum'),
            'card_name_p' => $this->input->post('card_name'),
            'card_expiring_date_p' => $this->input->post('exp_date'),
            'user_id_fk' => $this->session->userdata['logged_in']['id']
        );


        $fecha = explode("/", $pagoInfo['card_expiring_date_p']);

        $validacion = card_expiry_valid($fecha[0], $fecha[1]);

        if ($validacion == FALSE) {
            $this->session->set_flashdata('error', 'Fecha incorrecta de expiración.');
            redirect('tarjeta');
        }


        $correct_cardnum = card_number_valid($pagoInfo['card_num_p']);

        if ($correct_cardnum == FALSE) {
            $this->session->set_flashdata('error', 'Número de tarjeta incorrecto.');
            redirect('tarjeta');
        }


        if (strcmp($pagoInfo['card_name_p'], 'unknown') == 0) {
            $this->session->set_flashdata('error', 'Tarjeta desconocida.');
            redirect('tarjeta');
        }


        $result = $this->factura_model->addPago($pagoInfo);


        if ($result > 0) {
            $this->session->set_flashdata('success', 'Añadida exitosamente');
            $stock = $this->session->userdata['logged_in']['stock'];
            $this->factura_model->insertTotal();
            $this->factura_model->CompletePago($stock);
        } else {

            $this->session->set_flashdata('error', 'No fue posible');
        }

        redirect('userPage');



    }


}

?>
