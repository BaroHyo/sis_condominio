<?php
/****************************************************************************************
*@package pXP
*@file gen-ServicioAtDet.php
*@author  (admin)
*@date 16-05-2024 13:41:56
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema

HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                16-05-2024 13:41:56    admin            Creacion    
 #   

*******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.ServicioAtDet=Ext.extend(Phx.gridInterfaz,{

    constructor:function(config){
        this.maestro=config.maestro;
        //llama al constructor de la clase padre
        Phx.vista.ServicioAtDet.superclass.constructor.call(this,config);
        this.init();
        this.load({params:{start:0, limit:this.tam_pag}})
    },
            
    Atributos:[
        {
            //configuracion del componente
            config:{
                    labelSeparator:'',
                    inputType:'hidden',
                    name: 'id_servicio_at_det'
            },
            type:'Field',
            form:true 
        },
        {
            config:{
                name: 'estado_reg',
                fieldLabel: 'Estado Reg.',
                allowBlank: true,
                anchor: '80%',
                gwidth: 100,
            	maxLength:10
            },
                type:'TextField',
                filters:{pfiltro:'sdt.estado_reg',type:'string'},
                id_grupo:1,
                grid:true,
                form:false
		},
        {
            config: {
                name: 'id_servicio_at',
                fieldLabel: 'id_servicio_at',
                allowBlank: false,
                emptyText: 'Elija una opción...',
                store: new Ext.data.JsonStore({
                    url: '../../sis_/control/Clase/Metodo',
                    id: 'id_',
                    root: 'datos',
                    sortInfo: {
                        field: 'nombre',
                        direction: 'ASC'
                    },
                    totalProperty: 'total',
                    fields: ['id_', 'nombre', 'codigo'],
                    remoteSort: true,
                    baseParams: {par_filtro: 'movtip.nombre#movtip.codigo'}
                }),
                valueField: 'id_',
                displayField: 'nombre',
                gdisplayField: 'desc_',
                hiddenName: 'id_servicio_at',
                forceSelection: true,
                typeAhead: false,
                triggerAction: 'all',
                lazyRender: true,
                mode: 'remote',
                pageSize: 15,
                queryDelay: 1000,
                anchor: '100%',
                gwidth: 150,
                minChars: 2,
                renderer : function(value, p, record) {
                    return String.format('{0}', record.data['desc_']);
                }
            },
            type: 'ComboBox',
            id_grupo: 0,
            filters: {pfiltro: 'movtip.nombre',type: 'string'},
            grid: true,
            form: true
        },
        {
            config:{
                name: 'nombre',
                fieldLabel: 'nombre',
                allowBlank: false,
                anchor: '80%',
                gwidth: 100,
            	maxLength:100
            },
                type:'TextField',
                filters:{pfiltro:'sdt.nombre',type:'string'},
                id_grupo:1,
                grid:true,
                form:true
		},
        {
            config:{
                name: 'descripcion',
                fieldLabel: 'descripcion',
                allowBlank: false,
                anchor: '80%',
                gwidth: 100,
            	maxLength:100
            },
                type:'TextField',
                filters:{pfiltro:'sdt.descripcion',type:'string'},
                id_grupo:1,
                grid:true,
                form:true
		},
        {
            config:{
                name: 'usr_reg',
                fieldLabel: 'Creado por',
                allowBlank: true,
                anchor: '80%',
                gwidth: 100,
            	maxLength:4
            },
                type:'Field',
                filters:{pfiltro:'usu1.cuenta',type:'string'},
                id_grupo:1,
                grid:true,
                form:false
		},
        {
            config:{
                name: 'fecha_reg',
                fieldLabel: 'Fecha creación',
                allowBlank: true,
                anchor: '80%',
                gwidth: 100,
                            format: 'd/m/Y', 
                            renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
            },
                type:'DateField',
                filters:{pfiltro:'sdt.fecha_reg',type:'date'},
                id_grupo:1,
                grid:true,
                form:false
		},
        {
            config:{
                name: 'id_usuario_ai',
                fieldLabel: 'Fecha creación',
                allowBlank: true,
                anchor: '80%',
                gwidth: 100,
            	maxLength:4
            },
                type:'Field',
                filters:{pfiltro:'sdt.id_usuario_ai',type:'numeric'},
                id_grupo:1,
                grid:false,
                form:false
		},
        {
            config:{
                name: 'usuario_ai',
                fieldLabel: 'Funcionaro AI',
                allowBlank: true,
                anchor: '80%',
                gwidth: 100,
            	maxLength:300
            },
                type:'TextField',
                filters:{pfiltro:'sdt.usuario_ai',type:'string'},
                id_grupo:1,
                grid:true,
                form:false
		},
        {
            config:{
                name: 'usr_mod',
                fieldLabel: 'Modificado por',
                allowBlank: true,
                anchor: '80%',
                gwidth: 100,
            	maxLength:4
            },
                type:'Field',
                filters:{pfiltro:'usu2.cuenta',type:'string'},
                id_grupo:1,
                grid:true,
                form:false
		},
        {
            config:{
                name: 'fecha_mod',
                fieldLabel: 'Fecha Modif.',
                allowBlank: true,
                anchor: '80%',
                gwidth: 100,
                            format: 'd/m/Y', 
                            renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
            },
                type:'DateField',
                filters:{pfiltro:'sdt.fecha_mod',type:'date'},
                id_grupo:1,
                grid:true,
                form:false
		}
    ],
    tam_pag:50,    
    title:'Servicio detalle',
    ActSave:'../../sis_condominio/control/ServicioAtDet/insertarServicioAtDet',
    ActDel:'../../sis_condominio/control/ServicioAtDet/eliminarServicioAtDet',
    ActList:'../../sis_condominio/control/ServicioAtDet/listarServicioAtDet',
    id_store:'id_servicio_at_det',
    fields: [
		{name:'id_servicio_at_det', type: 'numeric'},
		{name:'estado_reg', type: 'string'},
		{name:'id_servicio_at', type: 'numeric'},
		{name:'nombre', type: 'string'},
		{name:'descripcion', type: 'string'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'usuario_ai', type: 'string'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
        
    ],
    sortInfo:{
        field: 'id_servicio_at_det',
        direction: 'ASC'
    },
    bdel:true,
    bsave:true
    }
)
</script>
        
        