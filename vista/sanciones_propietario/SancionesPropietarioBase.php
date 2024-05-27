<?php
/****************************************************************************************
 * @package pXP
 * @file gen-SancionesPropietario.php
 * @author  (admin)
 * @date 27-05-2024 01:48:15
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                27-05-2024 01:48:15    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.SancionesPropietarioBase = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.SancionesPropietarioBase.superclass.constructor.call(this, config);
                this.init();
                this.finCons = true;
            },
            Atributos: [
                {
                    //configuracion del componente
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_sanciones_propietario'
                    },
                    type: 'Field',
                    form: true
                },
                {
                    config: {
                        name: 'id_propietario',
                        fieldLabel: 'Propietario',
                        allowBlank: false,
                        emptyText: 'Elija una opción...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_condominio/control/Propietario/listarPropietario',
                            id: 'id_propietario',
                            root: 'datos',
                            sortInfo: {
                                field: 'nombre',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_propietario', 'nombre', 'ap_materno', 'ap_paterno'],
                            remoteSort: true,
                            baseParams: {par_filtro: 'p.nombre#p.apellido_paterno#p.apellido_materno'}
                        }),
                        valueField: 'id_propietario',
                        displayField: 'nombre',
                        gdisplayField: 'desc_propietario',
                        tpl: '<tpl for="."><div class="x-combo-list-item"><p>Propietario: <b>{nombre} {ap_paterno}</b></p> </div></tpl>',
                        hiddenName: 'id_propietario',
                        forceSelection: true,
                        typeAhead: false,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'remote',
                        pageSize: 15,
                        queryDelay: 1000,
                        anchor: '80%',
                        gwidth: 150,
                        minChars: 2,
                        renderer: function (value, p, record) {
                            return String.format('{0}', record.data['desc_propietario']);
                        }
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {pfiltro: 'per.nombre', type: 'string'},
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'desc_unidad',
                        fieldLabel: 'Unidad',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 10
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'unn.numero_unidad ', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'estado',
                        fieldLabel: 'Estado',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 50
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'sap.estado', type: 'string'},
                    id_grupo: 1,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        name: 'id_sancion',
                        fieldLabel: 'Sancion',
                        allowBlank: false,
                        emptyText: 'Elija una opción...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_condominio/control/Sancion/listarSancion',
                            id: 'id_sancion',
                            root: 'datos',
                            sortInfo: {
                                field: 'nombre',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_sancion', 'nombre', 'importe_mb', 'id_moneda', 'desc_moneda'],
                            remoteSort: true,
                            baseParams: {par_filtro: 'san.nombre'}
                        }),
                        valueField: 'id_sancion',
                        displayField: 'nombre',
                        gdisplayField: 'desc_sancion',
                        hiddenName: 'id_sancion',
                        forceSelection: true,
                        typeAhead: false,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'remote',
                        pageSize: 15,
                        queryDelay: 1000,
                        anchor: '80%',
                        gwidth: 150,
                        minChars: 2,
                        renderer: function (value, p, record) {
                            return String.format('{0}', record.data['desc_sancion']);
                        }
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {pfiltro: 'movtip.nombre', type: 'string'},
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'fecha',
                        fieldLabel: 'Fecha',
                        allowBlank: false,
                        anchor: '50%',
                        gwidth: 100,
                        format: 'd/m/Y',
                        renderer: function (value, p, record) {
                            return value ? value.dateFormat('d/m/Y') : ''
                        }
                    },
                    type: 'DateField',
                    filters: {pfiltro: 'sap.fecha', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'justificacion',
                        fieldLabel: 'Justificacion',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 100,
                        renderer: function (value, metaData, record, rowIndex, colIndex, store) {
                            metaData.css = 'multilineColumn';
                            return String.format('<div class="gridmultiline"><font>{0}</font></div>', value);//#4
                        }
                    },
                    type: 'TextArea',
                    filters: {pfiltro: 'sap.justificacion', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'importe',
                        fieldLabel: 'Importe',
                        allowBlank: true,
                        anchor: '40%',
                        gwidth: 100,
                        disabled: true,
                        renderer: function (value, p, record) {
                            Number.prototype.formatDinero = function (c, d, t) {
                                var n = this,
                                    c = isNaN(c = Math.abs(c)) ? 2 : c,
                                    d = d == undefined ? "." : d,
                                    t = t == undefined ? "," : t,
                                    s = n < 0 ? "-" : "",
                                    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
                                    j = (j = i.length) > 3 ? j % 3 : 0;
                                return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
                            };
                            return String.format('<div style="vertical-align:middle;text-align:right;"><b>{0}</b></div>', (parseFloat(value)).formatDinero(2, ',', '.'));

                        }
                    },
                    type: 'NumberField',
                    filters: {pfiltro: 'sap.importe', type: 'numeric'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'id_moneda',
                        origen: 'MONEDA',
                        fieldLabel: 'Moneda',
                        anchor: '30%',
                        allowBlank: false,
                        gdisplayField: 'desc_moneda',//mapea al store del grid
                        gwidth: 200,
                        renderer: function (value, p, record) {
                            return String.format('{0}', record.data['desc_moneda']);
                        }
                    },
                    type: 'ComboRec',
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
                    filters: {pfiltro: 'sap.estado_reg', type: 'string'},
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
                    filters: {pfiltro: 'sap.fecha_reg', type: 'date'},
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
                    filters: {pfiltro: 'sap.id_usuario_ai', type: 'numeric'},
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
                    filters: {pfiltro: 'sap.usuario_ai', type: 'string'},
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
                    filters: {pfiltro: 'sap.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Sanciones Propietario',
            ActSave: '../../sis_condominio/control/SancionesPropietario/insertarSancionesPropietario',
            ActDel: '../../sis_condominio/control/SancionesPropietario/eliminarSancionesPropietario',
            ActList: '../../sis_condominio/control/SancionesPropietario/listarSancionesPropietario',
            id_store: 'id_sanciones_propietario',
            fields: [
                {name: 'id_sanciones_propietario', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'id_propietario', type: 'numeric'},
                {name: 'id_sancion', type: 'numeric'},
                {name: 'fecha', type: 'date', dateFormat: 'Y-m-d'},
                {name: 'justificacion', type: 'string'},
                {name: 'importe', type: 'numeric'},
                {name: 'id_moneda', type: 'numeric'},
                {name: 'estado', type: 'string'},
                {name: 'id_usuario_reg', type: 'numeric'},
                {name: 'fecha_reg', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'id_usuario_ai', type: 'numeric'},
                {name: 'usuario_ai', type: 'string'},
                {name: 'id_usuario_mod', type: 'numeric'},
                {name: 'fecha_mod', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'usr_reg', type: 'string'},
                {name: 'usr_mod', type: 'string'},
                {name: 'desc_propietario', type: 'string'},
                {name: 'desc_sancion', type: 'string'},
                {name: 'desc_moneda', type: 'string'},
                {name: 'desc_unidad', type: 'string'},

            ],
            sortInfo: {
                field: 'id_sanciones_propietario',
                direction: 'ASC'
            },
            bdel: true,
            bsave: false,
            fwidth: '60%',
            fheight: '25%',
        }
    )
</script>
        
        