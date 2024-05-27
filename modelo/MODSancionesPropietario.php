<?php
/****************************************************************************************
 * @package pXP
 * @file gen-MODSancionesPropietario.php
 * @author  (admin)
 * @date 27-05-2024 01:48:15
 * @description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                27-05-2024 01:48:15    admin             Creacion
 * #
 *****************************************************************************************/

class MODSancionesPropietario extends MODbase
{

    function __construct(CTParametro $pParam)
    {
        parent::__construct($pParam);
    }

    function listarSancionesPropietario()
    {
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento = 'ate.ft_sanciones_propietario_sel';
        $this->transaccion = 'ATE_SAP_SEL';
        $this->tipo_procedimiento = 'SEL';//tipo de transaccion

        //Definicion de la lista del resultado del query
        $this->captura('id_sanciones_propietario', 'int4');
        $this->captura('estado_reg', 'varchar');
        $this->captura('id_propietario', 'int4');
        $this->captura('id_sancion', 'int4');
        $this->captura('fecha', 'date');
        $this->captura('justificacion', 'text');
        $this->captura('importe', 'numeric');
        $this->captura('id_moneda', 'int4');
        $this->captura('estado', 'varchar');
        $this->captura('id_usuario_reg', 'int4');
        $this->captura('fecha_reg', 'timestamp');
        $this->captura('id_usuario_ai', 'int4');
        $this->captura('usuario_ai', 'varchar');
        $this->captura('id_usuario_mod', 'int4');
        $this->captura('fecha_mod', 'timestamp');
        $this->captura('usr_reg', 'varchar');
        $this->captura('usr_mod', 'varchar');

        $this->captura('desc_propietario', 'text');
        $this->captura('desc_sancion', 'varchar');
        $this->captura('desc_moneda', 'varchar');
        $this->captura('desc_unidad', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function insertarSancionesPropietario()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_sanciones_propietario_ime';
        $this->transaccion = 'ATE_SAP_INS';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_propietario', 'id_propietario', 'int4');
        $this->setParametro('id_sancion', 'id_sancion', 'int4');
        $this->setParametro('fecha', 'fecha', 'date');
        $this->setParametro('justificacion', 'justificacion', 'text');
        $this->setParametro('importe', 'importe', 'numeric');
        $this->setParametro('id_moneda', 'id_moneda', 'int4');
        $this->setParametro('estado', 'estado', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function modificarSancionesPropietario()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_sanciones_propietario_ime';
        $this->transaccion = 'ATE_SAP_MOD';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_sanciones_propietario', 'id_sanciones_propietario', 'int4');
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_propietario', 'id_propietario', 'int4');
        $this->setParametro('id_sancion', 'id_sancion', 'int4');
        $this->setParametro('fecha', 'fecha', 'date');
        $this->setParametro('justificacion', 'justificacion', 'text');
        $this->setParametro('importe', 'importe', 'numeric');
        $this->setParametro('id_moneda', 'id_moneda', 'int4');
        $this->setParametro('estado', 'estado', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function eliminarSancionesPropietario()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_sanciones_propietario_ime';
        $this->transaccion = 'ATE_SAP_ELI';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_sanciones_propietario', 'id_sanciones_propietario', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

}

?>