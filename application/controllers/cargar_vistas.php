<?php


Class Cargar_Vistas extends CI_Controller {

public function __construct() {
	parent::__construct();
$this->load->helper('url');
$this->load->model('piezas_model');
        $this->load->model('factura_model');
}

//Ir a home
public function home(){
	$data['data']=$this->piezas_model->get_all_product();
	$this->load->view('home',$data);
}


//Ir al perfil
public function mypage()
{
		$data['clienteInfo'] = $this->factura_model->getUserInfo();
		$this->load->view('user_page', $data);
}



}

?>
