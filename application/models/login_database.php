<?php

Class Login_Database extends CI_Model {
  // Insertar datos de registro en la base de datos
  public function registration_insert($data) {

  // Query para checkear si el usuario ya existe en la base de datos
  $condition = "user_name =" . "'" . $data['user_name'] . "'";
  $this->db->select('*');
  $this->db->from('usuario');
  $this->db->where($condition);
  $this->db->limit(1);
  $query = $this->db->get();


  if ($query->num_rows() == 0) {

  // Query para insertar en la base de datos
  $this->db->insert('usuario', $data);
  if ($this->db->affected_rows() > 0) {
  return true;
  }
  } else {
  return false;
  }
  }

//Lee datos usando el usuario
public function login($data) {
    $this->db->select('user_password,user_id');
    $this->db->from('usuario');
    $this->db->where('user_name', $data['username']);

    $query = $this->db->get();
            $record = $query->row_array();


        return password_verify($data['password'], $record['user_password']);


}


public function userlog($data){
    $this->db->select('user_id');
    $this->db->from('usuario');
    $this->db->where('user_name', $data['username']);

    $query = $this->db->get();
            $record = $query->row_array();

  $this->db->insert('userlog', array('userIp' => $this->input->ip_address(), 'loginTime'=> date('Y-m-d H:i:s'), 'user_id_fk' => $record['user_id']));

}

// Lee desde la base de datos para mostrarlos en la página de perfil
public function read_user_information($username) {

$condition = "user_name =" . "'" . $username . "'";
$this->db->select('*');
$this->db->from('usuario');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return $query->result();
} else {
return false;
}
}



public function addInfo($clienteInfo){
$this->db->select('*');
$this->db->from('cliente');
$this->db->where('user_id_fk', $this->session->userdata['logged_in']['id']);
$query = $this->db->get();

if ($query->num_rows() == 0) {
  $this->db->trans_start();
  $this->db->insert('cliente', $clienteInfo);
  $this->db->trans_complete();
}else{
  $this->db->where('user_id_fk', $this->session->userdata['logged_in']['id']);
  $this->db->update('cliente', $clienteInfo);
}

}
}

?>
