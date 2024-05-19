<?php
/****************************************************************************************
*@package pXP
*@file gen-MODServicioAt.php
*@author  (admin)
*@date 16-05-2024 13:12:18
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                16-05-2024 13:12:18    admin             Creacion    
  #
*****************************************************************************************/

class MODServicioAt extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarServicioAt(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_servicio_at_sel';
        $this->transaccion='ATE_SER_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_servicio_at','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('codigo','varchar');
		$this->captura('nombre','varchar');
		$this->captura('tipo','varchar');
		$this->captura('contacto','varchar');
		$this->captura('nit','varchar');
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
            
    function insertarServicioAt(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_servicio_at_ime';
        $this->transaccion='ATE_SER_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('tipo','tipo','varchar');
		$this->setParametro('contacto','contacto','varchar');
		$this->setParametro('nit','nit','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarServicioAt(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_servicio_at_ime';
        $this->transaccion='ATE_SER_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_servicio_at','id_servicio_at','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('tipo','tipo','varchar');
		$this->setParametro('contacto','contacto','varchar');
		$this->setParametro('nit','nit','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarServicioAt(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_servicio_at_ime';
        $this->transaccion='ATE_SER_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_servicio_at','id_servicio_at','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>