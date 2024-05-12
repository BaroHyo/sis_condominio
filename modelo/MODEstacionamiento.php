<?php
/****************************************************************************************
*@package pXP
*@file gen-MODEstacionamiento.php
*@author  (admin)
*@date 12-05-2024 14:10:39
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                12-05-2024 14:10:39    admin             Creacion    
  #
*****************************************************************************************/

class MODEstacionamiento extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarEstacionamiento(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_estacionamiento_sel';
        $this->transaccion='ATE_EST_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_estacionamiento','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_condominio','int4');
		$this->captura('numero_espacio','varchar');
		$this->captura('tipo_espacion','varchar');
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
            
    function insertarEstacionamiento(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_estacionamiento_ime';
        $this->transaccion='ATE_EST_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('numero_espacio','numero_espacio','varchar');
		$this->setParametro('tipo_espacion','tipo_espacion','varchar');
		$this->setParametro('informacion_adicional','informacion_adicional','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarEstacionamiento(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_estacionamiento_ime';
        $this->transaccion='ATE_EST_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_estacionamiento','id_estacionamiento','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('numero_espacio','numero_espacio','varchar');
		$this->setParametro('tipo_espacion','tipo_espacion','varchar');
		$this->setParametro('informacion_adicional','informacion_adicional','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarEstacionamiento(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_estacionamiento_ime';
        $this->transaccion='ATE_EST_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_estacionamiento','id_estacionamiento','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>