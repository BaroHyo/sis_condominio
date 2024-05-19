<?php
/****************************************************************************************
*@package pXP
*@file gen-MODTipoRelacion.php
*@author  (admin)
*@date 14-05-2024 15:36:59
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                14-05-2024 15:36:59    admin             Creacion    
  #
*****************************************************************************************/

class MODTipoRelacion extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarTipoRelacion(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_tipo_relacion_sel';
        $this->transaccion='ATE_TIP_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_tipo_relacion','int4');
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
            
    function insertarTipoRelacion(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_tipo_relacion_ime';
        $this->transaccion='ATE_TIP_INS';
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
            
    function modificarTipoRelacion(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_tipo_relacion_ime';
        $this->transaccion='ATE_TIP_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_tipo_relacion','id_tipo_relacion','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('tipo','tipo','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarTipoRelacion(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_tipo_relacion_ime';
        $this->transaccion='ATE_TIP_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_tipo_relacion','id_tipo_relacion','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>