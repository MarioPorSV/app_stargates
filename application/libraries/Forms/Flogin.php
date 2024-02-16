

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class Flogin

{

    

    protected $cls;

    protected $datos;

    protected $accion;

    

    function __construct()

    {

        $this->cls = 'form-control';

        $this->datos = array();

    }

    

    public function set_accion($valor)

    {

        $this->accion = $valor;

    }

      

    

    private function inicio1()

    {

        $this->datos['form'] = form_open(

            $this->accion,

            array(

                'id'    => 'Form_Login',

                'class' => 'form-horizontal'

            )

            );

    }

    

    private function inicio()

    {

        $this->datos['form'] = form_open(

            $this->accion,

            array(

                'id'    => 'Form_Login',

                'class' => 'signin-form '

            )

            );

    }



    private function fin()

    {

        $this->datos['submit'] = form_submit(

            '',

            'Ingresar',

            array(

                'class' => 'form-control btn btn-primary submit px-3 ' ,

                'style' => 'background:#F15a29 ' 

                )

            );

           

        $this->datos['cancelar'] = form_submit(

            '',

            'Cancelar',

            array('class' => 'btn btn-default form-control ' )

            );

                

            

        $this->datos['form_cierre'] = form_close();

    }

    

    private function user()

    {

        $id  = 'correo';

        $nom = 'correo';

        

        $this->datos['correo_label'] = form_label(

            'Correo',

            '',

            array(

                'class' => 'control-label'. " col-sm-2 label",

                'for' => $id

            )

            );

        

        $this->datos['correo'] = form_input(

            array(

                'id'       => $id,

                'name'     => $nom,

                'value'    => set_value_input(array(),'correo','correo'),

                'class'    => "{$this->cls}" . "col-sm-12 text form-control",

                'placeholder' => "Digitar Correo"

            ));

    }

         

    private function clave()

    {

        $id  = 'clave';

        $nom = 'clave';

        

        $this->datos['clave_label'] = form_label(

            'Clave',

            '',

            array(

                'class' => 'control-label' . " col-sm-12 label ",

                'for' => $id

                )

            );

        

        $this->datos['clave'] = form_input(

            array(

                'id'       => $id,

                'name'     => $nom,

                'type'     => 'password',

                'class'    => "{$this->cls}" . "col-sm-12 text form-control",

                'placeholder' => 'Digitar Clave.'

            ));

    }

    

    

    public function get_formulario()

    {

        $this->fin();

        $this->inicio();

        $this->user();

        $this->clave();

        

        return $this->datos;

    }

    

    

}



