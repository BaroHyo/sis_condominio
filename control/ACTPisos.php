<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTPisos.php
 * @author  (admin)
 * @date 12-05-2024 17:24:36
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                12-05-2024 17:24:36    admin             Creacion
 * #
 *****************************************************************************************/

class ACTPisos extends ACTbase
{

    function listarPisos()
    {
        $this->objParam->defecto('ordenacion', 'id_pisos');
        $this->objParam->defecto('dir_ordenacion', 'asc');

        if ($this->objParam->getParametro('tipo_interfaz') == 'PisosBlo') {
            if ($this->objParam->getParametro('id_bloques') != '') {
                $this->objParam->addFiltro("pis.id_bloques = " . $this->objParam->getParametro('id_bloques'));
            }
        } else {
            if ($this->objParam->getParametro('id_condominio') != '') {
                $this->objParam->addFiltro("pis.id_condominio = " . $this->objParam->getParametro('id_condominio'));
            }
        }
        if ($this->objParam->getParametro('id_bloques_cmb') != '') {
            $this->objParam->addFiltro("pis.id_bloques = " . $this->objParam->getParametro('id_bloques_cmb'));
        }

        if ($this->objParam->getParametro('id_condominio_cmb') != '') {
            $this->objParam->addFiltro("pis.id_condominio = " . $this->objParam->getParametro('id_condominio_cmb'));
        }

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODPisos', 'listarPisos');
        } else {
            $this->objFunc = $this->create('MODPisos');

            $this->res = $this->objFunc->listarPisos($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarPisos()
    {
        $this->objFunc = $this->create('MODPisos');
        if ($this->objParam->insertar('id_pisos')) {
            $this->res = $this->objFunc->insertarPisos($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarPisos($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarPisos()
    {
        $this->objFunc = $this->create('MODPisos');
        $this->res = $this->objFunc->eliminarPisos($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>