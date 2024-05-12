<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTAreasComunes.php
*@author  (admin)
*@date 12-05-2024 03:48:04
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                12-05-2024 03:48:04    admin             Creacion    
  #
*****************************************************************************************/

class ACTAreasComunes extends ACTbase{    
            
    function listarAreasComunes(){
		$this->objParam->defecto('ordenacion','id_areas_comunes');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODAreasComunes','listarAreasComunes');
        } else{
        	$this->objFunc=$this->create('MODAreasComunes');
            
        	$this->res=$this->objFunc->listarAreasComunes($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarAreasComunes(){
        $this->objFunc=$this->create('MODAreasComunes');    
        if($this->objParam->insertar('id_areas_comunes')){
            $this->res=$this->objFunc->insertarAreasComunes($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarAreasComunes($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarAreasComunes(){
        	$this->objFunc=$this->create('MODAreasComunes');    
        $this->res=$this->objFunc->eliminarAreasComunes($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>