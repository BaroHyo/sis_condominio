<?php
/****************************************************************************************
*@package pXP
*@file gen-MODBloques.php
*@author  (admin)
*@date 12-05-2024 17:24:28
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                12-05-2024 17:24:28    admin             Creacion    
  #
*****************************************************************************************/

class MODBloques extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarBloques(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_bloques_sel';
        $this->transaccion='ATE_BLO_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_bloques','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_condominio','int4');
		$this->captura('nombre','varchar');
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
            
    function insertarBloques(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_bloques_ime';
        $this->transaccion='ATE_BLO_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('nombre','nombre','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarBloques(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_bloques_ime';
        $this->transaccion='ATE_BLO_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_bloques','id_bloques','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('nombre','nombre','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarBloques(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_bloques_ime';
        $this->transaccion='ATE_BLO_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_bloques','id_bloques','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>