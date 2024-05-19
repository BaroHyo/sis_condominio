<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTBloques.php
 * @author  (admin)
 * @date 12-05-2024 17:24:28
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                12-05-2024 17:24:28    admin             Creacion
 * #
 *****************************************************************************************/

class ACTBloques extends ACTbase
{

    function listarBloques()
    {
        $this->objParam->defecto('ordenacion', 'id_bloques');
        $this->objParam->defecto('dir_ordenacion', 'asc');
        if ($this->objParam->getParametro('id_condominio') != '') {
            $this->objParam->addFiltro("blo.id_condominio = " . $this->objParam->getParametro('id_condominio'));
        }
        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODBloques', 'listarBloques');
        } else {
            $this->objFunc = $this->create('MODBloques');

            $this->res = $this->objFunc->listarBloques($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarBloques()
    {
        $this->objFunc = $this->create('MODBloques');
        if ($this->objParam->insertar('id_bloques')) {
            $this->res = $this->objFunc->insertarBloques($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarBloques($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarBloques()
    {
        $this->objFunc = $this->create('MODBloques');
        $this->res = $this->objFunc->eliminarBloques($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>