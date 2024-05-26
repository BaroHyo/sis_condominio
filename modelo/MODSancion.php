<?php
/****************************************************************************************
*@package pXP
*@file gen-MODSancion.php
*@author  (admin)
*@date 24-05-2024 04:17:23
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                24-05-2024 04:17:23    admin             Creacion    
  #
*****************************************************************************************/

class MODSancion extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarSancion(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_sancion_sel';
        $this->transaccion='ATE_SAN_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_sancion','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_condominio','int4');
		$this->captura('id_moneda','int4');
		$this->captura('nombre','varchar');
		$this->captura('importe_mb','numeric');
		$this->captura('informacion_adicional','text');
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
            
    function insertarSancion(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_sancion_ime';
        $this->transaccion='ATE_SAN_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('id_moneda','id_moneda','int4');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('importe_mb','importe_mb','numeric');
		$this->setParametro('informacion_adicional','informacion_adicional','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarSancion(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_sancion_ime';
        $this->transaccion='ATE_SAN_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_sancion','id_sancion','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_condominio','id_condominio','int4');
		$this->setParametro('id_moneda','id_moneda','int4');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('importe_mb','importe_mb','numeric');
		$this->setParametro('informacion_adicional','informacion_adicional','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarSancion(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_sancion_ime';
        $this->transaccion='ATE_SAN_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_sancion','id_sancion','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>