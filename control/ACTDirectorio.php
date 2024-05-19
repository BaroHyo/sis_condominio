<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTDirectorio.php
*@author  (admin)
*@date 15-05-2024 22:33:12
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                15-05-2024 22:33:12    admin             Creacion    
  #
*****************************************************************************************/

class ACTDirectorio extends ACTbase{    
            
    function listarDirectorio(){
		$this->objParam->defecto('ordenacion','id_directorio');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODDirectorio','listarDirectorio');
        } else{
        	$this->objFunc=$this->create('MODDirectorio');
            
        	$this->res=$this->objFunc->listarDirectorio($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarDirectorio(){
        $this->objFunc=$this->create('MODDirectorio');    
        if($this->objParam->insertar('id_directorio')){
            $this->res=$this->objFunc->insertarDirectorio($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarDirectorio($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarDirectorio(){
        	$this->objFunc=$this->create('MODDirectorio');    
        $this->res=$this->objFunc->eliminarDirectorio($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>