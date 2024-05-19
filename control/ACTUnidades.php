<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTUnidades.php
*@author  (admin)
*@date 12-05-2024 12:25:22
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                12-05-2024 12:25:22    admin             Creacion    
  #
*****************************************************************************************/

class ACTUnidades extends ACTbase{    
            
    function listarUnidades(){
		$this->objParam->defecto('ordenacion','id_unidades');
        $this->objParam->defecto('dir_ordenacion','asc');
        if($this->objParam->getParametro('id_condominio') != '') {
            $this->objParam->addFiltro("uni.id_condominio = " . $this->objParam->getParametro('id_condominio'));
        }
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODUnidades','listarUnidades');
        } else{
        	$this->objFunc=$this->create('MODUnidades');
            
        	$this->res=$this->objFunc->listarUnidades($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarUnidades(){
        $this->objFunc=$this->create('MODUnidades');    
        if($this->objParam->insertar('id_unidades')){
            $this->res=$this->objFunc->insertarUnidades($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarUnidades($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarUnidades(){
        	$this->objFunc=$this->create('MODUnidades');    
        $this->res=$this->objFunc->eliminarUnidades($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>