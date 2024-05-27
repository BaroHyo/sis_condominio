<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTTransacciones.php
*@author  (admin)
*@date 27-05-2024 01:46:33
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                27-05-2024 01:46:33    admin             Creacion    
  #
*****************************************************************************************/

class ACTTransacciones extends ACTbase{    
            
    function listarTransacciones(){
		$this->objParam->defecto('ordenacion','id_transacciones');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODTransacciones','listarTransacciones');
        } else{
        	$this->objFunc=$this->create('MODTransacciones');
            
        	$this->res=$this->objFunc->listarTransacciones($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarTransacciones(){
        $this->objFunc=$this->create('MODTransacciones');    
        if($this->objParam->insertar('id_transacciones')){
            $this->res=$this->objFunc->insertarTransacciones($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarTransacciones($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarTransacciones(){
        	$this->objFunc=$this->create('MODTransacciones');    
        $this->res=$this->objFunc->eliminarTransacciones($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>