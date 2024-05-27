<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTEnfermedadesPropietario.php
 * @author  (admin)
 * @date 27-05-2024 01:53:14
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                27-05-2024 01:53:14    admin             Creacion
 * #
 *****************************************************************************************/

class ACTEnfermedadesPropietario extends ACTbase
{

    function listarEnfermedadesPropietario()
    {
        $this->objParam->defecto('ordenacion', 'id_enfermedades_propietario');
        $this->objParam->defecto('dir_ordenacion', 'asc');
        if ($this->objParam->getParametro('id_propietario') != '') {
            $this->objParam->addFiltro("enf.id_propietario = " . $this->objParam->getParametro('id_propietario'));
        }
        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODEnfermedadesPropietario', 'listarEnfermedadesPropietario');
        } else {
            $this->objFunc = $this->create('MODEnfermedadesPropietario');

            $this->res = $this->objFunc->listarEnfermedadesPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarEnfermedadesPropietario()
    {
        $this->objFunc = $this->create('MODEnfermedadesPropietario');
        if ($this->objParam->insertar('id_enfermedades_propietario')) {
            $this->res = $this->objFunc->insertarEnfermedadesPropietario($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarEnfermedadesPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarEnfermedadesPropietario()
    {
        $this->objFunc = $this->create('MODEnfermedadesPropietario');
        $this->res = $this->objFunc->eliminarEnfermedadesPropietario($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>