  <?php
class Product extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('piezas_model');
        $this->get_stock();
    }

    function index()
    {
        $data['piezas'] = $this->piezas_model->get_all_product();
        $this->load->view('product_view', $data);
    }

    function get_electronica()
    {
        $data['piezas'] = $this->piezas_model->get_electronica_product();
        $this->load->view('electronica', $data);
    }

    function get_electrica()
    {
        $data['piezas'] = $this->piezas_model->get_electrica_product();
        $this->load->view('electrica', $data);
    }

    function get_mecanica()
    {
        $data['piezas'] = $this->piezas_model->get_mecanica_product();
        $this->load->view('mecanica', $data);
    }

    function get_stock()
    {
        if (isset($this->session->userdata['logged_in'])) {
            $data["stock"] = $this->piezas_model->get_stock();

            if ($data['stock'] != NULL) {

                $stock = json_decode(json_encode($data["stock"]), True);

                $session_data = $this->session->userdata('logged_in');
                $session_data['stock'] = $stock;
                $this->session->set_userdata("logged_in", $session_data);
                $this->piezas_model->gotten_stock();
            }
        }
    }

    function add_to_cart()
    {

        if (!isset($this->session->userdata['logged_in'])) {
            redirect('loginUser');
        }


        $data = array(
            'id' => $this->input->post('product_id'),
            'name' => $this->input->post('product_name'),
            'price' => $this->input->post('product_price'),
            'qty' => $this->input->post('quantity')
        );
        $id_p = $data['id'] - 1;

        if ($this->session->userdata['logged_in']['stock'][$id_p]["cantidad_pie"] > 0) {

            $session_data  = $this->session->userdata('logged_in');
            $stock     = $this->session->userdata['logged_in']['stock'][$id_p]["cantidad_pie"];
            $stock_down    = $stock - 1;
            $session_data['stock'][$id_p]["cantidad_pie"] = $stock_down;
            $this->session->set_userdata("logged_in", $session_data);



            $result = $this->piezas_model->insert_product($data);
        } else {
            $result = FALSE;
        }



        if ($result == TRUE) {

            $this->session->set_flashdata('success', 'Elemento del carrito añadido exitosamente');
        } else {
            $this->session->set_flashdata('error', 'No fue posible añadir el elemento al carrito');
        }
        redirect('cart', 'refresh');
    }


    function load_cart()
    {

        if (!isset($this->session->userdata['logged_in'])) {
            redirect('loginUser');
        }

        $data['carrito'] = $this->piezas_model->get_cart_product();

        $this->load->view("show_cart", $data);
    }

    function delete_cart($piezaId = NULL)
    {
        if ($piezaId == null) {
            redirect('show_cart');
        }
        $id_p      = $piezaId - 1;
        $session_data  = $this->session->userdata('logged_in');
        $stock     = $this->session->userdata['logged_in']['stock'][$id_p]["cantidad_pie"];
        $stock_up  = (int) $this->piezas_model->getIdStock($piezaId);
        $session_data['stock'][$id_p]["cantidad_pie"] = $stock_up;
        $this->session->set_userdata("logged_in", $session_data);

        $result = $this->piezas_model->delete_cart($piezaId);
        if ($result == TRUE) {




            $this->session->set_flashdata('success', 'Elemento eliminado del carrito exitosamente');

        } else {
            $this->session->set_flashdata('error', 'La eliminación del elemento del carrito no fue posible');
        }
        redirect('show_cart');

    }


    function delete_element_cart($piezaId = NULL)
    {
        if (!isset($this->session->userdata['logged_in'])) {
            redirect('loginUser');
        }
        if ($piezaId == null) {
            redirect('show_cart');
        }

        $id_p      = $piezaId - 1;
        $session_data  = $this->session->userdata('logged_in');
        $stock     = $this->session->userdata['logged_in']['stock'][$id_p]["cantidad_pie"];
        $stock_up  = $stock + 1;
        $session_data['stock'][$id_p]["cantidad_pie"] = $stock_up;
        $this->session->set_userdata("logged_in", $session_data);

        $result = $this->piezas_model->delete_element_cart($piezaId);
        if ($result == TRUE) {

            $this->session->set_flashdata('success', 'Elemento eliminado del carrito exitosamente');
        } else {
            $this->session->set_flashdata('error', 'La eliminación del elemento del carrito no fue posible');
        }
        redirect('show_cart');
    }
}
