<?php
Class Piezas_Model extends CI_Model {



 function get_all_product(){
       $this->db->select('*');
      $this->db->from('piezas_electronicas');
      $this->db->join('piezas_categoria as cat','cat.id_cat = piezas_electronicas.id_cat_fk','left');
      $this->db->where('estaBorrado', 0);
      $result = $this->db->get();

      return $result;
    }


    function get_electronica_product(){
      $this->db->select('*');
      $this->db->from('piezas_electronicas');
      $this->db->join('piezas_categoria as cat','cat.id_cat = piezas_electronicas.id_cat_fk','left');
      $this->db->where('estaBorrado', 0);
 	  $this->db->where('cat.nombre_cat', 'Electrónica');
      $result = $this->db->get();

      return $result;
    }

     function get_electrica_product(){
      $this->db->select('*');
      $this->db->from('piezas_electronicas');
      $this->db->join('piezas_categoria as cat','cat.id_cat = piezas_electronicas.id_cat_fk','left');
      $this->db->where('estaBorrado', 0);
 	  $this->db->where('cat.nombre_cat', 'Eléctrica');
      $result = $this->db->get();

      return $result;
    }

         function get_mecanica_product(){
      $this->db->select('*');
      $this->db->from('piezas_electronicas');
      $this->db->join('piezas_categoria as cat','cat.id_cat = piezas_electronicas.id_cat_fk','left');
      $this->db->where('estaBorrado', 0);
 	  $this->db->where('cat.nombre_cat', 'Mecánica');
      $result = $this->db->get();

      return $result;
    }

    function insert_product($data){

  $this->db->insert('cart_items', array('nombre_cart' => $data['name'], 'precio_cart'=> $data['price'], 'cantidad_cart' => $data['qty'],
  'id_pie_fk' => $data['id'], 'user_id_fk' => $this->session->userdata['logged_in']['id']));


return TRUE;



    }


function get_stock(){
$this->db->select('cantidad_pie');
$this->db->from('piezas_electronicas');
$this->db->where('fueObtenido', 0);

      $result = $this->db->get();

return $result->result();

}

function gotten_stock(){
         $this->db->set('fueObtenido', 1);
        $this->db->where('fueObtenido', 0);
        $this->db->update('piezas_electronicas');
}

function no_got_stock(){
  $this->db->set('fueObtenido', 0);
 $this->db->where('fueObtenido', 1);
 $this->db->update('piezas_electronicas');
}

function getIdStock($piezaId){
  $this->db->select('cantidad_pie');
  $this->db->from('piezas_electronicas');
  $this->db->where('id_pie', $piezaId);

  $result = $this->db->get();

  if ($result->num_rows() > 0) {
          return $result->row()->cantidad_pie;
      }

}

    function get_cart_product(){
        $this->db->select('t1.nombre_cart, t1.precio_cart, t1.id_pie_fk, t1.user_id_fk, count(cantidad_cart) as cantidad, SUM(precio_cart) as subtotal, pie.imagen_pie, pie.cantidad_pie');
     $this->db->from('cart_items as t1');
     $this->db->join('piezas_electronicas as pie','pie.id_pie = t1.id_pie_fk','left');
    $this->db->where('user_id_fk', $this->session->userdata['logged_in']['id']);
          $this->db->group_by('nombre_cart, precio_cart, id_pie_fk, user_id_fk');

    $result = $this->db->get();
    return $result;
    }


    function delete_cart($piezaId)
    {
        $this->db->where('id_pie_fk', $piezaId);
        $this->db->delete('cart_items');

        return TRUE;
    }

function delete_cart_definetely(){
  $this->db->where('user_id_fk', $this->session->userdata['logged_in']['id']);
  $this->db->delete('cart_items');

}

    function delete_element_cart($piezaId)
    {
      $this->db->where('id_pie_fk', $piezaId);
      $this->db->order_by('id_cart', 'desc');
          $this->db->limit(1);
        $this->db->delete('cart_items');

                return TRUE;
    }


}


?>
