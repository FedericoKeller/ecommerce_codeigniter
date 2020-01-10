<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Admin (AdminController)
 * Admin class to control to authenticate admin credentials and include admin functions.
 * @author : Samet Aydın / sametay153@gmail.com
 * @version : 1.0
 * @since : 27.02.2018
 */
class Admin extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
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
            // isAdmin / Admin role control function / This function used admin role control
            if($this->isAdmin() == TRUE)
            {
                $this->accesslogincontrol();
            }
        }
    }

     /**
     * This function is used to load the user list
     */
    function userListing()
    {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->user_model->userListingCount($searchText);

			$returns = $this->paginationCompress ( "userListing/", $count, 10 );

            $data['userRecords'] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"]);

            $process = 'Lista de usuarios';
            $processFunction = 'Admin/userListing';
            $this->logrecord($process,$processFunction);

            $this->global['pageTitle'] = 'Lista de usuarios';

            $this->loadViews("users", $this->global, $data, NULL);
    }



    function employeeListing(){
      $searchText = $this->security->xss_clean($this->input->post('searchText'));
      $data['searchText'] = $searchText;

      $this->load->library('pagination');

      $count = $this->user_model->userListingCount($searchText);

$returns = $this->paginationCompress ( "employeeListing/", $count, 10 );

      $data['employeeRecords'] = $this->user_model->employeeListing($searchText, $returns["page"], $returns["segment"]);

      $process = 'Lista de empleados';
      $processFunction = 'Admin/employeeListing';
      $this->logrecord($process,$processFunction);

      $this->global['pageTitle'] = 'Lista de empleados';

      $this->loadViews("empleados", $this->global, $data, NULL);
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
            $data['roles'] = $this->user_model->getUserRoles();

            $this->global['pageTitle'] = 'Añadir usuario';

            $this->loadViews("addNew", $this->global, $data, NULL);
    }


    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        $roleId = $this->input->post('role');

            $this->load->library('form_validation');

            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');

            if($roleId == 3){
              $this->form_validation->set_rules('civil','Estado Civil','trim|required|max_length[128]');
              $this->form_validation->set_rules('exp','Experiencia','trim|required|numeric');
              $this->form_validation->set_rules('dir','Dirección','trim|required|max_length[128]');
              $this->form_validation->set_rules('money','Salario','trim|required|numeric');
              $this->form_validation->set_rules('studies','Estudios','trim|required|max_length[128]');
              $this->form_validation->set_rules('hours','Horas','trim|required|numeric|min_length[2]');
            }


            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = $this->security->xss_clean($this->input->post('email'));
                $password = $this->input->post('password');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));

                $civil = $this->security->xss_clean($this->input->post('civil'));
                $experiencia = $this->security->xss_clean($this->input->post('exp'));
                $direccion = $this->security->xss_clean($this->input->post('dir'));
                $salario = $this->security->xss_clean($this->input->post('money'));
                $estudios = $this->security->xss_clean($this->input->post('studies'));
                $horas = $this->security->xss_clean($this->input->post('hours'));

                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId, 'name'=> $name,
                                    'mobile'=>$mobile, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));


                                    $empleadoInfo = array(
                                                          'estado_civil_emp' => $civil,
                                                          'experiencia_emp' => $experiencia,
                                                          'direccion_emp' => $direccion,
                                                          'salario_emp' => $salario,
                                                          'estudios_emp' => $estudios,
                                                          'horas_sem_emp' => $horas,
                                                          'user_emp_fk' => NULL
                                                        );


                                    $result = $this->user_model->addNewUser($userInfo,$empleadoInfo);






                if($result > 0)
                {
                    $process = 'Añadir usuario';
                    $processFunction = 'Admin/addNewUser';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Usuario creado exitosamente');
                }
                else
                {

                    $this->session->set_flashdata('error', 'La creación del usuario no fue posible');
                }

                redirect('userListing');


            }
        }

     /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
            if($userId == null)
            {
                redirect('userListing');
            }

            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);

            $this->global['pageTitle'] = 'Edición de usuarios';

            $this->loadViews("editOld", $this->global, $data, NULL);
    }


    /**
     * This function is used to edit the user informations
     */
    function editUser()
    {
            $this->load->library('form_validation');

            $userId = $this->input->post('userId');
              $roleId = $this->input->post('role');

            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');

            if($roleId == 3){
              $this->form_validation->set_rules('civil','Estado Civil','trim|required|max_length[128]');
              $this->form_validation->set_rules('exp','Experiencia','trim|required|numeric');
              $this->form_validation->set_rules('dir','Dirección','trim|required|max_length[128]');
              $this->form_validation->set_rules('money','Salario','trim|required|numeric');
              $this->form_validation->set_rules('studies','Estudios','trim|required|max_length[128]');
              $this->form_validation->set_rules('hours','Horas','trim|required|numeric|min_length[2]');


            }

            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = $this->security->xss_clean($this->input->post('email'));
                $password = $this->input->post('password');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));

                $civil = $this->security->xss_clean($this->input->post('civil'));
                $experiencia = $this->security->xss_clean($this->input->post('exp'));
                $direccion = $this->security->xss_clean($this->input->post('dir'));
                $salario = $this->security->xss_clean($this->input->post('money'));
                $estudios = $this->security->xss_clean($this->input->post('studies'));
                $horas = $this->security->xss_clean($this->input->post('hours'));

                $userInfo = array();

                if(empty($password))
                {
                    $userInfo = array('email'=>$email, 'roleId'=>$roleId, 'name'=>$name,
                                    'mobile'=>$mobile, 'status'=>0, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                else
                {
                    $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId,
                        'name'=>ucwords($name), 'mobile'=>$mobile,'status'=>0, 'updatedBy'=>$this->vendorId,
                        'updatedDtm'=>date('Y-m-d H:i:s'));
                }


                                                    $empleadoInfo = array(
                                                                          'estado_civil_emp' => $civil,
                                                                          'experiencia_emp' => $experiencia,
                                                                          'direccion_emp' => $direccion,
                                                                          'salario_emp' => $salario,
                                                                          'estudios_emp' => $estudios,
                                                                          'horas_sem_emp' => $horas,
                                                                          'user_emp_fk' => NULL
                                                                        );


                $result = $this->user_model->editUser($userInfo, $userId, $empleadoInfo);

                if($result == true)
                {
                    $process = 'Actualización de usuario';
                    $processFunction = 'Admin/editUser';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'Usuario actualizado correctamente');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Actualización de usuario fallida');
                }

                redirect('userListing');
            }
    }

     /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));

            $result = $this->user_model->deleteUser($userId, $userInfo);

            if ($result > 0) {
                 echo(json_encode(array('status'=>TRUE)));

                 $process = 'Eliminar usuario';
                 $processFunction = 'Admin/deleteUser';
                 $this->logrecord($process,$processFunction);

                }
            else { echo(json_encode(array('status'=>FALSE))); }
    }

     /**
     * This function used to show log history
     * @param number $userId : This is user id
     */
    function logHistory($userId = NULL)
    {
            $data['dbinfo'] = $this->user_model->gettablemb('tbl_log','local_electronica');
            if(isset($data['dbinfo']->total_size))
            {
                if(($data['dbinfo']->total_size)>1000){
                    $this->backupLogTable();
                }
            }
            $data['userRecords'] = $this->user_model->logHistory($userId);

            $process = 'Observando historial de actividades';
            $processFunction = 'Admin/logHistory';
            $this->logrecord($process,$processFunction);

            $this->global['pageTitle'] = 'Historial de inicio de sesión de usuario';

            $this->loadViews("logHistory", $this->global, $data, NULL);
    }

    /**
     * This function used to show specific user log history
     * @param number $userId : This is user id
     */
    function logHistorysingle($userId = NULL)
    {
            $userId = ($userId == NULL ? $this->session->userdata("userId") : $userId);
            $data["userInfo"] = $this->user_model->getUserInfoById($userId);
            $data['userRecords'] = $this->user_model->logHistory($userId);

            $process = 'Vista de registro único';
            $processFunction = 'Admin/logHistorysingle';
            $this->logrecord($process,$processFunction);

            $this->global['pageTitle'] = 'Historial de inicio de sesión de usuario';

            $this->loadViews("logHistorysingle", $this->global, $data, NULL);
    }

    /**
     * This function used to backup and delete log table
     */
    function backupLogTable()
    {
        $this->load->dbutil();
        $prefs = array(
            'tables'=>array('tbl_log')
        );
        $backup=$this->dbutil->backup($prefs) ;


        $this->user_model->clearlogtbl();

        if($backup)
        {
            $this->session->set_flashdata('success', 'La limpieza de la tabla ha sido exitosa');
            redirect('log-history');
        }
        else
        {
            $this->session->set_flashdata('error', 'No se ha podido limpiar la tabla');
            redirect('log-history');
        }
    }

}
