<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTComunicado.php
 * @author  (admin)
 * @date 21-05-2024 05:16:20
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                21-05-2024 05:16:20    admin             Creacion
 * #
 *****************************************************************************************/

class ACTComunicado extends ACTbase
{

    function listarComunicado()
    {
        $this->objParam->defecto('ordenacion', 'id_comunicado');
        $this->objParam->defecto('dir_ordenacion', 'asc');

        switch ($this->objParam->getParametro('pes_estado')) {
            case 'borrador':
                $this->objParam->addFiltro("com.estado = ''registro''");
                break;
            case 'notificado':
                $this->objParam->addFiltro("com.estado = ''enviado''");
                break;
        }

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODComunicado', 'listarComunicado');
        } else {
            $this->objFunc = $this->create('MODComunicado');

            $this->res = $this->objFunc->listarComunicado($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarComunicado()
    {
        $this->objFunc = $this->create('MODComunicado');
        if ($this->objParam->insertar('id_comunicado')) {
            $this->res = $this->objFunc->insertarComunicado($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarComunicado($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarComunicado()
    {
        $this->objFunc = $this->create('MODComunicado');
        $this->res = $this->objFunc->eliminarComunicado($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function notificarComunidaco()
    {
        $this->objFunc = $this->create('MODComunicado');
        $this->res = $this->objFunc->notificarComunidaco($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>