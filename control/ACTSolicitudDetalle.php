<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTSolicitudDetalle.php
*@author  (admin)
*@date 15-05-2024 22:30:44
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                15-05-2024 22:30:44    admin             Creacion    
  #
*****************************************************************************************/

class ACTSolicitudDetalle extends ACTbase{    
            
    function listarSolicitudDetalle(){
		$this->objParam->defecto('ordenacion','id_solicitud_detalle');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODSolicitudDetalle','listarSolicitudDetalle');
        } else{
        	$this->objFunc=$this->create('MODSolicitudDetalle');
            
        	$this->res=$this->objFunc->listarSolicitudDetalle($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarSolicitudDetalle(){
        $this->objFunc=$this->create('MODSolicitudDetalle');    
        if($this->objParam->insertar('id_solicitud_detalle')){
            $this->res=$this->objFunc->insertarSolicitudDetalle($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarSolicitudDetalle($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarSolicitudDetalle(){
        	$this->objFunc=$this->create('MODSolicitudDetalle');    
        $this->res=$this->objFunc->eliminarSolicitudDetalle($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>