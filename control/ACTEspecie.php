<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTEspecie.php
*@author  (admin)
*@date 14-05-2024 15:37:28
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                14-05-2024 15:37:28    admin             Creacion    
  #
*****************************************************************************************/

class ACTEspecie extends ACTbase{    
            
    function listarEspecie(){
		$this->objParam->defecto('ordenacion','id_especie');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODEspecie','listarEspecie');
        } else{
        	$this->objFunc=$this->create('MODEspecie');
            
        	$this->res=$this->objFunc->listarEspecie($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarEspecie(){
        $this->objFunc=$this->create('MODEspecie');    
        if($this->objParam->insertar('id_especie')){
            $this->res=$this->objFunc->insertarEspecie($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarEspecie($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarEspecie(){
        	$this->objFunc=$this->create('MODEspecie');    
        $this->res=$this->objFunc->eliminarEspecie($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>