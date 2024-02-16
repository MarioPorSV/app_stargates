<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_Model');
        
    }

    
    public function index()
    {
        $this->load->library('Forms/Flogin');

        $form_login = new Flogin();

        $form_login->set_accion("index.php/login/validar_Login");

        $this->load->view('login', $form_login->get_formulario());
    }

    public function validar_Login()
    {
        if ($this->input->post()) {
            if ($this->form_validation->run('login')) {
                $datosparm = array(

                    'correo' => $this->input->post('correo', true),

                    'clave' => $this->input->post('clave', true),

                );

                $data = $this->Usuario_Model->getLogin($datosparm);

                if ($data) {

                    $datos = array(
                        "user_id" => $data->id,

                        "nombre"  => $data->nombre,

                        "login"   => true
                    );
                 

                    $_SESSION["user_id"]        = $data->id;

                    $_SESSION["nombre"]         = $data->nombre;

                    $_SESSION["login"]          = true;

                    $_SESSION["id_empresa"]     = $data->id_empresa;

                    $_SESSION["nombre_empresa"] = $data->nombre_empresa;

                    $_SESSION["ver_privado"]    = $data->ver_doc_privado;

                    $_SESSION["casillero"]      = $data->casillero;

                    $_SESSION["interno"]        = $data->interno;
					
				    $_SESSION["pais"]           = $data->id_pais;
					
	
                    if ($data->interno==0){
                                    $dato_Menu = $this->Usuario_Model->get_Parent_Menu(2);
                                    $this->dato['menu'] = $this->crear_Menu($dato_Menu,2);
                    }else{
                         $dato_Menu = $this->Usuario_Model->get_Parent_Menu($data->id);
                         $this->dato['menu'] = $this->crear_Menu($dato_Menu,$data->id);
                    }

            
                    $_SESSION["menu"] = $this->dato;

                    $this->load->view('principal', $this->dato);
                } else {
                    echo "error datos incorrectos";

                    redirect("login");
                }
            } else {
                echo "error datos incorrectos";

                redirect("login");
            }
        } else {
            redirect("login");
        }
    }

    

    public function crear_Menu($datos, $id_Usuario)
    {
        $menu_Dinamico = "";

        $menu_Devolver = "";

        $entro_Header = "N";

        $id_Parent = 0;


        for ($x = 0; $x < count($datos); $x++) {
            foreach ($datos[$x]  as $item => $field) {

               

                if ($item == 'id') {
                    $id_Parent = $field;
                }

                if ($item =='title') {
                    $menu_Dinamico = "<li class='nav-item has-treeview menu-close'>";

                    $menu_Dinamico = $menu_Dinamico . "<a href='#' class='nav-link active'>";

                    $menu_Dinamico = $menu_Dinamico . "<i class='nav-icon fa fa-dashboard'></i>";

                    $menu_Dinamico = $menu_Dinamico . "<p>$field";

                    $menu_Dinamico = $menu_Dinamico . "<i class='right fa fa-angle-left'></i><i class='fa fa-printer'></i>";

                    $menu_Dinamico = $menu_Dinamico . "</p>";

                    $menu_Dinamico = $menu_Dinamico . "</a>";

                    $entro_Header = "S";


                    //Buscar sus hijos

                    $dato_Menu_Hijo = $this->Usuario_Model->get_Hijos($id_Usuario, $id_Parent);



                    //die();

                    if ($dato_Menu_Hijo) {
                        for ($y = 0; $y < count($dato_Menu_Hijo); $y++) {
                            $url_Destino = "";

                            if ($y ==0) {
                                $menu_Dinamico = $menu_Dinamico . "<ul class='nav nav-treeview'>";
                            }

                            foreach ($dato_Menu_Hijo[$y]  as $item => $field) {
                                if ($item == 'url') {
                                    $url_Destino = $field;
                                }

                                if ($item == 'title') {

                                       // echo base_url()."index/$url_Destino";

                                    $menu_Dinamico = $menu_Dinamico . "<li class='nav-item '>";

                                    $menu_Dinamico = $menu_Dinamico . "<a href='javascript:;' class='nav-link active' onclick='$url_Destino()'>";

                                    $menu_Dinamico = $menu_Dinamico . "<i class='fa fa-circle-o nav-icon'></i>";

                                    $menu_Dinamico = $menu_Dinamico . "<p>$field</p>";

                                    $menu_Dinamico = $menu_Dinamico . "</a>";

                                    $menu_Dinamico = $menu_Dinamico . "</li>";
                                }
                            }
                        }
                    }
                }
            }

            // fin foreach

            if ($entro_Header == "S") {
                $menu_Dinamico = $menu_Dinamico . "</ul>"; /*cierre de opciones hijo */

                $menu_Dinamico = $menu_Dinamico ."</li>";

                $menu_Devolver = $menu_Devolver . $menu_Dinamico;

                $menu_Dinamico = "";

                $entro_Header = "N";
            }
        } // fin fon

        return $menu_Devolver;
    }

    public function cerrar()
    {
        session_unset();
    }
    
    public function principal()
    {
        $this->load->view('principal');
    }

    public function credencial($correo="")
    {   
        $datos['guias2'] = $this->Login_Model->consultar_usu($correo);
        $data= array();
        foreach ($datos['guias2'] as $fila) {
            $clv =$fila->clave;
            $id = $fila->id;
            $email = $fila->correo;
        }
            if($clv!=""){
                $data = array(
                    'valido' =>'<script type="text/javascript">window.location="http://localhost/app_starship/";</script>',
                );
               /* $data = array(
                    'valido' =>'ok',
                );*/
            }else{
                 $data = array(
                    'data2' =>$id,
                    'data3' =>$email,
                );
            }

        $this->load->view('ps_login/log_in', $data);
    }


}