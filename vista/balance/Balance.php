<?php
/****************************************************************************************
*@package pXP
*@file gen-Balance.php
*@author  (admin)
*@date 27-05-2024 01:47:12
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema

HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                27-05-2024 01:47:12    admin            Creacion    
 #   

*******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.Balance=Ext.extend(Phx.gridInterfaz,{

    constructor:function(config){
        this.maestro=config.maestro;
        //llama al constructor de la clase padre
        Phx.vista.Balance.superclass.constructor.call(this,config);
        this.init();
        this.load({params:{start:0, limit:this.tam_pag}})
    },
            
    Atributos:[
        {
            //configuracion del componente
            config:{
                    labelSeparator:'',
                    inputType:'hidden',
                    name: 'id_balance'
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
                filters:{pfiltro:'bal.estado_reg',type:'string'},
                id_grupo:1,
                grid:true,
                form:false
		},
        {
            config: {
                name: 'id_condominio',
                fieldLabel: 'id_condominio',
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
                hiddenName: 'id_condominio',
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
            config: {
                name: 'id_moneda',
                fieldLabel: 'id_moneda',
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
                hiddenName: 'id_moneda',
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
                name: 'total_ingresos',
                fieldLabel: 'total_ingresos',
                allowBlank: true,
                anchor: '80%',
                gwidth: 100,
            	maxLength:655362
            },
                type:'NumberField',
                filters:{pfiltro:'bal.total_ingresos',type:'numeric'},
                id_grupo:1,
                grid:true,
                form:true
		},
        {
            config:{
                name: 'total_egresos',
                fieldLabel: 'total_egresos',
                allowBlank: true,
                anchor: '80%',
                gwidth: 100,
            	maxLength:655362
            },
                type:'NumberField',
                filters:{pfiltro:'bal.total_egresos',type:'numeric'},
                id_grupo:1,
                grid:true,
                form:true
		},
        {
            config:{
                name: 'balance_neto',
                fieldLabel: 'balance_neto',
                allowBlank: true,
                anchor: '80%',
                gwidth: 100,
            	maxLength:655362
            },
                type:'NumberField',
                filters:{pfiltro:'bal.balance_neto',type:'numeric'},
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
                filters:{pfiltro:'bal.fecha_reg',type:'date'},
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
                filters:{pfiltro:'bal.id_usuario_ai',type:'numeric'},
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
                filters:{pfiltro:'bal.usuario_ai',type:'string'},
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
                filters:{pfiltro:'bal.fecha_mod',type:'date'},
                id_grupo:1,
                grid:true,
                form:false
		}
    ],
    tam_pag:50,    
    title:'Balance',
    ActSave:'../../sis_condominio/control/Balance/insertarBalance',
    ActDel:'../../sis_condominio/control/Balance/eliminarBalance',
    ActList:'../../sis_condominio/control/Balance/listarBalance',
    id_store:'id_balance',
    fields: [
		{name:'id_balance', type: 'numeric'},
		{name:'estado_reg', type: 'string'},
		{name:'id_condominio', type: 'numeric'},
		{name:'id_moneda', type: 'numeric'},
		{name:'total_ingresos', type: 'numeric'},
		{name:'total_egresos', type: 'numeric'},
		{name:'balance_neto', type: 'numeric'},
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
        field: 'id_balance',
        direction: 'ASC'
    },
    bdel:true,
    bsave:true
    }
)
</script>
        
        