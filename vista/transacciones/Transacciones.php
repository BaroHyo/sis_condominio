<?php
/****************************************************************************************
 * @package pXP
 * @file gen-Transacciones.php
 * @author  (admin)
 * @date 27-05-2024 01:46:33
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 *
 * HISTORIAL DE MODIFICACIONES:
 * #ISSUE                FECHA                AUTOR                DESCRIPCION
 * #0                27-05-2024 01:46:33    admin            Creacion
 * #
 *******************************************************************************************/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.Transacciones = Ext.extend(Phx.gridInterfaz, {

            constructor: function (config) {
                this.maestro = config.maestro;
                //llama al constructor de la clase padre
                this.initButtons = [this.cmbGestion, this.cmbPeriodo, this.cmbCondominio];
                Phx.vista.Transacciones.superclass.constructor.call(this, config);
                this.init();
                this.grid.addListener('cellclick', this.oncellclick, this);
                this.cmbGestion.on('select', function (combo, record, index) {
                    this.tmpGestion = record.data.gestion;
                    this.cmbPeriodo.enable();
                    this.cmbPeriodo.reset();
                    this.store.removeAll();
                    this.cmbPeriodo.store.baseParams = Ext.apply(this.cmbPeriodo.store.baseParams, {id_gestion: this.cmbGestion.getValue()});
                    this.cmbPeriodo.modificado = true;
                }, this);
                this.cmbPeriodo.on('select', function (combo, record, index) {
                    this.tmpPeriodo = record.data.periodo;
                    this.cmbCondominio.enable();
                    this.cmbCondominio.reset();
                }, this);
                this.cmbCondominio.on('select', function (combo, record, index) {
                    this.tmpCondominio = record.data.id_condominio;
                    this.capturaFiltros();
                }, this);
            },
            Atributos: [
                {
                    //configuracion del componente
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_transacciones'
                    },
                    type: 'Field',
                    form: true
                },
                {
                    config: {
                        labelSeparator: '',
                        inputType: 'hidden',
                        name: 'id_periodo'
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
                        name: 'validar',
                        fieldLabel: 'Revisado',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 100,
                        maxLength: 3,
                        renderer: function (value) {
                            //check or un check row
                            var checked = '',
                                momento = 'no';
                            if (value === 'si') {
                                checked = 'checked';
                            }
                            return String.format('<div style="vertical-align:middle;text-align:center;"><input style="height:37px;width:37px;" type="checkbox"  {0}></div>', checked);
                        }
                    },
                    type: 'TextField',
                    id_grupo: 0,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'desc_condominio',
                        fieldLabel: 'Condominio',
                        allowBlank: true,
                        anchor: '80%',
                        gwidth: 200,
                        maxLength: 10
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'con.nombre', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                },
                {
                    config: {
                        name: 'id_plan_cuenta_at',
                        fieldLabel: 'Cuenta',
                        allowBlank: false,
                        emptyText: 'Elija una opción...',
                        store: new Ext.data.JsonStore({
                            url: '../../sis_condominio/control/PlanCuentaAt/listarPlanCuentaAt',
                            id: 'id_plan_cuenta_at',
                            root: 'datos',
                            sortInfo: {
                                field: 'nombre',
                                direction: 'ASC'
                            },
                            totalProperty: 'total',
                            fields: ['id_plan_cuenta_at', 'tipo', 'nombre', 'codigo', 'id_condominio'],
                            remoteSort: true,
                            baseParams: {par_filtro: 'plc.nombre#plc.codigo', sw_movimiento: 'si'}
                        }),
                        valueField: 'id_plan_cuenta_at',
                        displayField: 'nombre',
                        gdisplayField: 'desc_cuenta',
                        hiddenName: 'id_plan_cuenta_at',
                        tpl: '<tpl for="."><div class="x-combo-list-item"><p><b style="color: darkblue">{codigo}</b> <b>{nombre}</b></p><p><b>Tipo:</b> {tipo}</p> </div></tpl>',
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
                            return String.format('{0}', record.data['desc_cuenta']);
                        }
                    },
                    type: 'ComboBox',
                    id_grupo: 0,
                    filters: {pfiltro: 'pla.nombre', type: 'string'},
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'tipo',
                        fieldLabel: 'Tipo',
                        allowBlank: false,
                        anchor: '30%',
                        gwidth: 100,
                        maxLength: 30,
                        disabled: true,
                        style: 'background-image: none;',
                    },
                    type: 'TextField',
                    filters: {pfiltro: 'tra.tipo', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'fecha',
                        fieldLabel: 'Fecha',
                        allowBlank: false,
                        anchor: '40%',
                        gwidth: 100,
                        format: 'd/m/Y',
                        renderer: function (value, p, record) {
                            return value ? value.dateFormat('d/m/Y') : ''
                        }
                    },
                    type: 'DateField',
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'concepto',
                        fieldLabel: 'Concepto',
                        allowBlank: false,
                        anchor: '80%',
                        gwidth: 300,
                        renderer: function (value, metaData, record, rowIndex, colIndex, store) {
                            metaData.css = 'multilineColumn';
                            return String.format('<div class="gridmultiline"><font>{0}</font></div>', value);//#4
                        }
                    },
                    type: 'TextArea',
                    filters: {pfiltro: 'tra.concepto', type: 'string'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'monto',
                        fieldLabel: 'Monto',
                        allowBlank: false,
                        anchor: '40%',
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
                    filters: {pfiltro: 'tra.monto', type: 'numeric'},
                    id_grupo: 1,
                    grid: true,
                    form: true
                },
                {
                    config: {
                        name: 'id_moneda',
                        origen: 'MONEDA',
                        fieldLabel: 'Moneda',
                        anchor: '70%',
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
                    filters: {pfiltro: 'tra.estado_reg', type: 'string'},
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
                    filters: {pfiltro: 'tra.fecha_reg', type: 'date'},
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
                    filters: {pfiltro: 'tra.id_usuario_ai', type: 'numeric'},
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
                    filters: {pfiltro: 'tra.usuario_ai', type: 'string'},
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
                    filters: {pfiltro: 'tra.fecha_mod', type: 'date'},
                    id_grupo: 1,
                    grid: true,
                    form: false
                }
            ],
            tam_pag: 50,
            title: 'Transacciones',
            ActSave: '../../sis_condominio/control/Transacciones/insertarTransacciones',
            ActDel: '../../sis_condominio/control/Transacciones/eliminarTransacciones',
            ActList: '../../sis_condominio/control/Transacciones/listarTransacciones',
            id_store: 'id_transacciones',
            fields: [
                {name: 'id_transacciones', type: 'numeric'},
                {name: 'estado_reg', type: 'string'},
                {name: 'id_condominio', type: 'numeric'},
                {name: 'id_plan_cuenta_at', type: 'numeric'},
                {name: 'id_moneda', type: 'numeric'},
                {name: 'tipo', type: 'string'},
                {name: 'monto', type: 'numeric'},
                {name: 'concepto', type: 'string'},
                {name: 'id_usuario_reg', type: 'numeric'},
                {name: 'fecha_reg', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'id_usuario_ai', type: 'numeric'},
                {name: 'usuario_ai', type: 'string'},
                {name: 'id_usuario_mod', type: 'numeric'},
                {name: 'fecha_mod', type: 'date', dateFormat: 'Y-m-d H:i:s.u'},
                {name: 'usr_reg', type: 'string'},
                {name: 'usr_mod', type: 'string'},
                {name: 'id_periodo', type: 'numeric'},
                {name: 'fecha', type: 'date', dateFormat: 'Y-m-d'},
                {name: 'validar', type: 'string'},
                {name: 'desc_condominio', type: 'string'},
                {name: 'desc_cuenta', type: 'string'},
                {name: 'desc_moneda', type: 'string'},
            ],
            sortInfo: {
                field: 'id_transacciones',
                direction: 'ASC'
            },
            bdel: true,
            bsave: false,
            fwidth: '60%',
            fheight: '30%',
            onButtonNew: function () {
                if (!this.validarFiltros()) {
                    alert('Especifique el año y el mes antes')
                } else {
                    Phx.vista.Transacciones.superclass.onButtonNew.call(this);//habilita el boton y se abre
                    this.Cmp.id_condominio.setValue(this.cmbCondominio.getValue());
                    this.Cmp.id_periodo.setValue(this.cmbPeriodo.getValue());
                }
            },
            onButtonAct: function () {
                this.store.baseParams.id_periodo = this.cmbPeriodo.getValue();
                this.store.baseParams.id_condominio = this.cmbCondominio.getValue();
                Phx.vista.Transacciones.superclass.onButtonAct.call(this);
            },
            capturaFiltros: function (combo, record, index) {
                if (this.validarFiltros()) {
                    this.store.baseParams.id_periodo = this.cmbPeriodo.getValue();
                    this.store.baseParams.id_condominio = this.cmbCondominio.getValue();
                    this.load({params: {start: 0, limit: this.tam_pag}})
                }
            },
            validarFiltros: function () {
                return !!(this.cmbGestion.validate() && this.cmbPeriodo.validate() && this.cmbCondominio.validate());
            },
            oncellclick: function (grid, rowIndex, columnIndex, e) {
                const record = this.store.getAt(rowIndex),
                    fieldName = grid.getColumnModel().getDataIndex(columnIndex); // Get field name
                if (fieldName === 'validar' /*&& fieldName.validar === 'no'*/) {
                    //    if (confirm("Esta seguro de validar la transaccion")) {
                    this.cambiarRevision(record);
                    //      }
                }
            },
            cambiarRevision: function (record) {
                Phx.CP.loadingShow();
                var d = record.data;
                Ext.Ajax.request({
                    url: '../../sis_condominio/control/Transacciones/cambiarRevision',
                    params: {
                        id_transacciones: d.id_transacciones
                    },
                    success: this.successRevision,
                    failure: this.conexionFailure,
                    timeout: this.timeout,
                    scope: this
                });
            },
            successRevision: function (resp) {
                Phx.CP.loadingHide();
                var reg = Ext.util.JSON.decode(Ext.util.Format.trim(resp.responseText));
                this.load({params: {start: 0, limit: this.tam_pag}})
            },
            cmbGestion: new Ext.form.ComboBox({
                fieldLabel: 'Gestion',
                allowBlank: false,
                emptyText: 'Gestion...',
                blankText: 'Año',
                grupo: [0, 1, 2, 3, 4],
                store: new Ext.data.JsonStore(
                    {
                        url: '../../sis_parametros/control/Gestion/listarGestion',
                        id: 'id_gestion',
                        root: 'datos',
                        sortInfo: {
                            field: 'gestion',
                            direction: 'DESC'
                        },
                        totalProperty: 'total',
                        fields: ['id_gestion', 'gestion'],
                        // turn on remote sorting
                        remoteSort: true,
                        baseParams: {par_filtro: 'gestion'}
                    }),
                valueField: 'id_gestion',
                triggerAction: 'all',
                displayField: 'gestion',
                hiddenName: 'id_gestion',
                mode: 'remote',
                pageSize: 50,
                queryDelay: 500,
                listWidth: '280',
                width: 80
            }),
            cmbPeriodo: new Ext.form.ComboBox({
                fieldLabel: 'Periodo',
                allowBlank: false,
                blankText: 'Mes',
                emptyText: 'Periodo...',
                grupo: [0, 1, 2, 3, 4],
                store: new Ext.data.JsonStore(
                    {
                        url: '../../sis_parametros/control/Periodo/listarPeriodo',
                        id: 'id_periodo',
                        root: 'datos',
                        sortInfo: {
                            field: 'periodo',
                            direction: 'ASC'
                        },
                        totalProperty: 'total',
                        fields: ['id_periodo', 'periodo', 'id_gestion', 'literal'],
                        // turn on remote sorting
                        remoteSort: true,
                        baseParams: {par_filtro: 'gestion'}
                    }),
                valueField: 'id_periodo',
                triggerAction: 'all',
                displayField: 'literal',
                hiddenName: 'id_periodo',
                mode: 'remote',
                pageSize: 50,
                disabled: true,
                queryDelay: 500,
                listWidth: '280',
                width: 80
            }),
            cmbCondominio: new Ext.form.ComboBox({
                fieldLabel: 'Condominio',
                allowBlank: false,
                emptyText: 'Seleccione un condominio...',
                blankText: 'Condominio',
                grupo: [0, 1, 2, 3, 4],
                store: new Ext.data.JsonStore({
                    url: '../../sis_condominio/control/Condominio/listarCondominio',
                    id: 'id_condominio',
                    root: 'datos',
                    sortInfo: {
                        field: 'nombre',
                        direction: 'ASC'
                    },
                    totalProperty: 'total',
                    fields: ['id_condominio', 'codigo', 'nombre', 'direccion'],
                    remoteSort: true,
                    baseParams: {par_filtro: 'con.nombre'}
                }),
                valueField: 'id_condominio',
                triggerAction: 'all',
                displayField: 'nombre',
                hiddenName: 'id_condominio',
                mode: 'remote',
                pageSize: 50,
                disabled: true,
                queryDelay: 500,
                listWidth: '280',
                width: 280
            }),
        }
    )
</script>
        
        