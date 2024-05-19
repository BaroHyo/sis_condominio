<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTSolicitud.php
*@author  (admin)
*@date 15-05-2024 22:06:23
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                15-05-2024 22:06:23    admin             Creacion    
  #
*****************************************************************************************/

class ACTSolicitud extends ACTbase{    
            
    function listarSolicitud(){
		$this->objParam->defecto('ordenacion','id_solicitud');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODSolicitud','listarSolicitud');
        } else{
        	$this->objFunc=$this->create('MODSolicitud');
            
        	$this->res=$this->objFunc->listarSolicitud($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarSolicitud(){
        $this->objFunc=$this->create('MODSolicitud');    
        if($this->objParam->insertar('id_solicitud')){
            $this->res=$this->objFunc->insertarSolicitud($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarSolicitud($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarSolicitud(){
        	$this->objFunc=$this->create('MODSolicitud');    
        $this->res=$this->objFunc->eliminarSolicitud($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>