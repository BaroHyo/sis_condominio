<?php
/****************************************************************************************
 * @package pXP
 * @file gen-Condominio.php
 * @author  (admin)
 * @date 12-05-2024 03:10:00
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                12-05-2024 03:10:00    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.CondominioBase = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.CondominioBase.superclass.constructor.call(this, config);
                this.init();
                this.addButton('btm-bloques', {
                    text: 'Bloques/Pisos',
                    iconCls: 'bsee',
                    disabled: false,
                    handler: this.onShowBloque,
                    tooltip: '<b>Bloques</b>',
                    scope: this
                });
                this.addButton('btm-plan-cuenta', {
                    text: 'Plan de Cuenta',
                    iconCls: 'bengineadd',
                    disabled: false,
                    handler: this.onShowPlanCuenta,
                    tooltip: '<b>Directorio por condominio</b>',
                    scope: this
                });
                this.addButton('btm-sancion', {
                    text: 'Sanciones',
                    iconCls: 'bpagar',
                    disabled: false,
                    handler: this.onSanciones,
                    tooltip: '<b>Directorio por condominio</b>',
                    scope: this
                });
                this.addButton('btm-espensa', {
                    text: 'Espensa',
                    iconCls: 'binfo',
                    disabled: false,
                    handler: this.onEspensa,
                    tooltip: '<b>Bloques</b>',
                    scope: this
                });
             },
            Atributos: [
                {
                    //configuracion del componente
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
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'con.codigo', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'nombre',
                        fieldLabel: 'Nombre',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 250,
                        maxLength: 200,
                        renderer: function (value, p, record) {
                            return String.format('<b>{0}</b>', value);
                        }
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'con.nombre', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true,
                    bottom_filter: true
                },
                {
                    config: {
                        name: 'id_lugar',
                        fieldLabel: 'Lugar',
                        allowBlank: false,
                        emptyText: 'Lugar...',
                        store: new Ext.data.JsonStore(
                            {
                                url: '../../sis_parametros/control/Lugar/listarLugar',
                                id: 'id_lugar',
                                root: 'datos',
                                sortInfo: {
                                    field: 'nombre',
                                    direction: 'ASC'
                                },
                                totalProperty: 'total',
                                fields: ['id_lugar', 'id_lugar_fk', 'codigo', 'nombre', 'tipo', 'sw_municipio', 'sw_impuesto', 'codigo_largo'],
                                // turn on remote sorting
                                remoteSort: true,
                                baseParams: {par_filtro: 'lug.nombre'}
                            }),
                        valueField: 'id_lugar',
                        displayField: 'nombre',
                        gdisplayField: 'desc_lugar',
                        hiddenName: 'id_lugar',
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'remote',
                        pageSize: 50,
                        queryDelay: 500,
                        anchor: '80%',
                        gwidth: 150,
                        minChars: 2,
                        renderer: function (value, p, record) {
                            return String.format('{0}', record.data['desc_lugar']);
                        }
                    },
                    type: 'ComboBox',
                    filters: {pfiltro: 'lug.nombre', type: 'string'},
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'direccion',
                        fieldLabel: 'Direccion',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 250,
                        maxLength: 500,
                        renderer: function (value, metaData, record, rowIndex, colIndex, store) {
                            metaData.css = 'multilineColumn';
                            return String.format('<div class="gridmultiline"><font>{0}</font></div>', value);//#4
                        }
                    },
                    type: 'TextArea',
                    filters: {pfiltro: 'con.direccion', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'bloques',
                        fieldLabel: 'Se Divide en Bloques',
                        allowBlank: false,
                        emptyText: 'Tipo...',
                        typeAhead: true,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'local',
                        anchor: '50%',
                        gwidth: 150,
                        store: ['no', 'si']
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {pfiltro: 'con.bloques', type: 'string'},
                    valorInicial: 'no',
                    form: true,
                    grid: false,
                },
                {
                    config: {
                        name: 'informacion_adicional',
                        fieldLabel: 'Informacion Adicional',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 300,
                        renderer: function (value, metaData, record, rowIndex, colIndex, store) {
                            metaData.css = 'multilineColumn';
                            return String.format('<div class="gridmultiline"><font>{0}</font></div>', value);//#4
                        }
                    },
                    type: 'TextArea',
                    filters: {pfiltro: 'con.informacion_adicional', type: 'string'},
                    id_grupo: 1,
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
                    filters: {pfiltro: 'con.estado_reg', type: 'string'},
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
                    filters: {pfiltro: 'con.fecha_reg', type: 'date'},
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
                    filters: {pfiltro: 'con.id_usuario_ai', type: 'numeric'},
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
                    filters: {pfiltro: 'con.usuario_ai', type: 'string'},
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
                    filters: {pfiltro: 'con.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Condominio',
            ActSave: '../../sis_condominio/control/Condominio/insertarCondominio',
            ActDel: '../../sis_condominio/control/Condominio/eliminarCondominio',
            ActList: '../../sis_condominio/control/Condominio/listarCondominio',
            id_store: 'id_condominio',
            fields: [
                {name: 'id_condominio', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'id_lugar', type: 'numeric'},
                {name: 'codigo', type: 'string'},
                {name: 'nombre', type: 'string'},
                {name: 'direccion', type: 'string'},
                {name: 'informacion_adicional', type: 'string'},
                {name: 'id_usuario_reg', type: 'numeric'},
                {name: 'fecha_reg', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'id_usuario_ai', type: 'numeric'},
                {name: 'usuario_ai', type: 'string'},
                {name: 'id_usuario_mod', type: 'numeric'},
                {name: 'fecha_mod', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'usr_reg', type: 'string'},
                {name: 'usr_mod', type: 'string'},
                {name: 'desc_lugar', type: 'string'},
                {name: 'bloques', type: 'string'},
            ],
            sortInfo: {
                field: 'id_condominio',
                direction: 'ASC'
            },
            bdel: true,
            bsave: false,
            preparaMenu: function (n) {
                Phx.vista.CondominioBase.superclass.preparaMenu.call(this, n);
                this.getBoton('btm-bloques').enable();
                this.getBoton('btm-plan-cuenta').enable();
                this.getBoton('btm-sancion').enable();
                this.getBoton('btm-espensa').enable();
            },
            liberaMenu: function () {
                const tb = Phx.vista.CondominioBase.superclass.liberaMenu.call(this);
                if (tb) {
                    this.getBoton('btm-bloques').disable();
                    this.getBoton('btm-plan-cuenta').disable();
                    this.getBoton('btm-sancion').disable();
                    this.getBoton('btm-espensa').disable();
                }
                return tb
            },
            onShowBloque: function () {
                const rec = this.sm.getSelected();
                const me = this;
                if (rec.data.bloques === 'si') {
                    me.objSolForm = Phx.CP.loadWindows('../../../sis_condominio/vista/bloques/Bloques.php',
                        'Bloques',
                        {
                            width: '60%',
                            height: 500
                        },
                        {
                            data: {objPadre: rec.data}
                        },
                        this.idContenedor,
                        'Bloques'
                    )
                } else {
                    me.objSolForm = Phx.CP.loadWindows('../../../sis_condominio/vista/pisos/PisosCon.php',
                        'Pisos',
                        {
                            width: '30%',
                            height: 400
                        },
                        rec.data,
                        this.idContenedor,
                        'PisosCon'
                    )
                }
            },
            onShowDirectorio: function () {
                const rec = this.sm.getSelected();
                const me = this;
                me.objSolForm = Phx.CP.loadWindows('../../../sis_condominio/vista/directorio/Directorio.php',
                    'Pisos',
                    {
                        width: '70%',
                        height: 500
                    },
                    rec.data,
                    this.idContenedor,
                    'Directorio'
                );
            },
            onShowPlanCuenta: function () {
                const rec = this.sm.getSelected();
                const me = this;
                me.objSolForm = Phx.CP.loadWindows('../../../sis_condominio/vista/plan_cuenta_at/PlanCuentaAtArb.php',
                    'Plan de Cuentas',
                    {
                        width: '70%',
                        height: 500
                    },
                    rec.data,
                    this.idContenedor,
                    'PlanCuentaAtArb'
                );
            },
            onSanciones: function () {
                const rec = this.sm.getSelected();
                const me = this;
                me.objSolForm = Phx.CP.loadWindows('../../../sis_condominio/vista/sancion/Sancion.php',
                    'Sanciones',
                    {
                        width: '70%',
                        height: 500
                    },
                    rec.data,
                    this.idContenedor,
                    'Sancion'
                );
            },
            onEspensa: function () {
                const rec = this.sm.getSelected();
                const me = this;
                me.objSolForm = Phx.CP.loadWindows('../../../sis_condominio/vista/espensa/Espensa.php',
                    'Espensa',
                    {
                        width: '70%',
                        height: 500
                    },
                    rec.data,
                    this.idContenedor,
                    'Espensa'
                );
            }

        }
    )
</script>
        
        