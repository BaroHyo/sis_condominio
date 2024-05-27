<?php
/****************************************************************************************
*@package pXP
*@file gen-MODTransacciones.php
*@author  (admin)
*@date 27-05-2024 01:46:33
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                27-05-2024 01:46:33    admin             Creacion    
  #
*****************************************************************************************/

class MODTransacciones extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarTransacciones(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_transacciones_sel';
        $this->transaccion='ATE_TRA_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_transacciones','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_condominio','int4');
		$this->captura('id_plan_cuenta_at','int4');
		$this->captura('id_moneda','int4');
		$this->captura('tipo','varchar');
		$this->captura('monto','numeric');
		$this->captura('concepto','text');
		$this->captura('id_usuario_reg','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_ai','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_mod','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('usr_reg','varchar');
        $this->captura('usr_mod','varchar');

        $this->captura('id_periodo','int4');
        $this->captura('fecha','date');
        $this->captura('validar','varchar');
        $this->captura('desc_condominio','varchar');
        $this->captura('desc_cuenta','varchar');
        $this->captura('desc_moneda','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();
        
        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function insertarTransacciones(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_transacciones_ime';
        $this->transaccion='ATE_TRA_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('id_plan_cuenta_at','id_plan_cuenta_at','int4');
		$this->setParametro('id_moneda','id_moneda','int4');
		$this->setParametro('tipo','tipo','varchar');
		$this->setParametro('monto','monto','numeric');
		$this->setParametro('concepto','concepto','text');
		$this->setParametro('id_periodo','id_periodo','int4');
		$this->setParametro('fecha','fecha','date');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarTransacciones(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_transacciones_ime';
        $this->transaccion='ATE_TRA_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_transacciones','id_transacciones','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('id_plan_cuenta_at','id_plan_cuenta_at','int4');
		$this->setParametro('id_moneda','id_moneda','int4');
		$this->setParametro('tipo','tipo','varchar');
		$this->setParametro('monto','monto','numeric');
		$this->setParametro('concepto','concepto','text');
        $this->setParametro('fecha','fecha','date');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarTransacciones(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_transacciones_ime';
        $this->transaccion='ATE_TRA_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_transacciones','id_transacciones','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
    function cambiarRevision(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_transacciones_ime';
        $this->transaccion='ATE_TRA_VAL';
        $this->tipo_procedimiento='IME';

        //Define los parametros para la funcion
		$this->setParametro('id_transacciones','id_transacciones','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>