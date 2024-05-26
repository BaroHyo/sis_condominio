<?php
/****************************************************************************************
 * @package pXP
 * @file gen-MODSolicitud.php
 * @author  (admin)
 * @date 15-05-2024 22:06:23
 * @description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                15-05-2024 22:06:23    admin             Creacion
 * #
 *****************************************************************************************/

class MODSolicitud extends MODbase
{

    function __construct(CTParametro $pParam)
    {
        parent::__construct($pParam);
    }

    function listarSolicitud()
    {
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento = 'ate.ft_solicitud_sel';
        $this->transaccion = 'ATE_SOA_SEL';
        $this->tipo_procedimiento = 'SEL';//tipo de transaccion

        //Definicion de la lista del resultado del query
        $this->captura('id_solicitud', 'int4');
        $this->captura('estado_reg', 'varchar');
        $this->captura('id_propietario', 'int4');
        $this->captura('fecha', 'date');
        $this->captura('estado', 'varchar');
        $this->captura('nro_tramite', 'varchar');
        $this->captura('id_proceso_wf', 'int4');
        $this->captura('id_estado_wf', 'int4');
        $this->captura('id_usuario_reg', 'int4');
        $this->captura('fecha_reg', 'timestamp');
        $this->captura('id_usuario_ai', 'int4');
        $this->captura('usuario_ai', 'varchar');
        $this->captura('id_usuario_mod', 'int4');
        $this->captura('fecha_mod', 'timestamp');
        $this->captura('usr_reg', 'varchar');
        $this->captura('usr_mod', 'varchar');
        $this->captura('id_condominio', 'int4');
        $this->captura('descripcion', 'varchar');
        $this->captura('desc_propietario', 'text');
        $this->captura('desc_condominio', 'varchar');
        $this->captura('id_areas_comunes', 'int4');
        $this->captura('importe_mb', 'numeric');
        $this->captura('hr_desde', 'time');
        $this->captura('hr_hasta', 'time');
        $this->captura('importe_garantia', 'numeric');
        $this->captura('desc_area_comunes', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function insertarSolicitud()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_solicitud_ime';
        $this->transaccion = 'ATE_SOA_INS';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_propietario', 'id_propietario', 'int4');
        $this->setParametro('fecha', 'fecha', 'date');
        $this->setParametro('id_condominio', 'id_condominio', 'int4');
        $this->setParametro('descripcion', 'descripcion', 'varchar');
        $this->setParametro('id_areas_comunes', 'id_areas_comunes', 'int4');
        $this->setParametro('importe_mb', 'importe_mb', 'numeric');
        $this->setParametro('hr_desde', 'hr_desde', 'time');
        $this->setParametro('hr_hasta', 'hr_hasta', 'time');
        $this->setParametro('importe_garantia', 'importe_garantia', 'numeric');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function modificarSolicitud()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_solicitud_ime';
        $this->transaccion = 'ATE_SOA_MOD';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_solicitud', 'id_solicitud', 'int4');
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_propietario', 'id_propietario', 'int4');
        $this->setParametro('fecha', 'fecha', 'date');
        $this->setParametro('id_condominio', 'id_condominio', 'int4');
        $this->setParametro('descripcion', 'descripcion', 'varchar');
        $this->setParametro('id_areas_comunes', 'id_areas_comunes', 'int4');
        $this->setParametro('importe_mb', 'importe_mb', 'numeric');
        $this->setParametro('hr_desde', 'hr_desde', 'time');
        $this->setParametro('hr_hasta', 'hr_hasta', 'time');
        $this->setParametro('importe_garantia', 'importe_garantia', 'numeric');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function eliminarSolicitud()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_solicitud_ime';
        $this->transaccion = 'ATE_SOA_ELI';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_solicitud', 'id_solicitud', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

}

?>