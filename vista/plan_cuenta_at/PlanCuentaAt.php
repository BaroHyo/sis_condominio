<?php
/****************************************************************************************
 * @package pXP
 * @file gen-PlanCuentaAt.php
 * @author  (admin)
 * @date 16-05-2024 13:42:42
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                16-05-2024 13:42:42    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.PlanCuentaAt = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config;
                //llama al constructor de la clase padre
                Phx.vista.PlanCuentaAt.superclass.constructor.call(this, config);
                this.init();
                this.store.baseParams.id_condominio = this.maestro.id_condominio;
                this.load({params: {start: 0, limit: this.tam_pag}})
            },
            Atributos: [
                {
                    //configuracion del componente
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_plan_cuenta_at'
                    },
                    type: 'Field',
                    form: true
                },
                {
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_condominio'
                    },
                    type: 'Field',
                    form: true
                },
                {
                    config: {
                        name: 'codigo',
                        fieldLabel: 'Codigo',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 50,
                        maxLength: 100
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'plc.codigo', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'nombre',
                        fieldLabel: 'Nombre',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 300,
                        maxLength: 100
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'plc.nombre', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'tipo',
                        fieldLabel: 'Tipo',
                        allowBlank: false,
                        emptyText: 'Tipo...',
                        typeAhead: true,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'local',
                        anchor: '50%',
                        gwidth: 120,
                        store: ['ingreso', 'egreso']
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {pfiltro: 'plc.tipo', type: 'string'},
                    valorInicial: 'ingreso',
                    form: true,
                    grid: true,
                },
                {
                    config: {
                        name: 'estado_reg',
                        fieldLabel: 'Estado Reg.',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 10
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'plc.estado_reg', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'usr_reg',
                        fieldLabel: 'Creado por',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 4
                    },
                    type: 'Field',
                    filters: {pfiltro: 'usu1.cuenta', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'fecha_reg',
                        fieldLabel: 'Fecha creación',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        format: 'd/m/Y',
                        renderer: function (value, p, record) {
                            return value ? value.dateFormat('d/m/Y H:i:s') : ''
                        }
                    },
                    type: 'DateField',
                    filters: {pfiltro: 'plc.fecha_reg', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'id_usuario_ai',
                        fieldLabel: 'Fecha creación',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 4
                    },
                    type: 'Field',
                    filters: {pfiltro: 'plc.id_usuario_ai', type: 'numeric'},
                    id_grupo: 1,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        name: 'usuario_ai',
                        fieldLabel: 'Funcionaro AI',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 300
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'plc.usuario_ai', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'usr_mod',
                        fieldLabel: 'Modificado por',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 4
                    },
                    type: 'Field',
                    filters: {pfiltro: 'usu2.cuenta', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'fecha_mod',
                        fieldLabel: 'Fecha Modif.',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        format: 'd/m/Y',
                        renderer: function (value, p, record) {
                            return value ? value.dateFormat('d/m/Y H:i:s') : ''
                        }
                    },
                    type: 'DateField',
                    filters: {pfiltro: 'plc.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Plan de cuenta',
            ActSave: '../../sis_condominio/control/PlanCuentaAt/insertarPlanCuentaAt',
            ActDel: '../../sis_condominio/control/PlanCuentaAt/eliminarPlanCuentaAt',
            ActList: '../../sis_condominio/control/PlanCuentaAt/listarPlanCuentaAt',
            id_store: 'id_plan_cuenta_at',
            fields: [
                {name: 'id_plan_cuenta_at', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'tipo', type: 'string'},
                {name: 'nombre', type: 'string'},
                {name: 'codigo', type: 'string'},
                {name: 'id_usuario_reg', type: 'numeric'},
                {name: 'fecha_reg', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'id_usuario_ai', type: 'numeric'},
                {name: 'usuario_ai', type: 'string'},
                {name: 'id_usuario_mod', type: 'numeric'},
                {name: 'fecha_mod', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'usr_reg', type: 'string'},
                {name: 'usr_mod', type: 'string'},
                {name: 'id_condominio', type: 'numeric'},
            ],
            sortInfo: {
                field: 'id_plan_cuenta_at',
                direction: 'ASC'
            },
            bdel: true,
            bsave: false,
            bexcel: false,
            fwidth: '40%',
            fheight: '20%',
            loadValoresIniciales: function () {
                Phx.vista.PlanCuentaAt.superclass.loadValoresIniciales.call(this);
                this.Cmp.id_condominio.setValue(this.maestro.id_condominio);
            },
        }
    )
</script>
        
        