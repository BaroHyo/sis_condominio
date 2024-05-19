<?php
/****************************************************************************************
*@package pXP
*@file gen-MODPropietario.php
*@author  (admin)
*@date 14-05-2024 15:32:39
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                14-05-2024 15:32:39    admin             Creacion    
  #
*****************************************************************************************/

class MODPropietario extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarPropietario(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_propietario_sel';
        $this->transaccion='ATE_PRO_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_propietario','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_persona','int4');
		$this->captura('id_condominio','int4');
		$this->captura('codigo','varchar');
		$this->captura('fecha_desde','date');
		$this->captura('fecha_hasta','date');
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
            
    function insertarPropietario(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_propietario_ime';
        $this->transaccion='ATE_PRO_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_persona','id_persona','int4');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('fecha_desde','fecha_desde','date');
		$this->setParametro('fecha_hasta','fecha_hasta','date');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarPropietario(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_propietario_ime';
        $this->transaccion='ATE_PRO_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_propietario','id_propietario','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_persona','id_persona','int4');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('fecha_desde','fecha_desde','date');
		$this->setParametro('fecha_hasta','fecha_hasta','date');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarPropietario(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_propietario_ime';
        $this->transaccion='ATE_PRO_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_propietario','id_propietario','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>