<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTTipoRelacion.php
*@author  (admin)
*@date 14-05-2024 15:36:59
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                14-05-2024 15:36:59    admin             Creacion    
  #
*****************************************************************************************/

class ACTTipoRelacion extends ACTbase{    
            
    function listarTipoRelacion(){
		$this->objParam->defecto('ordenacion','id_tipo_relacion');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODTipoRelacion','listarTipoRelacion');
        } else{
        	$this->objFunc=$this->create('MODTipoRelacion');
            
        	$this->res=$this->objFunc->listarTipoRelacion($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarTipoRelacion(){
        $this->objFunc=$this->create('MODTipoRelacion');    
        if($this->objParam->insertar('id_tipo_relacion')){
            $this->res=$this->objFunc->insertarTipoRelacion($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarTipoRelacion($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarTipoRelacion(){
        	$this->objFunc=$this->create('MODTipoRelacion');    
        $this->res=$this->objFunc->eliminarTipoRelacion($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>