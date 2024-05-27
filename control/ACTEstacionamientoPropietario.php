<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTEstacionamientoPropietario.php
 * @author  (admin)
 * @date 15-05-2024 20:44:50
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                15-05-2024 20:44:50    admin             Creacion
 * #
 *****************************************************************************************/

class ACTEstacionamientoPropietario extends ACTbase
{

    function listarEstacionamientoPropietario()
    {
        $this->objParam->defecto('ordenacion', 'id_estacionamiento_propietario');
        $this->objParam->defecto('dir_ordenacion', 'asc');
        if ($this->objParam->getParametro('id_propietario') != '') {
            $this->objParam->addFiltro("esp.id_propietario = " . $this->objParam->getParametro('id_propietario'));
        }
        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODEstacionamientoPropietario', 'listarEstacionamientoPropietario');
        } else {
            $this->objFunc = $this->create('MODEstacionamientoPropietario');

            $this->res = $this->objFunc->listarEstacionamientoPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarEstacionamientoPropietario()
    {
        $this->objFunc = $this->create('MODEstacionamientoPropietario');
        if ($this->objParam->insertar('id_estacionamiento_propietario')) {
            $this->res = $this->objFunc->insertarEstacionamientoPropietario($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarEstacionamientoPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarEstacionamientoPropietario()
    {
        $this->objFunc = $this->create('MODEstacionamientoPropietario');
        $this->res = $this->objFunc->eliminarEstacionamientoPropietario($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>