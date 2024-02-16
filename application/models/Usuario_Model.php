<?php



class Usuario_model extends CI_Model

{

    function __construct() {

        parent::__construct();

    }

    

    function getLogin($datos) {

         

        $query=$this->db

        ->select("us.id, us.nombre, us.correo, us.clave, em.id as id_empresa, em.nombre as nombre_empresa, ver_doc_privado, casillero, interno, id_pais")

        ->from("usuarios as us")

        ->join("empresa as em","em.id = us.id_empresa","inner")

        ->where('us.correo' , $datos['correo'])

        ->where('us.clave'  , $datos['clave'])

        ->get();

        if ($query->num_rows()>0){

            return $query->row();

        }else{

            return false;

        }
      
    }


    public function get_Parent_Menu($datos)

        {

            $query = $this->db

                        ->select('me.id, me.title')

                        ->join('permisos as pe' , 'pe.id_usuario = us.id' , 'inner')

                        ->join('dyn_menu as me' , "me.id = pe.id_menu and me.is_parent = 1" , 'inner')

                        ->where('us.id', $datos)

                        ->order_by('me.position asc')

                        ->get('usuarios as us');

                        

            return $query->result();

            

           /*  var_dump($this->db->last_query()); die();

            die();



            var_dump($query->num_rows());

            die();

 */

           /*  if ($query->num_rows() > 1) {

            return $query->result();

            }else { return $query->row();} */

        }



    public function get_Hijos($datos, $id_parent)

        {

            $query = $this->db

                        ->select('pe.id, me.url , me.title')

                        ->join('permisos as pe' , 'pe.id_usuario = us.id' , 'inner')

                        ->join('dyn_menu as me' , "me.id = pe.id_menu and me.is_parent = 0 and me.parent_id = $id_parent" , 'inner')

                        ->where('us.id', $datos)

                        ->order_by('me.position', 'asc')

                        ->get('usuarios as us');

                        



            return $query->result();           

        }

    

    

}