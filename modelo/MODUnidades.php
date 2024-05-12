<?php
/****************************************************************************************
*@package pXP
*@file gen-MODUnidades.php
*@author  (admin)
*@date 12-05-2024 12:25:22
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                12-05-2024 12:25:22    admin             Creacion    
  #
*****************************************************************************************/

class MODUnidades extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarUnidades(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_unidades_sel';
        $this->transaccion='ATE_UNI_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_unidades','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_condominio','int4');
		$this->captura('numero_unidad','varchar');
		$this->captura('descripcion','text');
		$this->captura('tipo_unidad','varchar');
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
            
    function insertarUnidades(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_unidades_ime';
        $this->transaccion='ATE_UNI_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('numero_unidad','numero_unidad','varchar');
		$this->setParametro('descripcion','descripcion','text');
		$this->setParametro('tipo_unidad','tipo_unidad','varchar');
		$this->setParametro('informacion_adicional','informacion_adicional','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarUnidades(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_unidades_ime';
        $this->transaccion='ATE_UNI_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_unidades','id_unidades','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('numero_unidad','numero_unidad','varchar');
		$this->setParametro('descripcion','descripcion','text');
		$this->setParametro('tipo_unidad','tipo_unidad','varchar');
		$this->setParametro('informacion_adicional','informacion_adicional','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarUnidades(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_unidades_ime';
        $this->transaccion='ATE_UNI_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_unidades','id_unidades','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>