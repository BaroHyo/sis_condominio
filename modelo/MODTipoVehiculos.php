<?php
/****************************************************************************************
*@package pXP
*@file gen-MODTipoVehiculos.php
*@author  (admin)
*@date 27-05-2024 02:00:44
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                27-05-2024 02:00:44    admin             Creacion    
  #
*****************************************************************************************/

class MODTipoVehiculos extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarTipoVehiculos(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_tipo_vehiculos_sel';
        $this->transaccion='ATE_TPV_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_tipo_vehiculos','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('tipo','varchar');
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
            
    function insertarTipoVehiculos(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_tipo_vehiculos_ime';
        $this->transaccion='ATE_TPV_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('tipo','tipo','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarTipoVehiculos(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_tipo_vehiculos_ime';
        $this->transaccion='ATE_TPV_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_tipo_vehiculos','id_tipo_vehiculos','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('tipo','tipo','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarTipoVehiculos(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_tipo_vehiculos_ime';
        $this->transaccion='ATE_TPV_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_tipo_vehiculos','id_tipo_vehiculos','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>