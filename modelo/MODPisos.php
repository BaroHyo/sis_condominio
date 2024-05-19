<?php
/****************************************************************************************
 * @package pXP
 * @file gen-MODPisos.php
 * @author  (admin)
 * @date 12-05-2024 17:24:36
 * @description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                12-05-2024 17:24:36    admin             Creacion
 * #
 *****************************************************************************************/

class MODPisos extends MODbase
{

    function __construct(CTParametro $pParam)
    {
        parent::__construct($pParam);
    }

    function listarPisos()
    {
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento = 'ate.ft_pisos_sel';
        $this->transaccion = 'ATE_PIS_SEL';
        $this->tipo_procedimiento = 'SEL';//tipo de transaccion

        //Definicion de la lista del resultado del query
        $this->captura('id_pisos', 'int4');
        $this->captura('estado_reg', 'varchar');
        $this->captura('id_bloques', 'int4');
        $this->captura('id_condominio', 'int4');
        $this->captura('numero_piso', 'int4');
        $this->captura('id_usuario_reg', 'int4');
        $this->captura('fecha_reg', 'timestamp');
        $this->captura('id_usuario_ai', 'int4');
        $this->captura('usuario_ai', 'varchar');
        $this->captura('id_usuario_mod', 'int4');
        $this->captura('fecha_mod', 'timestamp');
        $this->captura('usr_reg', 'varchar');
        $this->captura('usr_mod', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function insertarPisos()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_pisos_ime';
        $this->transaccion = 'ATE_PIS_INS';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_bloques', 'id_bloques', 'int4');
        $this->setParametro('id_condominio', 'id_condominio', 'int4');
        $this->setParametro('numero_piso', 'numero_piso', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function modificarPisos()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_pisos_ime';
        $this->transaccion = 'ATE_PIS_MOD';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_pisos', 'id_pisos', 'int4');
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_bloques', 'id_bloques', 'int4');
        $this->setParametro('id_condominio', 'id_condominio', 'int4');
        $this->setParametro('numero_piso', 'numero_piso', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function eliminarPisos()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_pisos_ime';
        $this->transaccion = 'ATE_PIS_ELI';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_pisos', 'id_pisos', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

}

?>