<?php
/****************************************************************************************
 * @package pXP
 * @file gen-MODAreasComunes.php
 * @author  (admin)
 * @date 12-05-2024 03:48:04
 * @description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                12-05-2024 03:48:04    admin             Creacion
 * #
 *****************************************************************************************/

class MODAreasComunes extends MODbase
{

    function __construct(CTParametro $pParam)
    {
        parent::__construct($pParam);
    }

    function listarAreasComunes()
    {
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento = 'ate.ft_areas_comunes_sel';
        $this->transaccion = 'ATE_ARE_SEL';
        $this->tipo_procedimiento = 'SEL';//tipo de transaccion

        //Definicion de la lista del resultado del query
        $this->captura('id_areas_comunes', 'int4');
        $this->captura('estado_reg', 'varchar');
        $this->captura('id_condominio', 'int4');
        $this->captura('nombre', 'varchar');
        $this->captura('descripcion', 'varchar');
        $this->captura('id_usuario_reg', 'int4');
        $this->captura('fecha_reg', 'timestamp');
        $this->captura('id_usuario_ai', 'int4');
        $this->captura('usuario_ai', 'varchar');
        $this->captura('id_usuario_mod', 'int4');
        $this->captura('fecha_mod', 'timestamp');
        $this->captura('usr_reg', 'varchar');
        $this->captura('usr_mod', 'varchar');
        $this->captura('importe', 'numeric');
        $this->captura('id_moneda', 'int4');
        $this->captura('tipo_reserva', 'varchar');
        $this->captura('desc_moneda', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function insertarAreasComunes()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_areas_comunes_ime';
        $this->transaccion = 'ATE_ARE_INS';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_condominio', 'id_condominio', 'int4');
        $this->setParametro('nombre', 'nombre', 'varchar');
        $this->setParametro('descripcion', 'descripcion', 'varchar');
        $this->setParametro('importe', 'importe', 'numeric');
        $this->setParametro('id_moneda', 'id_moneda', 'int4');
        $this->setParametro('tipo_reserva', 'tipo_reserva', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function modificarAreasComunes()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_areas_comunes_ime';
        $this->transaccion = 'ATE_ARE_MOD';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_areas_comunes', 'id_areas_comunes', 'int4');
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_condominio', 'id_condominio', 'int4');
        $this->setParametro('nombre', 'nombre', 'varchar');
        $this->setParametro('descripcion', 'descripcion', 'varchar');
        $this->setParametro('importe', 'importe', 'numeric');
        $this->setParametro('id_moneda', 'id_moneda', 'int4');
        $this->setParametro('tipo_reserva', 'tipo_reserva', 'varchar');
        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function eliminarAreasComunes()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_areas_comunes_ime';
        $this->transaccion = 'ATE_ARE_ELI';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_areas_comunes', 'id_areas_comunes', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

}

?>