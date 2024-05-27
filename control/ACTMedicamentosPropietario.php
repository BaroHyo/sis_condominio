<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTMedicamentosPropietario.php
 * @author  (admin)
 * @date 27-05-2024 01:52:00
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                27-05-2024 01:52:00    admin             Creacion
 * #
 *****************************************************************************************/

class ACTMedicamentosPropietario extends ACTbase
{

    function listarMedicamentosPropietario()
    {
        $this->objParam->defecto('ordenacion', 'id_medicamentos_propietario');
        $this->objParam->defecto('dir_ordenacion', 'asc');
        if ($this->objParam->getParametro('id_propietario') != '') {
            $this->objParam->addFiltro("med.id_propietario = " . $this->objParam->getParametro('id_propietario'));
        }

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODMedicamentosPropietario', 'listarMedicamentosPropietario');
        } else {
            $this->objFunc = $this->create('MODMedicamentosPropietario');

            $this->res = $this->objFunc->listarMedicamentosPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarMedicamentosPropietario()
    {
        $this->objFunc = $this->create('MODMedicamentosPropietario');
        if ($this->objParam->insertar('id_medicamentos_propietario')) {
            $this->res = $this->objFunc->insertarMedicamentosPropietario($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarMedicamentosPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarMedicamentosPropietario()
    {
        $this->objFunc = $this->create('MODMedicamentosPropietario');
        $this->res = $this->objFunc->eliminarMedicamentosPropietario($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>