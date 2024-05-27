<?php
/****************************************************************************************
 * @package pXP
 * @file gen-MODVehiculo.php
 * @author  (admin)
 * @date 14-05-2024 15:37:08
 * @description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                14-05-2024 15:37:08    admin             Creacion
 * #
 *****************************************************************************************/

class MODVehiculo extends MODbase
{

    function __construct(CTParametro $pParam)
    {
        parent::__construct($pParam);
    }

    function listarVehiculo()
    {
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento = 'ate.ft_vehiculo_sel';
        $this->transaccion = 'ATE_VEH_SEL';
        $this->tipo_procedimiento = 'SEL';//tipo de transaccion

        //Definicion de la lista del resultado del query
        $this->captura('id_vehiculo', 'int4');
        $this->captura('estado_reg', 'varchar');
        $this->captura('id_propietario', 'int4');
        $this->captura('tipo', 'varchar');
        $this->captura('marca', 'varchar');
        $this->captura('modelo', 'varchar');
        $this->captura('color', 'varchar');
        $this->captura('placa', 'varchar');
        $this->captura('informacion_adicional', 'text');
        $this->captura('id_usuario_reg', 'int4');
        $this->captura('fecha_reg', 'timestamp');
        $this->captura('id_usuario_ai', 'int4');
        $this->captura('usuario_ai', 'varchar');
        $this->captura('id_usuario_mod', 'int4');
        $this->captura('fecha_mod', 'timestamp');
        $this->captura('usr_reg', 'varchar');
        $this->captura('usr_mod', 'varchar');
        $this->captura('id_tipo_vehiculos', 'int4');
        $this->captura('desc_tipo', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function insertarVehiculo()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_vehiculo_ime';
        $this->transaccion = 'ATE_VEH_INS';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_propietario', 'id_propietario', 'int4');
        $this->setParametro('marca', 'marca', 'varchar');
        $this->setParametro('modelo', 'modelo', 'varchar');
        $this->setParametro('color', 'color', 'varchar');
        $this->setParametro('placa', 'placa', 'varchar');
        $this->setParametro('informacion_adicional', 'informacion_adicional', 'text');
        $this->setParametro('id_tipo_vehiculos', 'id_tipo_vehiculos', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function modificarVehiculo()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_vehiculo_ime';
        $this->transaccion = 'ATE_VEH_MOD';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_vehiculo', 'id_vehiculo', 'int4');
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_propietario', 'id_propietario', 'int4');
        $this->setParametro('marca', 'marca', 'varchar');
        $this->setParametro('modelo', 'modelo', 'varchar');
        $this->setParametro('color', 'color', 'varchar');
        $this->setParametro('placa', 'placa', 'varchar');
        $this->setParametro('informacion_adicional', 'informacion_adicional', 'text');
        $this->setParametro('id_tipo_vehiculos', 'id_tipo_vehiculos', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function eliminarVehiculo()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_vehiculo_ime';
        $this->transaccion = 'ATE_VEH_ELI';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_vehiculo', 'id_vehiculo', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

}

?>