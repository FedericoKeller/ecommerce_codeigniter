<?php



Class User_Authentication extends CI_Controller
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
        $this->load->model('login_database');
        $this->load->model('piezas_model');
        $this->load->model('factura_model');

    }
    // Mostrar página de login
    public function index()
    {
        if (isset($this->session->userdata['logged_in'])) {
            redirect('home');
        }
        $this->load->view('login_user');
    }

    //  Mostrar página de registro
    public function user_registration_show()
    {
        $this->load->view('registration');
    }



    //Verifica si la contraseña cumple con ciertos requisitos
    public function is_password_strong($password)
    {
        $this->form_validation->set_message('is_password_strong', 'The %s is weak. Use at least 1 number and 1 character.');
        if (preg_match('#[0-9]#', $password) && preg_match('#[a-zA-Z]#', $password)) {
            return TRUE;
        }
        return FALSE;
    }
    // Validar y almacenar en la base de datos
    public function new_user_registration()
    {

        // Check validation for user input in SignUp form
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_is_password_strong');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('registration');
        } else {

            $data   = array(
                'user_email' => $this->input->post('email'),
                'user_name' => $this->input->post('username'),
                'user_password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );
            $result = $this->login_database->registration_insert($data);

            if ($result == TRUE) {
                $data['message_display'] = 'Registration Successfully !';
                $this->load->view('login_user', $data);
            } else {
                $data['message_display'] = 'Username already exist!';
                $this->load->view('registration', $data);
            }
        }
    }

    // Supervisar proceso de login
    public function user_login_process()
    {

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (isset($this->session->userdata['logged_in'])) {
                $data['clienteInfo'] = $this->factura_model->getUserInfo();
                $this->load->view('user_page', $data);
            } else {
                $this->load->view('login_user');
            }
        } else {
            $data   = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );
            $result = $this->login_database->login($data);
            if ($result == TRUE) {

                $username = $this->input->post('username');
                $result   = $this->login_database->read_user_information($username);
                if ($result != false) {
                    $session_data = array(
                        'id' => $result[0]->user_id,
                        'username' => $result[0]->user_name,
                        'email' => $result[0]->user_email


                    );
                    $this->login_database->userlog($data);
                    // Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);



                    redirect('userPage');
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('login_user', $data);
            }
        }
    }

    // Cerrar la sesión
    public function logout()
    {

        // Removing session data
        $sess_array = array(
            'username' => ''
        );
        $this->piezas_model->delete_cart_definetely();
        $this->piezas_model->no_got_stock();
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('login_user', $data);
    }



    public function addUserInfo()
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('apellido', 'Apellido', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dni', 'DNI', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tel', 'Télefono', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $data['clienteInfo'] = $this->factura_model->getUserInfo();
            $this->load->view('user_page', $data);
        }

        $clienteInfo = array(
            'nombre_cli' => $this->input->post('nombre'),
            'apellido_cli' => $this->input->post('apellido'),
            'dni_cli' => $this->input->post('dni'),
            'telefono_cli' => $this->input->post('tel'),
            'user_id_fk' => $this->session->userdata['logged_in']['id']
        );

        $this->login_database->addInfo($clienteInfo);

        $data['clienteInfo'] = $this->factura_model->getUserInfo();
        $this->load->view('user_page', $data);
    }





}

?>
