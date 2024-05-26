<?php
/****************************************************************************************
*@package pXP
*@file gen-MODVisita.php
*@author  (admin)
*@date 21-05-2024 05:51:03
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                21-05-2024 05:51:03    admin             Creacion    
  #
*****************************************************************************************/

class MODVisita extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarVisita(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_visita_sel';
        $this->transaccion='ATE_VIS_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_visita','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_condominio','int4');
		$this->captura('id_unidades','int4');
		$this->captura('fecha','date');
		$this->captura('nombre','varchar');
		$this->captura('ap_paterno','varchar');
		$this->captura('tipo_documento','varchar');
		$this->captura('codigo_documento','varchar');
		$this->captura('ingreso','timestamp');
		$this->captura('salida','timestamp');
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
            
    function insertarVisita(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_visita_ime';
        $this->transaccion='ATE_VIS_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('id_unidades','id_unidades','int4');
		$this->setParametro('fecha','fecha','date');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('ap_paterno','ap_paterno','varchar');
		$this->setParametro('tipo_documento','tipo_documento','varchar');
		$this->setParametro('codigo_documento','codigo_documento','varchar');
		$this->setParametro('ingreso','ingreso','timestamp');
		$this->setParametro('salida','salida','timestamp');
		$this->setParametro('informacion_adicional','informacion_adicional','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarVisita(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_visita_ime';
        $this->transaccion='ATE_VIS_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_visita','id_visita','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('id_unidades','id_unidades','int4');
		$this->setParametro('fecha','fecha','date');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('ap_paterno','ap_paterno','varchar');
		$this->setParametro('tipo_documento','tipo_documento','varchar');
		$this->setParametro('codigo_documento','codigo_documento','varchar');
		$this->setParametro('ingreso','ingreso','timestamp');
		$this->setParametro('salida','salida','timestamp');
		$this->setParametro('informacion_adicional','informacion_adicional','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarVisita(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_visita_ime';
        $this->transaccion='ATE_VIS_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_visita','id_visita','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>