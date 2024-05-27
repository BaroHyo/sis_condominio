<?php
/****************************************************************************************
*@package pXP
*@file gen-MODBalance.php
*@author  (admin)
*@date 27-05-2024 01:47:12
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                27-05-2024 01:47:12    admin             Creacion    
  #
*****************************************************************************************/

class MODBalance extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarBalance(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_balance_sel';
        $this->transaccion='ATE_BAL_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_balance','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_condominio','int4');
		$this->captura('id_moneda','int4');
		$this->captura('total_ingresos','numeric');
		$this->captura('total_egresos','numeric');
		$this->captura('balance_neto','numeric');
		$this->captura('id_usuario_reg','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_ai','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_mod','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('usr_reg','varchar');
        $this->captura('usr_mod','varchar');
        $this->captura('desc_condominio','varchar');
        $this->captura('desc_moneda','varchar');
        $this->captura('fecha_balance','date');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();
        
        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function insertarBalance(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_balance_ime';
        $this->transaccion='ATE_BAL_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('id_moneda','id_moneda','int4');
		$this->setParametro('total_ingresos','total_ingresos','numeric');
		$this->setParametro('total_egresos','total_egresos','numeric');
		$this->setParametro('balance_neto','balance_neto','numeric');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarBalance(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_balance_ime';
        $this->transaccion='ATE_BAL_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_balance','id_balance','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('id_moneda','id_moneda','int4');
		$this->setParametro('total_ingresos','total_ingresos','numeric');
		$this->setParametro('total_egresos','total_egresos','numeric');
		$this->setParametro('balance_neto','balance_neto','numeric');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarBalance(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_balance_ime';
        $this->transaccion='ATE_BAL_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_balance','id_balance','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>