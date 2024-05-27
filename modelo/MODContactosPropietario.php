<?php
/****************************************************************************************
*@package pXP
*@file gen-MODContactosPropietario.php
*@author  (admin)
*@date 27-05-2024 01:45:45
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                27-05-2024 01:45:45    admin             Creacion    
  #
*****************************************************************************************/

class MODContactosPropietario extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarContactosPropietario(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_contactos_propietario_sel';
        $this->transaccion='ATE_CNP_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_contactos_propietario','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_propietario','int4');
		$this->captura('tipo','varchar');
		$this->captura('contacto','text');
		$this->captura('id_usuario_reg','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_ai','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_mod','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('usr_reg','varchar');
        $this->captura('usr_mod','varchar');
        
        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();
        
        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function insertarContactosPropietario(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_contactos_propietario_ime';
        $this->transaccion='ATE_CNP_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_propietario','id_propietario','int4');
		$this->setParametro('tipo','tipo','varchar');
		$this->setParametro('contacto','contacto','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarContactosPropietario(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_contactos_propietario_ime';
        $this->transaccion='ATE_CNP_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_contactos_propietario','id_contactos_propietario','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_propietario','id_propietario','int4');
		$this->setParametro('tipo','tipo','varchar');
		$this->setParametro('contacto','contacto','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarContactosPropietario(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_contactos_propietario_ime';
        $this->transaccion='ATE_CNP_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_contactos_propietario','id_contactos_propietario','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>