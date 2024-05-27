<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTUnidadPropietario.php
 * @author  (admin)
 * @date 15-05-2024 20:44:41
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                15-05-2024 20:44:41    admin             Creacion
 * #
 *****************************************************************************************/

class ACTUnidadPropietario extends ACTbase
{

    function listarUnidadPropietario()
    {
        $this->objParam->defecto('ordenacion', 'id_unidad_propietario');
        $this->objParam->defecto('dir_ordenacion', 'asc');
        if ($this->objParam->getParametro('id_propietario') != '') {
            $this->objParam->addFiltro("unp.id_propietario = " . $this->objParam->getParametro('id_propietario'));
        }

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODUnidadPropietario', 'listarUnidadPropietario');
        } else {
            $this->objFunc = $this->create('MODUnidadPropietario');

            $this->res = $this->objFunc->listarUnidadPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarUnidadPropietario()
    {
        $this->objFunc = $this->create('MODUnidadPropietario');
        if ($this->objParam->insertar('id_unidad_propietario')) {
            $this->res = $this->objFunc->insertarUnidadPropietario($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarUnidadPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarUnidadPropietario()
    {
        $this->objFunc = $this->create('MODUnidadPropietario');
        $this->res = $this->objFunc->eliminarUnidadPropietario($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>