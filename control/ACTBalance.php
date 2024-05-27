<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTBalance.php
*@author  (admin)
*@date 27-05-2024 01:47:12
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                27-05-2024 01:47:12    admin             Creacion    
  #
*****************************************************************************************/

class ACTBalance extends ACTbase{    
            
    function listarBalance(){
		$this->objParam->defecto('ordenacion','id_balance');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODBalance','listarBalance');
        } else{
        	$this->objFunc=$this->create('MODBalance');
            
        	$this->res=$this->objFunc->listarBalance($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarBalance(){
        $this->objFunc=$this->create('MODBalance');    
        if($this->objParam->insertar('id_balance')){
            $this->res=$this->objFunc->insertarBalance($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarBalance($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarBalance(){
        	$this->objFunc=$this->create('MODBalance');    
        $this->res=$this->objFunc->eliminarBalance($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>