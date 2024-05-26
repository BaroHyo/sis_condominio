<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTServicioAtDet.php
 * @author  (admin)
 * @date 16-05-2024 13:41:56
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                16-05-2024 13:41:56    admin             Creacion
 * #
 *****************************************************************************************/

class ACTServicioAtDet extends ACTbase
{

    function listarServicioAtDet()
    {
        $this->objParam->defecto('ordenacion', 'id_servicio_at_det');
        $this->objParam->defecto('dir_ordenacion', 'asc');

        if ($this->objParam->getParametro('id_servicio_at') != '') {
            $this->objParam->addFiltro("sdt.id_servicio_at = " . $this->objParam->getParametro('id_servicio_at'));
        }

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODServicioAtDet', 'listarServicioAtDet');
        } else {
            $this->objFunc = $this->create('MODServicioAtDet');

            $this->res = $this->objFunc->listarServicioAtDet($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarServicioAtDet()
    {
        $this->objFunc = $this->create('MODServicioAtDet');
        if ($this->objParam->insertar('id_servicio_at_det')) {
            $this->res = $this->objFunc->insertarServicioAtDet($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarServicioAtDet($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarServicioAtDet()
    {
        $this->objFunc = $this->create('MODServicioAtDet');
        $this->res = $this->objFunc->eliminarServicioAtDet($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>