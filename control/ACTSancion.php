<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTSancion.php
 * @author  (admin)
 * @date 24-05-2024 04:17:23
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                24-05-2024 04:17:23    admin             Creacion
 * #
 *****************************************************************************************/

class ACTSancion extends ACTbase
{

    function listarSancion()
    {
        $this->objParam->defecto('ordenacion', 'id_sancion');
        $this->objParam->defecto('dir_ordenacion', 'asc');

        if ($this->objParam->getParametro('id_condominio') != '') {
            $this->objParam->addFiltro("san.id_condominio = " . $this->objParam->getParametro('id_condominio'));
        }
        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODSancion', 'listarSancion');
        } else {
            $this->objFunc = $this->create('MODSancion');

            $this->res = $this->objFunc->listarSancion($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarSancion()
    {
        $this->objFunc = $this->create('MODSancion');
        if ($this->objParam->insertar('id_sancion')) {
            $this->res = $this->objFunc->insertarSancion($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarSancion($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarSancion()
    {
        $this->objFunc = $this->create('MODSancion');
        $this->res = $this->objFunc->eliminarSancion($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>