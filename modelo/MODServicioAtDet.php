<?php
/****************************************************************************************
*@package pXP
*@file gen-MODServicioAtDet.php
*@author  (admin)
*@date 16-05-2024 13:41:56
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                16-05-2024 13:41:56    admin             Creacion    
  #
*****************************************************************************************/

class MODServicioAtDet extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarServicioAtDet(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_servicio_at_det_sel';
        $this->transaccion='ATE_SDT_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_servicio_at_det','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_servicio_at','int4');
		$this->captura('nombre','varchar');
		$this->captura('descripcion','varchar');
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
            
    function insertarServicioAtDet(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_servicio_at_det_ime';
        $this->transaccion='ATE_SDT_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_servicio_at','id_servicio_at','int4');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('descripcion','descripcion','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarServicioAtDet(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_servicio_at_det_ime';
        $this->transaccion='ATE_SDT_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_servicio_at_det','id_servicio_at_det','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_servicio_at','id_servicio_at','int4');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('descripcion','descripcion','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarServicioAtDet(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_servicio_at_det_ime';
        $this->transaccion='ATE_SDT_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_servicio_at_det','id_servicio_at_det','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>