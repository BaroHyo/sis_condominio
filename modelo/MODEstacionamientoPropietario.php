<?php
/****************************************************************************************
 * @package pXP
 * @file gen-MODEstacionamientoPropietario.php
 * @author  (admin)
 * @date 15-05-2024 20:44:50
 * @description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                15-05-2024 20:44:50    admin             Creacion
 * #
 *****************************************************************************************/

class MODEstacionamientoPropietario extends MODbase
{

    function __construct(CTParametro $pParam)
    {
        parent::__construct($pParam);
    }

    function listarEstacionamientoPropietario()
    {
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento = 'ate.ft_estacionamiento_propietario_sel';
        $this->transaccion = 'ATE_ESP_SEL';
        $this->tipo_procedimiento = 'SEL';//tipo de transaccion

        //Definicion de la lista del resultado del query
        $this->captura('id_estacionamiento_propietario', 'int4');
        $this->captura('estado_reg', 'varchar');
        $this->captura('id_propietario', 'int4');
        $this->captura('id_estacionamiento', 'int4');
        $this->captura('id_usuario_reg', 'int4');
        $this->captura('fecha_reg', 'timestamp');
        $this->captura('id_usuario_ai', 'int4');
        $this->captura('usuario_ai', 'varchar');
        $this->captura('id_usuario_mod', 'int4');
        $this->captura('fecha_mod', 'timestamp');
        $this->captura('usr_reg', 'varchar');
        $this->captura('usr_mod', 'varchar');
        $this->captura('numero_espacio', 'varchar');
        $this->captura('tipo_espacion', 'varchar');
        $this->captura('informacion_adicional', 'text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function insertarEstacionamientoPropietario()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_estacionamiento_propietario_ime';
        $this->transaccion = 'ATE_ESP_INS';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_propietario', 'id_propietario', 'int4');
        $this->setParametro('id_estacionamiento', 'id_estacionamiento', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function modificarEstacionamientoPropietario()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_estacionamiento_propietario_ime';
        $this->transaccion = 'ATE_ESP_MOD';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_estacionamiento_propietario', 'id_estacionamiento_propietario', 'int4');
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_propietario', 'id_propietario', 'int4');
        $this->setParametro('id_estacionamiento', 'id_estacionamiento', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function eliminarEstacionamientoPropietario()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_estacionamiento_propietario_ime';
        $this->transaccion = 'ATE_ESP_ELI';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_estacionamiento_propietario', 'id_estacionamiento_propietario', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

}

?>