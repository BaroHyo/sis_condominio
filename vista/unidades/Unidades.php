<?php
/****************************************************************************************
 * @package pXP
 * @file gen-Unidades.php
 * @author  (admin)
 * @date 12-05-2024 12:25:22
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                12-05-2024 12:25:22    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.Unidades = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                Phx.vista.Unidades.superclass.constructor.call(this, config);
                this.init();
                const dataPadre = Phx.CP.getPagina(this.idContenedorPadre).getSelectedData();
                if (dataPadre) {
                    this.onEnablePanel(this, dataPadre);
                } else {
                    this.bloquearMenus();
                }
            },

            Atributos: [
                {
                    //configuracion del componente
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_unidades'
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
                        name: 'id_bloques',
                        fieldLabel: 'Bloque',
                        allowBlank: false,
                        emptyText: 'Elija una opción...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_condominio/control/Bloques/listarBloques',
                            id: 'id_bloques',
                            root: 'datos',
                            sortInfo: {
                                field: 'nombre',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_bloques', 'nombre',],
                            remoteSort: true,
                            baseParams: {par_filtro: 'blo.nombre'}
                        }),
                        valueField: 'id_bloques',
                        displayField: 'nombre',
                        gdisplayField: 'desc_bloque',
                        hiddenName: 'id_bloques',
                        forceSelection: true,
                        typeAhead: false,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'remote',
                        pageSize: 15,
                        queryDelay: 1000,
                        anchor: '80%',
                        gwidth: 100,
                        minChars: 2,
                        renderer: function (value, p, record) {
                            return String.format('<b>{0}</b>', record.data['desc_bloque']);
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
                        name: 'id_pisos',
                        fieldLabel: 'Piso',
                        allowBlank: false,
                        emptyText: 'Elija una opción...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_condominio/control/Pisos/listarPisos',
                            id: 'id_pisos',
                            root: 'datos',
                            sortInfo: {
                                field: 'numero_piso',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_pisos', 'numero_piso'],
                            remoteSort: true,
                            baseParams: {par_filtro: 'pis.numero_piso'}
                        }),
                        valueField: 'id_pisos',
                        displayField: 'numero_piso',
                        gdisplayField: 'desc_piso',
                        hiddenName: 'id_pisos',
                        forceSelection: true,
                        typeAhead: false,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'remote',
                        pageSize: 15,
                        queryDelay: 1000,
                        anchor: '80%',
                        gwidth: 90,
                        minChars: 2,
                        renderer: function (value, p, record) {
                            return String.format('<b style="color: darkblue">{0}</b>', record.data['desc_piso']);
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
                        name: 'numero_unidad',
                        fieldLabel: 'Numero Unidad',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 20
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'uni.numero_unidad', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'id_espensa',
                        fieldLabel: 'Tipo',
                        allowBlank: false,
                        emptyText: 'Elija una opción...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_condominio/control/Espensa/listarEspensa',
                            id: 'id_espensa',
                            root: 'datos',
                            sortInfo: {
                                field: 'nombre',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_espensa', 'nombre'],
                            remoteSort: true,
                            baseParams: {par_filtro: 'esp.nombre'}
                        }),
                        valueField: 'id_espensa',
                        displayField: 'nombre',
                        gdisplayField: 'desc_espensa',
                        hiddenName: 'id_espensa',
                        forceSelection: true,
                        typeAhead: false,
                        triggerAction: 'all',
                        lazyRender: true,
                        mode: 'remote',
                        pageSize: 15,
                        queryDelay: 1000,
                        anchor: '80%',
                        gwidth: 200,
                        minChars: 2,
                        renderer: function (value, p, record) {
                            return String.format('<b style="color: darkblue">{0}</b>', record.data['desc_espensa']);
                        }
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'descripcion',
                        fieldLabel: 'Descripcion',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 200,
                        renderer: function (value, metaData, record, rowIndex, colIndex, store) {
                            metaData.css = 'multilineColumn';
                            return String.format('<div class="gridmultiline"><font>{0}</font></div>', value);//#4
                        }
                    },
                    type: 'TextArea',
                    filters: {pfiltro: 'uni.descripcion', type: 'string'},
                    id_grupo: 1,
                    grid: false,
                    form: false
                },
                {
                    config: {
                        name: 'importe',
                        fieldLabel: 'Espensa',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 100,
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
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'desc_moneda',
                        fieldLabel: 'Moneda',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 150,
                        maxLength: 20
                    },
                    type: 'TextField',
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'informacion_adicional',
                        fieldLabel: 'Informacion Adicional',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 200,
                        renderer: function (value, metaData, record, rowIndex, colIndex, store) {
                            metaData.css = 'multilineColumn';
                            return String.format('<div class="gridmultiline"><font>{0}</font></div>', value);//#4
                        }
                    },
                    type: 'TextArea',
                    filters: {pfiltro: 'uni.informacion_adicional', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
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
                        name: 'estado_reg',
                        fieldLabel: 'Estado Reg.',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 10
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'uni.estado_reg', type: 'string'},
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
                    filters: {pfiltro: 'uni.fecha_reg', type: 'date'},
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
                    filters: {pfiltro: 'uni.id_usuario_ai', type: 'numeric'},
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
                    filters: {pfiltro: 'uni.usuario_ai', type: 'string'},
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
                    filters: {pfiltro: 'uni.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Unidades',
            ActSave: '../../sis_condominio/control/Unidades/insertarUnidades',
            ActDel: '../../sis_condominio/control/Unidades/eliminarUnidades',
            ActList: '../../sis_condominio/control/Unidades/listarUnidades',
            id_store: 'id_unidades',
            fields: [
                {name: 'id_unidades', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'id_condominio', type: 'numeric'},
                {name: 'numero_unidad', type: 'string'},
                {name: 'descripcion', type: 'string'},
                {name: 'tipo_unidad', type: 'string'},
                {name: 'informacion_adicional', type: 'string'},
                {name: 'id_usuario_reg', type: 'numeric'},
                {name: 'fecha_reg', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'id_usuario_ai', type: 'numeric'},
                {name: 'usuario_ai', type: 'string'},
                {name: 'id_usuario_mod', type: 'numeric'},
                {name: 'fecha_mod', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'usr_reg', type: 'string'},
                {name: 'usr_mod', type: 'string'},
                {name: 'id_bloques', type: 'numeric'},
                {name: 'id_pisos', type: 'numeric'},
                {name: 'desc_bloque', type: 'string'},
                {name: 'desc_piso', type: 'string'},
                {name: 'id_espensa', type: 'numeric'},
                {name: 'desc_espensa', type: 'string'},
                {name: 'importe', type: 'numeric'},
                {name: 'desc_moneda', type: 'string'},
            ],
            sortInfo: {
                field: 'id_unidades',
                direction: 'ASC'
            },
            bdel: true,
            bsave: false,
            fwidth: '60%',
            fheight: '30%',
            tipoStore: 'GroupingStore',//GroupingStore o JsonStore #
            remoteGroup: true,
            groupField: 'desc_piso',
            viewGrid: new Ext.grid.GroupingView({
                forceFit: false
            }),
            onReloadPage: function (m) {
                this.maestro = m;
                this.store.baseParams = {id_condominio: this.maestro.id_condominio};
                if (this.maestro.bloques === 'no') {
                    this.hideColumns(['desc_bloque']);
                } else {
                    this.showColumns(['desc_bloque']);
                }
                this.load({params: {start: 0, limit: 50}})
            },
            loadValoresIniciales: function () {
                Phx.vista.Unidades.superclass.loadValoresIniciales.call(this);
                this.Cmp.id_condominio.setValue(this.maestro.id_condominio);
            },
            onButtonNew: function () {
                Phx.vista.Unidades.superclass.onButtonNew.call(this);
                if (this.maestro.bloques === 'si') {
                    this.mostrarComponente(this.Cmp.id_bloques);
                    this.Cmp.id_bloques.store.baseParams = Ext.apply(this.Cmp.id_bloques.store.baseParams, {id_condominio: this.maestro.id_condominio});
                    this.Cmp.id_bloques.modificado = true;
                    this.Cmp.id_bloques.on('select', function (combo, record, index) {
                        this.Cmp.id_pisos.reset();
                        this.Cmp.id_pisos.store.baseParams.id_bloques_cmb = record.data.id_bloques;
                        this.Cmp.id_pisos.modificado = true;
                    }, this);
                } else {
                    this.ocultarComponente(this.Cmp.id_bloques);
                    this.Cmp.id_bloques.store.baseParams.id_condominio = null;
                    this.Cmp.id_bloques.modificado = true;
                    this.Cmp.id_pisos.store.baseParams.id_bloques_cmb = null;
                    this.Cmp.id_pisos.modificado = true;
                    this.Cmp.id_pisos.store.baseParams.id_condominio_cmb = this.maestro.id_condominio;
                    this.Cmp.id_pisos.modificado = true;
                }
            },
            onButtonEdit: function () {
                Phx.vista.Unidades.superclass.onButtonEdit.call(this);
            },
            hideColumns: function (columnsToHide) {
                const colModel = this.grid.getColumnModel();
                columnsToHide.forEach(function (dataIndex) {
                    const colIndex = colModel.findColumnIndex(dataIndex);
                    if (colIndex !== -1) {
                        colModel.setHidden(colIndex, true);
                    }
                });
            },
            showColumns: function (columnsToShow) {
                const colModel = this.grid.getColumnModel();
                columnsToShow.forEach(function (dataIndex) {
                    const colIndex = colModel.findColumnIndex(dataIndex);
                    if (colIndex !== -1) {
                        colModel.setHidden(colIndex, false);
                    }
                });
            }
        }
    )
</script>
        
        