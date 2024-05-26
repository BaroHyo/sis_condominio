<?php
/****************************************************************************************
 * @package pXP
 * @file gen-MODMascota.php
 * @author  (admin)
 * @date 14-05-2024 15:34:01
 * @description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                14-05-2024 15:34:01    admin             Creacion
 * #
 *****************************************************************************************/

class MODMascota extends MODbase
{

    function __construct(CTParametro $pParam)
    {
        parent::__construct($pParam);
    }

    function listarMascota()
    {
        //Definicion de variables para ejecucion del procedimientp
        $this->procedimiento = 'ate.ft_mascota_sel';
        $this->transaccion = 'ATE_MAS_SEL';
        $this->tipo_procedimiento = 'SEL';//tipo de transaccion

        //Definicion de la lista del resultado del query
        $this->captura('id_mascota', 'int4');
        $this->captura('estado_reg', 'varchar');
        $this->captura('id_propietario', 'int4');
        $this->captura('nombre', 'varchar');
        $this->captura('id_especie', 'int4');
        $this->captura('raza', 'varchar');
        $this->captura('genero', 'varchar');
        $this->captura('informacion_adicional', 'text');
        $this->captura('id_usuario_reg', 'int4');
        $this->captura('fecha_reg', 'timestamp');
        $this->captura('id_usuario_ai', 'int4');
        $this->captura('usuario_ai', 'varchar');
        $this->captura('id_usuario_mod', 'int4');
        $this->captura('fecha_mod', 'timestamp');
        $this->captura('usr_reg', 'varchar');
        $this->captura('usr_mod', 'varchar');
        $this->captura('desc_especie', 'varchar');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function insertarMascota()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_mascota_ime';
        $this->transaccion = 'ATE_MAS_INS';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_propietario', 'id_propietario', 'int4');
        $this->setParametro('nombre', 'nombre', 'varchar');
        $this->setParametro('id_especie', 'id_especie', 'int4');
        $this->setParametro('raza', 'raza', 'varchar');
        $this->setParametro('genero', 'genero', 'varchar');
        $this->setParametro('informacion_adicional', 'informacion_adicional', 'text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function modificarMascota()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_mascota_ime';
        $this->transaccion = 'ATE_MAS_MOD';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_mascota', 'id_mascota', 'int4');
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('id_propietario', 'id_propietario', 'int4');
        $this->setParametro('nombre', 'nombre', 'varchar');
        $this->setParametro('id_especie', 'id_especie', 'int4');
        $this->setParametro('raza', 'raza', 'varchar');
        $this->setParametro('genero', 'genero', 'varchar');
        $this->setParametro('informacion_adicional', 'informacion_adicional', 'text');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

    function eliminarMascota()
    {
        //Definicion de variables para ejecucion del procedimiento
        $this->procedimiento = 'ate.ft_mascota_ime';
        $this->transaccion = 'ATE_MAS_ELI';
        $this->tipo_procedimiento = 'IME';

        //Define los parametros para la funcion
        $this->setParametro('id_mascota', 'id_mascota', 'int4');

        //Ejecuta la instruccion
        $this->armarConsulta();
        $this->ejecutarConsulta();

        //Devuelve la respuesta
        return $this->respuesta;
    }

}

?>