<?php
/****************************************************************************************
 * @package pXP
 * @file gen-MODComunicado.php
 * @author  (admin)
 * @date 21-05-2024 05:16:20
 * @description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                21-05-2024 05:16:20    admin             Creacion
 * #
 *****************************************************************************************/

class MODComunicado extends MODbase
{

    function __construct(CTParametro $pParam)
    {
        parent::__construct($pParam);
    }

    function listarComunicado()
    {
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento = 'ate.ft_comunicado_sel';
        $this->transaccion = 'ATE_COM_SEL';
        $this->tipo_procedimiento = 'SEL';//tipo de transaccion

        //Definicion de la lista del resultado del query
        $this->captura('id_comunicado', 'int4');
        $this->captura('estado_reg', 'varchar');
        $this->captura('id_condominio', 'int4');
        $this->captura('asunto', 'varchar');
        $this->captura('contenido', 'text');
        $this->captura('estado', 'varchar');
        $this->captura('fecha', 'date');
        $this->captura('id_usuario_reg', 'int4');
        $this->captura('fecha_reg', 'timestamp');
        $this->captura('id_usuario_ai', 'int4');
        $this->captura('usuario_ai', 'varchar');
        $this->captura('id_usuario_mod', 'int4');
        $this->captura('fecha_mod', 'timestamp');
        $this->captura('usr_reg', 'varchar');
        $this->captura('usr_mod', 'varchar');
        $this->captura('desc_condominio', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function insertarComunicado()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_comunicado_ime';
        $this->transaccion = 'ATE_COM_INS';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_condominio', 'id_condominio', 'int4');
        $this->setParametro('asunto', 'asunto', 'varchar');
        $this->setParametro('contenido', 'contenido', 'text');
        $this->setParametro('estado', 'estado', 'varchar');
        $this->setParametro('fecha', 'fecha', 'date');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function modificarComunicado()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_comunicado_ime';
        $this->transaccion = 'ATE_COM_MOD';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_comunicado', 'id_comunicado', 'int4');
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_condominio', 'id_condominio', 'int4');
        $this->setParametro('asunto', 'asunto', 'varchar');
        $this->setParametro('contenido', 'contenido', 'text');
        $this->setParametro('estado', 'estado', 'varchar');
        $this->setParametro('fecha', 'fecha', 'date');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function eliminarComunicado()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_comunicado_ime';
        $this->transaccion = 'ATE_COM_ELI';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_comunicado', 'id_comunicado', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function notificarComunidaco()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_comunicado_ime';
        $this->transaccion = 'ATE_COM_CANB';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_comunicado', 'id_comunicado', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

}

?>