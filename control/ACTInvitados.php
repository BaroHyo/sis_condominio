<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTInvitados.php
 * @author  (admin)
 * @date 21-05-2024 04:12:21
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                21-05-2024 04:12:21    admin             Creacion
 * #
 *****************************************************************************************/

class ACTInvitados extends ACTbase
{

    function listarInvitados()
    {
        $this->objParam->defecto('ordenacion', 'id_invitados');
        $this->objParam->defecto('dir_ordenacion', 'asc');

        if ($this->objParam->getParametro('id_solicitud') != '') {
            $this->objParam->addFiltro("inv.id_solicitud = " . $this->objParam->getParametro('id_solicitud'));
        }
        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODInvitados', 'listarInvitados');
        } else {
            $this->objFunc = $this->create('MODInvitados');

            $this->res = $this->objFunc->listarInvitados($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarInvitados()
    {
        $this->objFunc = $this->create('MODInvitados');
        if ($this->objParam->insertar('id_invitados')) {
            $this->res = $this->objFunc->insertarInvitados($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarInvitados($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarInvitados()
    {
        $this->objFunc = $this->create('MODInvitados');
        $this->res = $this->objFunc->eliminarInvitados($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>