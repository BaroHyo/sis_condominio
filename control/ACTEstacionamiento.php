<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTEstacionamiento.php
 * @author  (admin)
 * @date 12-05-2024 14:10:39
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                12-05-2024 14:10:39    admin             Creacion
 * #
 *****************************************************************************************/

class ACTEstacionamiento extends ACTbase
{

    function listarEstacionamiento()
    {
        $this->objParam->defecto('ordenacion', 'id_estacionamiento');
        $this->objParam->defecto('dir_ordenacion', 'asc');
        if ($this->objParam->getParametro('id_condominio') != '') {
            $this->objParam->addFiltro("est.id_condominio = " . $this->objParam->getParametro('id_condominio'));

            if ($this->objParam->getParametro('es_propietario') == 'si') {
                $this->objParam->addFiltro("est.id_estacionamiento not in( select est.id_estacionamiento
                                                                        from ate.testacionamiento_propietario esp
                                                                                 join ate.testacionamiento est on est.id_estacionamiento = esp.id_estacionamiento
                                                                        where est.id_condominio = " . $this->objParam->getParametro('id_condominio') . ")");
            }
        }
        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODEstacionamiento', 'listarEstacionamiento');
        } else {
            $this->objFunc = $this->create('MODEstacionamiento');

            $this->res = $this->objFunc->listarEstacionamiento($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarEstacionamiento()
    {
        $this->objFunc = $this->create('MODEstacionamiento');
        if ($this->objParam->insertar('id_estacionamiento')) {
            $this->res = $this->objFunc->insertarEstacionamiento($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarEstacionamiento($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarEstacionamiento()
    {
        $this->objFunc = $this->create('MODEstacionamiento');
        $this->res = $this->objFunc->eliminarEstacionamiento($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>