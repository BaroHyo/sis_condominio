<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTEspensa.php
 * @author  (admin)
 * @date 25-05-2024 21:15:41
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                25-05-2024 21:15:41    admin             Creacion
 * #
 *****************************************************************************************/

class ACTEspensa extends ACTbase
{

    function listarEspensa()
    {
        $this->objParam->defecto('ordenacion', 'id_espensa');
        $this->objParam->defecto('dir_ordenacion', 'asc');
        if ($this->objParam->getParametro('id_condominio') != '') {
            $this->objParam->addFiltro("esp.id_condominio = " . $this->objParam->getParametro('id_condominio'));
        }
        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODEspensa', 'listarEspensa');
        } else {
            $this->objFunc = $this->create('MODEspensa');

            $this->res = $this->objFunc->listarEspensa($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarEspensa()
    {
        $this->objFunc = $this->create('MODEspensa');
        if ($this->objParam->insertar('id_espensa')) {
            $this->res = $this->objFunc->insertarEspensa($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarEspensa($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarEspensa()
    {
        $this->objFunc = $this->create('MODEspensa');
        $this->res = $this->objFunc->eliminarEspensa($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>