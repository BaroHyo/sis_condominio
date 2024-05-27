<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTPropietario.php
 * @author  (admin)
 * @date 14-05-2024 15:32:39
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                14-05-2024 15:32:39    admin             Creacion
 * #
 *****************************************************************************************/

class ACTPropietario extends ACTbase
{

    function listarPropietario()
    {
        $this->objParam->defecto('ordenacion', 'id_propietario');
        $this->objParam->defecto('dir_ordenacion', 'asc');
        if ($this->objParam->getParametro('id_condominio') != '') {
            $this->objParam->addFiltro("pro.id_condominio = " . $this->objParam->getParametro('id_condominio'));
        }

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODPropietario', 'listarPropietario');
        } else {
            $this->objFunc = $this->create('MODPropietario');

            $this->res = $this->objFunc->listarPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarPropietario()
    {
        $this->objFunc = $this->create('MODPropietario');
        if ($this->objParam->insertar('id_propietario')) {
            $this->res = $this->objFunc->insertarPropietario($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarPropietario()
    {
        $this->objFunc = $this->create('MODPropietario');
        $this->res = $this->objFunc->eliminarPropietario($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>