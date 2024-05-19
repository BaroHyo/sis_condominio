<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTCargoDirectorio.php
 * @author  (admin)
 * @date 15-05-2024 22:32:10
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                15-05-2024 22:32:10    admin             Creacion
 * #
 *****************************************************************************************/

class ACTCargoDirectorio extends ACTbase
{

    function listarCargoDirectorio()
    {
        $this->objParam->defecto('ordenacion', 'id_cargo_directorio');
        $this->objParam->defecto('dir_ordenacion', 'asc');
        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODCargoDirectorio', 'listarCargoDirectorio');
        } else {
            $this->objFunc = $this->create('MODCargoDirectorio');

            $this->res = $this->objFunc->listarCargoDirectorio($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarCargoDirectorio()
    {
        $this->objFunc = $this->create('MODCargoDirectorio');
        if ($this->objParam->insertar('id_cargo_directorio')) {
            $this->res = $this->objFunc->insertarCargoDirectorio($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarCargoDirectorio($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarCargoDirectorio()
    {
        $this->objFunc = $this->create('MODCargoDirectorio');
        $this->res = $this->objFunc->eliminarCargoDirectorio($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>