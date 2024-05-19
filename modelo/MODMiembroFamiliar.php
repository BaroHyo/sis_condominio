<?php
/****************************************************************************************
*@package pXP
*@file gen-MODMiembroFamiliar.php
*@author  (admin)
*@date 14-05-2024 15:36:36
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                14-05-2024 15:36:36    admin             Creacion    
  #
*****************************************************************************************/

class MODMiembroFamiliar extends MODbase{
    
    function __construct(CTParametro $pParam){
        parent::__construct($pParam);
    }
            
    function listarMiembroFamiliar(){
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento='ate.ft_miembro_familiar_sel';
        $this->transaccion='ATE_MIE_SEL';
        $this->tipo_procedimiento='SEL';//tipo de transaccion
                
        //Definicion de la lista del resultado del query
		$this->captura('id_vehiculo','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('id_propietario','int4');
		$this->captura('id_tipo_relacion','int4');
		$this->captura('nombre','varchar');
		$this->captura('apellido_paterno','varchar');
		$this->captura('apellido_materno','varchar');
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
            
    function insertarMiembroFamiliar(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_miembro_familiar_ime';
        $this->transaccion='ATE_MIE_INS';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_propietario','id_propietario','int4');
		$this->setParametro('id_tipo_relacion','id_tipo_relacion','int4');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('apellido_paterno','apellido_paterno','varchar');
		$this->setParametro('apellido_materno','apellido_materno','varchar');
		$this->setParametro('informacion_adicional','informacion_adicional','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function modificarMiembroFamiliar(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_miembro_familiar_ime';
        $this->transaccion='ATE_MIE_MOD';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_vehiculo','id_vehiculo','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('id_propietario','id_propietario','int4');
		$this->setParametro('id_tipo_relacion','id_tipo_relacion','int4');
		$this->setParametro('nombre','nombre','varchar');
		$this->setParametro('apellido_paterno','apellido_paterno','varchar');
		$this->setParametro('apellido_materno','apellido_materno','varchar');
		$this->setParametro('informacion_adicional','informacion_adicional','text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
    function eliminarMiembroFamiliar(){
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento='ate.ft_miembro_familiar_ime';
        $this->transaccion='ATE_MIE_ELI';
        $this->tipo_procedimiento='IME';
                
        //Define los parametros para la funcion
		$this->setParametro('id_vehiculo','id_vehiculo','int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }
            
}
?>