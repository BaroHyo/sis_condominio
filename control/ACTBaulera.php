<?php
/****************************************************************************************
*@package pXP
*@file gen-ACTBaulera.php
*@author  (admin)
*@date 12-05-2024 15:44:06
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo

 HISTORIAL DE MODIFICACIONES:
 #ISSUE                FECHA                AUTOR                DESCRIPCION
  #0                12-05-2024 15:44:06    admin             Creacion    
  #
*****************************************************************************************/

class ACTBaulera extends ACTbase{    
            
    function listarBaulera(){
		$this->objParam->defecto('ordenacion','id_baulera');
        $this->objParam->defecto('dir_ordenacion','asc');
        if($this->objParam->getParametro('id_condominio') != '') {
            $this->objParam->addFiltro("bau.id_condominio = " . $this->objParam->getParametro('id_condominio'));
        }
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
            $this->objReporte = new Reporte($this->objParam,$this);
            $this->res = $this->objReporte->generarReporteListado('MODBaulera','listarBaulera');
        } else{
        	$this->objFunc=$this->create('MODBaulera');

        	$this->res=$this->objFunc->listarBaulera($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                
    function insertarBaulera(){
        $this->objFunc=$this->create('MODBaulera');    
        if($this->objParam->insertar('id_baulera')){
            $this->res=$this->objFunc->insertarBaulera($this->objParam);            
        } else{            
            $this->res=$this->objFunc->modificarBaulera($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
                        
    function eliminarBaulera(){
        	$this->objFunc=$this->create('MODBaulera');    
        $this->res=$this->objFunc->eliminarBaulera($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
            
}

?>