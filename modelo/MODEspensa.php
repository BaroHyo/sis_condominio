<?php
/****************************************************************************************
*@package pXP
*@file gen-MODEspensa.php
*@author  (admin)
*@date 25-05-2024 21:15:41
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                25-05-2024 21:15:41    admin             Creacion    
  #
*****************************************************************************************/

class MODEspensa extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarEspensa(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_espensa_sel';
        $this->transaccion='ATE_ESP_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_espensa','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_condominio','int4');
		$this->captura('nombre','varchar');
		$this->captura('importe','numeric');
		$this->captura('id_moneda','int4');
		$this->captura('id_usuario_reg','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_ai','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_mod','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('usr_reg','varchar');
        $this->captura('usr_mod','varchar');
        $this->captura('desc_moneda','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();
        
        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function insertarEspensa(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_espensa_ime';
        $this->transaccion='ATE_ESP_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('importe','importe','numeric');
		$this->setParametro('id_moneda','id_moneda','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarEspensa(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_espensa_ime';
        $this->transaccion='ATE_ESP_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_espensa','id_espensa','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('importe','importe','numeric');
		$this->setParametro('id_moneda','id_moneda','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarEspensa(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_espensa_ime';
        $this->transaccion='ATE_ESP_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_espensa','id_espensa','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>