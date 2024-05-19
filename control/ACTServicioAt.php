<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTServicioAt.php
*@author  (admin)
*@date 16-05-2024 13:12:18
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                16-05-2024 13:12:18    admin             Creacion    
  #
*****************************************************************************************/

class ACTServicioAt extends ACTbase{    
            
    function listarServicioAt(){
		$this->objParam->defecto('ordenacion','id_servicio_at');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODServicioAt','listarServicioAt');
        } else{
        	$this->objFunc=$this->create('MODServicioAt');
            
        	$this->res=$this->objFunc->listarServicioAt($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarServicioAt(){
        $this->objFunc=$this->create('MODServicioAt');    
        if($this->objParam->insertar('id_servicio_at')){
            $this->res=$this->objFunc->insertarServicioAt($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarServicioAt($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarServicioAt(){
        	$this->objFunc=$this->create('MODServicioAt');    
        $this->res=$this->objFunc->eliminarServicioAt($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>