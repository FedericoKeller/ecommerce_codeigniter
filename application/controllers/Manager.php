<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Manager (ManagerController)
 * Manager class to control to authenticate manager credentials and include manager functions.
 * @author : Samet Aydın / sametay153@gmail.com
 * @version : 1.0
 * @since : 27.02.2018
 */
class Manager extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        // Datas -> libraries ->BaseController / This function used load user sessions
        $this->datas();
        // isLoggedIn / Login control function /  This function used login control
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            redirect('login');
        }
        else
        {
            // isManagerOrAdmin / Admin or manager role control function / This function used admin or manager role control
            if($this->isManagerOrAdmin() == TRUE)
            {
                $this->accesslogincontrol();
            }
        }
    }

     /**
     * This function used to show tasks
     */
    function tasks()
    {
            $data['taskRecords'] = $this->user_model->getTasks();

            $process = 'Viendo tareas pendientes';
            $processFunction = 'Manager/tasks';
            $this->logrecord($process,$processFunction);

            $this->global['pageTitle'] = 'Todas las tareas';

            $this->loadViews("tasks", $this->global, $data, NULL);
    }

function piezas()
{
  $data['piezaRecords'] = $this->user_model->getPiezas();

  $process = 'Ver piezas';
  $processFunction = 'Manager/piezas';
  $this->logrecord($process,$processFunction);

  $this->global['pageTitle'] = 'Todas las tareas';

  $this->loadViews("piezas", $this->global, $data, NULL);
}



    /**
     * This function is used to load the add new task
     */
    function addNewTask()
    {
            $data['tasks_prioritys'] = $this->user_model->getTasksPrioritys();

            $this->global['pageTitle'] = 'Añadir tarea';

            $this->loadViews("addNewTask", $this->global, $data, NULL);
    }

     /**
     * This function is used to add new task to the system
     */
    function addNewTasks()
    {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fname','Título de la tarea','required');
            $this->form_validation->set_rules('priority','Prioridad','required');

            if($this->form_validation->run() == FALSE)
            {
                $this->addNewTask();
            }
            else
            {
                $title = $this->input->post('fname');
                $comment = $this->input->post('comment');
                $priorityId = $this->input->post('priority');
                $statusId = 1;
                $permalink = sef($title);

                $taskInfo = array('title'=>$title, 'comment'=>$comment, 'priorityId'=>$priorityId, 'statusId'=> $statusId,
                                    'permalink'=>$permalink, 'createdBy'=>$this->vendorId, 'createdDate'=>date('Y-m-d H:i:s'));

                $result = $this->user_model->addNewTasks($taskInfo);

                if($result > 0)
                {
                    $process = 'Agregando nuevas tareas';
                    $processFunction = 'Manager/addNewTasks';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Tarea creada exitosamente');
                }
                else
                {
                    $this->session->set_flashdata('error', 'La creación de la tarea no fue posible');
                }

                redirect('addNewTask');
            }
        }

    /**
     * This function is used to open edit tasks view
     */
    function editOldTask($taskId = NULL)
    {
            if($taskId == null)
            {
                redirect('tasks');
            }

            $data['taskInfo'] = $this->user_model->getTaskInfo($taskId);
            $data['tasks_prioritys'] = $this->user_model->getTasksPrioritys();
            $data['tasks_situations'] = $this->user_model->getTasksSituations();

            $this->global['pageTitle'] = 'Editar tarea';

            $this->loadViews("editOldTask", $this->global, $data, NULL);
    }

    /**
     * This function is used to edit tasks
     */
    function editTask()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname','Título de la tarea','required');
        $this->form_validation->set_rules('priority','Prioridad','required');

        $taskId = $this->input->post('taskId');

        if($this->form_validation->run() == FALSE)
        {
            $this->editOldTask($taskId);
        }
        else
        {
            $taskId = $this->input->post('taskId');
            $title = $this->input->post('fname');
            $comment = $this->input->post('comment');
            $priorityId = $this->input->post('priority');
            $statusId = $this->input->post('status');
            $permalink = sef($title);

            $taskInfo = array('title'=>$title, 'comment'=>$comment, 'priorityId'=>$priorityId, 'statusId'=> $statusId,
                                'permalink'=>$permalink);

            $result = $this->user_model->editTask($taskInfo,$taskId);

            if($result > 0)
            {
                $process = 'Edición de tareas';
                $processFunction = 'Manager/editTask';
                $this->logrecord($process,$processFunction);
                $this->session->set_flashdata('success', 'La edición de la tarea fue exitosa');
            }
            else
            {
                $this->session->set_flashdata('error', 'Falló la edición de la tarea');
            }
            redirect('tasks');

            }
    }

    /**
     * This function is used to delete tasks
     */
    function deleteTask($taskId = NULL)
    {
        if($taskId == null)
            {
                redirect('tasks');
            }

            $result = $this->user_model->deleteTask($taskId);

            if ($result == TRUE) {
                 $process = 'Eliminación de tareas';
                 $processFunction = 'Manager/deleteTask';
                 $this->logrecord($process,$processFunction);

                 $this->session->set_flashdata('success', 'Tarea eliminada exitosamente');
                }
            else
            {
                $this->session->set_flashdata('error', 'La eliminación de la tarea no fue posible');
            }
            redirect('tasks');
    }


        function addNewPieza()
    {
          $data['categoria'] = $this->user_model->getPiezaCategoria();

            $this->global['pageTitle'] = 'Añadir pieza';

            $this->loadViews("addNewPieza", $this->global, $data, NULL);
    }


      function addNewPiezas()
    {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name','Nombre de la pieza','required');
            $this->form_validation->set_rules('price','Precio de la pieza','required');
            $this->form_validation->set_rules('amount','Cantidad de piezas','required');
            $this->form_validation->set_rules('type','Tipo de pieza','required');
            $this->form_validation->set_rules('discount','Descuento','required');
            $this->form_validation->set_rules('image','Imagen de pieza','required');

            if($this->form_validation->run() == FALSE)
            {
                $this->addNewPieza();
            }
            else
            {
                $name = $this->input->post('name');
                $price = $this->input->post('price');
                $description = $this->input->post('comment');
                $amount = $this->input->post('amount');
                $discount = $this->input->post('discount');
                $image = $this->input->post('image');
                $type = $this->input->post('type');



                $PiezaInfo = array('nombre_pie'=>$name, 'precio_pie'=>$price, 'descripcion_pie'=>$description, 'cantidad_pie'=>$amount,
                    'descuento_pie'=>$discount, 'imagen_pie'=>$image, 'id_cat_fk'=> $type, 'creacion_pie'=>date('Y-m-d H:i:s'));

                $result = $this->user_model->addNewPiezas($PiezaInfo);

                if($result > 0)
                {
                    $process = 'Crear pieza';
                    $processFunction = 'Manager/addNewPieza';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Pieza agregada exitosamente');
                }
                else
                {
                    $this->session->set_flashdata('error', 'La inserción de la pieza no fue posible');
                }

                redirect('addNewPieza');
            }
        }

        function editOldPieza($piezaId = NULL)
        {
                if($piezaId == null)
                {
                    redirect('piezas');
                }

                $data['piezaInfo'] = $this->user_model->getPiezaInfo($piezaId);
                $data['categoria'] = $this->user_model->getPiezaCategoria();

                $this->global['pageTitle'] = 'Editar pieza';

                $this->loadViews("editOldPieza", $this->global, $data, NULL);
        }


        function editPieza()
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name','Nombre de la pieza','required');
            $this->form_validation->set_rules('price','Precio de la pieza','required');
            $this->form_validation->set_rules('amount','Cantidad de piezas','required');
            $this->form_validation->set_rules('discount','Descuento','required');
            $this->form_validation->set_rules('image','Imagen de pieza','required');
            $this->form_validation->set_rules('type','Tipo de pieza','required');

            $piezaId = $this->input->post('piezaId');

            if($this->form_validation->run() == FALSE)
            {
                $this->editOldPieza($piezaId);
            }
            else
            {
                $piezaId = $this->input->post('piezaId');
                $name = $this->input->post('name');
                $price = $this->input->post('price');
                $description = $this->input->post('comment');
                $amount = $this->input->post('amount');
                $discount = $this->input->post('discount');
                $image = $this->input->post('image');
                $type = $this->input->post('type');


                $PiezaInfo = array('nombre_pie'=>$name, 'precio_pie'=>$price, 'descripcion_pie'=>$description, 'cantidad_pie'=>$amount,
                 'id_cat_fk'=> $type, 'descuento_pie'=>$discount, 'imagen_pie'=>$image, 'creacion_pie'=>date('Y-m-d H:i:s'));

                $result = $this->user_model->editPieza($PiezaInfo,$piezaId);

                if($result > 0)
                {
                    $process = 'Edición de piezas';
                    $processFunction = 'Manager/editPieza';
                    $this->logrecord($process,$processFunction);
                    $this->session->set_flashdata('success', 'La edición de la pieza fue exitosa');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Falló la edición de la pieza');
                }
                redirect('piezas');

                }
        }


        function deletePieza($piezaId = NULL)
        {
            if($piezaId == null)
                {
                    redirect('piezas');
                }

                $result = $this->user_model->deletePieza($piezaId);

                if ($result == TRUE) {
                     $process = 'Eliminación de piezas';
                     $processFunction = 'Manager/deletePieza';
                     $this->logrecord($process,$processFunction);

                     $this->session->set_flashdata('success', 'Tarea eliminada exitosamente');
                    }
                else
                {
                    $this->session->set_flashdata('error', 'La eliminación de la tarea no fue posible');
                }
                redirect('piezas');
        }


        function salesListing(){
          $searchText = $this->security->xss_clean($this->input->post('searchText'));
          $data['searchText'] = $searchText;

          $this->load->library('pagination');

          $count = $this->user_model->userListingCount($searchText);

    $returns = $this->paginationCompress ( "salesListing/", $count, 10 );

          $data['salesRecords'] = $this->user_model->ventasListing($searchText, $returns["page"], $returns["segment"]);

          $process = 'Lista de ventas';
          $processFunction = 'Manager/ventasListing';
          $this->logrecord($process,$processFunction);

          $this->global['pageTitle'] = 'Lista de ventas';

          $this->loadViews("ventas", $this->global, $data, NULL);
        }


}
