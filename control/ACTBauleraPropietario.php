<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTBauleraPropietario.php
*@author  (admin)
*@date 15-05-2024 20:44:58
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                15-05-2024 20:44:58    admin             Creacion    
  #
*****************************************************************************************/

class ACTBauleraPropietario extends ACTbase{    
            
    function listarBauleraPropietario(){
		$this->objParam->defecto('ordenacion','id_baulera_propietario');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODBauleraPropietario','listarBauleraPropietario');
        } else{
        	$this->objFunc=$this->create('MODBauleraPropietario');
            
        	$this->res=$this->objFunc->listarBauleraPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarBauleraPropietario(){
        $this->objFunc=$this->create('MODBauleraPropietario');    
        if($this->objParam->insertar('id_baulera_propietario')){
            $this->res=$this->objFunc->insertarBauleraPropietario($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarBauleraPropietario($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarBauleraPropietario(){
        	$this->objFunc=$this->create('MODBauleraPropietario');    
        $this->res=$this->objFunc->eliminarBauleraPropietario($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>