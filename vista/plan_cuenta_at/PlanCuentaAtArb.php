<?php
/**
 * @package pXP
 * @file Cuenta.php
 * @author  Gonzalo Sarmiento Sejas
 * @date 21-02-2013 15:04:03
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 * ISSUE            FECHA                AUTHOR                        DESCRIPCION
 *
 */
header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.PlanCuentaAtArb = Ext.extend(Phx.arbGridInterfaz, {

        constructor: function (config) {
            this.idContenedor = config.idContenedor;
            this.maestro = config;
            Phx.vista.PlanCuentaAtArb.superclass.constructor.call(this, config);
            this.loaderTree.baseParams = {id_condominio: this.maestro.id_condominio};
            this.init();
            this.root.reload();
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
                    name: 'id_plan_cuenta_at_fk'
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
                    gwidth: 200,
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
                    gwidth: 600,
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
                    name: 'sw_transaccional',
                    fieldLabel: 'Operación',
                    allowBlank: false,
                    emptyText: 'Tipo...',
                    typeAhead: true,
                    triggerAction: 'all',
                    lazyRender: true,
                    mode: 'local',
                    gwidth: 100,
                    store: ['movimiento', 'titular']
                },
                type: 'ComboBox',
                id_grupo: 0,
                grid: true,
                form: true
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
        title: 'Cuenta',
        ActSave: '../../sis_condominio/control/PlanCuentaAt/insertarPlanCuentaAt',
        ActDel: '../../sis_condominio/control/PlanCuentaAt/eliminarPlanCuentaAt',
        ActList: '../../sis_condominio/control/PlanCuentaAt/listarPlanCuentaAtArbol',
        id_store: 'id_plan_cuenta_at',
        textRoot: 'Plan de Cuentas',
        id_nodo: 'id_plan_cuenta_at',
        id_nodo_p: 'id_plan_cuenta_at_fk',
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
            {name: 'id_plan_cuenta_at_fk', type: 'numeric'},
            {name: 'sw_transaccional', type: 'string'},
            {name: 'tipo_nodo', type: 'string'},
        ],
        sortInfo: {
            field: 'id_plan_cuenta_at',
            direction: 'ASC'
        },
        bdel: true,
        bsave: false,
        rootVisible: true,
        expanded: false,
        fwidth: '60%',
        fheight: '30%',
        getTipoCuentaPadre: function (n) {
            let direc;
            const padre = n.parentNode;
            if (padre) {
                if (padre.attributes.id != 'id') {
                    return this.getTipoCuentaPadre(padre);
                } else {
                    return n.attributes.tipo_cuenta;
                }
            } else {
                return undefined;
            }
        },
        preparaMenu: function (n) {
            if (n.attributes.tipo_nodo == 'hijo' || n.attributes.tipo_nodo == 'raiz' || n.attributes.id == 'id') {
                this.tbar.items.get('b-new-' + this.idContenedor).enable()
            } else {
                this.tbar.items.get('b-new-' + this.idContenedor).disable()
            }
            Phx.vista.PlanCuentaAtArb.superclass.preparaMenu.call(this, n);
        },
        liberaMenu: function (n) {
            Phx.vista.PlanCuentaAtArb.superclass.liberaMenu.call(this, n);
        },
        loadValoresIniciales: function () {
            Phx.vista.PlanCuentaAtArb.superclass.loadValoresIniciales.call(this);
            this.getComponente('id_condominio').setValue(this.maestro.id_condominio);
        },
    })
</script>



