<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTCondominio.php
*@author  (admin)
*@date 12-05-2024 03:10:00
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                12-05-2024 03:10:00    admin             Creacion    
  #
*****************************************************************************************/

class ACTCondominio extends ACTbase{    
            
    function listarCondominio(){
		$this->objParam->defecto('ordenacion','id_condominio');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODCondominio','listarCondominio');
        } else{
        	$this->objFunc=$this->create('MODCondominio');
            
        	$this->res=$this->objFunc->listarCondominio($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarCondominio(){
        $this->objFunc=$this->create('MODCondominio');    
        if($this->objParam->insertar('id_condominio')){
            $this->res=$this->objFunc->insertarCondominio($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarCondominio($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarCondominio(){
        	$this->objFunc=$this->create('MODCondominio');    
        $this->res=$this->objFunc->eliminarCondominio($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>