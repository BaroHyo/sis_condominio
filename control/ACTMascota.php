<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTMascota.php
 * @author  (admin)
 * @date 14-05-2024 15:34:01
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                14-05-2024 15:34:01    admin             Creacion
 * #
 *****************************************************************************************/

class ACTMascota extends ACTbase
{

    function listarMascota()
    {
        $this->objParam->defecto('ordenacion', 'id_mascota');
        $this->objParam->defecto('dir_ordenacion', 'asc');

        if ($this->objParam->getParametro('id_propietario') != '') {
            $this->objParam->addFiltro("mas.id_propietario = " . $this->objParam->getParametro('id_propietario'));
        }

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODMascota', 'listarMascota');
        } else {
            $this->objFunc = $this->create('MODMascota');

            $this->res = $this->objFunc->listarMascota($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarMascota()
    {
        $this->objFunc = $this->create('MODMascota');
        if ($this->objParam->insertar('id_mascota')) {
            $this->res = $this->objFunc->insertarMascota($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarMascota($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarMascota()
    {
        $this->objFunc = $this->create('MODMascota');
        $this->res = $this->objFunc->eliminarMascota($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>