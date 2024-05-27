<?php
/****************************************************************************************
 * @package pXP
 * @file gen-ACTContactosPropietario.php
 * @author  (admin)
 * @date 27-05-2024 01:45:45
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                27-05-2024 01:45:45    admin             Creacion
 * #
 *****************************************************************************************/

class ACTContactosPropietario extends ACTbase
{

    function listarContactosPropietario()
    {
        $this->objParam->defecto('ordenacion', 'id_contactos_propietario');
        $this->objParam->defecto('dir_ordenacion', 'asc');


        if ($this->objParam->getParametro('id_propietario') != '') {
            $this->objParam->addFiltro("cnp.id_propietario = " . $this->objParam->getParametro('id_propietario'));
        }

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODContactosPropietario', 'listarContactosPropietario');
        } else {
            $this->objFunc = $this->create('MODContactosPropietario');

            $this->res = $this->objFunc->listarContactosPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertarContactosPropietario()
    {
        $this->objFunc = $this->create('MODContactosPropietario');
        if ($this->objParam->insertar('id_contactos_propietario')) {
            $this->res = $this->objFunc->insertarContactosPropietario($this->objParam);
        } else {
            $this->res = $this->objFunc->modificarContactosPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminarContactosPropietario()
    {
        $this->objFunc = $this->create('MODContactosPropietario');
        $this->res = $this->objFunc->eliminarContactosPropietario($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

}

?>