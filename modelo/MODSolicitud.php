<?php
/****************************************************************************************
*@package pXP
*@file gen-MODSolicitud.php
*@author  (admin)
*@date 15-05-2024 22:06:23
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                15-05-2024 22:06:23    admin             Creacion    
  #
*****************************************************************************************/

class MODSolicitud extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarSolicitud(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_solicitud_sel';
        $this->transaccion='ATE_SOA_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_solicitud','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_propietario','int4');
		$this->captura('fecha','date');
		$this->captura('estado','varchar');
		$this->captura('nro_tramite','varchar');
		$this->captura('id_proceso_wf','int4');
		$this->captura('id_estado_wf','int4');
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
            
    function insertarSolicitud(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_solicitud_ime';
        $this->transaccion='ATE_SOA_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_propietario','id_propietario','int4');
		$this->setParametro('fecha','fecha','date');
		$this->setParametro('estado','estado','varchar');
		$this->setParametro('nro_tramite','nro_tramite','varchar');
		$this->setParametro('id_proceso_wf','id_proceso_wf','int4');
		$this->setParametro('id_estado_wf','id_estado_wf','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarSolicitud(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_solicitud_ime';
        $this->transaccion='ATE_SOA_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_solicitud','id_solicitud','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_propietario','id_propietario','int4');
		$this->setParametro('fecha','fecha','date');
		$this->setParametro('estado','estado','varchar');
		$this->setParametro('nro_tramite','nro_tramite','varchar');
		$this->setParametro('id_proceso_wf','id_proceso_wf','int4');
		$this->setParametro('id_estado_wf','id_estado_wf','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarSolicitud(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_solicitud_ime';
        $this->transaccion='ATE_SOA_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_solicitud','id_solicitud','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>