<?php
/****************************************************************************************
*@package pXP
*@file gen-MODDirectorio.php
*@author  (admin)
*@date 15-05-2024 22:33:12
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                15-05-2024 22:33:12    admin             Creacion    
  #
*****************************************************************************************/

class MODDirectorio extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarDirectorio(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_directorio_sel';
        $this->transaccion='ATE_DIR_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_directorio','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_condominio','int4');
		$this->captura('id_cargo_directorio','int4');
		$this->captura('id_propietario','int4');
		$this->captura('fecha_desde','date');
		$this->captura('fecha_hasta','date');
		$this->captura('estado','varchar');
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
            
    function insertarDirectorio(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_directorio_ime';
        $this->transaccion='ATE_DIR_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('id_cargo_directorio','id_cargo_directorio','int4');
		$this->setParametro('id_propietario','id_propietario','int4');
		$this->setParametro('fecha_desde','fecha_desde','date');
		$this->setParametro('fecha_hasta','fecha_hasta','date');
		$this->setParametro('estado','estado','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarDirectorio(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_directorio_ime';
        $this->transaccion='ATE_DIR_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_directorio','id_directorio','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('id_cargo_directorio','id_cargo_directorio','int4');
		$this->setParametro('id_propietario','id_propietario','int4');
		$this->setParametro('fecha_desde','fecha_desde','date');
		$this->setParametro('fecha_hasta','fecha_hasta','date');
		$this->setParametro('estado','estado','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarDirectorio(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_directorio_ime';
        $this->transaccion='ATE_DIR_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_directorio','id_directorio','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>