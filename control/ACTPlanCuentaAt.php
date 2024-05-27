<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTPlanCuentaAt.php
 * @author  (admin)
 * @date 16-05-2024 13:42:42
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                16-05-2024 13:42:42    admin             Creacion
 * #
 *****************************************************************************************/

class ACTPlanCuentaAt extends ACTbase
{

    function listarPlanCuentaAt()
    {
        $this->objParam->defecto('ordenacion', 'id_plan_cuenta_at');
        $this->objParam->defecto('dir_ordenacion', 'asc');

        if ($this->objParam->getParametro('sw_movimiento') == 'si') {
            $this->objParam->addFiltro("plc.sw_transaccional = ''movimiento'' ");
        }

        if ($this->objParam->getParametro('sw_tipo') != '') {
            $this->objParam->addFiltro("plc.tipo = ''" . $this->objParam->getParametro('sw_tipo') . "'' ");
        }

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODPlanCuentaAt', 'listarPlanCuentaAt');
        } else {
            $this->objFunc = $this->create('MODPlanCuentaAt');

            $this->res = $this->objFunc->listarPlanCuentaAt($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarPlanCuentaAt()
    {
        $this->objFunc = $this->create('MODPlanCuentaAt');
        if ($this->objParam->insertar('id_plan_cuenta_at')) {
            $this->res = $this->objFunc->insertarPlanCuentaAt($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarPlanCuentaAt($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarPlanCuentaAt()
    {
        $this->objFunc = $this->create('MODPlanCuentaAt');
        $this->res = $this->objFunc->eliminarPlanCuentaAt($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function listarPlanCuentaAtArbol()
    {

        //obtiene el parametro nodo enviado por la vista
        $node = $this->objParam->getParametro('node');

        $id_cuenta = $this->objParam->getParametro('id_plan_cuenta_at');
        $tipo_nodo = $this->objParam->getParametro('tipo_nodo');


        if ($node == 'id') {
            $this->objParam->addParametro('id_padre', '%');
        } else {
            $this->objParam->addParametro('id_padre', $id_cuenta);
        }

        $this->objFunc = $this->create('MODPlanCuentaAt');
        $this->res = $this->objFunc->listarPlanCuentaAtArbol();

        $this->res->setTipoRespuestaArbol();

        $arreglo = array();

        array_push($arreglo, array('nombre' => 'id', 'valor' => 'id_plan_cuenta_at'));
        array_push($arreglo, array('nombre' => 'id_p', 'valor' => 'id_plan_cuenta_at_fk'));


        array_push($arreglo, array('nombre' => 'text', 'valores' => '<b> #codigo# - #nombre#</b>'));
        array_push($arreglo, array('nombre' => 'cls', 'valor' => 'nombre_cuenta'));
        array_push($arreglo, array('nombre' => 'qtip', 'valores' => '<b> #codigo#</b><br/><b> #nombre#</b>'));


        $this->res->addNivelArbol('tipo_nodo', 'raiz', array('leaf' => false,
            'allowDelete' => true,
            'allowEdit' => true,
            'cls' => 'folder',
            'tipo_nodo' => 'raiz',
            'icon' => '../../../lib/imagenes/a_form.png'),
            $arreglo);

        /*se ande un nivel al arbol incluyendo con tido de nivel carpeta con su arreglo de equivalencias
          es importante que entre los resultados devueltos por la base exista la variable\
          tipo_dato que tenga el valor en texto = 'hoja' */


        $this->res->addNivelArbol('tipo_nodo', 'hijo', array(
            'leaf' => false,
            'allowDelete' => true,
            'allowEdit' => true,
            'tipo_nodo' => 'hijo',
            'icon' => '../../../lib/imagenes/a_form.png'),
            $arreglo);


        $this->res->addNivelArbol('tipo_nodo', 'hoja', array(
            'leaf' => true,
            'allowDelete' => true,
            'allowEdit' => true,
            'tipo_nodo' => 'hoja',
            'icon' => '../../../lib/imagenes/a_table_gear.png'),
            $arreglo);


        $this->res->imprimirRespuesta($this->res->generarJson());

    }

}

?>