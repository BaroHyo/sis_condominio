<?php
/****************************************************************************************
*@package pXP
*@file gen-MODSolicitudDetalle.php
*@author  (admin)
*@date 15-05-2024 22:30:44
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                15-05-2024 22:30:44    admin             Creacion    
  #
*****************************************************************************************/

class MODSolicitudDetalle extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarSolicitudDetalle(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_solicitud_detalle_sel';
        $this->transaccion='ATE_DTS_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_solicitud_detalle','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_solicitud','int4');
		$this->captura('id_areas_comunes','int4');
		$this->captura('hr_desde','time');
		$this->captura('hr_hasta','time');
		$this->captura('importer','numeric');
		$this->captura('justificativo','text');
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
            
    function insertarSolicitudDetalle(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_solicitud_detalle_ime';
        $this->transaccion='ATE_DTS_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_solicitud','id_solicitud','int4');
		$this->setParametro('id_areas_comunes','id_areas_comunes','int4');
		$this->setParametro('hr_desde','hr_desde','time');
		$this->setParametro('hr_hasta','hr_hasta','time');
		$this->setParametro('importer','importer','numeric');
		$this->setParametro('justificativo','justificativo','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarSolicitudDetalle(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_solicitud_detalle_ime';
        $this->transaccion='ATE_DTS_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_solicitud_detalle','id_solicitud_detalle','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_solicitud','id_solicitud','int4');
		$this->setParametro('id_areas_comunes','id_areas_comunes','int4');
		$this->setParametro('hr_desde','hr_desde','time');
		$this->setParametro('hr_hasta','hr_hasta','time');
		$this->setParametro('importer','importer','numeric');
		$this->setParametro('justificativo','justificativo','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarSolicitudDetalle(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_solicitud_detalle_ime';
        $this->transaccion='ATE_DTS_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_solicitud_detalle','id_solicitud_detalle','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>