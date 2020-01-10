<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Factura_model extends CI_Model
{


function getUserInfo(){
  $this->db->select('*');
  $this->db->from('cliente');
  $this->db->where('user_id_fk',$this->session->userdata['logged_in']['id']);

  $query = $this->db->get();

  $result = $query->result();
  return $result;
}


function addFactura($facturaInfo){
  $this->db->select('*');
  $this->db->from('cliente');
  $this->db->where('user_id_fk', $this->session->userdata['logged_in']['id']);
  $query = $this->db->get();

  if ($query->num_rows() == 0) {
        $this->db->trans_start();
        $this->db->insert('cliente', $facturaInfo);
        $this->db->trans_complete();
        }else{
          $this->db->where('user_id_fk', $this->session->userdata['logged_in']['id']);
          $this->db->update('cliente', $facturaInfo);
        }


}


function addPago($pagoInfo){
          $this->db->trans_start();
        $this->db->insert('pagos', $pagoInfo);
    $insert_id = $this->db->insert_id();
        $this->db->trans_complete();

        return $insert_id;
}

function insertTotal(){
  $this->db->trans_start();
  $this->db->insert('total_cart', array('total' => $this->session->userdata['logged_in']['total'], 'user_id_fk' => $this->session->userdata['logged_in']['id']));
  $this->db->trans_complete();
}

function CompletePago($stock){
  $count = 0;
  foreach($stock as $row) {
    $this->db->where('id_pie', $count+1);
  $this->db->set('cantidad_pie', $this->session->userdata['logged_in']['stock'][$count]["cantidad_pie"]);
  $this->db->update('piezas_electronicas');
  $count++;
  }
$this->cleanCart();
}


function cleanCart(){
    $this->db->where('user_id_fk',$this->session->userdata['logged_in']['id']);
    $this->db->delete('cart_items');
}




}
