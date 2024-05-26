<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTVisita.php
*@author  (admin)
*@date 21-05-2024 05:51:03
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                21-05-2024 05:51:03    admin             Creacion    
  #
*****************************************************************************************/

class ACTVisita extends ACTbase{    
            
    function listarVisita(){
		$this->objParam->defecto('ordenacion','id_visita');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODVisita','listarVisita');
        } else{
        	$this->objFunc=$this->create('MODVisita');
            
        	$this->res=$this->objFunc->listarVisita($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarVisita(){
        $this->objFunc=$this->create('MODVisita');    
        if($this->objParam->insertar('id_visita')){
            $this->res=$this->objFunc->insertarVisita($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarVisita($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarVisita(){
        	$this->objFunc=$this->create('MODVisita');    
        $this->res=$this->objFunc->eliminarVisita($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>