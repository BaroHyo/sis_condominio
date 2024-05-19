<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTVehiculo.php
*@author  (admin)
*@date 14-05-2024 15:37:08
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                14-05-2024 15:37:08    admin             Creacion    
  #
*****************************************************************************************/

class ACTVehiculo extends ACTbase{    
            
    function listarVehiculo(){
		$this->objParam->defecto('ordenacion','id_vehiculo');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODVehiculo','listarVehiculo');
        } else{
        	$this->objFunc=$this->create('MODVehiculo');
            
        	$this->res=$this->objFunc->listarVehiculo($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarVehiculo(){
        $this->objFunc=$this->create('MODVehiculo');    
        if($this->objParam->insertar('id_vehiculo')){
            $this->res=$this->objFunc->insertarVehiculo($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarVehiculo($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarVehiculo(){
        	$this->objFunc=$this->create('MODVehiculo');    
        $this->res=$this->objFunc->eliminarVehiculo($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>