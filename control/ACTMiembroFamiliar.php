<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTMiembroFamiliar.php
*@author  (admin)
*@date 14-05-2024 15:36:36
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                14-05-2024 15:36:36    admin             Creacion    
  #
*****************************************************************************************/

class ACTMiembroFamiliar extends ACTbase{    
            
    function listarMiembroFamiliar(){
		$this->objParam->defecto('ordenacion','id_vehiculo');
        $this->objParam->defecto('dir_ordenacion','asc');

        if ($this->objParam->getParametro('id_propietario') != '') {
            $this->objParam->addFiltro("mie.id_propietario = " . $this->objParam->getParametro('id_propietario'));
        }


        if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODMiembroFamiliar','listarMiembroFamiliar');
        } else{
        	$this->objFunc=$this->create('MODMiembroFamiliar');
            
        	$this->res=$this->objFunc->listarMiembroFamiliar($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarMiembroFamiliar(){
        $this->objFunc=$this->create('MODMiembroFamiliar');    
        if($this->objParam->insertar('id_vehiculo')){
            $this->res=$this->objFunc->insertarMiembroFamiliar($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarMiembroFamiliar($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarMiembroFamiliar(){
        	$this->objFunc=$this->create('MODMiembroFamiliar');    
        $this->res=$this->objFunc->eliminarMiembroFamiliar($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>