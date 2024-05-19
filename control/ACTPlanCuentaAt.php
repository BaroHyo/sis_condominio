<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTPlanCuentaAt.php
*@author  (admin)
*@date 16-05-2024 13:42:42
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                16-05-2024 13:42:42    admin             Creacion    
  #
*****************************************************************************************/

class ACTPlanCuentaAt extends ACTbase{    
            
    function listarPlanCuentaAt(){
		$this->objParam->defecto('ordenacion','id_plan_cuenta_at');

        $this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODPlanCuentaAt','listarPlanCuentaAt');
        } else{
        	$this->objFunc=$this->create('MODPlanCuentaAt');
            
        	$this->res=$this->objFunc->listarPlanCuentaAt($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarPlanCuentaAt(){
        $this->objFunc=$this->create('MODPlanCuentaAt');    
        if($this->objParam->insertar('id_plan_cuenta_at')){
            $this->res=$this->objFunc->insertarPlanCuentaAt($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarPlanCuentaAt($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarPlanCuentaAt(){
        	$this->objFunc=$this->create('MODPlanCuentaAt');    
        $this->res=$this->objFunc->eliminarPlanCuentaAt($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>