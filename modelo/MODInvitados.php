<?php
/****************************************************************************************
*@package pXP
*@file gen-MODInvitados.php
*@author  (admin)
*@date 21-05-2024 04:12:21
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                21-05-2024 04:12:21    admin             Creacion    
  #
*****************************************************************************************/

class MODInvitados extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarInvitados(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_invitados_sel';
        $this->transaccion='ATE_INV_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_invitados','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_solicitud','int4');
		$this->captura('revisar','bool');
		$this->captura('nombre','varchar');
		$this->captura('ap_paterno','varchar');
		$this->captura('ap_materno','varchar');
		$this->captura('fecha_nacimiento','date');
		$this->captura('tipo_documento','varchar');
		$this->captura('codigo_documento','varchar');
		$this->captura('informacion_adicional','text');
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
            
    function insertarInvitados(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_invitados_ime';
        $this->transaccion='ATE_INV_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_solicitud','id_solicitud','int4');
		$this->setParametro('revisar','revisar','bool');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('ap_paterno','ap_paterno','varchar');
		$this->setParametro('ap_materno','ap_materno','varchar');
		$this->setParametro('fecha_nacimiento','fecha_nacimiento','date');
		$this->setParametro('tipo_documento','tipo_documento','varchar');
		$this->setParametro('codigo_documento','codigo_documento','varchar');
		$this->setParametro('informacion_adicional','informacion_adicional','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarInvitados(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_invitados_ime';
        $this->transaccion='ATE_INV_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_invitados','id_invitados','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_solicitud','id_solicitud','int4');
		$this->setParametro('revisar','revisar','bool');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('ap_paterno','ap_paterno','varchar');
		$this->setParametro('ap_materno','ap_materno','varchar');
		$this->setParametro('fecha_nacimiento','fecha_nacimiento','date');
		$this->setParametro('tipo_documento','tipo_documento','varchar');
		$this->setParametro('codigo_documento','codigo_documento','varchar');
		$this->setParametro('informacion_adicional','informacion_adicional','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarInvitados(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_invitados_ime';
        $this->transaccion='ATE_INV_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_invitados','id_invitados','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>