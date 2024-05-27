<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTTipoVehiculos.php
*@author  (admin)
*@date 27-05-2024 02:00:44
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                27-05-2024 02:00:44    admin             Creacion    
  #
*****************************************************************************************/

class ACTTipoVehiculos extends ACTbase{    
            
    function listarTipoVehiculos(){
		$this->objParam->defecto('ordenacion','id_tipo_vehiculos');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODTipoVehiculos','listarTipoVehiculos');
        } else{
        	$this->objFunc=$this->create('MODTipoVehiculos');
            
        	$this->res=$this->objFunc->listarTipoVehiculos($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarTipoVehiculos(){
        $this->objFunc=$this->create('MODTipoVehiculos');    
        if($this->objParam->insertar('id_tipo_vehiculos')){
            $this->res=$this->objFunc->insertarTipoVehiculos($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarTipoVehiculos($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarTipoVehiculos(){
        	$this->objFunc=$this->create('MODTipoVehiculos');    
        $this->res=$this->objFunc->eliminarTipoVehiculos($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>