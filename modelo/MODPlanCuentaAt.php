<?php
/****************************************************************************************
 * @package pXP
 * @file gen-MODPlanCuentaAt.php
 * @author  (admin)
 * @date 16-05-2024 13:42:42
 * @description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                16-05-2024 13:42:42    admin             Creacion
 * #
 *****************************************************************************************/

class MODPlanCuentaAt extends MODbase
{

    function __construct(CTParametro $pParam)
    {
        parent::__construct($pParam);
    }

    function listarPlanCuentaAt()
    {
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento = 'ate.ft_plan_cuenta_at_sel';
        $this->transaccion = 'ATE_PLC_SEL';
        $this->tipo_procedimiento = 'SEL';//tipo de transaccion

        //Definicion de la lista del resultado del query
        $this->captura('id_plan_cuenta_at', 'int4');
        $this->captura('estado_reg', 'varchar');
        $this->captura('tipo', 'varchar');
        $this->captura('nombre', 'varchar');
        $this->captura('codigo', 'varchar');
        $this->captura('id_usuario_reg', 'int4');
        $this->captura('fecha_reg', 'timestamp');
        $this->captura('id_usuario_ai', 'int4');
        $this->captura('usuario_ai', 'varchar');
        $this->captura('id_usuario_mod', 'int4');
        $this->captura('fecha_mod', 'timestamp');
        $this->captura('usr_reg', 'varchar');
        $this->captura('usr_mod', 'varchar');
        $this->captura('id_condominio', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function insertarPlanCuentaAt()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_plan_cuenta_at_ime';
        $this->transaccion = 'ATE_PLC_INS';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('tipo', 'tipo', 'varchar');
        $this->setParametro('nombre', 'nombre', 'varchar');
        $this->setParametro('codigo', 'codigo', 'varchar');
        $this->setParametro('id_condominio', 'id_condominio', 'int4');
        $this->setParametro('sw_transaccional','sw_transaccional','varchar');
        $this->setParametro('id_plan_cuenta_at_fk','id_plan_cuenta_at_fk','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function modificarPlanCuentaAt()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_plan_cuenta_at_ime';
        $this->transaccion = 'ATE_PLC_MOD';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_plan_cuenta_at', 'id_plan_cuenta_at', 'int4');
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('tipo', 'tipo', 'varchar');
        $this->setParametro('nombre', 'nombre', 'varchar');
        $this->setParametro('codigo', 'codigo', 'varchar');
        $this->setParametro('id_condominio', 'id_condominio', 'int4');
        $this->setParametro('sw_transaccional','sw_transaccional','varchar');
        $this->setParametro('id_plan_cuenta_at_fk','id_plan_cuenta_at_fk','varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function eliminarPlanCuentaAt()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_plan_cuenta_at_ime';
        $this->transaccion = 'ATE_PLC_ELI';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_plan_cuenta_at', 'id_plan_cuenta_at', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function listarPlanCuentaAtArbol()
    {
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento = 'ate.ft_plan_cuenta_at_sel';
        $this->transaccion = 'ATE_PLC_ARB';
        $this->tipo_procedimiento = 'SEL';//tipo de transaccion
        $this-> setCount(false);

        $id_padre = $this->objParam->getParametro('id_padre');

        $this->setParametro('id_padre','id_padre','varchar');
        $this->setParametro('id_condominio','id_condominio','integer');

        //Definicion de la lista del resultado del query
        $this->captura('id_plan_cuenta_at', 'int4');
        $this->captura('estado_reg', 'varchar');
        $this->captura('tipo', 'varchar');
        $this->captura('nombre', 'varchar');
        $this->captura('codigo', 'varchar');
        $this->captura('id_usuario_reg', 'int4');
        $this->captura('fecha_reg', 'timestamp');
        $this->captura('id_usuario_ai', 'int4');
        $this->captura('usuario_ai', 'varchar');
        $this->captura('id_usuario_mod', 'int4');
        $this->captura('fecha_mod', 'timestamp');
        $this->captura('usr_reg', 'varchar');
        $this->captura('usr_mod', 'varchar');
        $this->captura('id_condominio', 'int4');
        $this->captura('id_plan_cuenta_at_fk', 'int4');
        $this->captura('sw_transaccional', 'varchar');
        $this->captura('tipo_nodo', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

}

?>