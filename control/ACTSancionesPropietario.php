<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTSancionesPropietario.php
 * @author  (admin)
 * @date 27-05-2024 01:48:15
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                27-05-2024 01:48:15    admin             Creacion
 * #
 *****************************************************************************************/

class ACTSancionesPropietario extends ACTbase
{

    function listarSancionesPropietario()
    {
        $this->objParam->defecto('ordenacion', 'id_sanciones_propietario');
        $this->objParam->defecto('dir_ordenacion', 'asc');
        switch ($this->objParam->getParametro('pes_estado')) {
            case 'borrador':
                $this->objParam->addFiltro("sap.estado = ''registado''");
                break;
            case 'pendiente':
                $this->objParam->addFiltro("sap.estado = ''pendiente''");
                break;
            case 'pagado':
                $this->objParam->addFiltro("sap.estado = ''pagado''");
                break;
        }
        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODSancionesPropietario', 'listarSancionesPropietario');
        } else {
            $this->objFunc = $this->create('MODSancionesPropietario');

            $this->res = $this->objFunc->listarSancionesPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarSancionesPropietario()
    {
        $this->objFunc = $this->create('MODSancionesPropietario');
        if ($this->objParam->insertar('id_sanciones_propietario')) {
            $this->res = $this->objFunc->insertarSancionesPropietario($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarSancionesPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarSancionesPropietario()
    {
        $this->objFunc = $this->create('MODSancionesPropietario');
        $this->res = $this->objFunc->eliminarSancionesPropietario($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>